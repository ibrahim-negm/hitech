<?php
$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')

@section('title-content')من نحن - هاى تك للتقسيط  @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">من نحن </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>من نحن  </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="content-block">
            <!-- About Services info -->
            <div class="section-full content-inner bg-white video-section">
                <div class="container">
                    <div class="section-content">
                        <div class="row d-flex">
                            <div class="col-lg-6 col-md-12 m-b30">
                                <div class="video-bx">
                                    <img src="{{ asset('frontend/images/about/hitech_logo.jpg') }}" alt="Signature">
                                    <div class="video-play-icon">
                                        <a href="{{ $settings->youtube }}" class="popup-youtube video bg-primary"><i class="fa fa-play"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 m-b30 align-self-center video-infobx">
                                <div class="content-bx1">
                                    <h2 class="m-b15 title" id="about">شركة متخصصة فى<br><span class="text-primary">تقسيط جميع المنتجات </span></h2>
                                    <p class="m-b30">
                                        أحدى شركات التقسيط التى تتميز بسرعة الاجراءات و جودة المنتج.
                                        خدمات التقسيط تشمل الاجهزه كهربائيه - الادوات منزليه - الموبايلات - الاثاث والموبيليا - الدراجات بخاريه - المراتب والمفروشات المنزلية - مكن الخياطة - أخرى.
                                        شركة خبرة 25 عام فى مجال بيع جميع ما يخص الاسرة المصرية من منتجات كهربائية ومنزليه ومفروشات وغيرها من المنتجات . تتميز الشركة فى سرعة الاجراءات وتنفيذ العملية الشرائية عن طريق التقسيط فى اقل وقت ممكن . بالاضافه الى جودة منتجاتها واسعارها التنافسية وده اللى ادى الانتشار للشركة . الجودة والثقة والسرعة ده شعارنا دايما.


                                    </p>
                                    <h4 class="m-b0">كابتن خالد الفنجرى</h4>
                                    <span class="font-14">رئيس مجلس الادارة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Services info END -->
            <!-- Counter -->
            <div class="section-full content-inner overlay-black-dark bg-img-fix" style="background-image:url({{ asset('frontend/images/page_slider/slider-1.jpg') }});">
                <div class="container">
                    <div class="section-content text-center text-white">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-5">
                                    <div class="">
                                        <span class="counter" @if($settings->products > 9999)style="font-size: 20px" @endif>{{ $settings->products }}</span>
                                    </div>
                                    <span class="counter-text"> عدد المنتجات</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-5">
                                    <div class="">
                                        <span class="counter" @if($settings->products > 9999)style="font-size: 20px" @endif>{{ $settings->clients }}</span>
                                    </div>
                                    <span class="counter-text">عدد العملاء</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-5">
                                    <div class="">
                                        <span class="counter" @if($settings->products > 9999)style="font-size: 20px" @endif>{{ $settings->branches }}</span>
                                    </div>
                                    <span class="counter-text">عدد الفروع</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
                                <div class="counter-style-5">
                                    <div class="">
                                        <span class="counter" @if($settings->products > 9999)style="font-size: 20px" @endif>{{ $settings->employees }}</span>
                                    </div>
                                    <span class="counter-text">عدد الموظغين</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Counter END -->
            <!-- Team Section -->
            {{--@if($employees)--}}
            {{--<div class="section-full text-center bg-gray content-inner">--}}
                {{--<div class="container">--}}
                    {{--<div class="section-head text-black text-center">--}}
                        {{--<h2 class="title">فريق العمل</h2>--}}
                        {{--<p> هنا ممكن تتواصل مع فريق العمل مباشرة لو حابب الاستفسار عن حاجة او عندك سؤال معين بخصوص التقسيط او شروطه.وده لاتاحة التواصل مع عملائنا طوال الـ24 ساعة على مدار اليوم.وده فرق كتير مع العملاء لسرعة الرد على استفسارتهم. ونحن فى خدمتكم باستمرار. </p>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--@foreach($employees as $employee)--}}
                        {{--<div class="col-lg-3 col-md-6 col-sm-6">--}}
                            {{--<div class="dlab-box m-b30 dlab-team1">--}}
                                {{--<div class="dlab-media">--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<img width="358" height="460" alt="" src="{{ asset($employee->image) }}">--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="dlab-info">--}}
                                    {{--<h4 class="dlab-title"><a href="javascript:;">{{ $employee->employee_name }}</a></h4>--}}
                                    {{--<span class="dlab-position">{{ $employee->position }}</span>--}}
                                    {{--<ul class="dlab-social-icon dez-border">--}}
                                        {{--@if($employee->facebook) <li><a href="{{ $employee->facebook }}" class="site-button-link facebook fa fa-facebook"></a></li> @endif--}}
                                        {{--@if($employee->twitter) <li><a href="{{ $employee->twitter }}" class="site-button-link twitter fa fa-twitter"></a></li>@endif--}}
                                        {{--@if($employee->instgram)<li><a href="{{ $employee->instgram }}" class="site-button-link instagram fa fa-instagram"></a></li>@endif--}}
                                        {{--@if($employee->whatsup) <li><a href="{{ $employee->whatsup }}" class="site-button-link whatsapp fa fa-whatsapp"></a></li>@endif--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}
            <!-- Team Section END -->

            <!-- Testimonials -->
            @if(count($comments)> 0)
            <div class="section-full content-inner-2 bg-white">
                <div class="container">
                    <div class="section-head text-black text-center">
                        <h2 class="title">أراء العملاء</h2>
                        <p>
                            ستجد أدناه بعض اراء العملاء بعد التعامل والشراء عن طريق التقسيط طرف شركتنا. هى رحلة ممتعة انك تشوف بعنيك نجاجنا بعيون عملائنا.
                        </p>
                    </div>
                    <div class="testimonial-six owl-loaded owl-theme owl-carousel owl-none dots-style-2">
                        @foreach($comments as $row)
                        <div class="item">
                            <div class="testimonial-8">
                                <div class="testimonial-text">
                                    <p style="word-wrap: break-word">{{ substr($row->description,0,100)}}</p>
                                </div>
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow">
                                        <img  src="{{ (!empty( $row->user->profile_photo_path))
                                                            ? url('upload/frontend/users/'.$row->user->profile_photo_path)
                                                            : url('upload/avatar.png')}}"  alt="" width="100" height="100">
                                    </div>
                                    <strong class="testimonial-name">{{ ($row->user != null) ?  $row->user->name :'غير معرف' }}  </strong> <span class="testimonial-position">عميل</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <!-- Testimonials END -->
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END -->


@endsection
