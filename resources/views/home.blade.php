@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group text-right">
                <li class="list-group-item" style="background-color:#343A40; color: white;">همه‌ی پست‌های شما</li>
                @foreach($posts as $index=>$post)
                <li class="list-group-item">
                    <div class="row post text-right mr-0 ml-0">
                        <div class="col-12 post-body">
                            <h2>
                                <a href="{{ $post->link }}" class="" target="_blank">
                                    <span class="text-secondary number">
                                        {{ num_to_fa($index + 1) }}
                                    </span>
                                    . {{ $post->title }}
                                </a>
                                <span class="text-secondary link"><a
                                        href="{{ route('show_post', ['post' => $post]) }}">(نمایش)</a></span>
                            </h2>
                            <h3 class="text-secondary">
                                امتیاز:
                                {{ num_to_fa($post->getPointsAttribute()) }}
                                |
                                {{ num_to_fa(\Morilog\Jalali\Jalalian::forge($post->created_at)->ago()) }}
                                | {{ num_to_fa($post->comments_count) }}
                                <a class="text-secondary" href="{{route('show_post',['post'=>$post])}}">
                                    {{ __("general.Comment") }}</a>
                            </h3>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection