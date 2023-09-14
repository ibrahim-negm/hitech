@extends('admin.admin_master')

@section('title-content') تغير كلمة المرور @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">تغير كلمة المرور  </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.show.admin') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المديرين</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small ">تغير كلمة المرور
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">

            <!-- horizontal grid start -->
            <section class="horizontal-grid" id="horizontal-grid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">

                                <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    @include('alerts.success')
                                    @include('alerts.errors')
                                    <form action="{{ route('update.admin_password') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">كلمة المرور الحالية</label>
                                                    <input id="current_password" type="password" class="form-control"  name="current_password">

                                                    @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">كلمة المرور الجديدة</label>
                                                    <input id="password" type="password" class="form-control"  name="password">

                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">تأكيد كلمة المرور</label>
                                                    <input id="password_confirmation" type="password" class="form-control"  name="password_confirmation">

                                                    @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">تحديث <i class="ft-thumbs-up position-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- horizontal grid end -->

        </div>
    </div>




@endsection
