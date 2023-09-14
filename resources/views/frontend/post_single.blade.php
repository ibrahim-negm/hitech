
@extends('frontend.layouts.master')

@section('title-content') - هاى تك للتقسيط  {{ $post_data->post_title }} @endsection

@section('home-content')

    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry align-m text-center">
                    <h2 class="text-white">{{ $post_data->post_title }}</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li><a href="{{ route('all.posts') }}">الاخبار</a></li>
                            <li>{{ $post_data->post_title }}</li>
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
                    <!-- Left part start -->
                    @if($post_data)

                            <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
                                <!-- blog start -->
                                <div class="blog-post blog-single">
                                    <div class="dlab-post-meta">
                                        <ul>
                                            @php
                                                $timestamp = strtoTime($post_data->created_at);
                                                $date = date('j F , Y',$timestamp);
                                            @endphp
                                            <li class="post-date"> <strong>{{ $date }}</strong>  </li>
                                            <li class="post-author"> By <a href="javascript:void(0);">{{ ( $post_data->admin ) ? $post_data->admin->name : 'غير معرف'}}</a> </li>
                                        </ul>
                                    </div>
                                    <div class="dlab-post-title ">
                                        <h4 class="post-title m-t0"><a href="javascript:void(0);">{{ str_limit($post_data->post_title,60) }}</a></h4>
                                    </div>
                                    <div class="dlab-post-media dlab-img-effect zoom-slow">
                                        <a href="javascript:void(0);"><img src="{{ asset('upload/blog/'. $post_data->post_image) }}" alt="{{  $post_data->post_image }}"></a>
                                    </div>
                                    <div class="dlab-post-text">
                                        {!! $post_data->post_details !!}

                                       </div>
                                    @if($post_data->post_tags)
                                    <div class="dlab-post-tags clear">
                                        <div class="post-tags">
                                        @foreach(explode(',',$post_data->post_tags) as $tag)
                                                <a href="{{url('post/search/'.$tag) }}">{{ $tag }} </a>

                                        @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="clear" id="comment-list">
                                    <div class="comments-area" id="comments">
                                        <h2 class="comments-title"> التعليقات ( {{ count($comments) }} )</h2>
                                        <div class="clearfix">
                                            <!-- comment list END -->
                                            <ol class="comment-list">
                                                @if(count($comments) > 0)
                                                    @foreach($comments as $row)
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="comment-author vcard"> <img  class="avatar photo" src="{{ (!empty( $row->user->profile_photo_path))
                                ? url('upload/frontend/users/'.$row->user->profile_photo_path)
                                : url('upload/avatar.png')}}"  alt="user image">
                                                            <cite class="fn">{{ ($row->user) ? $row->user-> name : 'غير معرف'  }}</cite> <span class="says">تعليق :</span> </div>
                                                        @php
                                                        $timestamp = strTotime($row->created_at);
                                                        $date = date('F j, Y, g:i a',$timestamp)
                                                        @endphp
                                                        <div class="comment-meta"> <a href="javascript:void(0);">{{ $date }}</a> </div>
                                                        <p style="word-wrap: break-word">{{ $row->description }} </p>

                                                    </div>
                                                    @php
                                                       $comments_replies = App\Models\Admin\Comment_reply::where('comment_id',$row->id)->get();

                                                    @endphp
                                                    @if(count($comments_replies)> 0)
                                                        @foreach($comments_replies as $reply)
                                                    <ol class="children">
                                                        <li class="comment odd parent">
                                                            <div class="comment-body">
                                                                <div class="comment-author vcard"> <img  class="avatar photo" src="{{ (!empty( $reply->admin->profile_photo_path))
                                                                    ? url('upload/backend/users/'.$reply->admin->profile_photo_path)
                                                                    : url('upload/avatar.png')}}"  alt="user image">

                                                                    <cite class="fn">{{ ($reply->admin) ? $reply->admin->name : 'غير معرف'}}</cite> <span class="says">رد :</span> </div>
                                                                @php
                                                                    $timestamp = strTotime($reply->created_at);
                                                                    $date = date('F j, Y, g:i a',$timestamp)
                                                                @endphp
                                                                <div class="comment-meta"> <a href="javascript:void(0);">{{ $date }}</a> </div>
                                                                <p style="word-wrap: break-word">{{ $reply->description }} </p>
                                                                <div class="reply"> <a href="javascript:void(0);" class="comment-reply-link">رد</a> </div>

                                                            </div>

                                                            <!-- list END -->
                                                        </li>
                                                    </ol>
                                                        @endforeach
                                                    @endif
                                                    <!-- list END -->
                                                </li>
                                                    @endforeach
                                                @endif

                                            </ol>
                                            <!-- comment list END -->
                                            <!-- Form -->
                                            <div class="comment-respond" >
                                                <h4 class="comment-reply-title" id="reply-title">أكتب تعليقك <small> <a style="display:none;" href="javascript:void(0);" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a> </small> </h4>
                                                <form class="comment-form"  method="post" action="{{ route('store.comment',$post_data->id) }}">
                                                    @csrf
                                                    <p class="comment-form-author">
                                                        <label for="author">الاسم <span class="required">*</span></label>
                                                        <input type="text" @auth value="{{ Auth::user()->name }}" @endauth name="name"  placeholder="الأسم بالكامل"  required>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </p>

                                                    <p class="comment-form-email">
                                                        <label for="email">البريد الالكترونى <span class="required">*</span></label>
                                                        <input type="text" @auth value="{{ Auth::user()->email }}" @endauth placeholder="البريد الالكترونى" name="email"  required>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </p>

                                                    <p class="comment-form-comment">
                                                        <label for="comment">التعليق</label>
                                                        <textarea rows="8" name="description" placeholder="التعليق"  required></textarea>

                                                        @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </p>
                                                    <p class="form-submit">
                                                        <input type="submit" value="إرسل تعليقك" class="submit"  name="submit">
                                                    </p>
                                                </form>
                                            </div>
                                            <!-- Form -->
                                        </div>
                                    </div>
                                </div>
                                <!-- blog END -->
                            </div>

                    @endif
                    <!-- left part END -->
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
                                                            <li class="post-author"> By <a href="javascript:void(0);">{{ ($row->admin->name) ? $row->admin->name : 'غير معرف'}}</a> </li>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Left & right section END -->
    <!-- Content END-->

@endsection