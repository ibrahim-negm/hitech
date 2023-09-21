
<?php
use App\Models\Admin\Adv;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Coupon;
use App\Models\Admin\Product;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Subscriber;
use App\Models\Front\Contact;
use App\Models\Front\Order;
use App\Models\Front\Order_details;
use App\Models\Front\Review;
use App\Models\Front\Shipping;
use App\Models\User;

$all_days = Order::whereIn('status',[1,2,3,4,5])->get();
$date = date('d-m-y');
$today =   Order::where('date',$date)->whereIn('status',[1,2,3,4,5])->get();
$month = date('F');
$monthly =   Order::where('month',$month)->whereIn('status',[1,2,3,4,5])->get();
$year = date('Y');
$yearly =   Order::where('year',$year)->whereIn('status',[1,2,3,4,5])->get();
$last_order =  Order::whereIn('status',[1,2,3,4,5])->orderBy('id','desc')->first();
$reviews_no = count(Review::all());
$coupons = Coupon::all();
$brands = Brand::all();
$products = Product::where('status',1)->get();
$categories = Category::all();
$subcategories = Subcategory::all();
$messages = Contact::all();
$replay_messages = Contact::where('status',2)->get();
$read_message = Contact::whereIn('status',[1,2])->get();
$advs = Adv::all();
$subscribers =Subscriber::all();
$users = User::all();
$last_ship =  Shipping::orderBy('id','desc')->first();
$order_details = Order_details::latest()->get();





?>

@extends('backend.layouts.admin_master')
@section('title-content') لوحة التحكم - هاى تك للتقسيط @endsection

@section('admin-content')


    <div class="content-wrapper">
        @include('alerts.success')
        @include('alerts.errors')
        <div class="content-header row">
        </div>
        @if(Auth::user()->permission->company == 1)
        @else
        <div class="content-body">
            <!-- Revenue, Hit Rate & Deals -->
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">عدد الاستعلامات</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0">
                                <div class="row mb-1">
                                    <div class="col-6 col-md-4">
                                        <h5>العدد الكلى</h5>
                                        <h2 class="danger">
                                            @if($all_days)
                                                {{ count($all_days) }}                                             استعلام
                                              @else
                                                استعلام 0
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <h5>اليوم الحالى</h5>
                                        <h2 class="text-muted">
                                            @if($today)
                                            {{ count($today) }} استعلام
                                            @else
                                                استعلام  0
                                            @endif
                                        </h2>
                                    </div>
                                </div>
                                <div class="chartjs">
                                    <canvas id="thisYearRevenue" width="400" style="position: absolute;"></canvas>
                                    <canvas id="lastYearRevenue" width="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-header bg-hexagons">
                                    <h4 class="card-title">الاستعلامات الشهرية
                                        <br><br> <h2 class="danger">
                                            @if($monthly)
                                            {{ count($monthly) }} استعلام
                                            @else
                                                استعلام 0
                                            @endif
                                        </h2>
                                    </h4>

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content collapse show bg-gradient-directional-danger ">
                                    <div class="card-body bg-hexagons-danger">
                                        <h4 class="card-title white">الاستعلامات السنوية
                                            <br>  <h2 class="white">
                                                @if($yearly)
                                                {{  count($yearly) }} استعلام
                                                @else
                                                    استعلام 0
                                                @endif
                                            </h2>

                                        </h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h6 class="text-muted">قيمة اخر استعلام </h6>
                                                <h3>
                                                    @if($last_order)
                                                    {{$last_order->total}} جنية
                                                    @else
                                                        جنية 0
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-trophy success font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h6 class="text-muted">تاريخ اخر أستعلام</h6>
                                                <h3>
                                                    @if($last_order)
                                                    {{ $last_order->date }}
                                                    @else
                                                       لايوجد
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-call-in danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h6 class="text-muted">عدد الاستعلامات </h6>
                                                <h3>
                                                    @if($all_days)
                                                    {{count($all_days)}}  استعلام
                                                    @else
                                                        0
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-basket-loaded success font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h6 class="text-muted">عدد التقييمات</h6>
                                                <h3>
                                                    @if($reviews_no)
                                                    {{ $reviews_no }} تقييم
                                                    @else
                                                        0
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-bell danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد إشعارات الخصم </h6>
                                        <h3>
                                            @if($coupons)
                                                {{count($coupons)}} إشعار
                                            @else
                                                لايوجد
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-action-undo danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد شركاء النجاح </h6>
                                        <h3>
                                            @if($brands)
                                                {{count($brands)}} ماركة
                                            @else
                                                لا يوجد
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-bag success font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد المنتجات </h6>
                                        <h3>
                                            @if($products)
                                                {{count($products)}}      منتج
                                            @else
                                                منتج 0
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-star success font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد المستخدمين </h6>
                                        <h3>
                                            @if($users)
                                                {{count($users)}}  عميل
                                            @else
                                                لايوجد
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-user danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد المتابعيين </h6>
                                        <h3>
                                            @if($subscribers)
                                            {{count($subscribers)}} متابع
                                            @else
                                                لايوجد
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-user-following info font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">عدد الإعلانات </h6>
                                        <h3>
                                            @if($advs)
                                            {{count($advs)}} إعلان
                                            @else
                                                لايوجد
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-paper-clip warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">رسائل العملاء</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0">
                                <p class="pt-1">ما تم قرائته
                                    @if(count($messages)>0)
                                        @if($read_message)
                                        <span class="float-right text-bold-600">{{round((count($read_message)/ count($messages)) *100)}}%</span>
                                        @endif
                                    @else
                                        <span class="float-right text-bold-600">0 </span>

                                    @endif
                                </p>
                                @if(count($messages)>0)
                                    @if($read_message)
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{(count($read_message)/ count($messages)) *100}}%"
                                         aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                    @else
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 0%"
                                                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif
                                @endif
                                <p class="pt-1">ما تم الرد عليه

                                        @if(count($messages)>0)
                                        <span class="float-right">
                                            @if($replay_messages)
                                              <span class="text-bold-600">{{count($replay_messages)}}</span>/{{count($messages)}}
                                            @endif
                                        </span>
                                        @else
                                        <span class="float-right">
                                              <span class="text-bold-600">0</span>/0
                                        </span>
                                        @endif

                                </p>
                                @if(count($messages)>0)
                                    @if($replay_messages)
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{(count($replay_messages) / count($messages))  * 100}}%"
                                         aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                    @else
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 0%"
                                                 aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">بيانات اخر مستعلم</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                        @if($last_ship && $last_ship->order->status > 0)
                                        <tr>

                                            <td class="border-top-0 text-center">{{ $last_ship->ship_name }}</td>
                                        </tr>
                                        <tr>

                                            <td class="border-top-0 text-center">{{ $last_ship->ship_phone }}</td>
                                        </tr>
                                        <tr>

                                            <td  class="border-top-0 text-center">{{ $last_ship->ship_city }}</td>
                                        </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">التصنيفات الرئيسية والفرعية</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                        <h6 class="danger text-bold-600">التصنيفات الرئيسية</h6>
                                        <h4 class="font-large-2 text-bold-400">@if($categories){{ count($categories) }} @else 0 @endif</h4>
                                        <p class="blue-grey lighten-2 mb-0">تصنيفا رئيسياً</p>
                                    </div>
                                    <div class="col-md-6 col-12 text-center">
                                        <h6 class="success text-bold-600">التصنيفات الفرعية</h6>
                                        <h4 class="font-large-2 text-bold-400"> @if($subcategories){{ count($subcategories) }} @else 0 @endif</h4>
                                        <p class="blue-grey lighten-2 mb-0">تصنيفاً فرعياً</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div id="recent-sales" class="col-12 col-md-8 offset-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">أحدث الاستعلامات</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"
                                           href="{{ route('admin.new.order') }}">كل الاستعلامات</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content mt-1">
                            <div class="table-responsive">
                                <table id="recent-orders" class="table table-hover table-xl mb-0">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">اسم المنتج</th>
                                        <th class="border-top-0">صورة المنتج</th>
                                        <th class="border-top-0">العدد</th>
                                        <th class="border-top-0">سعر المنتج</th>
                                        <th class="border-top-0">الإجمالى</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($order_details)
                                        @foreach($order_details as $key=>$row)
                                            @if($key>5)
                                                @break;
                                            @else

                                    <tr>
                                        @if($row->product != null && ($row->order != null && $row->order->status == 1  ))
                                            <td class="text-truncate">  <a href="{{ route('admin.show.order',$row->order_id) }}">{{ str_limit($row->product->product_name,$limit=15) }}</a></td>
                                        <td class="text-truncate p-1">
                                            <a href="{{ route('admin.show.order',$row->order_id) }}"><img src="{{ asset('upload/products/'.$row->product->main_image) }}"  style="width: 45px; height: 50px" alt=""></a>

                                        </td>
                                        <td>
                                            <span class="btn btn-sm btn-outline-danger round">{{ $row->quantity }}</span>
                                        </td>
                                        <td>
                                            {{ $row->singleprice }} جنية
                                        </td>
                                        <th class="text-truncate">
                                            {{ $row->totalprice }} جنية
                                        </th>
                                        @endif
                                    </tr>
                                            @endif
                                        @endforeach
                                      @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<!--/ Total earning & Recent Sales  -->--}}
            {{--<!-- Analytics map based session -->--}}
            {{--<div class="row">--}}
                {{--<div class="col-12">--}}
                    {{--<div class="card box-shadow-0">--}}
                        {{--<div class="card-content">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-9 col-12">--}}
                                    {{--<div id="world-map-markers" class="height-450"></div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3 col-12">--}}
                                    {{--<div class="card-body text-center">--}}
                                        {{--<h4 class="card-title mb-0">Visitors Sessions</h4>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-12">--}}
                                                {{--<p class="pb-1">Sessions by Browser</p>--}}
                                                {{--<div id="sessions-browser-donut-chart" class="height-200"></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-12">--}}
                                                {{--<div class="sales pr-2 pt-2">--}}
                                                    {{--<div class="sales-today mb-2">--}}
                                                        {{--<p class="m-0">Today's--}}
                                                            {{--<span class="success float-right"><i class="ft-arrow-up success"></i> 6.89%</span>--}}
                                                        {{--</p>--}}
                                                        {{--<div class="progress progress-sm mt-1 mb-0">--}}
                                                            {{--<div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25"--}}
                                                                 {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="sales-yesterday">--}}
                                                        {{--<p class="m-0">Yesterday's--}}
                                                            {{--<span class="danger float-right"><i class="ft-arrow-down danger"></i> 4.18%</span>--}}
                                                        {{--</p>--}}
                                                        {{--<div class="progress progress-sm mt-1 mb-0">--}}
                                                            {{--<div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="25"--}}
                                                                 {{--aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- Analytics map based session -->--}}
        </div>
        @endif
    </div>



@endsection