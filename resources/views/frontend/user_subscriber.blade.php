@php

$id = Auth::id();
$check_subscriber = \App\Models\Admin\Subscriber::where('email',Auth::user()->email)->first();

@endphp



@extends('frontend.layouts.master')
@section('title-content')  النشرة الاخبارية - هاى تك للتقسيط @endsection

@section('home-content')




    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">النشرة الاخبارية</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li>النشرة الاخبارية</li>
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
                            <a href="#" class="list-group-item active">{{ __('site.newsletter') }}</a>
                            <a href="{{ route('user.address') }}" class="list-group-item ">{{ __('site.my_addresses') }}</a>
                            <a href="{{ route('user.update.password') }}" class="list-group-item ">{{ __('site.change_password') }}</a>
                            <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <br>
                        <h2 class="mb-3">{{ __('site.newsletter') }}</h2>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        @if($check_subscriber)
                                            <h4> {{ __('site.subscribed_to') }},</h4>

                                        <a href="{{ url('delete/subscriber/'.Auth::user()->email) }}">
                                            <p>{{ __('site.unsubscriber') }}</p>
                                        </a>
                                        @else
                                            <h4> {{ __('site.not_subscribed_to') }},</h4>

                                        <a href="{{ url('subscribe/in/'.Auth::user()->email) }}">
                                       <p> {{ __('site.subscriber_now') }}</p>
                                        </a>
                                        @endif

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

