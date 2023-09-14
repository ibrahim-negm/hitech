@php
    $seo =\App\Models\Admin\Seo::first();
    $settings = \App\Models\Admin\Setting::first();
    $lang= app()->getLocale();
@endphp

@extends('frontend.layouts.master')
@section('title-content') الدخول الى الحساب - هاى تك للتقسيط@stop
@section('home-content')



    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">الدخول الى الحساب</h2>

                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>الدخول الى الحساب</li>
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
                        <h2 class="font-weight-700 m-t0 m-b40">عندك حساب؟</h2>
                    </div>
                </div>
                <div class="row dzseth">
                    <div class="col-lg-6 col-md-6 m-b30">
                        <div class="p-a30 border-1 seth">
                            <div class="tab-content">
                                <h4 class="font-weight-700">عميل جديد</h4>
                                <p class="font-weight-600">عندما يتم تسجيلك فانك ستتمتع بخدمات هاى تك للتقسيط. وستتابع اخر التحديثات فى المنصة. وسيمكن عن طريق التسجيل اضافة تعليقاتك على الاخبار أو رأيك على المنتجات </p>
                                <a class="site-button m-r5 button-lg radius-no" href="{{route('register')}}">إنشاء حساب</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 m-b30">
                        <div class="p-a30 border-1 seth">
                            <div class="tab-content nav">
                                <form id="login" class="tab-pane active col-12 p-a0 " action="{{ route('login') }}" method="post">
                                    @csrf
                                    <h4 class="font-weight-700">الدخول الى الحساب</h4>
                                    @include('alerts.success')
                                    @include('alerts.errors')
                                    @if (session('status'))
                                        <p class="font-weight-600" style="color: maroon;">
                                            تم إرسال رسالة الى بريدك الالكترونى لاستعادة كلمة المرور .
                                        </p>
                                    @else
                                        <p class="font-weight-600">إذا كنت تملك حساب لدينا، قم بالدخول الان.</p>
                                    @endif

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
                                    <div class="text-left text-center mt-3">
                                        <button class="site-button button-lg radius-no">سجل دخول</button>
                                        <br>
                                        <a data-toggle="tab" href="#forgot-password" class="float-left mt-3" ><i class="fa fa-unlock-alt mr-1"> </i>نسيت كلمة السر  </a>

                                    </div>
                                </form>

                                <form id="forgot-password" class="tab-pane fade  col-12 p-a0" method="POST" action="{{ route('password.email') }}" >
                                    @csrf
                                    <h4 class="font-weight-700">هل نسيت كلمة المرور؟</h4>

                                @if (session('status'))
                                        <p class="font-weight-600" style="color: maroon;">
                                            تم إرسال رسالة الى بريدك الالكترونى لاستعادة كلمة المرور .
                                        </p>
                                        @else
                                        <p class="font-weight-600">سوف نرسل لك رسالة على بريدك الالكترونى لاستعادة  كلمة المرور </p>
                                    @endif
                                    {{--<p class="font-weight-600"><x-jet-validation-errors class="mb-4" style="color: maroon;" /> </p>--}}
                                    @include('alerts.success')
                                    @include('alerts.errors')
                                    <div class="form-group">
                                        <label class="font-weight-700">البريد الالكترونى *</label>
                                        <input name="email" required="" class="form-control" placeholder="أكتب البريد الالكترونى" type="email">
                                    </div>
                                    <div class="text-left mt-3">
                                        <button class="site-button button-lg radius-no">إرسل</button>
                                        <a class="site-button pull-right outline gray button-lg radius-no" data-toggle="tab" href="#login">العودة</a>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i class="fa fa-circle bg-white text-gray-dark"></i></div>                                <div class="text-center">
                                <p class="font-weight-400">او الدخول بإستخدام</p>
                                    <a href="{{ url('auth/facebook')  }}" class="btn btn-info mb-2" >   <i class="fa fa-facebook">  </i> Facebook </a>
                                    <a href="{{ url('auth/google') }}" class="btn btn-danger mb-2"  ><i class="fa fa-google"> </i> Google &nbsp; </a>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </div>


    </div>





@endsection