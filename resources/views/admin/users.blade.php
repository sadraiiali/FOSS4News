@extends('admin.layout')
@section('content-admin')
    <div class="row  mb-4 m-0 px-3 justify-content-center">
        <div class="card m-1 border-success">
            <div class="card-header">ادمین‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($admins_count)}}</span>
            </div>
        </div>
        <div class="card m-1 border-primary">
            <div class="card-header">تعداد کل</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{ num_to_fa($users_count) }}</span>
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
        @foreach($users as $user)
            <div class="card m-1 {{ ($user->role=='ADMIN')? 'border-success':'border-primary' }}"
                 style="min-width: 100px;">
                <div class="card-header text-center">
                    {{$user->name}}
                </div>
                <div class="card-body px-1 p-0 justify-content-center row">
                    <a href="{{route('admin.users.delete',['user'=>$user])}}" class="text-danger pl-1 pr-1">حذف</a>
{{--                    <a href="" class="text-secondary pl-1 pr-1">گزارشات</a>--}}
                    @if($user->role!='ADMIN')
                        <a href="{{route('admin.users.make_admin',['user'=>$user])}}"
                           class="text-dark pl-1 pr-1">ارتقا</a>
                    @endif

                </div>
            </div>

        @endforeach

    </div>


@endsection
