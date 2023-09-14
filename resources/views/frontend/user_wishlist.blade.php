@php

use App\Models\Front\Wishlist;
$id = Auth::id();
$wishlist = Wishlist::where('user_id',$id)->latest()->get();
$lang= app()->getLocale();

@endphp

@extends('frontend.layouts.master')
@section('title-content')  المنتجات المحفوظة - هاى تك للتقسيط@endsection

@section('home-content')




    <div class="page-content bg-white">
        <!-- START SECTION BREADCRUMB -->
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white"> المنتجات المحفوظة</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>المنتجات المحفوظة</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="list-group">
                            <a href="{{ route('dashboard') }}" class="list-group-item">{{ __('site.account_details') }}</a>
                            <a href="{{ route('user.order') }}" class="list-group-item">{{ __('site.my_orders') }}</a>
                            <a href="#" class="list-group-item active">{{ __('site.my_wishlist') }}</a>
                            <a href="{{ route('user.subscriber') }}" class="list-group-item ">{{ __('site.newsletter') }}</a>
                            <a href="{{ route('user.address') }}" class="list-group-item">{{ __('site.my_addresses') }}</a>
                            <a href="{{ route('user.update.password') }}" class="list-group-item ">{{ __('site.change_password') }}</a>
                            <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <br>
                        <h2 class="mb-3">{{ __('site.my_wishlist') }}</h2>
                        @if(count($wishlist) > 0)
                            <div class="col-lg-12 col-md-12 m-b30">
                                <div class="row">
                                        @foreach($wishlist as $row)
                                            <div class="col-lg-3 ">
                                                <div class="item-box m-b10">
                                                    <div class="item-img">
                                                        <img src="{{ asset('upload/products/'.$row->product->main_image) }}" alt="{{ $row->product->product_name }}"/>
                                                        <div class="item-info-in center">
                                                            <ul>
                                                                <li><a href="{{ route('add.cart',$row->product->id) }}"><i class="ti-shopping-cart"></i></a></li>
                                                                <li><a href="{{ route('product.details',$row->product->slug) }}"><i class="ti-eye"></i></a></li>
                                                                <li><a class="removewishlist" data-id="{{ $row->product->id }}" href="javascript:void(0);"><i class="fa fa-heart text-danger"></i></a></li>
                                                                <?php
                                                                $product_installments = App\Models\Admin\Installment::where('product_id', $row->product->id)->get()
                                                                ?>
                                                                <h4 class="item-price" style="color: white"> {{ (count($product_installments)>0) ? $product_installments[3]->installment : 0 }} جنيه شهرى </h4>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="item-info text-center text-black p-a10">
                                                        <h6 class="item-title font-weight-500"><a href="{{ route('product.details',$row->product->slug) }}">{{ str_limit($row->product->product_name,50) }}</a></h6>
                                                        @if($row->product->brand) <h6 class="item-title font-weight-300" style="font-size: 14px" ><a href="{{ route('products.in.brand',[$row->product->brand->id,$row->product->brand->brand_name]) }}">{{ $row->product->brand->brand_name }}</a></h6>@endif
                                                        @php
                                                            $reviews = \App\Models\Front\Review::where('product_id',$row->product->id)->get();

                                                             if($reviews->sum('rate')==0){
                                                             $rate=0;
                                                             }else{
                                                             $rate=($reviews->sum('rate')/count($reviews));
                                                             }
                                                        @endphp
                                                        <ul class="item-review text-yellow-light">
                                                            @for($i = 0 ; $i<5 ; ++$i)
                                                                <li><i class="fa fa-star{{($rate <= $i) ? '-o' : ''}}"></i></li>
                                                            @endfor
                                                        </ul>
                                                        <h4 class="item-price">
                                                            @if($row->product_quantity <= 0)
                                                                <span class="text-primary"> نفذت الكمية</span>

                                                            @else
                                                                @if($row->discount_price == NULL)
                                                                    <span class="text-primary">{{ $row->selling_price }} جنيه </span>

                                                                @else
                                                                    <del>{{ $row->selling_price }}  جنيه </del>
                                                                    <span class="text-primary">{{ $row->discount_price }} جنيه </span>
                                                                @endif
                                                            @endif
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                </div>

                            </div>

                        @else
                            <div class="mt-5 text-center">
                                <h4>لا توجد منتجات محفوظة</h4>
                                <a href="{{ url('/') }}" class="btn btn-outline-success">الاستمرار فى التسوق</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- END MAIN CONTENT -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{--لاضافة المنتج بقائمة المنتجات المحفوظة--}}
    <script type="text/javascript">

        $(document).ready(function(){
            $('.addwishlist').on('click', function(){
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: " {{ url('add/wishlist/') }}/"+id,
                        type:"GET",
                        datType:"json",
                        success:function(data){
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }


                        },
                    });

                }else{
                    alert('danger');
                }
            });

        });


    </script>

    {{--لحذف المنتج بقائمة المنتجات المحفوظة--}}
    <script type="text/javascript">

        $(document).ready(function(){
            $('.removewishlist').on('click', function(){
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: " {{ url('remove/wishlist/') }}/"+id,
                        type:"GET",
                        datType:"json",
                        success:function(data){
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }


                        },
                    });

                }else{
                    alert('danger');
                }
            });

        });


    </script>

@endsection


