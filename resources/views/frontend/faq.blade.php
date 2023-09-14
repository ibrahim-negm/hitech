
<?php
$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')

@section('title-content') مكتب المساعدة - هاى تك للتسويق @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('frontend/images/page_slider/slider.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">مكتب المساعدة </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>مكتب المساعدة </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="content-block">
            <!-- Your Faq -->
            <div class="section-full overlay-white-middle content-inner" style="background-image:url('{{ asset('frontend/images/background/bg.jpg') }}');">
                <div class="container">
                    <div class="section-head text-black text-center">
                        <h3 class="title">الاسئلة الشائعة؟</h3>
                        <p>
                            نتطرق هنا الى الاسئلة الشائعة عن التقسيط وشروطه . واذا احتجت ان تسأل عن شىء اخر، لاتترد فى
                            <a href="{{ route('contact.us') }}" style="color: maroon; "> <strong>الاتصال بنا</strong></a> للرد على اى استفسار.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 m-b30">
                            <div class="faq-video">
                                <a class="play-btn popup-youtube" href="{{ $settings->youtube }}">
                                    <i class="flaticon-play-button text-primary"></i></a>
                                <img src="{{ asset('frontend/images/about/hitech_logo.jpg') }}" alt="hitech_logo" id="condition" class="img-cover radius-sm"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 m-b30" >
                            <div class="dlab-accordion faq-1 box-sort-in m-b30" id="accordion1">
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title">
                                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#faq1" class="collapsed" aria-expanded="true">
                                                1. ماهى شروط التقسيط؟</a> </h6>
                                    </div>
                                    <div id="faq1" class="acod-body collapse" data-parent="#accordion1">
                                        <div class="acod-content">ان يكون المشترى والضامن ذو أهلية وتجاوز الـ21 عام مصرى الجنسية.السكن الحالي تمليك او ايجار قديم للمشتري او الضامن.
                                            .

                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title">
                                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#faq2" class="collapsed" aria-expanded="false">
                                                2.الاوراق المطلوبه للتقسيط؟</a> </h6>
                                    </div>
                                    <div id="faq2" class="acod-body collapse" data-parent="#accordion1">
                                        <div class="acod-content">صورة بطاقة المشتري و الضامن و وصل غاز او كهرباء او عقد ملكية السكن.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title">
                                            <a href="javascript:void(0);" data-toggle="collapse"  data-target="#faq3" class="collapsed" aria-expanded="false">
                                               3.نطاق التقسيط؟ </a> </h6>
                                    </div>
                                    <div id="faq3" class="acod-body collapse"  data-parent="#accordion1">
                                        <div class="acod-content">
                                            داخل مدينة الإسماعيلية.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title">
                                            <a href="javascript:void(0);" data-toggle="collapse"  data-target="#faq4" class="collapsed" aria-expanded="false">
                                               4.نظام التقسيط؟ </a> </h6>
                                    </div>
                                    <div id="faq4" class="acod-body collapse" data-parent="#accordion1">
                                        <div class="acod-content">
                                            تقسيط مباشر بدون معاملات بنكية.
                                            </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title">
                                            <a href="javascript:void(0);" data-toggle="collapse"  data-target="#faq5" class="collapsed" aria-expanded="false">
                                                5.بنقسط ايه؟</a> </h6>
                                    </div>
                                    <div id="faq5" class="acod-body collapse" data-parent="#accordion1">
                                        <div class="acod-content">
                                            اجهزة كهربائية
                                            - موبايلات
                                            - ادوات منزلية
                                            - مفروشات
                                            - اثاث
                                            - مراتب
                                            - موتسيكلات
                                            - بلايستيشن
                                            - لاب توب
                                            - عجل
                                            - مكن خياطة.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Our Services -->
                    <div class="section-full bg-gray content-inner">
                        <div class="container">
                            <div class="section-head text-black text-center">
                                <h2 class="title">ليه تختار هاى تك </h2>
                                <p>شركة خبرة 25 عام فى مجال  بيع جميع ما يخص الاسرة المصرية من منتجات كهربائية ومنزليه ومفروشات وغيرها من المنتجات . تتميز الشركة فى سرعة الاجراءات وتنفيذ العملية الشرائية عن طريق التقسيط فى اقل وقت ممكن . بالاضافه الى جودة منتجاتها واسعارها التنافسية  وده اللى ادى الانتشار للشركة . الجودة والثقة والسرعة ده شعارنا دايما.</p>
                            </div>
                            <div class="section-content row">
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                                    <div class="icon-bx-wraper" data-name="01">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/experience.png') }}" alt="experience">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte"> الخبرة الكبيرة</h2>
                                            <p>شركة تعمل فى تقسيط المنتجات  من اكثر من 25 عام  مما زادها خبرة فى التعامل مع العملاء والسرعة فى تنفيذ التقسيط باسرع وقت ممكن. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                                    <div class="icon-bx-wraper" data-name="02">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/diving.png') }}" alt="diving">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte">السرعة فى التنفيذ</h2>
                                            <p> بمجرد ما يستوفى المشترى الشروط الخاصة بالتقسيط يتم تسليم المنتج فى الحال وقد لايتعدى ذلك الـ24 ساعة فقط لاغير.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                                    <div class="icon-bx-wraper" data-name="03">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/best-price.png') }}" alt="price">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte">أفضل الاسعار</h2>
                                            <p>وهنا كان حل المعادلة الصعبة ان الشركة تقدم خدمة التقسيط مع افضل الاسعار المناسبة للمشترى وده كانت نقطة الانطلاق لشركتنا. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.8s">
                                    <div class="icon-bx-wraper" data-name="04">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/review.png') }}" alt="review">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte"> جميع المنتجات </h2>
                                            <p>جميع المنتجات متوفرة نظرا لتعاقد الشركة مع كبار الموردين والتوكيلات لتوفيرها. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                                    <div class="icon-bx-wraper" data-name="05">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/plan.png') }}" alt="plan">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte"> جدولة الاقساط</h2>
                                            <p>ويتم ذلك مع مراعاة و مناقشة العميل فى قيمة القسط الشهرى مما يتيح له سهولة السداد.  </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-sm-12 service-box style3 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                                    <div class="icon-bx-wraper" data-name="06">
                                        <div class="icon-lg">
                                            <a href="javascript:void(0);" class="icon-cell">
                                                <img src="{{ asset('frontend/images/installment/friendly.png') }}" alt="friendly">
                                            </a>
                                        </div>
                                        <div class="icon-content">
                                            <h2 class="dlab-tilte">الضمان </h2>
                                            <p>جميع المنتجات شاملة الضمان ضد عيوب الصناعة والاسترجاع فى خلال 14 يوم.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Services End -->
                    <br>
                </div>
            </div>
            <!-- Your Faq End -->
        </div>
        <!-- contact area END -->
    </div>
    <!-- Content END-->

@endsection
