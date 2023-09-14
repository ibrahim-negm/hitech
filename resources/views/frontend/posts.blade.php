
@extends('frontend.layouts.master')

@section('title-content') كل الاخبار - هاى تك للتقسيط @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">كل الاخبار</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>كل الاخبار</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-area">
            <div class="container">

                <div class="row">

                    <!-- left part start -->
                @if(count($posts) > 0)
                    <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                            <div class="row">
                                <!-- blog grid -->
                                <div id="masonry" class="dlab-blog-grid-3">
                                    @foreach($posts as $row)
                                        <div class="post card-container col-lg-4 col-md-12 col-sm-12">
                                            <div class="blog-post blog-grid blog-rounded blog-effect1">
                                                <div class="dlab-post-media dlab-img-effect">
                                                    <a href="{{ route('show.post', $row->slug)}}"><img src="{{ asset('upload/blog/'.$row->post_image) }}" alt="{{$row->slug}}"></a>
                                                </div>
                                                <div class="dlab-info p-a20 border-1">
                                                    <div class="dlab-post-meta">
                                                        <ul>
                                                            @php
                                                                $timestamp = strtoTime($row->created_at);
                                                                $date = date('j F , Y',$timestamp);
                                                            @endphp
                                                            <li class="post-date"> <strong>{{ $date }}</strong> </li>
                                                            <li class="post-author"> By <a href="javascript:void(0);">{{ $row->admin->name }}</a> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-title">
                                                        <h4 class="post-title"><a href="{{ route('show.post', $row->slug)}}">{{$row->post_title  }}</a></h4>
                                                    </div>
                                                    <div class="dlab-post-text">
                                                        <p style="word-wrap: break-word"> {{$row->post_short_details  }}</p>
                                                    </div>
                                                    <div class="dlab-post-readmore">
                                                        <a href="{{ route('show.post', $row->slug)}}" title="أقرا أكثر" rel="bookmark" class="site-button">أقرا أكثر
                                                            <i class="ti-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- blog grid END -->
                                <!-- Pagination -->

                                <div class="pagination-bx clearfix col-md-12 m-b30 text-center">
                                    <ul class="pagination">
                                        {{ $posts->onEachSide(0)->links() }}
                                    </ul>
                                </div>

                                <!-- Pagination END -->
                            </div>
                        </div>
                @endif

                <!-- Side bar start -->
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                        <aside  class="side-bar sticky-top">
                            <div class="widget">
                                <h5 class="widget-title style-1">البحث عن</h5>
                                <div class="search-bx style-1">
                                    <form role="search" method="post" action="{{route('search.post')}}">
                                        @csrf
                                        <div class="input-group">
                                            <input  class="form-control" placeholder="أكتب ما تريد البحث عنه..." type="text" name="search" required>
                                            <span class="input-group-btn">
												<button type="submit" class="fa fa-search text-primary"></button>
                                            </span>
                                            @error('search')
                                            <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @php
                                $recent_posts = App\Models\Admin\Post::where('status',1)->latest()->take(3)->get()
                            @endphp
                            @if(count($recent_posts) > 0)
                                <div class="widget recent-posts-entry">
                                    <h5 class="widget-title style-1">أحدث الاخبار</h5>
                                    <div class="widget-post-bx">
                                        @foreach($recent_posts as $row)
                                            <div class="widget-post clearfix">
                                                <div class="dlab-post-media">
                                                    <img src="{{ asset('upload/blog/'.$row->post_image) }}" width="200" height="143" alt="{{ $row->post_title }}">
                                                </div>
                                                <div class="dlab-post-info">
                                                    <div class="dlab-post-meta">
                                                        <ul>
                                                            @php
                                                                $timestamp = strtoTime($row->created_at);
                                                                $date = date('j F , Y',$timestamp);
                                                            @endphp
                                                            <li class="post-date"> <strong>{{$date}}</strong> </li>
                                                            <li class="post-author"> By <a href="javascript:void(0);">{{ $row->admin->name }}</a> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="dlab-post-header">
                                                        <h6 class="post-title"><a href="{{ route('show.post', $row->slug)}}">{{ $row->post_title }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif
                            <div class="widget widget-newslatter">
                                <h5 class="widget-title style-1">النشرة الاخبارية</h5>
                                <div class="news-box">
                                    <p>سجل الان فى النشرة الاخبارية عن طريق بريدك الالكترونى.</p>
                                    <form  action="{{ route('store.subscriber') }}" method="post">
                                        @csrf
                                        <div class="dzSubscribeMsg"></div>
                                        <div class="input-group">
                                            <input name="email" type="email" class="form-control" placeholder="بريدك الالكترونى" required/>
                                            <button name="submit" value="Submit" type="submit" class="site-button btn-block radius-no">أشترك الان</button>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                    </form>
                                </div>
                            </div>
                            @if(count($images) > 0)
                                <div class="widget widget_gallery gallery-grid-4">
                                    <h5 class="widget-title style-1"> معرض الصور </h5>
                                    <ul id="lightgallery" class="lightgallery">
                                        @foreach($images as $row)
                                            <li>
                                                <div class="dlab-post-thum dlab-img-effect">
											<span data-exthumbimage="{{ asset('upload/gallery/'.$row->image) }}" data-src="{{ asset('upload/gallery/'.$row->image) }}" class="check-km" title="{{ $row->image_name }}">
												<img src="{{ asset('upload/gallery/'.$row->image) }}" alt="{{ $row->image_name }}">
											</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(count($services) > 0)
                                <div class="widget widget_archive">
                                    <h5 class="widget-title style-1">خدمات التقسيط</h5>
                                    <ul>
                                        @foreach( $services as $service)
                                            <li><a href="{{ route('products.in.service',[$service->id,$service->service_name]) }}">
                                                    {{ $service->service_name }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @php
                                $posts_with_tags = \App\Models\Admin\Post::where('status',1)->inRandomOrder()->get();
                                $posts_tags = array();
                                foreach ($posts_with_tags as $row ){
                                    foreach( explode(',',$row->post_tags) as $tags){
                                    $posts_tags[] = $tags;
                                     if(count($posts_tags) > 10){
                                   break;
                                   }
                                    }
                                }
                            @endphp
                            @if(count($posts_with_tags) > 0)
                                <div class="widget widget_tag_cloud radius">
                                    <h5 class="widget-title style-1">الكلمات الاسترشادية</h5>
                                    <div class="tagcloud">
                                        @foreach($posts_tags as $tag)
                                            <a href="{{url('post/search/'.$tag) }}">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </aside>
                    </div>
                    <!-- Side bar END -->
                <!-- left part END -->
                </div>
            </div>
        </div>
    </div>
    <!-- Left & right section END -->
    <!-- Content END-->













@endsection