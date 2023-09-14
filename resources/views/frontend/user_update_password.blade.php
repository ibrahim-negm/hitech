@php

$id = Auth::id();

@endphp



@extends('frontend.layouts.master')
@section('title-content')  تغيير كلمة المرور - هاى تك للتقسيط @endsection

@section('home-content')




    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">تغيير كلمة المرور </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>تغيير كلمة المرور </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>


        <div class="content-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="list-group">
                            <a href="{{ route('dashboard') }}" class="list-group-item">{{ __('site.account_details') }}</a>
                            <a href="{{ route('user.order') }}" class="list-group-item">{{ __('site.my_orders') }}</a>
                            <a href="{{ route('user.wishlist') }}" class="list-group-item">{{ __('site.my_wishlist') }}</a>
                            <a href="{{ route('user.subscriber') }}" class="list-group-item ">{{ __('site.newsletter') }}</a>
                            <a href="{{ route('user.address') }}" class="list-group-item ">{{ __('site.my_addresses') }}</a>
                            <a href="#" class="list-group-item active">{{ __('site.change_password') }}</a>
                            <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <br>
                        <h2 class="mb-3">{{ __('site.change_password') }}</h2>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('user-password.update') }}">
                                            @csrf
                                                <div class="row mt-2">
                                                    <div class="col-sm-12">
                                                        <label class="text-uppercase">{{ __('site.current_password') }} : <span class="required"> *</span></label>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control form-control-sm" name="current_password" required>

                                                            @error('current_password')
                                                            <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-2">
                                                    <div class="col-sm-12">
                                                        <label class="text-uppercase">{{ __('site.new_password') }} : <span class="required"> *</span></label>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control form-control-sm" name="password" required>

                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-sm-12">
                                                        <label class="text-uppercase">{{ __('site.confirmation_password') }} : <span class="required"> *</span></label>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control form-control-sm" name="password_confirmation" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-info">{{ __('site.update') }}</button>
                                                    <button type="reset" class="btn btn-danger" data-form="#updateDetails">{{ __('site.cancel') }}</button>
                                                </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- END MAIN CONTENT -->




@endsection

