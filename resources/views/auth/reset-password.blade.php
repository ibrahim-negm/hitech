@php
    $seo =\App\Models\Admin\Seo::first();
    $settings = \App\Models\Admin\Setting::first();
    $lang= app()->getLocale();
@endphp

@extends('frontend.layouts.master')
@section('title-content') إستعادة كلمة المرور - هاى تك للتقسيط@stop
@section('home-content')



    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">إستعادة كلمة المرور</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>إستعادة كلمة المرور</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <!-- START MAIN CONTENT -->
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="font-weight-700 m-t0 m-b40">إستعادة كلمة المرور</h2>
                        {{--<p class="text-center"> <x-jet-validation-errors class="mb-4" style="color: maroon;" /></p>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b30">
                        <div class="p-a30 border-1  max-w500 m-auto">
                            <div class="tab-content">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">




                                    <div class="form-group">
                                        <label class="font-weight-700">البريد الالكترونى *</label>
                                        <input name="email" required="" class="form-control" placeholder="أكتب البريد الالكترونى" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">كلمة المرور *</label>
                                        <input name="password" required="" class="form-control " placeholder="اكتب كلمة المرور" type="password">
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">تأكيد كلمة المرور *</label>
                                        <input name="password_confirmation" required="" class="form-control " placeholder="اكتب كلمة المرور مرة ثانية" type="password">
                                    </div>

                                    <div class="text-left m-t15 text-center">
                                        <button type="submit" class="site-button button-lg radius-no outline outline-2">إستعادة كلمة المرور</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->

    </div>



@endsection
