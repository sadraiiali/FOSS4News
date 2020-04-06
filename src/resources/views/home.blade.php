@extends('layouts.app') @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="list-group text-right">
                    <li class="list-group-item text-center" style="background-color:#343A40; color: white;">
                        همه‌ی پست‌های شما
                    </li>

                    @if($posts_count==0)
                        <li class="list-group-item">
                            <div class="row post text-right mr-0 ml-0">
                                <div class="col-12 post-body">
                                    <h2 class="pt-3 text-center">
                                        (╥﹏╥)
                                    </h2>
                                </div>
                            </div>
                        </li>
                    @else
                        <div class="row  my-4 m-0 px-3 justify-content-center">
                            <div class="card m-1 border-danger">
                                <div class="card-header">تعداد پست‌ها</div>
                                <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                                    <span class="text-danger pl-1 pr-1">{{num_to_fa($posts_count)}}</span>
                                </div>
                            </div>
                        </div>
                        @if($last_page !=1 )
                            <div class="row justify-content-center">
                                <nav>
                                    <ul class="pagination mb-4 m-0 p-0">
                                        <li class="page-item">
                                            <a class="page-link"
                                               href="?page={{($current_page > 1)? $current_page-1:'1'}}"
                                               aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @for($i=1 ; $i <= $last_page ; $i++)
                                            <li class="page-item {{($i == $current_page)? 'active':''}}">
                                                <a class="page-link" href="?page={{$i}}">{{num_to_fa($i)}}</a>
                                            </li>
                                        @endfor

                                        <li class="page-item">
                                            <a class="page-link"
                                               href="?page={{($current_page < $last_page)? $current_page+1:$last_page}}"
                                               aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    @endif
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
                                        <span class="text-secondary link"><a class="text-danger"
                                                                             href="{{ route('post.delete', ['post' => $post]) }}">(حذف)</a></span>
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
