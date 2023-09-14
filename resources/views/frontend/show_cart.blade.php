<?php
$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')
@section('title-content')  هاى تك للتقسيط - عربة التسوق  @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">عربة التسوق </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>عربة التسوق  </li>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            @if($cart->count()>0)
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th width="10%">المنتج</th>
                                    <th>اسم المنتج</th>
                                    <th width="15%">سعر الوحده</th>
                                    <th width="15%">كمية</th>
                                    <th width="15%">المجموع الفرعى </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $cart as $key => $row)
                                    <?php
                                    $product_id=$row->id;
                                    $product = \App\Models\Admin\Product::find($product_id);
                                    ?>
                                    <form action="{{route('update.cart',$row->rowId)}}" method="POST" id="change">
                                        @csrf
                                        <input type="hidden" name="image" value="{{$row->options->image}}">
                                <tr class="alert">
                                    <td width="10%" class="product-item-img">
                                        <img src="{{asset('upload/products/'.$product->main_image)}}" alt="{{ $row->name }}" >
                                    </td>
                                    <td class="col col-6"> <div  class="product-item-name">
                                            @if(Session::has('coupon'))
                                                <a href="{{ route('product.details',$product->slug) }}">{{ $row->name }}</a>
                                            @else
                                                <a href="{{ route('remove.cart',$row->rowId) }}" class="ti-close" title="حذف" style="color: red"></a> &nbsp; <a href="{{ route('product.details',$product->slug) }}">{{ $row->name }}</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td width="15%" class="product-item-price">{{ $row->price }}  جنية </td>
                                    <td width="15%" >

                                          <input type="text" value="{{$row->qty}}" name="qty" class="form-control"
                                                 @if(Session::has('coupon')) @else onChange='$("#change").submit();' @endif style="width: 50px;"/>
                                        @if(Session::has('coupon'))
                                        @else
                                            <button type="submit" class="btn btn-small" title="تحديث"><i class="fa fa-pencil" style="color: green"></i> </button>
                                        @endif
                                    </td>
                                    <td width="15%" class="product-item-totle">{{$row->price * $row->qty}} جنيه</td>

                                </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="text-center"> <span class="text-danger text-center">السلة لاتحتوى على منتجات لتنفيذ عملية تنفيذ الطلب</span></div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @if(Session::has('coupon'))
                    @else

                    <div class="col-lg-6 m-b15">
                        <form  class="shop-form" action="{{route('apply.coupon')}}" method="POST" id="coupon">
                            @csrf
                            <h5> تطبيق كود الخصم</h5>
                            <div class="form-group">
                                <input type="text" name="coupon" class="form-control" placeholder="رمز الكوبون" onchange='$("#coupon").submit();'>
                                @error('coupon')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="site-button" type="submit">تطبيق القسيمة</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="col-lg-6 m-b15">
                        <h5>المجموع الفرعي لعربة التسوق</h5>
                        <table class="table-bordered check-tbl">
                            <tbody>
                            <tr>
                                <td>المجموع الفرعي للطلب</td>
                                <td>{{Cart::subtotal()}} جنيه</td>
                            </tr>
                            <tr>
                                <td>الشحن</td>
                                <td>الشحن مجانا</td>
                            </tr>
                            @if(Session::has('coupon'))
                            <tr>
                                <td>قسيمة
                                    <span class="text-danger"> ({{ Session::get('coupon')['name'] }})</span>
                                    <a href="{{ route('remove.coupon') }}" title="حذف"><i class="fa fa-trash"></i></a>
                                </td>
                                <td><span class="text-danger">- {{ Session::get('coupon')['discount'] }} </span> جنيه </td>
                            </tr>
                            @endif
                            <tr>
                                @if(Session::has('coupon'))
                                <td>مجموع</td>
                                <td> <strong> {{ Session::get('coupon')['balance']}}  جنيه </strong></td>
                                    @else
                                    <td>مجموع</td>
                                    <td> <strong> {{ Cart::subtotal() }} جنيه </strong> </td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                        @if($cart->count()>0)
                        <div class="form-group">
                            <a href="{{route('user.checkout')}}" class="site-button" type="button">تنفيذ الطلب</a>
                            @else
                                <div class="text-center"> <span class="text-danger text-center">السلة لاتحتوى على منتجات لتنفيذ عملية الطلب</span></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </div>

    </div>
    <!-- Content END-->




























@endsection