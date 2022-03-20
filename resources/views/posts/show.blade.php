@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                @if (session('status'))
                <div>
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                </div>
                @endif

                @if (session('error-status'))
                <div>
                    <h6 class="alert alert-danger">{{ session('error-status') }}</h6>
                </div>
                @enderror
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center">
                            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                            <div class="d-flex flex-column ml-2">
                                <span><strong>Author</strong> : {{ $post->author }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis">
                            <small class="mr-2">{{ date("D, d M Y H:i", strtotime($post->created_at)) }}</small>
                            @auth
                            @if($post->user_id == Auth::id())
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <form id="post-delete-form" action="{{ route('posts.destroy' , ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="ml-1" href="javascript:{}" onclick="$('#post-delete-form').submit();"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </form>
                            @endif
                            @else
                            <i title="Please login/register to update or delete" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            @endauth
                        </div>
                    </div>
                    <div class="p-2">
                        <span><strong>Title</strong> : <p>{{ $post->title }}</p></span>
                    </div>
                    <div class="p-2">
                        <p class="text-justify"><strong>Description</strong> : {{ $post->description }}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row icons d-flex align-items-center"></div>
                            <div class="d-flex flex-row muted-color"> <span>@if(!empty($comments)) {{ count($comments) }} @else 0 @endif comments</span> </div>
                        </div>
                        <hr>
                        <div class="comments">
                            @if(!empty($comments))
                            @foreach($comments as $c_k => $c_v)
                            <div class="d-flex flex-row mb-2">
                                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" width="40" class="rounded-image">
                                <div class="d-flex flex-column ml-2">
                                    <span class="name">{{ $c_v['user']['name'] }}</span>
                                    <small class="comment-text">{{ $c_v['comment'] }}</small>
                                    <div class="d-flex flex-row align-items-center status">
                                        <small>{{ date("D, d M Y H:i", strtotime($c_v['created_at'])) }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                            <div class="comment-input">
                                <form id="post-comment-form" action="{{ route('comment.store') }}" method="POST">
                                    <input type="text" class="form-control" id="comment" name="comment" value="" placeholder="Add a comment">
                                    <div class="fonts">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        <a href="javascript:{}" onclick="$('#post-comment-form').submit();"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-primary mt10" href="{{ url()->previous() }}">Back</a>
    </div>
</div>
</div>
@endsection