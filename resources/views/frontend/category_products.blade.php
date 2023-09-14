<?php

$settings = \App\Models\Admin\Setting::first();

?>
@extends('frontend.layouts.master')

@section('title-content') {{ $nameOfFather }}  - هاى تك للتقسيط  @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">{{ $nameOfFather }}</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>{{ $nameOfFather }}  </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>


        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 m-b30">
                        <div class="row">

                            @if(count($products)>0)
                                @foreach($products as $row)
                                    <div class="post card-container col-lg-3" >
                                        <div class="item-box m-b10 blog-post blog-grid blog-rounded blog-effect1 dlab-info p-a20 border-1" @if($row->product_quantity <= 0) style="background-color: #fff5f8" @endif>
                                            <div class="item-img dlab-post-media dlab-img-effect ">
                                                <img src="{{ asset('upload/products/'.$row->main_image) }}" alt="{{ $row->product_name }}"/>
                                                <div class="item-info-in center">
                                                    <ul>
                                                        <li><a href="{{ route('add.cart',$row->id) }}"><i class="ti-shopping-cart"></i></a></li>
                                                        <li><a href="{{ route('product.details',$row->slug) }}"><i class="ti-eye"></i></a></li>
                                                        <?php
                                                        $user_id = Auth::id();
                                                        $check = \App\Models\Front\Wishlist::where('user_id',$user_id)->where('product_id',$row->id)->first();
                                                        ?>
                                                        @auth
                                                            @if($check)
                                                                <li><a class="removewishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="fa fa-heart text-danger"></i></a></li>
                                                            @else
                                                                <li><a class="addwishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="ti-heart text-white"></i></a></li>
                                                            @endif
                                                        @else
                                                            <li><a class="addwishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i class="ti-heart text-white"></i></a></li>
                                                        @endauth
                                                        <?php
                                                        $product_installments = App\Models\Admin\Installment::where('product_id', $row->id)->get()
                                                        ?>
                                                        <h4 class="item-price" style="color: white"> {{ (count($product_installments)>0) ? $product_installments[3]->installment : 0 }} جنيه شهرى </h4>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="item-info text-center text-black p-a10">
                                                <h6 class="item-title font-weight-500"><a href="{{ route('product.details',$row->slug) }}">{{ str_limit($row->product_name,50) }}</a></h6>
                                                @if($row->brand) <h6 class="item-title font-weight-300" style="font-size: 14px" ><a href="{{ route('products.in.brand',[$row->brand->id,$row->brand->brand_name]) }}">{{ $row->brand->brand_name }}</a></h6> @endif
                                                @php
                                                    $reviews = \App\Models\Front\Review::where('product_id',$row->id)->get();

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
                            @endif
                        </div>
                        {{--pagination--}}
                        <?php
                        $route = Route::current()->getName();
                        ?>
                        @if(
                        $route == 'price.filter' || $route == 'price.filter.category' ||
                        $route == 'price.filter.subcategory' || $route == 'price.filter.sub_subcategory' ||
                        $route == 'price.filter.brand' || $route == 'brand.filter' ||
                        $route == 'brand.filter.category' || $route == 'brand.filter.subcategory' ||
                        $route == 'brand.filter.sub_subcategory' || $route == 'brand.filter.brand'
                        )
                        @else
                        <div class="row">
                            <div class="col-lg-6 col-md-6 ">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="section-content box-sort-in m-b15">
                                    <div class="pagination-bx gray clearfix">
                                        <ul class="pagination">

                                            {{ $products->onEachSide(0)->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-4 m-b30">
                        <aside class="side-bar shop-categories sticky-top">
                            <div class="widget recent-posts-entry">
                                <div class="dlab-accordion advanced-search toggle" id="accordion1">
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-toggle="collapse" href="#categories">
                                                    الفئات الفرعية
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="categories" class="acod-body collapse show">
                                            <div class="acod-content">
                                                <div class="widget widget_services">
                                                    <ul>
                                                        <?php
                                                            $subcategories = \App\Models\Admin\Subcategory::where('category_id',$id)->get();
                                                        ?>
                                                        @if(count($subcategories) > 0)
                                                            @foreach($subcategories as $row)
                                                        <li><a href="{{ route('products.in.subcategory',[$row->id, $row->subcategory_name]) }}">{{ $row->subcategory_name }}</a></li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-toggle="collapse" href="#vendor">
                                                    نطاق السعر
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="vendor" class="acod-body collapse show">
                                            <div class="acod-content">
                                                <div class="product-brand">

                                                    <form action="{{ route('price.filter.category',[$id,$nameOfFather]) }}" method="post" id="priceList">
                                                        @csrf
                                                        <input id="seating1" type="checkbox" onChange='$("#priceList").submit();' name="less_1000">
                                                        <label for="seating1"> <small>أقل من 1000 جنيه</small> </label>

                                                        <input id="seating2" type="checkbox" onChange='$("#priceList").submit();'  name="less_3000">
                                                        <label for="seating2"> <small>من 1000 جنيه الى 3000 جنيه</small></label>

                                                        <input id="seating3" type="checkbox" onChange='$("#priceList").submit();' name="less_6000">
                                                        <label for="seating3"> <small>من 3000 جنيه الى 6000 جنيه</small> </label>

                                                        <input id="seating4" type="checkbox" onChange='$("#priceList").submit();' name="less_10000">
                                                        <label for="seating4"> <small>من 6000 جنيه الى 10000 جنيه</small> </label>

                                                        <input id="seating5" type="checkbox" onChange='$("#priceList").submit();'name="more_than_10000">
                                                        <label for="seating5"> <small> فوق 10000 جنيه</small></label>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        $brands = \App\Models\Admin\Brand::all();
                                    ?>
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-toggle="collapse" href="#vendor">
                                                    شركاء النجاح
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="vendor" class="acod-body collapse show">
                                            <div class="acod-content">
                                                <div class="product-brand">
                                                    <form action="{{ route('brand.filter.category',[$id,$nameOfFather]) }}" method="post" id="brandList">
                                                    @csrf
                                                    @foreach($brands as $brand)
                                                    <div class="search-content">
                                                        <input id="brand{{ $brand->id }}" type="checkbox" onChange='$("#brandList").submit();' name="brand_id" value="{{ $brand->id }}">
                                                        <label for="brand{{ $brand->id }}"  class="search-content-area">{{ $brand->brand_name }}</label>
                                                    </div>
                                                    @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <?php
                                            $all_products = \App\Models\Admin\Product::where('category_id',$id)->where('status',1)->
                                                where('approved',1)->get();
                                        $category_tags = array();
                                        foreach ($all_products as $row ){
                                            foreach( explode(',',$row->product_tags) as $tags){
                                                if(!in_array($tags,$category_tags)){
                                                    $category_tags[] = $tags;
                                                }

                                            }
                                        }

                                        ?>
                                        <div class="acod-head">
                                            <h5 class="acod-title">
                                                <a data-toggle="collapse"  href="#tags" class="collapsed" >
                                                    كلمات البحث
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="tags" class="acod-body collapse">
                                            <div class="acod-content">
                                                <div class="widget_tag_cloud radius">
                                                       @foreach($category_tags as $tag)
                                                       <a href="{{route('tag.category.products.filter',[$id,$nameOfFather,$tag])}}">{{$tag}}</a>
                                                       @endforeach

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </aside>
                    </div>


                </div>
            </div>
            <!-- Product END -->
        </div>



    </div>
    <!-- Content END -->


@endsection
