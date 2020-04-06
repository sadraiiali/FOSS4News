@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card ">
                    <div
                        class="card-header text-center bg-success text-white"> {{ __('general.Done Successful Title') }}</div>

                    <div class="card-body">
                        <p class="card-text text-right">{{__('general.Report Successful')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
