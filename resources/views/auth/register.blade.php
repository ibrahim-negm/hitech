@php
    $seo =\App\Models\Admin\Seo::first();
    $settings = \App\Models\Admin\Setting::first();
    $lang= app()->getLocale();
@endphp

@extends('frontend.layouts.master')
@section('title-content') تسجيل جديد - هاى تك للتقسيط @endsection
@section('home-content')


    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white"> تسجيل جديد</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li> تسجيل جديد</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="font-weight-700 m-t0 m-b40">إنشاء حساب جديد</h2>
                        {{--<p class="text-center"> <x-jet-validation-errors class="mb-4" style="color: maroon;" /></p>--}}
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b30">
                        <div class="p-a30 border-1  max-w500 m-auto">
                            <div class="tab-content">
                                <form id="login" class="tab-pane active" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <h4 class="font-weight-700">المعلومات الشخصية</h4>
                                    {{--<p class="font-weight-600"><x-jet-validation-errors class="mb-4" style="color: maroon;" /></p>--}}
                                    @include('alerts.success')
                                    @include('alerts.errors')
                                    <div class="form-group">
                                        <label class="font-weight-700">الاسم بالكامل *</label>
                                        <input name="name" required="" class="form-control" placeholder="الاسم بالكامل" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">البريد الالكترونى *</label>
                                        <input name="email" required="" class="form-control" placeholder="أكتب البريد الالكترونى" type="email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">كلمة المرور *</label>
                                        <input name="password" required="" class="form-control " placeholder="اكتب كلمة المرور" type="password">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">تأكيد كلمة المرور *</label>
                                        <input name="password_confirmation" required="" class="form-control " placeholder="اكتب كلمة المرور مرة ثانية" type="password">
                                    </div>

                                    <div class="text-left m-t15 text-center">
                                        <button type="submit" class="site-button button-lg radius-no outline outline-2">إنشاء حساب</button>
                                    </div>
                                </form>
                                <br>
                                <div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i class="fa fa-circle bg-white text-gray-dark"></i></div>                                <div class="text-center">
                                    <p class="font-weight-400">او الدخول بإستخدام</p>
                                    <a href="{{ url('auth/facebook')  }}" class="btn btn-info mb-2" >   <i class="fa fa-facebook">  </i> Facebook </a>
                                    <a href="{{ url('auth/google') }}" class="btn btn-danger  mb-2" ><i class="fa fa-google"> </i> Google &nbsp; </a>
                                </div>
                                <br>
                                <div class="form-note text-center">هل تمتلك حساب؟ <a href="{{route('login')}}">أذخل الان</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </div>

    </div>
    <!-- Content END-->



@endsection

