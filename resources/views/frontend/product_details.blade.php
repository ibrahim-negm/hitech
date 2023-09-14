@php
    $seo =\App\Models\Admin\Seo::first();
    $settings = \App\Models\Admin\Setting::first();
    $lang= app()->getLocale();
@endphp

@extends('frontend.layouts.master')

@section('meta_tags')
    @if($product)
        <title> {{ $product->product_name }}  - هاى تك للتقسيط   </title>
        {{--<meta name='description' itemprop='description' content='{{$product->product_detail}}' />--}}
        <meta name='keywords' content='{{ $product->product_tags}}' />
        <meta name="description" content="{{$product->product_short_detail}}">
        <meta property='article:published_time' content='{{$product->created_at}}' />
        <meta property='article:section' content='event' />

        <meta property="og:description" content="{{$product->product_short_detail}}" />
        <meta property="og:title" content="{{$product->product_name }}" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en-us" />
        <meta property="og:locale:alternate" content="en-us" />
        <meta property="og:site_name" content="{{env('APP_NAME', 'HiTech')}}" />
        <meta property="og:image" content="{{ asset('upload/products/'.$product->main_image) }}" />
        <meta property="og:image:url" content="{{ asset('upload/products/'.$product->main_image) }}" />
        <meta property="og:image:size" content="300" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="{{$product->product_name}}" />
        <meta name="twitter:site" content="@HiTech" />
    @endif
@endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle text-center bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">{{ $product->product_name }}</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>{{ $product->subcategory->subcategory_name }}  </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <!-- contact area -->
        <div class="section-full content-inner bg-white">
            <!-- Product details -->
            <div class="container woo-entry">
                <div class="row m-b30">
                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <div class="product-gallery on-show-slider lightgallery" id="lightgallery">
                            <div id="sync1" class="owl-carousel owl-theme owl-btn-center-lr m-b5 owl-btn-1 primary">
                                <div class="item">
                                    <div class="mfp-gallery">
                                        <div class="dlab-box">
                                            <div class="dlab-thum-bx dlab-img-overlay1 ">
                                                <img src="{{ asset('upload/products/'.$product->main_image) }}" alt="{{ $product->product_name }}">
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon">
														<span data-exthumbimage="{{ asset('upload/products/'.$product->main_image) }}" data-src="{{ asset('upload/products/'.$product->main_image) }}" class="check-km" title="{{ $product->product_name }}">
															<i class="ti-fullscreen"></i>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($product_images as $image)
                                  <div class="item">
                                    <div class="mfp-gallery">
                                        <div class="dlab-box">
                                            <div class="dlab-thum-bx dlab-img-overlay1 ">
                                                <img src="{{ asset('upload/products/'.$image->image) }}" alt="{{$image->image}}">
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon">
														<span data-exthumbimage="{{ asset('upload/products/'.$image->image) }}" data-src="{{ asset('upload/products/'.$image->image) }}" class="check-km" title="{{ $product->product_name }}">
															<i class="ti-fullscreen"></i>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="sync2" class="owl-carousel owl-theme owl-none">
                                <div class="item">
                                    <div class="dlab-media">
                                        <img src="{{ asset('upload/products/'.$product->main_image) }}" alt="{{ $product->product_name }}">
                                    </div>
                                </div>
                                @foreach($product_images as $image)
                                <div class="item">
                                    <div class="dlab-media">
                                        <img src="{{ asset('upload/products/'.$image->image) }}" alt="{{ $image->image }}">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12">
                        <form class="cart sticky-top" action="{{ route('add.product.cart',$product->id) }}" method="POST" >
                            @csrf

                            <div class="dlab-post-title">
                                <h3 class="post-title"><a href="javascript:void(0);">{{ $product->product_name }} </a>
                                    @if($product->product_quantity <= 0)
                                        <span class="text-success" style="font-size: medium">( نفذت الكمية )</span>
                                    @endif

                                </h3>
                                <br>
                                <p class="m-b10" style="word-wrap: break-word"> {{ $product->product_short_detail }}</p>
                                <div class="dlab-divider bg-gray tb15">
                                    <i class="icon-dot c-square"></i>
                                </div>
                            </div>
                            <div class="relative">
                                @if($product->discount_price == NULL)
                                    <h3 class="m-tb10">{{ $product->selling_price }} جنيه </h3>
                                 @else
                                    <h3 class="m-tb10">{{ $product->discount_price }} جنيه </h3>
                                    <del>{{ $product->selling_price }} جنيه</del>
                                @endif

                                <div class="shop-item-rating">
									<span class="rating-bx">
                                         @for($i = 0 ; $i<5 ; ++$i)
                                           <i class="fa fa-star{{($rate <= $i) ? '-o' : ''}}"></i>
                                        @endfor
									</span>
                                    <span>{{ $rate }} تقييم</span>
                                </div>
                            </div>
                            <div class="shop-item-tage">
                                <span>الكلمات الاسترشادية :- </span>
                                @foreach(explode(',',$product->product_tags) as $tag)
                                <a href="javascript:void(0);"> {{ $tag }} ,</a>
                                @endforeach
                            </div>
                            <div class="dlab-divider bg-gray tb15">
                                <i class="icon-dot c-square"></i>
                            </div>
                            <div class="row">

                                <div class="m-b30 col-md-3 col-sm-3">
                                    <h6>حدد الكمية</h6>
                                    <div class="quantity btn-quantity style-1">
                                        <input id="demo_vertical2"   type="text" value="1" name="demo_vertical2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-b30 col-md-5 col-sm-5">
                                <button class="btn btn-lg btn-danger" type="submit">
                                    <i class="ti-shopping-cart"> </i>&nbsp;      طلب تقسيط
                                </button>
                                </div>

                                <br><br>
                                <div class="m-b30 col-md-7 col-sm-7">
                                    <!-- Shop Service info -->
                                    <a href="#installment">
                                    <div class="section-full p-t20 p-b0 bg-primary text-white">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="icon-bx-wraper left shop-service-info m-b10">

                                                        <div class="icon-content">
                                                            <h6 class="dlab-tilte">أقل قسط بأقل فائدة فى مصر </h6>
                                                            @if(count($product_installments)>0)
                                                            <p>قسط شهرى يصل الى :

                                                          <span style="font-size: larger;"> {{ $product_installments[3]->installment }}</span>
                                                                جنيه

                                                            </p>
                                                            @endif
                                                           <i class="fa fa-arrow-left fa-lg float-right"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                    <!-- Shop Service info End -->
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dlab-tabs  product-description tabs-site-button">
                            <ul class="nav nav-tabs ">
                                <li><a data-toggle="tab" href="#web-design-1" ><i class="fa fa-globe"></i> وصف</a></li>
                                <li><a data-toggle="tab" href="#graphic-design-1"><i class="fa fa-photo"></i> معلومة اضافية</a></li>
                                <li><a data-toggle="tab" href="#installment" class="active"><i class="fa fa-money" ></i> عروض التقسيط</a></li>
                                <li><a data-toggle="tab" href="#developement-1" ><i class="fa fa-cog"></i> تقييم المنتج</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane ">
                                    <p class="m-b10" style="word-wrap: break-word"> {!! $product->product_long_detail !!} </p>
                                </div>
                                <div id="graphic-design-1" class="tab-pane">

                                    <table class="table table-bordered" >
                                        <tr>
                                            <td>المقاس</td>
                                            <td>{{ (empty($product->product_size)) ? 'لا يوجد معلومات' : $product->product_size }}</td>
                                        </tr>
                                        <tr>
                                            <td>اللون</td>
                                            <td>{{ (empty($product->product_color)) ? 'لا يوجد معلومات' : $product->product_color }}</td>
                                        </tr>
                                        <tr>
                                            <td>تقييم</td>
                                            <td>
												<span class="rating-bx">
													@for($i = 0 ; $i<5 ; ++$i)
                                                        <i class="fa fa-star{{($rate <= $i) ? '-o' : ''}}"></i>
                                                    @endfor

												</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>الخامة</td>
                                            <td>{{ (empty($product->product_material)) ? 'لا يوجد معلومات' : $product->product_material }}</td>
                                        </tr>
                                        <tr>
                                            <td>الصناعة</td>
                                            <td>{{ (empty($product->manufacture)) ? 'لا يوجد معلومات' : $product->manufacture }}</td>
                                        </tr>
                                        <tr>
                                            <td>كود المنتج</td>
                                            <td>{{ (empty($product->product_code)) ? 'لا يوجد معلومات' : $product->product_code }} </td>
                                        </tr>
                                        <tr>
                                            <td>المخزن</td>
                                            <td>{{ (empty($product->product_quantity)) ? 'لا يوجد معلومات' : $product->product_quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>الوزن</td>
                                            <td>{{ (empty($product->product_capacity)) ? 'لا يوجد معلومات' : $product->product_capacity }}</td>
                                        </tr>
                                        <tr>
                                            <td>الوكيل</td>
                                            @if($product->brand)  <td><a href="{{ route('products.in.brand',[$product->brand_id,$product->brand->brand_name]) }}">{{ $product->brand->brand_name }}</a>@endif
                                              </td>
                                        </tr>
                                    </table>

                                </div>
                                <div id="installment" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-lg-8  col-md-8">
                                    @if(count($product_installments)>0)
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>الشهور</th>
                                            <th style="background-color: #fffebd">الحد الأدنى للمقدم</th>
                                            <th>القسط الشهري</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>6 اشهر</td>
                                            <td style="background-color: #fffebd"> <div style="color: maroon"> {{ $product_installments[0]->deposit }}   جنيه </div></td>
                                            <td><strong><div style="color: maroon">{{ $product_installments[0]->installment }}   جنيه </div></strong></td>
                                        </tr>
                                        <tr>
                                            <td>12 شهر</td>
                                            <td style="background-color: #fffebd"> <div style="color: maroon"> {{ $product_installments[1]->deposit }}   جنيه </div></td>
                                            <td><strong><div style="color: maroon">{{ $product_installments[1]->installment }}   جنيه </div></strong></td>
                                        </tr>
                                        <tr>
                                            <td>18 شهر</td>
                                            <td style="background-color: #fffebd"> <div style="color: maroon"> {{ $product_installments[2]->deposit }}   جنيه </div></td>
                                            <td><strong><div style="color: maroon">{{ $product_installments[2]->installment }}   جنيه </div></strong></td>
                                        </tr>
                                        <tr>
                                            <td>24 شهر</td>
                                            <td style="background-color: #fffebd">  <div style="color: maroon">{{ $product_installments[3]->deposit }}   جنيه </div></td>
                                            <td><strong><div style="color: maroon">{{ $product_installments[3]->installment }}   جنيه </div></strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @endif
                                        </div>
                                        <div class="col-lg-4  col-md-4">
                                            <div class="section-content box-sort-in m-b30">
                                                <div class="alert alert-warning"> <strong><i class="fa fa-warning"></i>كيف تقدم طلب التقسيط  ؟
                                                    </strong><br>
                                                    أضف المنتج إلى عربة التسوق عن طريق الضغط على طلب تقسيط ، و

                                                    سوف نتصل بك لمتابعة الطلب وتحديد موعد لزيارتك خلال فترة وجيزة من استلام الطلب .


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="developement-1" class="tab-pane">
                                    <div id="comments">
                                        <ol class="commentlist">
                                            @if(count($reviews) > 0)
                                                @foreach($reviews as $row)
                                            <li class="comment">
                                                <div class="comment_container">
                                                    <img class="avatar avatar-60 photo" src="
                                                    {{ (!empty( $row->user->profile_photo_path))
                                ? url('upload/frontend/users/'.$row->user->profile_photo_path)
                                : url('upload/avatar.png')}}"  alt="user_image">
                                                    <div class="comment-text">
                                                        <div  class="star-rating">
                                                            <div data-rating="3">
                                                                @for($i = 0 ; $i<5 ; ++$i)
                                                                    <i class="fa fa-star{{($row->rate <= $i) ? '-o' : ''}} text-yellow" data-alt="{{$i+1}}" title="منتظم"></i>
                                                                @endfor

                                                            </div>
                                                        </div>
                                                        <p class="meta">

                                                            @php
                                                                $timestamp = strTotime($row->created_at);
                                                                $date = date('F j, Y, g:i a',$timestamp)
                                                            @endphp
                                                            <span>{{ $date }} <i class="fa fa-clock-o"></i> </span>
                                                            <strong class="author">{{ ($row->user) ? $row->user->name : 'غير معرف' }} </strong>
                                                        </p>
                                                        <div class="description">
                                                            <p style="word-wrap: break-word">{{ $row->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                                @endforeach
                                            @else

                                                لاتوجد تقييمات على هذا المنتج.

                                            @endif
                                        </ol>
                                    </div>
                                    <br>
                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <h3 class="comment-reply-title" id="reply-title">إضافة تقييم للمنتج</h3>
                                                <form class="comment-form"  method="post" action="{{ route('store.review',$product->id) }}">
                                                    @csrf
                                                    <div class="comment-form-author">
                                                        <label>اسم <span class="required">*</span></label>
                                                        <input type="text" @auth value="{{ Auth::user()->name }}" @endauth aria-required="true"
                                                               size="30"  name="name" id="author" placeholder="الاسم بالكامل" required>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>

                                                    <div class="comment-form-email">
                                                        <label>البريد الإلكتروني <span class="required">*</span></label>
                                                        <input type="text"  @auth value="{{ Auth::user()->email }}" @endauth aria-required="true"
                                                               size="30"  name="email" id="email" placeholder="البريد الالكترونى" required>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                    <div class="comment-form-rating">
                                                        <label class="pull-left m-r20">تقييمك</label>
                                                        <div class="rating-widget">
                                                            <!-- Rating Stars Box -->
                                                            <div class="rating-stars">
                                                                <ul id="stars">

                                                                    @for($i=1; $i<6 ; $i++)
                                                                        <li class="star" title="Poor" data-value="{{$i}}">
                                                                            <i class="fa fa-star fa-fw"></i>
                                                                        </li>
                                                                    @endfor
                                                                    <input type="hidden" name="rate" value="5" id="star" required>

                                                                    @error('rate')
                                                                    <span class="invalid-feedback" role="alert">
                                                                     <strong>{{ $message }}</strong></span>
                                                                    @enderror

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-form-comment">
                                                        <label>رأيك على المنتج</label>
                                                        <textarea aria-required="true" rows="8" cols="45" name="description" required placeholder="أكتب تقييمك للمنتج هنا *"  id="comment"></textarea>
                                                    </div>
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit" class="site-button" id="submit" name="submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($related_products) > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="m-b20">منتجات ذات صله</h5>
                        <div class="img-carousel-content owl-carousel owl-btn-center-lr owl-btn-1 primary">
                            @foreach($related_products as $row)
                            <div class="item">
                                <div class="item-box">
                                    <div class="item-img">
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
                                        @if($row->brand) <h6 class="item-title font-weight-300" style="font-size: 14px" ><a href="{{ route('products.in.brand',[$row->brand->id,$row->brand->brand_name]) }}">{{ $row->brand->brand_name }}</a></h6>@endif
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

                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- Product details -->
        </div>
        <!-- contact area  END -->

    </div>
    <!-- Content END-->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $('.star').on('click',function () {
            var number= $(this).data('value');
            $('#star').val(number);
        });

    </script>



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
