@extends('admin.admin_master')
@section('title-content') تحديث إشعارات الخصم - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> تحديث إشعارات الخصم</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.coupon') }}" style="font-family:'Cairo', sans-serif; font-size: small ">إشعارات الخصم</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> تحديث أشعار خصم {{ $coupon->coupon_code}} </li>
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

                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ url('admin/update/coupon/'.$coupon->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم إشعار الخصم</label>
                                                <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       placeholder="اسم إشعار الخصم" name="coupon_code" value="{{$coupon->coupon_code}}">

                                                @error('coupon_code')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">نسبة الخصم بالجنية</label>
                                                <input type="text" class="form-control @error('coupon_discount') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       placeholder=" نسبة الخصم " name="coupon_discount" value="{{$coupon->coupon_discount}}">

                                                @error('coupon_discount')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" > تحديث البيانات <i class="ft-thumbs-up position-right"></i></button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- LARGE MODAL -->



            </section>


        </div>
    </div>


@endsection