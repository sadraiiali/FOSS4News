@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @isset($error)
                <div class="col-md-8 alert alert-danger text-right" role="alert">
                    متاسفانه مشکلی وجود دارد.
                </div>
            @endisset
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('general.Report Post') }}
                        <span class="badge badge-secondary">#{{$post->uri}}</span></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create_post_report',['post'=> $post]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="reason" class="col-md-4 col-form-label text-md-right input-group-append">
                                    {{ __('general.Report Reason') }}
                                </label>

                                <div class="col-md-6">
                                    <select id="reason" type="text" dir="auto"
                                            class="form-control custom-select @error('reason') is-invalid @enderror"
                                            name="reason"
                                            required autofocus>
                                        <option selected>یک دلیل انتخاب کنید ...</option>
                                        <option value="ABUSE">سو‌استفاده از پلتفورم</option>
                                        <option value="SPAM">اسپم کردن</option>
                                        <option value="PORN">غیر اخلاقی بودن</option>
                                        <option value="OTHER">سایر</option>

                                    </select>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Report Reason Body') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="body" type="text" dir="auto"
                                              class="form-control @error('body') is-invalid @enderror" name="body"
                                              autofocus> </textarea>

                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="row justify-content-end pl-0">
                                    <div class="form-group mb-0 col-md-8 pl-1">
                                        <button type="submit" class="btn btn-primary">
                                            {{__('general.Send')}}

                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
