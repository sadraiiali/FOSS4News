@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible text-center fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mx-0 mb-4" style="margin-top: -1.5rem">
        <div class="col-12 py-3 bg-primary text-white mt-0">
            <h4 class="text-center mb-0">
                «<a href="http://{{ $siteName }}" class="text-white" target="_blank">{{ $siteName }}</a>»
            </h4>
        </div>
    </div>

    @foreach($posts as $index=>$post)
        <div class="row post text-right mr-0 ml-0">
            <div class="col-12 post-body">
                <h2>
                    <a href="{{ $post->link }}" target="_blank" class="">
                        <span class="text-secondary number">
                        {{ num_to_fa($index+1) }}
                        </span>
                        . {{ $post->title }}
                    </a>
                    <span class="text-secondary link">({{ $post -> site -> domain }})</span>
                </h2>
                <h3 class="text-secondary">
                    {{ num_to_fa($post->getPointsAttribute()) }}
                    <a href="{{ route('post.vote', ['post'=>$post, 1]) }}">🔺</a>
                    <a href="{{ route('post.vote', ['post'=>$post, 0]) }}">🔻</a>
                    | نوشته {{ $post->user->name }} در
                    {{ num_to_fa(\Morilog\Jalali\Jalalian::forge($post->created_at)->ago()) }}
                    | {{ num_to_fa($post->comments_count) }}
                    <a class="text-secondary"
                       href="{{route('show_post',['post'=>$post])}}">
                        {{__('general.Comment')}}</a> |
                    <a class="text-secondary"
                       href="{{ route('post_report',['post'=>$post])}}">
                        گزارش
                    </a>
                </h3>
            </div>
        </div>
    @endforeach
    @if(! $is_end)
        <div class="row more ml-0">
            <a href="?page={{ $page +1 }}"><h2 class="text-secondary">بیشتر</h2></a>
        </div>
    @elseif($page != 1 && sizeof($posts)!=0)
        <div class="row more ml-0">
            <h2 class="text-secondary">شما تمام صفحات را دیدید :) <span>(<a href="?page=1">صغحه اول</a>)</span></h2>
        </div>
    @elseif(sizeof($posts)==0)
        <div class="row more ml-0">
            <h2 class="text-secondary">¯\_( ͡° ͜ʖ ͡°)_/¯ پستی نبود!</h2>
        </div>
    @endif
@endsection
