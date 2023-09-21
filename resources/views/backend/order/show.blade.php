@extends('backend.layouts.admin_master')
@section('title-content')  تفاصيل الاستعلام - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تفاصيل الاستعلام</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.new.order') }}" style="font-family:'Cairo', sans-serif; font-size: small"> الاستعلامات </a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small"> استعلام رقم  {{ $order-> id}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <br><br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">

                                             <div class="card-header"> <strong>تفاصيل الاستعلام</strong> {{ $order-> id}} </div>
                                             <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th> نوع الاستعلام : </th>
                                                            <td style="color: maroon"> {{ ($order->payment_type == 1) ? 'استعلام داخلى' : 'استعلام خارجى' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> إسم صاحب الاستعلام : </th>
                                                            <td style="color: maroon"> {{ $shipping->ship_name }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> رقم التليفون : </th>
                                                            <td style="color: maroon"> {{ $shipping->ship_phone }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الالكترونى : </th>
                                                            <td style="color: maroon">  {{ ($shipping->ship_email) ? $shipping->ship_email : 'لا يوجد' }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> العنوان : </th>
                                                            <td style="color: maroon">{{ $shipping->ship_address  }} </td>
                                                        </tr>



                                                        <tr>
                                                            <th> المدينة : </th>
                                                            <td style="color: maroon"> {{ ($shipping->ship_city) ? $shipping->ship_city : 'لا يوجد'  }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> الشهر : </th>
                                                            <td style="color: maroon"> {{ $order->month }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> اليوم : </th>
                                                            <td style="color: maroon"> {{ $order->date }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> ملاحظات على الطلب : </th>
                                                            <td style="color: maroon"> {{ $order->notes }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> الحالة: </th>
                                                            <td>
                                                                @if($order->status == 1)
                                                                    <span class="badge badge-info badge-md">جديد</span>

                                                                @elseif($order->status == 2)
                                                                    <span class="badge badge-warning badge-md">تحت المراجعة</span>
                                                                @elseif($order->status == 3)
                                                                    <span class="badge badge-success badge-md">تم الموافقة عليه</span>
                                                                @elseif($order->status == 4)
                                                                    <span class="badge badge-danger badge-md">تم التسليم</span>
                                                                @elseif($order->status == 5)
                                                                    <span class="badge badge-secondary badge-md">تم رفضه</span>
                                                                @else
                                                                    <span class="badge badge-danger badge-md">Cancel</span>

                                                                @endif

                                                            </td>

                                                        </tr>

                                                    </table>


                                                </div>



                                            </div>
                                        </div>


                                        @if($guarantee)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header"><strong>تفاصيل الضامن</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th > اسم الضامن : </th>
                                                            <td style="color: maroon"> {{ ($guarantee) ? $guarantee->guarantee_name : 'لايوجد'}}  </td>
                                                        </tr>

                                                        <tr>
                                                            <th> التليفون : </th>
                                                            <td style="color: maroon"> {{ ($guarantee) ? $guarantee->guarantee_phone : 'لايوجد'}} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الالكترونى : </th>
                                                            <td style="color: maroon"> {{ ($guarantee) ? $guarantee->guarantee_email : 'لايوجد'}} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> العنوان : </th>
                                                            <td style="color: maroon"> {{ ($guarantee) ? $guarantee->guarantee_address : 'لايوجد'}} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> المدينة : </th>
                                                            <td style="color: maroon"> {{ ($guarantee) ? $guarantee->guarantee_city : 'لايوجد'}} </td>
                                                        </tr>






                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        @endif


                                    </div>

                                    @if(count($order_details) > 0)
                                    <div class="row">

                                        <div class="card pd-20 pd-sm-40 col-lg-12">

                                            <div class="card-header "> <strong>تفاصيل منتجات الاستعلام</strong> </div>

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
                                                        @if($row->product)

                                                        <tr>

                                                            <td> <a href="{{ route('admin.show.product',$row->product_id)  }}">{{ $row->product_name}}</a></td>

                                                            <td> <img src="{{ asset('upload/products/'.$row->product->main_image) }}"  style="width: 90px; height: 100px" alt=""> </td>

                                                            <th class="text-center">{{ $row->quantity }}
                                                                <br><br>
                                                                <span class="badge badge-danger"> الرصيد فى المخزن :  {{ $row->product->product_quantity }} </span>
                                                            </th>
                                                            <td>{{ $row->singleprice }} جنيه </td>
                                                            <td>{{ $row->totalprice }} جنيه </td>

                                                        </tr>
                                                        @endif
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div><!-- table-wrapper -->
                                        </div><!-- card -->


                                    </div>
                                    @endif
                                    <div class="text-center">
                                   @if($order->status == 1)
                                        <a href="{{ url('admin/delivery/process/'.$order->id) }}" class="btn btn-warning"> تحت المراجعة </a>


                                        @elseif($order->status == 2)
                                        <a href="{{ url('admin/delivery/done/'.$order->id) }}" class="btn btn-success">الموافقة عليه </a>
                                        <a href="{{ url('admin/order/refused/'.$order->id) }}" class="btn btn-secondary"> رفض الاستعلام </a>

                                     @elseif($order->status == 3)
                                            <a href="{{ url('admin/order/approved/'.$order->id) }}" class="btn btn-danger"> تم التسليم </a>

                                    @elseif($order->status == 4)
                                        <strong class="text-success text-center">  هذا الطلب تم تسليمه بنجاح للعميل بتاريخ  :
                                            <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                        </strong>
                                    @elseif($order->status == 5)
                                        <strong class="text-secondary text-center">  هذا الاستعلام تم رفضه للعميل بتاريخ  :
                                            <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                        </strong>
                                     @else
                                            <strong class="text-success text-center">  هذا الطلب لم يتم تنشيطه من العميل  :
                                                <span class="text-danger"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('Y-m-d') }} </span>
                                            </strong>
                                    @endif

                                    </div>









                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ########## END: MAIN PANEL ########## -->

            </section>

        </div>
    </div>


@endsection