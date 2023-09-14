
@extends('frontend.layouts.master')
@section('title-content')  تتبع الطلب - هاى تك للتقسيط @endsection

@section('home-content')

    <div class="page-content bg-white">
        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">طلباتى</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li><a href="{{ route('user.order') }}">طلباتى</a></li>
                            <li>تتبع الطلب</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    @if(count($order_details) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card pd-20">

                                                <div class="card-header"> <strong>تفاصيل منتجات الطلب</strong> </div>

                                                <div class="card-body table-responsive">
                                                    <table class="table table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th class="wd-15p">اسم المنتج</th>
                                                            <th class="wd-15p">الصورة</th>
                                                            <th class="wd-15p">الكمية</th>
                                                            <th class="wd-15p">سعر الوحدة</th>
                                                            <th class="wd-20p">الاجمالى</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order_details as $row)
                                                            <tr>

                                                                <td><a href="{{ route('product.details',$row->product->slug) }}">{{ $row->product_name}}</a></td>

                                                                <td> <img src="{{ asset('upload/products/'.$row->product->main_image) }}"  style="width: 90px; height: 100px" alt="{{ $row->product_name}}"> </td>

                                                                <td>{{ $row->quantity }}</td>
                                                                <td>{{ $row->singleprice }}  {{__('site.currency')}} </td>
                                                                <td>{{ $row->totalprice }} {{__('site.currency')}} </td>

                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div><!-- table-wrapper -->
                                            </div><!-- card -->
                                        </div>

                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card pd-20">

                                                <div class="card-header"> <strong>{{ __('site.trace_order') }}</strong> </div>

                                                <div class="card-body ">
                                                    <div class="progress">
                                                        @if($order->status == 1)
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        @elseif($order->status == 2)
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                        @elseif($order->status == 3)
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        @elseif($order->status == 4)
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                        @elseif($order->status == 5)
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>

                                                        @else
                                                            <div class="progress-bar bg-grey-blue" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        @endif

                                                    </div>
                                                </div><!-- table-wrapper -->
                                            </div><!-- card -->
                                        </div>

                                    </div>
                                    <br>
                                    <div class="text-center">
                                        @if($order->status == 1)
                                            <strong class="btn-outline-primary btn--xxl">  الطلب  فى مرحلة طلب جديد</strong>
                                        @elseif($order->status == 2)
                                            <strong class="btn-outline-warning btn--xxl">الطلب  تحت المراجعة</strong>
                                        @elseif($order->status == 3 )
                                            <strong class="btn-outline-warning btn--xxl">الطلب تم الموافقة عليه</strong>
                                        @elseif($order->status == 4)
                                            <strong class="btn-outline-success btn--xxl">  الطلب  تم تسليمه   :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                        @elseif($order->status == 5)
                                            <strong class="btn-outline-danger btn--xxl">  الطلب  تم رفضه   :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                        @else
                                            <strong class="btn-outline-danger btn--xxl"> {{ __('site.order_failed') }}  </strong>
                                        @endif

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



@endsection
