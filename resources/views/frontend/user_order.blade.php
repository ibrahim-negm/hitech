@php

$id = Auth::id();
 $orders = \App\Models\Front\Order::where('user_id',$id)->orderBy('id','DESC')->limit(20)->get();
 $orders_completed = \App\Models\Front\Order::where('user_id',$id)->whereIn('status',[1,2,3])->orderBy('id','DESC')->limit(20)->get();

@endphp

@extends('frontend.layouts.master')
@section('title-content')  طلباتى - هاى تك للتقسيط @endsection

@section('home-content')


    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">طلباتى </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>لوحة التحكم</li>
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
                                    <a href="#" class="list-group-item active">{{ __('site.my_orders') }}</a>
                                   <a href="{{ route('user.wishlist') }}" class="list-group-item">{{ __('site.my_wishlist') }}</a>
                                    <a href="{{ route('user.subscriber') }}" class="list-group-item ">{{ __('site.newsletter') }}</a>
                                    <a href="{{route('user.address')}}" class="list-group-item">{{ __('site.my_addresses') }}</a>
                                    <a href="{{ route('user.update.password') }}" class="list-group-item ">{{ __('site.change_password') }}</a>
                                    <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <br>
                                <h2 class="mb-3">طلباتى</h2>
                                <div class="row">
                                    <div class="table-responsive mr-2 ml-2">
                                        <table class="table table-bordered table-striped table-order-history">
                                            <thead>
                                            <tr>
                                                <th scope="col"># </th>
                                                <th scope="col">تفاصيل الطلب</th>

                                                <th scope="col">{{ __('site.order_date') }}</th>
                                                <th scope="col">{{ __('site.status') }}</th>
                                                <th scope="col">{{ __('site.total') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $key=>$row)

                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td> <a href="{{ route('user.show.order',$row->id) }}" class="ml-1 mr-1">التفاصيل</a></td>

                                                    <td>{{ $row->date }}</td>
                                                    <td>
                                                        @if($row->status == 1)
                                                                <span class="btn  btn-primary btn-sm">جديد</span>
                                                          @elseif($row->status == 2)
                                                            <span class="btn btn-warning btn-sm">تحت المراجعة</span>
                                                        @elseif($row->status == 3)
                                                            <span class="btn btn-success btn-sm">تم الموافقة</span>
                                                        @elseif($row->status == 4)
                                                            <span class="btn btn-danger btn-sm">تم التسليم</span>
                                                        @elseif($row->status == 5)
                                                            <span class="btn btn-danger btn-sm">تم رفضه</span>
                                                        @else
                                                            <span class="btn btn-danger btn-m">Cancel</span>

                                                        @endif
                                                    </td>
                                                    <td>{{ $row->total }} {{ __('site.currency') }}</td>
                                                    <td>
                                                        <a href="{{ route('user.traced.order',$row->id) }}" class="btn btn-info btn-sm">{{ __('site.trace') }}</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                            </div>
                        </div>


            </div>
        </div>
        <!-- END SECTION BREADCRUMB -->

        <!-- START MAIN CONTENT -->


    </div>

    <!-- END MAIN CONTENT -->


@endsection

