@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="col-md-8">
        <h6 class="alert alert-success">{{ session('status') }}</h6>
    </div>
    @endif

    @if (session('error-status'))
    <div class="col-md-8">
        <h6 class="alert alert-danger">{{ session('error-status') }}</h6>
    </div>
    @enderror
    <div class="row">
        <div class="col-md-8">
            <div class="marginleft-9">
                <form class="form-inline" method="GET">
                    <div class="input-group md-form form-sm form-1 pl-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fa fa-search text-white" aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control my-0 py-1 tags-filter" type="text" id="filter" name="filter" placeholder="Search post using tags" aria-label="Search" value="{{$filter}}">
                    </div>
                    <button class="btn" type="submit" class="btn btn-default mb-2">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        @if(!empty($posts))
        @foreach($posts as $key => $value)
        <div class="col-md-8">
            <div class="media g-mb-30 media-comment posts-div">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                    <div class="g-mb-15">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $value['author']}}</h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">{{ date("D, d M Y H:i", strtotime($value['created_at'])) }}</span>
                    </div>

                    <p>{{ $value['title'] }}</p>

                    <ul class="list-inline d-sm-flex my-0">
                        <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                <i class="fa fa-comments g-pos-rel g-top-1 g-mr-3"></i>
                                {{ $value['comment_count'] }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('posts.show', ['post' => $value['id']]) }}">
                <span class="post-link"></span>
            </a>
        </div>
        @endforeach
        @endif
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="marginleft-9">
                <p>
                    Displaying {{$posts->count()}} of {{ $posts->total() }} post(s).
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="float-right">
                {{ $posts->appends(Request::except('page')) }}
            </div>
        </div>
    </div>
</div>
@endsection