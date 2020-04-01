@extends('admin.layout')

@section('content-admin')
    <div class="row  mb-4 m-0 px-3 justify-content-center">
        <div class="card m-1 border-danger">
            <div class="card-header">تعداد کل ریپوت‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($all_reports_count)}}</span>
            </div>
        </div>

        <div class="card m-1 border-primary">
            <a href="{{route('admin.reports.post')}}">
                <div class="card-header text-dark">پست‌ها</div>
            </a>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($post_reports_count)}}</span>
            </div>
        </div>
        <div class="card m-1 border-dark">
            <div class="card-header">پاک شده‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($trashed_reports_count)}}</span>
            </div>
        </div>
    </div>
@endsection
