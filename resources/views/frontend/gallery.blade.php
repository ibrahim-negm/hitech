
@extends('frontend.layouts.master')

@section('title-content') معرض الصور - هاى تك للتقسيط @endsection

@section('home-content')



        <!-- contact area -->

            <!-- Content -->
                <div class="page-content bg-white">
                    <!-- inner page banner -->
                    <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
                        <div class="container">
                            <div class="dlab-bnr-inr-entry">
                                <h2 class="text-white">معرض الصور</h2>
                                <!-- Breadcrumb row -->
                                <div class="breadcrumb-row">
                                    <ul class="list-inline">
                                        <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                                        <li>معرض الصور</li>
                                    </ul>
                                </div>
                                <!-- Breadcrumb row END -->

                        </div>
                    </div>
                </div>
                <!-- inner page banner END -->
                    @if($services)
                <div class="content-block">
                    <!-- Portfolio  -->
                    <div class="section-full content-inner-2 portfolio text-uppercase bg-gray" id="portfolio">
                        <div class="container">
                            <div class="site-filters clearfix center  m-b40">
                                <ul class="filters" data-toggle="buttons">
                                    <li data-filter="all" class="btn active">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>الكل</span></a>
                                    </li>
                                    <li data-filter="web" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>الاجهزة الكهربائية</span></a>
                                    </li>
                                    <li data-filter="advertising" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span> الادوات المنزلية</span></a>
                                    </li>
                                    <li data-filter="branding" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span> الموبيلات</span></a>
                                    </li>
                                    <li data-filter="design" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>دراجات بخارية</span></a>
                                    </li>
                                    <li data-filter="photography" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>أثاث وموبيليا</span></a>
                                    </li>
                                    <li data-filter="php" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>مراتب ومفروشات</span></a>
                                    </li>
                                    <li data-filter="java" class="btn">
                                        <input type="radio">
                                        <a href="javascript:void(0);" class="site-button-secondry button-sm radius-xl"><span>مكن خياطة</span></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="clearfix" id="lightgallery">
                                <ul id="masonry" class=" portfolio-ic dlab-gallery-listing gallery-grid-4 gallery lightgallery text-center">
                                    <li class="all card-container col-lg-3 col-md-6 col-sm-6 p-a0">

                                        @if($images)
                                        @foreach($images as $row)
                                        <div class="dlab-box dlab-gallery-box">
                                            <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                <div class="dlab-post-meta">
                                                    <ul>
                                                        <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                    </ul>
                                                </div>
                                                <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon">
                                                        <div class="text-white">
                                                            <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                            <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dez-info p-a30 bg-white">
                                                <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                <p><small>{{ $row->service->service_name }}</small></p>

                                            </div>
                                        </div>
                                       @endforeach
                                        @endif
                                    </li>
                                    <li class="web card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php
                                            //diving
                                            $images2 = \App\Models\admin\Image::where('service_id',2)->latest()->get();
                                        @endphp
                                        @if($images2)
                                        @foreach($images2 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>
                                        @endforeach
                                        @endif
                                    </li>
                                    <li class="advertising card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php

                                            $images3 = \App\Models\admin\Image::where('service_id',3)->latest()->get();
                                        @endphp
                                        @if($images3)
                                        @foreach($images3 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>

                                        @endforeach
                                        @endif
                                    </li>
                                    <li class="branding card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php
                                            //diving
                                            $images4 = \App\Models\admin\Image::where('service_id',4)->latest()->get();
                                        @endphp
                                        @if($images4)
                                            @foreach($images4 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </li>
                                    <li class="design card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php

                                            $images5 = \App\Models\admin\Image::where('service_id',5)->latest()->get();
                                        @endphp
                                        @if($images5)
                                            @foreach($images5 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>

                                            @endforeach
                                        @endif
                                    </li>

                                    <li class="photography card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php

                                            $images6 = \App\Models\admin\Image::where('service_id',6)->latest()->get();
                                        @endphp
                                        @if($images6)
                                            @foreach($images6 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>

                                            @endforeach
                                        @endif
                                    </li>
                                    <li class="php card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php
                                            //diving
                                            $images7 = \App\Models\admin\Image::where('service_id',7)->latest()->get();
                                        @endphp
                                        @if($images7)
                                            @foreach($images7 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </li>
                                    <li class="java card-container col-lg-3 col-md-6 col-sm-6 p-a0">
                                        @php

                                            $images8 = \App\Models\admin\Image::where('service_id',8)->latest()->get();
                                        @endphp
                                        @if($images8)
                                            @foreach($images8 as $row)
                                                <div class="dlab-box dlab-gallery-box">
                                                    <div class="dlab-media dlab-img-overlay1 dlab-img-effect">
                                                        <div class="dlab-post-meta">
                                                            <ul>
                                                                <li class="post-date"> <strong>{{ date('F j, Y',strtotime($row->created_at)) }}</strong>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0);"> <img src="{{ asset('upload/gallery/'.$row->image) }}"  alt="{{ $row->image_name }}"> </a>
                                                        <div class="overlay-bx">
                                                            <div class="overlay-icon">
                                                                <div class="text-white">
                                                                    <a href="javascript:void(0);"><i class="fa fa-link icon-bx-xs"></i></a>
                                                                    <span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
														<i class="fa fa-picture-o icon-bx-xs"></i>
													</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dez-info p-a30 bg-white">
                                                        <p class="dez-title m-t0"><a href="javascript:void(0);">{{ $row->image_name }}</a></p>
                                                        <p><small>{{ $row->service->service_name }}</small></p>

                                                    </div>
                                                </div>

                                            @endforeach
                                        @endif
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        <!-- contact area END -->
    </div>
    <!-- Content END-->


@endsection