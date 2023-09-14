
@extends('frontend.layouts.master')

@section('title-content')  الصفحة غير موجودة - هاى تك للتقسيط @endsection

@section('home-content')


    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('frontend/images/page_slider/slider.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">الصفحة غير موجودة!!</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>الصفحة غير موجودة !!</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="content-block">
            <!-- Privacy Policy -->
            <div class="section-full content-inner inner-text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="text-center">
                                <div style="font-size: 100px">404</div>
                                <h5 class="mb-2 mb-sm-3">للاسف! هذه الصفحة المراد تصفحها غير موجوده!</h5>
                                <p>هذة الصفحة من الممكن ان  تكون غير موجوده فى الاساس, أوتم مسحها, او تم نقلها او لسبب اخر لايمكن الوصول اليها.</p>

                                <a href="{{ url('/') }}" class="btn btn-danger">الرجوع الى الرئيسية</a>

                            </div>


                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <!-- Privacy Policy END -->
        </div>
    </div>
    <!-- Content END-->
    <br> <br>

@endsection
