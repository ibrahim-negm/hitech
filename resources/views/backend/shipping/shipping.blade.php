@extends('admin.admin_master')
@section('title-content') أسعار الشحن - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">أسعار الشحن</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif; font-size: small">أسعار الشحن
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


                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم المحافظة </th>
                                            <th>سعر الشحن</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($shippings)
                                        @foreach($shippings as $key =>$shipping)
                                            <tr>
                                                <td>{{ $key +1}}</td>
                                                <td>{{ $shipping->governorate }}</td>

                                                <th>
                                                    @if($shipping->shipping_price == null)
                                                 لايوجد
                                                    @else
                                                        {{ $shipping->shipping_price }}
                                                    @endif
                                                </th>
                                                <td>
                                                    <a href="{{ url('admin/edit/shipping/'.$shipping->id)  }}" class="btn btn-sm btn-info">تعديل</a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم المحافظة </th>
                                            <th>سعر الشحن</th>
                                            <th width="20%">Action</th>

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