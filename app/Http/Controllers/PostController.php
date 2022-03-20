<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $posts = Post::orderbyDesc('created_at')->withCount('comment')
                ->where('tags', 'like', '%' . $filter . '%')
                ->paginate(2);
        } else {
            $posts = Post::orderbyDesc('created_at')->withCount('comment')->paginate(2);
        }

        return view('posts.index', compact('posts', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $validated['title'];
        $post->author = $validated['author'];
        $post->description = $validated['description'];
        $post->tags = $validated['tags'];
        $post->save();
        return redirect('posts')->with('status', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post'  => Post::where('id', $id)->first(),
            'comments' => Comment::where('post_id', $id)
                ->with('user', function ($q) {
                    $q->select('id', 'name');
                })->orderbyDesc('created_at')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'post'  => Post::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $post = Post::find($id);
        if ($post->user_id == Auth::id()) {
            $post->title = $validated['title'];
            $post->author = $validated['author'];
            $post->description = $validated['description'];
            $post->tags = $validated['tags'];
            $post->save();
            return redirect('posts')->with('status', 'Post Update Successfully');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id)) {
            $post = Post::where('id', '=', $id)->withCount('comment')->first();
            if ($post->comment_count == 0) {
                $post->delete();
                return redirect('posts')->with('status', 'Successfully deleted post');
            }
            return redirect()->back()->with('error-status', 'You can\'t delete the post if have comments on it');
        }
        return redirect()->back()->with('error-status', 'Unable deleted post');
    }
}
