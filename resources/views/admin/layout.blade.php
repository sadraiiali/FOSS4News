@extends('layouts.app')
@section('content')

    <nav class="navbar navbar-light bg-primary justify-content-center mb-4" style="margin-top: -1.5rem">
        <a class="text-white pr-1 pl-1" href="{{ route('admin.users') }}">کاربران</a>
        <a class="text-white pr-1 pl-1" href="{{ route('admin.posts') }}">پست‌ها</a>
        <a class="text-white pr-1 pl-1" href="{{ route('admin.comments') }}">نظرات</a>
        <a class="text-white pr-1 pl-1" href="{{ route('admin.reports.all') }}">گزارشات</a>
    </nav>
    @yield('content-admin')
@endsection
