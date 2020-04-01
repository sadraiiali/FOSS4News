@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <a href="{{ $post->link }}">
                        <div class="card-header text-center bg-secondary text-white">
                            {{ $post->title }}
                        </div>
                    </a>

                    <div class="card-body pt-1">
                        <div class="text-right mb-2 ">
                            <span class="badge badge-secondary">
                                    {{ $post->user->name }}
                            </span>
                            <span class="badge badge-secondary">
                                    {{ num_to_fa(\Morilog\Jalali\Jalalian::forge($post->created_at)->ago()) }}
                            </span>
                        </div>
                        <p class="card-text text-right">
                            {{ $post->body }}
                        </p>

                    </div>
                </div>
                <div class="row justify-content-start pr-4 pl-4 p-2 align-items-center">
                    <h3 class="m-0">نظرات</h3>
                    <button type="button" class="btn btn-secondary mr-auto " id="comment-btn">+</button>
                </div>

                <div class="card mb-2 d-none" id="comment_section">
                    <form class="card-body‌ text-right p-2" action="{{ route('post.comment',['post'=>$post]) }}"
                          method="post">
                        @csrf
                        <div class="input-group mb-1">
                            <textarea type="text" class="form-control" placeholder=""
                                      name="body"
                                      aria-label="" aria-describedby="send-commit">
                            </textarea>
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit" id="send-commit">
                                    بفرست
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if(sizeof($comments) == 0 )
                    <div class="card">
                        <div class="card-body‌ text-right p-2">
                            <div class="card-title m-0 text-center">
                                ¯\(°_o)/¯
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($comments as $comment)
                    <div class="card">
                        <div class="card-body‌ text-right p-2">
                            <div class="card-title">
                                <span class="badge badge-danger">
                                    {{ $comment->user->name }}
                                </span>
                                <span class="badge badge-secondary">
                                    {{ num_to_fa(\Morilog\Jalali\Jalalian::forge($comment->created_at)->ago()) }}
                                </span>
                            </div>
                            <h3 class='m-0'>
                                {{ $comment->body }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/show-post.js"></script>
@stop
