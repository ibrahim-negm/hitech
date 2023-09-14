@php

    $lang= app()->getLocale();
@endphp
@extends('frontend.layouts.app')
@section('title-content') Kidzoo store - {{ __('site.forget_your_password_title') }} @endsection
@section('home-content')

    <div class="page-content">

        <!-- START SECTION BREADCRUMB -->
        <div class="holder breadcrumbs-wrap mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ url('/') }}" >{{ __('site.home') }}</a></li>
                    <li><span>{{ __('site.forget_your_password_title') }}</span></li>
                    @if($lang == 'ar')
                        <li></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END SECTION BREADCRUMB -->

        <!-- START MAIN CONTENT -->
        <div class="holder">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-18 col-lg-12">
                        <h2 class="text-center">{{ __('site.forget_your_password_title') }}</h2>
                        <p class="h-sub maxW-825 mr-1 ml-1">{{ __('site.forget_your_password_summary') }}</p>
                        @if (session('status'))
                            <p class="h-sub maxW-825 mr-1 ml-1" style="color: maroon;">
                                {{ __('site.forget_your_password_reply') }}
                            </p>
                        @endif
                        <p class="text-center"> <x-jet-validation-errors class="mb-4" style="color: maroon;" /></p>
                        <div class="form-wrapper">

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group">
                                    <input type="email" class="form-control " name="email" placeholder="{{__('site.email') }}" required>
                                </div>


                                <div class="text-center ">
                                    <button class="btn" type="submit">{{ __('site.sent') }}</button>
                                </div>

                            </form>
                            <hr width="50%">

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection