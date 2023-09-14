
@extends('frontend.layouts.master')

@section('title-content') إتصل بنا - هاى تك للتقسيط @endsection

@section('home-content')


    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url({{ asset('frontend/images/page_slider/slider.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white"> إتصل بنا </h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>إتصل بنا </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Contact Form -->
        <div class="section-full content-inner contact-page-8 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-location-pin"></i></span>
                                            عنوان الشركة
                                        </h5>
                                        <p>{!!   $settings->address !!} </p>
                                        <h6 class="m-b15 text-black font-weight-400"><i class="ti-alarm-clock"></i> ساعات العمل</h6>
                                        <p class="m-b0">السبت الى الخميس  12 صباحاً الى 10 مساءً</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-email"></i></span>
                                            البريد الالكترونى
                                        </h5>
                                        <p class="m-b0">{{ $settings->email }}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 m-b30">
                                <div class="icon-bx-wraper expertise bx-style-1 p-a20 radius-sm">
                                    <div class="icon-content">
                                        <h5 class="dlab-tilte">
                                            <span class="icon-sm text-primary"><i class="ti-mobile"></i></span>
                                            التليفون
                                        </h5>
                                        <p class="m-b0">{!!  $settings->phone !!}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 m-b30">
                        <form class="inquiry-form wow fadeInUp" data-wow-delay="0.2s" action="{{ route('store.message') }}" method="post">
                            @csrf
                            <h3 class="title-box font-weight-300 m-t0 m-b10">لا تتردد فى ارسالة استفسارك <span class="bg-primary"></span></h3>
                            <p> فى حالة الاستفسار او الاستعلام عن خدمات التقسيط لدينا. أو لديك شكوى ما . قم بالتواصل معنا  وسيقوم خدمة العملاء بالرد على إستفسارك او شكواك.</p>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-user text-primary"></i></span>
                                            <input name="name" type="text" required class="form-control" placeholder="الاسم بالكامل"
                                           @auth() value="{{ Auth::user()->name }}"  @endauth >
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-mobile text-primary"></i></span>
                                            <input name="phone" type="text" required class="form-control" placeholder="رقم التليفون"
                                                   @auth() value="{{ Auth::user()->phone }}"  @endauth >
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-email text-primary"></i></span>
                                            <input name="email" type="email" class="form-control" required  placeholder="البريد الالكترونى إن وجد"
                                                   @auth() value="{{ Auth::user()->email }}"  @endauth >
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-check-box text-primary"></i></span>
                                            <input name="subject" type="text" required class="form-control" placeholder="عنوان الرسالة">
                                        </div>
                                        @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ti-agenda text-primary"></i></span>
                                            <textarea name="message" rows="4" class="form-control" required placeholder="موضوع الاستفسار او الشكوى"></textarea>
                                        </div>
                                        @error('message')
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button name="submit" type="submit" value="Submit" class="site-button button-md"> <span>Send Message</span> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form END -->
    </div>
    <!-- Content END-->












@endsection
