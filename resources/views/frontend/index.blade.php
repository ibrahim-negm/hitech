<?php

$lang = app()->getLocale();
$categories_collection = \App\Models\Admin\Category::take(2)->get();
$wishlist = \App\Models\Front\Wishlist::where('user_id',Auth::id())->get();
$cart = Cart::content();
$adv = App\Models\Admin\Adv::where('status',1)->orderBy('id','desc')->first();
$employees = \App\Models\Admin\Employee::take(4)->get();
$services = \App\Models\Admin\Service::inRandomOrder()->get();
$images = \App\Models\Admin\Image::inRandomOrder()->take(10)->get();
$brands =  \App\Models\Admin\Brand::take(10)->inRandomOrder()->get();

?>
@extends('frontend.layouts.app')

@section('title-content')  الصفحة الرئيسية - هاى تك للتقسيط @endsection

@section('home-content')


    <div class="content-block">

        <!-- Our Story -->
        <div class="section-full content-inner bg-gray" id="about" style="background-color: #fffac2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-6 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.3s">
                                <div class="dlab-box-bg m-b30 box-hover style3" style="background-image: url({{ asset('frontend/images/gallery/car/bg_logo.jpg') }})">
                                    <div class="icon-bx-wraper center p-lr20 p-tb30">
                                        <div class="text-primary m-b20">
                                            <span class="icon-cell icon-md"><i class="ti-user"></i></span>
                                        </div>
                                        <div class="icon-content">
                                            <h5 class="dlab-tilte">من نحن</h5>
                                            <p>أحدى شركات التقسيط التى تتميز بسرعة الاجراءات  و جودة المنتج... </p>
                                        </div>
                                    </div>
                                    <div class="icon-box-btn text-center">
                                        <a href="{{ route('about') }}#about" class="site-button btn-block">اقرأ أكثر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-6 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                                <div class="dlab-box-bg m-b30 box-hover style3" style="background-image: url( {{ asset('frontend/images/gallery/car/bg_logo.jpg') }} )">
                                    <div class="icon-bx-wraper center p-lr20 p-tb30">
                                        <div class="text-primary m-b20">
                                            <span class="icon-cell icon-md"><i class="ti-settings"></i></span>
                                        </div>
                                        <div class="icon-content">
                                            <h5 class="dlab-tilte">شروط التقسيط</h5>
                                            <p>  ان يكون الشخص ذو أهلية وتجاوز الـ21 عام  مصرى الجنسية... </p>
                                        </div>
                                    </div>
                                    <div class="icon-box-btn text-center">
                                        <a href="{{route('faq')}}#condition" class="site-button btn-block">اقرأ أكثر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInDown" data-wow-duration="2s" data-wow-delay="0.3s">
                                <div class="dlab-box-bg m-b30 box-hover style3" style="background-image: url( {{ asset('frontend/images/gallery/car/bg_logo.jpg') }})">
                                    <div class="icon-bx-wraper center p-lr20 p-tb30">
                                        <div class="text-primary m-b20">
                                            <span class="icon-cell icon-md"><i class="ti-support"></i></span>
                                        </div>
                                        <div class="icon-content">
                                            <h5 class="dlab-tilte">طلبات التقسيط</h5>
                                            <p>صورة البطاقة الشخصية للمشترى والضامن وفاتوره كهرباء أو غاز حديثه... </p>
                                        </div>
                                    </div>
                                    <div class="icon-box-btn text-center">
                                        <a href="{{route('faq')}}#condition" class="site-button btn-block">اقرأ أكثر</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="request-form dezPlaceAni" >
                            <div class="request-form-header"  id="fast_offer">
                                <i class="flaticon-message"></i>
                                <p>لا تتردد في إرسال </p>
                                <h2> طلب تقسيط عن منتج</h2>
                            </div>
                            <form  action="{{route('fast.payment.process')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>اسمك </label>
                                        <input name="name" type="text" required="" class="form-control" placeholder="">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>العنوان </label>
                                        <input name="address" type="text" required="" class="form-control" placeholder="">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>الهاتف </label>
                                        <input name="phone" type="text" required="" class="form-control" placeholder="">
                                        <small>الهاتف  11 رقم </small>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>المنتج المراد تقسيطه </label>
                                        <textarea class="form-control" name="notes" placeholder="" required></textarea>
                                        <small>اسم المنتج اكثر من 5 حروف</small>
                                        @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="site-button btnhover19 button-md btn-block" type="submit">طلب تقسيط </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Story End -->

        <!-- خدماتنا-->
        <div class="section-full bg-gray content-inner about-carousel-ser" id="service" style="padding-top: 25px">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title">خدماتنا </h2>
                    <p>
                        خدمات التقسيط  تشمل الاجهزه كهربائيه - الادوات منزليه - الموبايلات - الاثاث والموبيليا - الدراجات بخاريه - المراتب والمفروشات المنزلية - مكن الخياطة - أخرى...

                    </p>
                </div>
                @if($services)
                    <div class="about-ser-carousel owl-carousel owl-theme owl-btn-center-lr owl-dots-primary-full owl-btn-3 m-b30 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                        @foreach($services as $service)
                            <div class="item">
                                <div class="dlab-box service-media-bx">
                                    <div class="dlab-media">
                                        <a href="{{ route('products.in.service',[$service->id,$service->service_name]) }}"><img src="{{ asset('upload/services/'.$service->service_image) }}" class="lazy" data-src="{{ asset('upload/services/'.$service->service_image) }}" alt="{{ $service->service_name }}"></a>
                                    </div>
                                    <div class="dlab-info text-center">
                                        <h2 class="dlab-title"><a href="{{ route('products.in.service',[$service->id,$service->service_name]) }}">{{ $service->service_name }}</a></h2>
                                        <a href="{{ route('products.in.service',[$service->id,$service->service_name]) }}" class="site-button btnhover13"> المنتجات </a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <!-- /خدماتنا -->

    @if($adv)
        <!-- Call To Action End -->
            <div class="section-full call-action bg-primary wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 text-white">
                            <h2 class="title">
                                {{ $adv->title }}</h2>
                            <p class="m-b0">{{ $adv->description }}</p>
                        </div>
                        <div class="col-lg-3 d-flex">
                            <a href="{{ route('contact.us') }}" class="site-button btnhover15 white align-self-center outline ml-auto radius-xl outline-2">إتصل بنا </a>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    <!-- Call To Action End -->
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
                                    <img src="{{ asset('frontend/images/installment/diving.png') }}" alt="installment">
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
        <!-- Our Team -->
        @if(count($products)>0)
            <div class="section-full bg-gray content-inner about-carousel-ser" id="service" style="padding-top: 0px">
                <div class="container">
                    <div class="section-head text-center">
                        <h2 class="title">المنتجات </h2>
                        <p>
                            من هنا ممكن تستعرض احدث المنتجات على المنصة.

                        </p>
                    </div>

                    <div class="about-ser-carousel owl-carousel owl-theme owl-btn-center-lr owl-dots-primary-full owl-btn-3 m-b30 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                        @foreach($products as $row)
                            <div class="item">
                                <div class="item-box dlab-box service-media-bx">
                                    <div class="item-img dlab-media">
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
                                        @if($row->brand)<h6 class="item-title font-weight-300" style="font-size: 14px" ><a href="{{ route('products.in.brand',[$row->brand->id,$row->brand->brand_name]) }}">{{ $row->brand->brand_name }}</a></h6>@endif
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
    <!-- Our Team END -->
        <!-- About Company -->
        @if(count($images) > 0)
            <div class="section-full bg-gray content-inner-2 about-carousel-ser" id="gallery" style="padding-top: 0px">
                <div class="container">
                    <div class="section-head text-center">
                        <h2 class="title">معرض الصور</h2>
                        <p>هى رحلة شاقة احنا كشركة قررنا السير فيها وحبينا نشارككم نجاحتنا فى مجال تقسيط المنتجات مع عملائنا. كل فترة زمنية ادارة الشركة تقرر عمل معارض لعرض منتجاتها بالتقسيط الى عملائها لتسيهل العملية الشرائية باقل التكاليف وده نبذة بسيطة عن احداث المعارض والجوائز اللى بتسلم فيها .... </p>
                    </div>
                    <div class="about-ser-carousel owl-carousel owl-theme owl-btn-center-lr owl-dots-primary-full owl-dots-none owl-btn-3">
                        @foreach($images as $image)
                            <div class="item wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">

                                <div class="dlab-box service-media-bx">
                                    <div class="dlab-post-meta">
                                        <ul>
                                            <li class="post-date"> <strong>{{ date('F j, Y',strtotime($image->created_at)) }}</strong>  </li>

                                        </ul>
                                    </div>
                                    <div class="dlab-media dlab-img-effect zoom">
                                        <a href="{{ route('gallery') }}"><img src="{{ asset('upload/gallery/'.$image->image) }}" alt="{{ $image->service->service_name }}"></a>
                                    </div>
                                    <div class="dlab-info text-center">
                                        <h2 class="dlab-title"><a href="{{ route('gallery') }}">{{ $image->image_name }}</a></h2>
                                        @if( $image->service != null)
                                            <p>

                                                {{ $image->service->service_name }}
                                            </p>
                                        @endif
                                        <a href="{{ route('gallery') }}" class="site-button btnhover15"> معرض الصور</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    <!-- About Company END -->

        <!-- Testimonials blog -->
        @if(count($comments)> 0)
            <div class="section-full overlay-black-middle bg-secondry content-inner-2 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s" style="background-image:url( {{ asset('frontend/images/background/map-bg.png') }} ); ">
                <div class="container">
                    <div class="section-head text-white text-center">
                        <h2 class="title">أراء العملاء</h2>
                        <p>
                            ستجد أدناه بعض اراء العملاء بعد التعامل والشراء عن طريق التقسيط طرف شركتنا. هى رحلة ممتعة انك تشوف بعنيك نجاجنا بعيون عملائنا.
                        </p>
                    </div>
                    <div class="section-content">
                        <div class="testimonial-two-dots owl-carousel owl-none owl-theme owl-dots-primary-full owl-loaded owl-drag">
                            @foreach($comments as $row)
                                <div class="item">
                                    <div class="testimonial-15 text-white">
                                        <div class="testimonial-text quote-left quote-right">
                                            <p style="word-wrap: break-word">{{ substr($row->description,0,100)}}</p>
                                        </div>
                                        <div class="testimonial-detail clearfix">
                                            <div class="testimonial-pic radius shadow">
                                                <img  src="{{ (!empty( $row->user->profile_photo_path))
                                                            ? url('upload/frontend/users/'.$row->user->profile_photo_path)
                                                            : url('upload/avatar.png')}}"  alt="user image">
                                            </div>
                                            <strong class="testimonial-name">{{($row->user) ?  $row->user->name : 'غير معرف' }}  </strong> <span class="testimonial-position">عميل</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif
    <!-- Testimonials blog End -->

        <!-- Latest From Blog -->
        @if(count($posts)>0)
            <div class="section-full content-inner bg-gray" >
                <div class="container">
                    <div class="section-head text-black text-center">
                        <h2 class="title text-capitalize">اخر الاخبار</h2>
                        <p>
                            هنا ممكن تشارك ارائك مع ادارة الشركة عن طريق تعليقاتك عن اخر الاخبار والاحداث والمعارض التى تقوم بها الشركة .
                        </p>
                    </div>
                    <div class="row">
                        @foreach($posts as $row)
                            <div class="col-lg-4 col-md-6 wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.3s">
                                <div class="blog-post blog-grid blog-rounded blog-effect1">
                                    <div class="dlab-post-media dlab-img-effect zoom">
                                        <a href="{{ route('show.post', $row->slug)}}"><img src="{{ asset('upload/blog/'.$row->post_image) }}" alt="{{$row->post_title  }}"></a>
                                    </div>
                                    <div class="dlab-info p-a20 border-1 bg-white">
                                        <div class="dlab-post-meta">
                                            <ul>
                                                <li class="post-date"> <strong>
                                                        @php
                                                            $timestamp = strtotime($row->created_at);
                                                            $date = date('j F , Y',$timestamp);
                                                        @endphp

                                                        {{$date}}</strong>  </li>
                                                <li class="post-author"> By <a href="javascript:void(0);">{{ ($row->admin) ? $row->admin->name : 'غير معرف'}} </a> </li>
                                            </ul>
                                        </div>
                                        <div class="dlab-post-title">
                                            <h4 class="post-title"><a href="{{ route('show.post', $row->slug)}}">{{ str_limit($row->post_title,60)  }}</a></h4>
                                        </div>
                                        <div class="dlab-post-text">
                                            <p style="word-wrap: break-word"> {{$row->post_short_details  }}</p>
                                        </div>
                                        <div class="dlab-post-readmore">
                                            <a href="{{ route('show.post', $row->slug)}}" title="READ MORE" rel="bookmark" class="site-button btnhover15">أقرا أكثر

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    @endif
    <!-- Latest From Blog End -->

        <!-- Client logo -->
        <div class="section-full dlab-we-find bg-img-fix p-t20 p-b20 bg-white wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
            <div class="container">
                <div class="section-content">
                    <div class="client-logo-carousel mfp-gallery gallery owl-btn-center-lr owl-carousel owl-btn-3">

                        @foreach($brands as $brand)
                            <div class="item">
                                <div class="ow-client-logo">
                                    <div class="client-logo"><a href="{{ route('products.in.brand',[$brand->id,$brand->brand_name]) }}"><img src="{{ asset($brand->brand_logo) }}" alt="{{ asset($brand->brand_name) }}"></a></div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Client logo END -->
    </div>

    <!-- contact area END -->




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>




@endsection