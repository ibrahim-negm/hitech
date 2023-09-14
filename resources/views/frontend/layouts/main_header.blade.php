
<?php

$services = \App\Models\Admin\Service::all();
$wishlist = \App\Models\Front\Wishlist::where('user_id',Auth::id())->get();
$cart = Cart::content();



?>

<!-- header -->
<header class="site-header mo-left header">

    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion logo-light">
                    <a href="{{ url('/') }}"><img src="{{ asset('upload/'.$settings->logo_light) }}" alt="Hi-Tech Logo"></a>

                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <button id="quik-search-btn" type="button" class="site-button-link"><i class="la la-search"></i></button>
                    </div>
                </div>
                <!-- Quik search -->
                <div class="dlab-quik-search">
                    <form action="{{route('products.search')}}" method="post">
                        @csrf
                        <input name="search" value="" type="text" class="form-control" placeholder="اكتب المنتج المراد البحث عنه">
                        <span id="quik-search-remove"><i class="ti-close"></i></span>
                    </form>
                </div>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <div class="logo-header d-md-block d-lg-none">
                        <a href="{{ url('/') }}"><img src="{{ asset('upload/'.$settings->logo_light) }}"  alt="Hi-Tech Logo"></a>
                    </div>
                    <ul class="nav navbar-nav">
                    <li class=" {{ Request::routeIs('main.home') ? 'active' : '' }} "> <a href="{{ url('/') }}">الصفحة الرئيسية</a> </li>
                    <li class="{{ request()->is('about-us')  ? 'active' : '' }} "> <a href="{{ route('about') }}">من نحن</a></li>
                    <li class="{{ request()->is('newest-offers')  ? 'active' : '' }} "> <a href="{{ route('newest.offers') }}"> أحدث العروض</a></li>

                    @if($services)
                    <li><a href="javascript:;">الخدمات<i class="fa fa-chevron-down"></i></a>
                    <ul class="sub-menu">
                    @foreach($services as $service)
                    <li><a href="{{ route('products.in.service',[$service->id,$service->service_name]) }}">{{ $service->service_name }}</a></li>

                    @endforeach
                    </ul>
                    </li>
                    @endif
                    <li><a href="javascript:;">المتجر<i class="fa fa-chevron-down"></i></a>
                    <ul class="sub-menu">
                    <li><a href="javascript:;"><i class="fa fa-angle-right"></i>المنتجات</a>
                        <ul class="sub-menu">
                            <?php $categories = \App\Models\Admin\Category::all(); ?>
                            @if(count($categories) > 0)
                                @foreach($categories as $row)
                                    <li><a href="{{ route('products.in.category',[$row->id,$row->category_name]) }}">{{ $row->category_name }}</a></li>
                                @endforeach
                            @endif

                        </ul>
                    </li>
                    <li><a href="{{ route('show.cart') }}">سلة المنتجات</a></li>
                    <li><a href="{{ route('user.checkout') }}">طلب التقسيط</a></li>
                    <li><a href="{{ route('user.wishlist') }}">القائمة المحفوظة</a></li>

                    @guest
                    <li><a href="{{ route('login') }}">الدخول</a></li>
                    <li><a href="{{route('register')}}">الاشتراك</a></li>
                    @endguest
                    @if(Route::has('login'))
                    @auth()
                    <li> <a href="{{ route('dashboard') }}">حسابى</a></li>
                    <li> <a href="{{ route('user.logout') }}">خروج</a></li>
                    @endauth
                    @endif
                    </ul>
                    </li>
                    <li class="{{ request()->is('show/all/posts')  ? 'active' : '' }} "> <a href="{{ route('all.posts') }}">الاخبار</a></li>
                    @guest
                    <li class="{{ Request::routeIs('login') ? 'active' : '' }}"> <a href="{{ route('login') }}">الدخول</a></li>
                    @endguest
                    @if(Route::has('login'))
                    @auth()
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}"> <a href="{{ route('dashboard') }}">حسابى</a></li>
                    @endauth
                    @endif
                    <li class="{{ request()->is('contact-us')  ? 'active' : '' }} "><a href="{{ route('contact.us') }}">اتصل بنا</a></li>
                    <li><a href="{{route('send.inquiry')}}" style ="color: orangered">طلب تقسيط</a></li>
                    </ul>
                    <div class="dlab-social-icon">
                        <ul>
                            <li><a class="site-button facebook circle-sm outline fa fa-facebook" href="{{ $settings->facebook }}"></a></li>
                            <li><a class="site-button twitter circle-sm outline fa fa-twitter" href="{{ $settings->twitter }}"></a></li>
                            <li><a class="site-button youtube circle-sm outline fa fa-youtube" href="{{ $settings->youtube }}"></a></li>
                            <li><a class="site-button instagram circle-sm outline fa fa-instagram" href="{{ $settings->instagram }}"></a></li>
                            <li><a class="site-button whatsapp circle-sm outline fa fa-whatsapp" href="{{ $settings->whatsup }}"></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->


