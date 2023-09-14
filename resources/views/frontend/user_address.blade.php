@php

$id = Auth::id();
$lang= app()->getLocale();



@endphp



@extends('frontend.layouts.master')
@section('title-content')  عنوانى - هاى تك للتقسيط @endsection

@section('home-content')




    <div class="page-content bg-white">

        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white"> عنوانى</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li> عنوانى</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="{{ route('dashboard') }}" class="list-group-item">{{ __('site.account_details') }}</a>
                            <a href="{{ route('user.order') }}" class="list-group-item">{{ __('site.my_orders') }}</a>
                            <a href="{{ route('user.wishlist') }}" class="list-group-item">{{ __('site.my_wishlist') }}</a>
                            <a href="{{ route('user.subscriber') }}" class="list-group-item ">{{ __('site.newsletter') }}</a>
                            <a href="#" class="list-group-item active">{{ __('site.my_addresses') }}</a>
                            <a href="{{ route('user.update.password') }}" class="list-group-item ">{{ __('site.change_password') }}</a>
                            <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <br>
                        <h2 class="mb-3">{{ __('site.my_addresses') }}</h2>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>{{ Auth::user()->name }}</h3>
                                        <p>{{ Auth::user()->email }}

                                            <br> {{ (Auth::user()->phone) ? Auth::user()->phone : 'لايوجد رقم تليفون' }}
                                            <br> {{ (Auth::user()->address) ? Auth::user()->address : 'لا يوجد عنوان'}}
                                            <br>{{ (Auth::user()->city) ? Auth::user()->city : ' لايوجد مدينة'}}

                                        </p>

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

