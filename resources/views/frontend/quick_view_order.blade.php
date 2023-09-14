@php


    $lang= app()->getLocale();

@endphp

@extends('frontend.layouts.master')

@section('title-content')  طلباتى - هاى تك للتقسيط @endsection

@section('home-content')

    <div class="page-content bg-white">

        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">طلباتى </h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li><a href="{{ route('user.order') }}">طلباتى </a></li>
                            <li>تفاصيل الطلب</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="content-area">

            <div class="container">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header"> <strong>عرض التفاصيل لطلب رقم </strong> {{ $order-> id}} </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th width="30%"> اسم صاحب الطلب : </th>
                                                            <td style="color: maroon"> {{ $order->user->name }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%"> {{ __('site.phone') }} : </th>
                                                            <td style="color: maroon"> {{ $order->user->phone }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">العنوان : </th>
                                                            <td style="color: maroon"> {{ ($order->user->address) ? $order->user->address : $shipping->ship_address }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">المدينة : </th>
                                                            <td style="color: maroon"> {{  $shipping->ship_city }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th width="30%"> {{ __('site.mail') }} : </th>
                                                            <td style="color: maroon"> {{ $order->user->email }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th width="30%"> رقم الطلب : </th>
                                                            <td style="color: maroon">{{ $order-> id}} </td>
                                                        </tr>



                                                        <tr>
                                                            <th width="40%">ملاحظات على الطلب :</th>
                                                            <td style="color: maroon"> {{ ($order-> notes) ?  $order-> notes : 'لايوجد'}} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%"> {{ __('site.subtotal') }} :</th>
                                                            <td style="color: maroon"> {{ $order->subtotal }} {{ __('site.currency') }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th width="30%"> {{ __('site.total_purchases') }} : </th>
                                                            <td style="color: maroon"> {{ $order->total }} {{ __('site.currency') }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%"> {{ __('site.month') }} : </th>
                                                            <td style="color: maroon"> {{ $order->month }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%"> {{ __('site.day') }} : </th>
                                                            <td style="color: maroon"> {{ $order->date }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">  {{ __('site.status') }} : </th>
                                                            <td>
                                                                @if($order->status == 1)
                                                                    <span class=" btn-primary btn-sm">جديد</span>
                                                                @elseif($order->status == 2)
                                                                    <span class="btn-warning btn-sm">تحت المراجعة</span>
                                                                @elseif($order->status == 3)
                                                                    <span class="btn-success btn-sm">تم الموافقة</span>
                                                                @elseif($order->status == 4)
                                                                    <span class="btn-danger btn-sm">تم التسليم</span>
                                                                @elseif($order->status == 5)
                                                                    <span class="btn-danger btn-sm">تم رفضه</span>
                                                                @else
                                                                    <span class="btn-danger btn-sm">Cancel</span>

                                                                @endif

                                                            </td>

                                                        </tr>


                                                    </table>


                                                </div>



                                            </div>
                                        </div>



                                        @if($guarantee)
                                        <div class="col-md-6 " >
                                            <div class="card">
                                                <div class="card-header"><strong>بيانات الضامن</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th width="30%">  أسم الضامن :  </th>
                                                            <td style="color: maroon"> {{ $guarantee->guarantee_name }}  </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">تليفون الضامن : </th>
                                                            <td style="color: maroon"> {{ $guarantee->guarantee_phone }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">  البريد الالكترونى : </th>
                                                            <td style="color: maroon"> {{ $guarantee->guarantee_email }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="30%">  عنوان الضامن : </th>
                                                            <td style="color: maroon"> {{ $guarantee->{'guarantee_address'} }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th width="30%">  المدينة : </th>
                                                            <td style="color: maroon"> {{ $guarantee->guarantee_city }} </td>
                                                        </tr>





                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                         @endif


                                    </div>
                @if(count($order_details) > 0)
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card pd-20">

                                                <div class="card-header"> <strong>تفاصيل منتجات الاستعلام</strong> </div>

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
                                    <div class="text-center">
                                        @if($order->status == 1)
                                            <strong class="btn-primary btn-lg">  هذا الطلب جديد</strong>
                                        @elseif($order->status == 2)
                                            <strong class="btn-warning btn-lg">هذا الطلب تحت المراجعة</strong>
                                        @elseif($order->status == 3)
                                            <strong class="btn-success btn-lg"> هذا الطلب تم الموافقه على تنفيذه :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                        @elseif($order->status == 4)
                                            <strong class="btn-success btn-lg"> هذا الطلب تم تسليمه يوم  :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                        @elseif($order->status == 5)
                                            <strong class="btn-success btn-lg"> هذا الطلب تم رفضه يوم  :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                        @else
                                            <strong class="btn-outline-danger btn--xxl"> {{ __('site.order_failed') }}  </strong>
                                        @endif

                                    </div>

                                </div>
        </div>

    </div>

    <!-- END MAIN CONTENT -->


@endsection
