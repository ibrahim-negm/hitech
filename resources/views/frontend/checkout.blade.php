<?php
$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')

@section('title-content')  هاى تك للتقسيط - تنفيذ الطلب  @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">تنفيذ الطلب </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>تنفيذ الطلب  </li>
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

             <form class="shop-form" action="{{route('payment.process')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-md-6 m-b30">
                            <h4>بيانات طالب الاستعلام (المشترى)</h4>
                             <small><span class="text-danger"> * حقول مطلوبة</span> </small>
                            <div class="form-group">
                                <select name="city" required>
                                    <option label="اسم المحافظة الرئيسية" selected="" disabled=""></option>
                                    @foreach($governorates  as $gov)
                                        <option value="{{ $gov->governorate }}" @if($gov->id == $settings->city_shipping) selected @endif >{{ $gov->governorate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="الاسم بالكامل * "
                                           name="name" @auth value="{{ Auth::user()->name }}" @endauth required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                </div>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control @error('billing_address') is-invalid @enderror" placeholder="عنوان *"
                                name="billing_address" @auth value="{{ Auth::user()->address }}" @endauth required>
                                @error('billing_address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control @error('billing_address2') is-invalid @enderror" placeholder="شقة وحدة جناح الخ."
                                           name="billing_address2">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="رقم الموبيل *"
                                           name="phone" @auth value="{{ Auth::user()->phone }}" @endauth required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الإلكتروني"
                                      name="email"  @auth value="{{ Auth::user()->email }}" @else value="" @endauth >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                            </div>

                            @guest
                            <h6>
                                <button class="site-button-link" type="button" data-toggle="collapse" data-target="#create-an-account"> انشئ حساب إذا اردت . لمتابعة طلبك اون لاين
                                    <i class="fa fa-arrow-circle-o-down"></i>
                                </button>
                            </h6>
                            <div id="create-an-account" class="collapse">
                                <p>قم بإنشاء حساب بإدخال المعلومات أدناه. و إذا كنت عميلا عائدا يرجى تسجيل الدخول في أعلى الصفحة. </p>
                                <div class="row">
                                      <div class="form-group col-md-6">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمه السر" name="password">
                                       <small>كلمة المرور لا تقل عن 8 حروف</small>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            @endguest
                        </div>

                        <div class="col-lg-6 col-md-6 col-md-6 m-b30">
                            <h4 class="font-weight-600"><button class="site-button-link " type="button" data-toggle="collapse" data-target="#different-address">بيانات ضامن الاستعلام <small><span class="text-danger">غير ضرورى فى تلك المرحلة</span> </small>
                                    <i class="fa fa-arrow-circle-o-down"></i></button></h4>

                            <div id="different-address" class="collapse">

                                <div class="form-group">
                                    <select name="guarantee_city">
                                        <option label="اسم المحافظة الرئيسية" selected="" disabled=""></option>
                                        @foreach($governorates  as $gov)
                                            <option value="{{ $gov->governorate }}" @if($gov->id == $settings->city_shipping) selected @endif >{{ $gov->governorate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control  @error('guarantee_name') is-invalid @enderror" placeholder="اسم الضامن بالكامل  "
                                               name="guarantee_name" >
                                        @error('guarantee_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('guarantee_billing_address') is-invalid @enderror" placeholder="عنوان الضامن "
                                           name="guarantee_billing_address">
                                    @error('guarantee_billing_address')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control @error('guarantee_billing_address2') is-invalid @enderror" placeholder="شقة وحدة جناح الخ."
                                               name="guarantee_billing_address2">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control @error('guarantee_phone') is-invalid @enderror" placeholder="رقم الموبيل"
                                               name="guarantee_phone" >
                                        @error('guarantee_phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="email" class="form-control @error('guarantee_email') is-invalid @enderror" placeholder="البريد الالكترونى"
                                               name="guarantee_email">
                                    </div>


                                </div>

                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="notes" placeholder="ملاحظات حول طلبك ، على سبيل المثال ملاحظات خاصة للتسليم"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="section-content box-sort-in m-b30">
                                    <div class="alert alert-warning"> <strong><i class="fa fa-warning"></i>ماذا بعد ارسال الطلب ؟
                                        </strong><br>
تقوم الادارة بالتواصل مع مقدم الطلب وزيارته للتحقق من جدية التعاقد وطلب الاوراق التالية :
                                        مطلوب صورة البطاقه الشخصيه للمشتري والضامن وايصال خدمات حديث
                                        (كهرباء او غاز) - تكلفة طلب الاستعلام 100 جنيها.

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i class="fa fa-circle bg-white text-gray-dark"></i></div>
                <div class="row">
                    <div class="col-lg-6 m-b15">
                        <h4>طلبك</h4>
                        <table class="table-bordered check-tbl">
                            <thead>
                            <tr>
                                <th>صورة</th>
                                <th>اسم المنتج</th>
                                <th>السعر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $row)
                                @php
                                    $product_id=$row->id;
                                    $product = \App\Models\Admin\Product::find($product_id);

                                @endphp
                            <tr>
                                <td>
                                    <img src="{{asset('upload/products/'.$product->main_image)}}" alt="{{ $row->name }}" >
                                </td>
                                <td> <a href="{{ route('product.details',$product->slug) }}">{{ $row->name }}</a></td>
                                <td class="product-price">{{ $row->price }}  جنية </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 m-b15">

                            <h4>الطلب الكلي</h4>
                            <table class="table-bordered check-tbl">
                                <tbody>
                                <tr>
                                    <td>المجموع الفرعي للطلب</td>
                                    <td class="product-price">{{ Cart::subtotal() }} جنيه
                                        <input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">

                                    </td>
                                </tr>
                                <tr>
                                    <td>الشحن</td>
                                    <td>الشحن مجانا</td>
                                </tr>
                                @if(Session::has('coupon'))
                                <tr>

                                    <td>قسيمة <span class="text-danger"> ({{ Session::get('coupon')['name'] }})</span>
                                        <a href="{{ route('remove.coupon') }}" title="حذف"><i class="fa fa-trash"></i></a></td>
                                    <td class="product-price"><span class="text-danger">- {{ Session::get('coupon')['discount'] }} </span> جنيه </td>
                                </tr>
                                @else

                                @endif
                                <tr>

                                    <td>مجموع</td>
                                    @if(Session::has('coupon'))
                                        <td class="product-price-total">{{ Session::get('coupon')['balance']}} جنيه
                                            <input type="hidden" name="total" value="{{ Session::get('coupon')['balance']}}">
                                             </td>
                                    @else
                                        <td class="product-price-total">{{ Cart::subtotal() }}  جنيه
                                            <input type="hidden" name="total" value="{{ Cart::subtotal() }}">
                                        </td>
                                    @endif

                                </tr>
                                </tbody>
                            </table>
                        @if($cart->count()>0)
                            <div class="form-group">
                                <button class="site-button button-lg btn-block" type="submit">ارسل الطلب الآن </button>
                                @else
                                    <div class="text-center"> <span class="text-danger text-center">السلة لاتحتوى على منتجات لتنفيذ عملية الطلب</span></div>
                            </div>
                        @endif

                    </div>
                </div>
             </form>
            </div>
        </div>
    </div>
    <!-- Content END-->








@endsection