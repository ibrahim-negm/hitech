
<?php
$route = Route::current()->getName();
?>

<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main" style="font-size: large">اللوحة الرئيسية</span></a>

        </li>

        <li class=" navigation-header">
            <span data-i18n="nav.category.layouts" style="font-size: large; color: yellow">لوحة التحكم</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                                                                    data-placement="right" data-original-title="Layouts"></i>
        </li>

        @if(  Auth::user()->permission->service == 1)
            <li class=" nav-item {{ ($route == 'admin.service' || $route == 'admin.edit.service' ) ? 'open' : '' }}"><a href="#"><i class="la la-columns"></i><span class="menu-title" data-i18n="nav.page_layouts.main" style="font-size: large">الخدمات الرئيسة</span><span class="badge badge badge-pill badge-danger float-right mr-2">@if($services)  {{ count($services) }} @else 0 @endif</span></a>
                      <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.service') }}" data-i18n="nav.page_layouts.1_column" style="font-size: medium">عرض الكل</a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->permission->brand == 1)
            <li class=" nav-item {{ ($route == 'admin.brand' || $route == 'admin.edit_brand' ) ? 'open' : '' }}">
                <a href="#"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="nav.horz_nav.main"  style="font-size: large">شركاء النجاح</span><span class="badge badge badge-pill badge-warning float-right mr-2">@if($brands)  {{ count($brands) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.brand') }}" data-i18n="nav.horz_nav.horizontal_navigation_types.main" style="font-size: medium">عرض الكل</a>

                    </li>
                </ul>
            </li>
        @endif

        @if(  Auth::user()->permission->category == 1)
            <li class=" nav-item  {{ ($route == 'admin.category' || $route == 'admin.edit.category' ) ? 'open' : '' }}"><a href="#"><i class="la la-check-circle"></i><span class="menu-title" data-i18n="nav.page_layouts.main" style="font-size: large">التصنيفات الرئيسة</span><span class="badge badge-pill badge-info float-right mr-2">  @if($categories)  {{ count($categories) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.category') }}" data-i18n="nav.page_layouts.1_column" style="font-size: medium">عرض الكل</a></li>
                </ul>
            </li>
        @endif

        @if(  Auth::user()->permission->subcategory == 1)
            <li class=" nav-item {{ ($route == 'admin.subcategory' || $route == 'admin.subsubcategory'  || $route == 'admin.edit.subcategory'  || $route == 'admin.edit.subsubcategory') ? 'open' : '' }}">
                <a href="#"><i class="la la-check-square"></i><span class="menu-title" data-i18n="nav.page_layouts.main" style="font-size: large">التصنيفات الفرعية</span><span class="badge badge-pill badge-success float-right mr-2">  @if($subcategories)  {{ count($subcategories) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.subcategory') }}" data-i18n="nav.page_layouts.1_column" style="font-size: medium">عرض الكل</a></li>
                    <li><a class="menu-item" href="{{ route('admin.subsubcategory') }}" data-i18n="nav.page_layouts.1_column" style="font-size: medium">التصنفيات الفرعية -> الفرعية</a></li>

                </ul>
            </li>
        @endif



        @if( Auth::user()->permission->product == 1)
        <li class=" nav-item {{ ($route == 'admin.approved.status.products' || $route == 'admin.create_product' ||
         $route == 'admin.approved.products' || $route == 'admin.status.products' || $route == 'admin.show.product' ||
           $route == 'admin.none.approved.status.products' || $route == 'admin.edit.product') ? 'open' : '' }}">
            <a href="#"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">المنتجات</span><span class="badge badge badge-pill badge-danger float-right mr-2">@if($products)  {{ count($products) }} @else 0 @endif</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.approved.status.products') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                <li><a class="menu-item" href="{{ route('admin.create_product') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">اضافة منتج</a>
                </li>

            </ul>
        </li>
        @endif



        @if( Auth::user()->permission->coupon == 1)
        <li class=" nav-item {{ ($route == 'admin.coupon' || $route == 'admin.edit.coupon' ) ? 'open' : '' }}"><a href="#"><i class="la la-envelope-o"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">إشعارات الخصم</span><span class="badge badge badge-pill badge-warning float-right mr-2">@if($coupons)  {{ count($coupons) }} @else 0 @endif</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.coupon') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                </li>

            </ul>
        </li>
        @endif

        @if( Auth::user()->permission->order == 1)
        <li class=" nav-item {{ ($route == 'admin.new.order' || $route == 'admin.reviewed.order'
         || $route == 'admin.done.order' || $route == 'admin.show.order') ? 'open' : '' }}"><a href="#"><i class="la la-bank"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">الاستعلامات</span><span class="badge badge badge-pill badge-info float-right mr-2">@if($orders)  {{ count($orders) }} @else 0 @endif</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.new.order') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                </li>

            </ul>
        </li>

        @endif



        @if( Auth::user()->permission->role == 1)
        <li class=" nav-item {{ ($route == 'admin.show.admin' || $route == 'admin.create.admin'
         || $route == 'admin.edit.admin' ) ? 'open' : '' }}"><a href="#"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">مديرى لوحة التحكم</span><span class="badge badge badge-pill badge-danger float-right mr-2">@if($admins) {{ count($admins) }} @else 0 @endif</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{route('admin.show.admin')}}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                </li>
                <li><a class="menu-item" href="{{route('admin.create.admin')}}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">إضافة مدير</a>
                </li>

            </ul>
        </li>
        @endif

        @if( Auth::user()->permission->user == 1)
            <li class=" nav-item {{ ($route == 'admin.show.user' ) ? 'open' : '' }}"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">المستخدمين</span><span class="badge badge badge-pill badge-warning float-right mr-2">@if($user)  {{ count($user) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.show.user')}}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                    </li>


                </ul>
            </li>
        @endif

        @if( Auth::user()->permission->stock==1)
            <li class="nav-item {{ ($route == 'admin.stock' ) ? 'open' : '' }}"><a href="#"><i class="la la-balance-scale"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">المخزن</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.stock') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">عرض الكل</a>
                    </li>

                </ul>
            </li>
        @endif

        @if( Auth::user()->permission->report==1)
        <li class=" nav-item {{ ($route == 'admin.daily.report' || $route == 'admin.monthly.report'
         || $route == 'admin.search.report'  || $route == 'search.by.date'
          || $route == 'search.by.month'  || $route == 'search.by.year' ) ? 'open' : '' }}">
            <a href="#"><i class="la la-file"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">التقارير</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.daily.report') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">التقرير اليومى </a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.monthly.report') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">التقرير الشهرى  </a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.search.report') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium"> البحث عن ... </a>
                </li>

            </ul>
        </li>
        @endif

        @if( Auth::user()->permission->setting==1)
            <li class=" nav-item {{ ($route == 'admin.setting' || $route == 'admin.seo'
         || $route == 'admin.shipping'  || $route == 'admin.edit.shipping') ? 'open' : '' }}">
            <a href="#"><i class="la la-warning"></i><span class="menu-title" data-i18n="nav.page_headers.main" style="font-size: large">الاعدادات</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.setting') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">الاعدادات العامة</a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.seo') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">محركات البحث</a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.shipping') }}" data-i18n="nav.page_headers.headers_breadcrumbs_basic" style="font-size: medium">أسعار الشحن</a>
                </li>

            </ul>
        </li>
        @endif

        <li class=" navigation-header">
            <span data-i18n="nav.category.general" style="font-size: large; color: yellow">الصفحات</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
             data-placement="right" data-original-title="General"></i>
        </li>

        @if( Auth::user()->permission->post==1)
            <li class=" nav-item {{ ($route == 'admin.post' || $route == 'admin.create_post'
         || $route == 'admin.show.post'  || $route == 'admin.edit.post') ? 'open' : '' }}">
                <a href="#"><i class="la la-navicon"></i><span class="menu-title" data-i18n="nav.navbars.main" style="font-size: large">الاخبار</span><span class="badge badge badge-pill badge-info float-right mr-2">@if($posts)  {{ count($posts) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.post') }}" data-i18n="nav.navbars.nav_light" style="font-size: medium">عرض الكل</a>

                </ul>
            </li>
        @endif

        @if(  Auth::user()->permission->gallery==1)
            <li class=" nav-item {{ ($route == 'admin.image' || $route == 'admin.edit.image') ? 'open' : '' }}">
                <a href="#"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="nav.horz_nav.main"  style="font-size: large">معرض الصور</span><span class="badge badge badge-pill badge-warning float-right mr-2">@if($images)  {{ count($images) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.image') }}" data-i18n="nav.horz_nav.horizontal_navigation_types.main" style="font-size: medium">عرض الكل</a>

                    </li>
                </ul>
            </li>
        @endif

        @if( Auth::user()->permission->employee==1)
            <li class=" nav-item {{ ($route == 'admin.employee' || $route == 'admin.edit.employee') ? 'open' : '' }}">
                <a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.changelog.main" style="font-size: large">الموظفين</span><span class="badge badge badge-pill badge-danger mr-2">@if($employees)  {{ count($employees) }} @else 0 @endif</span></a>

                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.employee') }}"
                           data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
                    </li>

                </ul>

            </li>
        @endif

        @if( Auth::user()->permission->subscriber==1)
            <li class=" nav-item {{ ($route == 'admin.subscriber' || $route == 'admin.send.news') ? 'open' : '' }}"><a href="#"><i class="la la-paint-brush"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">المتابعين</span><span class="badge badge badge-pill badge-primary float-right mr-2">@if($subscribers)  {{ count($subscribers) }} @else 0 @endif</span></a>
            <ul class="menu-content">

                <li><a class="menu-item" href="{{ route('admin.subscriber') }}" data-i18n="nav.color_palette.color_palette_red"  style="font-size: medium">عرض الكل</a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.send.news') }}" data-i18n="nav.color_palette.color_palette_red"  style="font-size: medium">إرسال نشرة</a>
                </li>

            </ul>
        </li>
        @endif

        @if( Auth::user()->permission->slider==1)
            <li class=" nav-item {{ ($route == 'admin.slider' || $route == 'admin.create.slider'
            || $route == 'admin.edit.slider'  ) ? 'open' : '' }}">
                <a href="#"><i class="la la-puzzle-piece"></i><span class="menu-title" data-i18n="nav.starter_kit.main" style="font-size: large">السلايدر</span><span class="badge badge badge-pill badge-warning float-right mr-2">@if($sliders)  {{ count($sliders) }} @else 0 @endif</span></a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('admin.slider') }}"
                       data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
                </li>
                <li><a class="menu-item" href="{{ route('admin.create.slider') }}"
                       data-i18n="nav.starter_kit.1_column" style="font-size: medium">إضافة سلايدر</a>
                </li>

            </ul>
        </li>
        @endif

        @if( Auth::user()->permission->advs==1)
            <li class=" nav-item {{ ($route == 'admin.adv' || $route == 'admin.create.adv'
            || $route == 'admin.edit.adv'  ) ? 'open' : '' }}">
            <a href="#"><i class="la la-copy"></i><span class="menu-title" data-i18n="nav.changelog.main" style="font-size: large">الاعلانات</span><span class="badge badge badge-pill badge-success mr-2">@if($advs)  {{ count($advs) }} @else 0 @endif</span></a>

        <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('admin.adv') }}"
                   data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
            </li>
            <li><a class="menu-item" href="{{ route('admin.create.adv') }}"
                   data-i18n="nav.starter_kit.1_column" style="font-size: medium">إضافة أعلان</a>
            </li>

        </ul>
        </li>
        @endif



        @if( Auth::user()->permission->message==1)
            <li class=" nav-item {{ ($route == 'admin.message' || $route == 'admin.show.message') ? 'open' : '' }}">
            <a href="#"><i class="la la-phone"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">رسائل العملاء</span><span class="badge badge badge-pill badge-danger mr-2">@if($messages)  {{ count($messages) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.message') }}"
                           data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
                    </li>


                </ul>

            </li>
        @endif

        @if( Auth::user()->permission->comment==1)
            <li class=" nav-item {{ ($route == 'admin.comment' || $route == 'admin.show.comment') ? 'open' : '' }}">
                <a href="#"><i class="la la-comment"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">التعليقات</span><span class="badge badge badge-pill badge-warning mr-2">@if($comments)  {{ count($comments) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.comment') }}"
                           data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
                    </li>


                </ul>


            </li>
        @endif

        @if( Auth::user()->permission->review==1)
            <li class=" nav-item {{ ($route == 'admin.review' || $route == 'admin.show.review') ? 'open' : '' }}">
                <a href="#"><i class="la la-reddit"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">أراء العملاء</span><span class="badge badge badge-pill badge-info mr-2">@if($reviews)  {{ count($reviews) }} @else 0 @endif</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.review') }}"
                           data-i18n="nav.starter_kit.1_column" style="font-size: medium">عرض الكل</a>
                    </li>


                </ul>


            </li>
        @endif

        {{--@if(Auth::user()->permission->about==1)--}}
        {{--<li class=" nav-item"><a href="#"><i class="la la-compress"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">من نحن</span></a>--}}
        {{--</li>--}}
        {{--@endif--}}





        <li class=" nav-item"><a href="{{ route('admin.logout') }}"><i class="la la-power-off"></i><span class="menu-title" data-i18n="nav.color_palette.main" style="font-size: large">خروج</span></a>
        </li>

    </ul>
</div>