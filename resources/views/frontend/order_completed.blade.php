<?php
$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')

@section('title-content')  هاى تك للتقسيط - نجاح الطلب  @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">نجاح الطلب </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>نجاح الطلب  </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <h2 class="text-center">تم إرسال طلبك بنجاح</h2>
                <div class="text-center">
                    <p class=" mr-2 ml-2">
                        ستقوم الادارة بالتواصل مع مقدم الطلب وزيارته للتحقق من جدية التعاقد وطلب الاوراق التالية :
                        <br>
                        مطلوب صورة البطاقه الشخصيه للمشتري والضامن وايصال خدمات حديث
                        (كهرباء او غاز) - تكلفة طلب الاستعلام 50 جنيها.

                    </p>
                    <br> <a href="{{url('/')}}" class="btn btn-success">الاستمرار فى التسوق</a>
                </div>

            </div>
        </div>
        <br>

    </div>



    <br><br>



@endsection