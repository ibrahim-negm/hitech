@extends('admin.admin_master')
@section('title-content')   الاستعلامات  - هاى تك للتقسيط@endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">الاستعلامات</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.new.order') }}" style="font-family:'Cairo', sans-serif; font-size: small">الاستعلامات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">عرض الكل
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
                            <div class="card-header">
                                <div class="float-right">
                                    <a href="{{ route('admin.new.order') }}" class="btn btn-sm btn-info  ml-1" style="float: right;" > الاستعلامات الجديدة</a>
                                    <a href="{{ route('admin.reviewed.order') }}" class="btn btn-sm btn-warning  ml-1" style="float: right;" > الاستعلامات المراجعة</a>
                                    <a href="{{ route('admin.done.order') }}" class="btn btn-sm btn-success  ml-1" style="float: right;"> الاستعلامات الموافقة</a>
                                    <a href="{{ route('admin.refused.order') }}" class="btn btn-sm btn-secondary  ml-1" style="float: right;"> الاستعلامات المرفوضة</a>
                                    <a href="{{ route('admin.approved.order') }}" class="btn btn-sm btn-danger  mr-1 ml-1" style="float: right;"> الاستعلامات المستلمة</a>


                                </div>

                            </div>
                            <br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">نوع الاستعلام</th>
                                            <th width="10%">صاحب الاستعلام</th>
                                            <th width="10%">تليفون</th>
                                            <th width="5%">الحالة</th>
                                            <th width="15%">التاريخ</th>
                                            <th width="15%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <?php
                                            $shipping_data = \App\Models\Front\Shipping::where('order_id',$order->id)->first();
                                            ?>
                                            <tr>
                                                <td>{{ ($order->payment_type == 1) ? 'داخلى' : 'خارجى' }}</td>
                                                <td>{{ $shipping_data->ship_name }}</td>
                                                <th>{{ $shipping_data->ship_phone }}  </th>


                                                <td>

                                                    @if($order->status == 1)
                                                      <span class="badge badge-info badge-md">جديد</span>

                                                    @elseif($order->status == 2)
                                                        <span class="badge badge-warning badge-md">تحت المراجعة</span>
                                                    @elseif($order->status == 3)
                                                        <span class="badge badge-success badge-md">تم الموافقة</span>
                                                    @elseif($order->status == 4)
                                                        <span class="badge badge-danger badge-md">تم التسليم</span>
                                                    @elseif($order->status == 5)
                                                        <span class="badge badge-secondary badge-md">تم رفضه</span>
                                                    @else
                                                        <span class="badge badge-danger badge-md">Cancel</span>

                                                    @endif
                                                </td>
                                                <td>{{ $order->date }}</td>
                                                <td>

                                                    <a href="{{ route('admin.show.order',$order->id)  }}" class="btn btn-sm btn-danger"title="رؤية"><i class="ft ft-eye"></i></a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">نوع الاستعلام</th>
                                            <th width="10%">صاحب الاستعلام</th>
                                            <th width="10%">تليفون</th>
                                            <th width="5%">الحالة</th>
                                            <th width="15%">التاريخ</th>
                                            <th width="15%">Action</th>

                                        </tr>
                                        </tfoot>
                                    </table>
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