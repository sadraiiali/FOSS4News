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
                    <div class="card-header text-center">{{ __('general.New Post Page Title') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create_post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Post Title') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="title" type="text" dir="auto"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Post Link') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="link" type="text" dir="auto"
                                           class="form-control @error('link') is-invalid @enderror" name="link"
                                           required autofocus>

                                    @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Post Body') }}
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
