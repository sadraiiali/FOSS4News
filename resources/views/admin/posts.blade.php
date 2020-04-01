@extends('admin.layout')
@section('content-admin')
    <div class="row  mb-4 m-0 px-3 justify-content-center">
        <div class="card m-1 border-success">
            <div class="card-header">تعداد پست‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($posts_count)}}</span>
            </div>
        </div>
        <div class="card m-1 border-dark">
            <div class="card-header">پاک شده‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($trashed_count)}}</span>
            </div>
        </div>
    </div>

    @if($last_page !=1 )
        <div class="row justify-content-center">
            <nav>
                <ul class="pagination mb-4 m-0 p-0">
                    <li class="page-item">
                        <a class="page-link" href="?page={{($current_page > 1)? $current_page-1:'1'}}"
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
                        <a class="page-link" href="?page={{($current_page < $last_page)? $current_page+1:$last_page}}"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif

    <div class="row m-0 px-3 justify-content-center">
        @foreach($posts as $post)
            <div class="card m-1 {{ ($post->isTrashed())? 'border-dark': 'border-primary'}}"
                 style="min-width: 125px;">
                <div class="card-header text-center">

                    <a href="{{route('show_post',['post'=>$post])}}" class="text-center">
                        {{'#'.$post->uri}}
                    </a>
                    <br>
                    <span class="badge badge-secondary">{{num_to_fa($post->likes-$post->dislikes)}}</span>
                    <span class="badge badge-dark">{{num_to_fa($post->comments_count)}}</span>
                    <br>
                    <span class="badge badge-dark">{{$post->User->name}}</span>
                    <br>

                </div>

                @if(!$post->isTrashed())
                    <div class="card-body px-1 p-0 justify-content-center row">
                        <a href="{{route('admin.posts.delete',['post'=>$post])}}" class="text-danger pl-1 pr-1">حذف</a>
                        <a href="{{route('admin.reports.post_id', ['post'=>$post])}}" class="text-secondary pl-1 pr-1">گزارشات</a>
                    </div>
                @else
                    <div class="card-body px-1 p-0 bg-dark  text-center text-white justify-content-center">
                        <span>حذف شده</span>
                    </div>
                @endif

            </div>

        @endforeach

    </div>
@endsection
