@php
    $seo =\App\Models\Admin\Seo::first();
    $settings = \App\Models\Admin\Setting::first();
    $lang= app()->getLocale();
@endphp

@extends('frontend.layouts.master')
@section('title-content') أرسال طلب تقسيط - هاى تك للتقسيط@stop
@section('home-content')



    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">أرسال طلب تقسيط </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li> طلب تقسيط </li>
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
                        <h2 class="font-weight-700 m-t0 m-b40">أرسل طلب تقسيط ؟</h2>
                    </div>
                </div>
                <div class="row dzseth">
                    <div class="col-lg-12 col-md-12 m-b30">

                            <div class="request-form dezPlaceAni" >
                                <div class="request-form-header"  id="fast_offer">
                                    <i class="flaticon-message"></i>
                                    <p>لا تتردد في إرسال </p>
                                    <h2> طلب تقسيط عن منتج</h2>
                                </div>
                                <form  action="{{route('fast.payment.process')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>اسمك </label>
                                            <input name="name" type="text" required="" class="form-control" placeholder="">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>العنوان </label>
                                            <input name="address" type="text" required="" class="form-control" placeholder="">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>الهاتف </label>
                                            <input name="phone" type="text" required="" class="form-control" placeholder="">
                                            <small>الهاتف  11 رقم </small>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>المنتج المراد تقسيطه </label>
                                            <textarea class="form-control" name="notes" placeholder="" required></textarea>
                                            <small>اسم المنتج اكثر من 5 حروف</small>
                                            @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="site-button btnhover19 button-md btn-block" type="submit">طلب تقسيط </button>
                                    </div>
                                </form>
                            </div>
                        <br><br><br>

                    </div>

                </div>
            </div>
            <!-- Product END -->
        </div>


    </div>





@endsection