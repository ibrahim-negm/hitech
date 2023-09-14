@extends('admin.admin_master')
@section('title-content')  تعديل مدير مسئول - هاى تك للتقسيط@endsection


@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">تعديل مدير مسئول</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.show.admin') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المديرين</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> تعديل مدير مسئول </li>
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
                                    <form action="{{ route('admin.update.admin',$admin_permission->id) }}" method="POST" >
                                        @csrf

                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> اسم المدير<span class="text-danger"> * </span></label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                   placeholder="اسم المدير" name="name"  value="{{ $admin_permission->admin->name }}" required>

                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                            @enderror


                                                        </div>
                                                    </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> رقم التليفون<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder=" رقم التليفون" name="phone" value="{{ $admin_permission->admin->phone }}" required>

                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                             </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">البريد الالكترونى <span class="text-danger"> * </span></label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="البريد الالكترونى" name="email" value="{{ $admin_permission->admin->email }}" required>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                            @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">كلمة المرور </label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="كلمة المرور" name="password" >

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row skin skin-flat mg-b-25">


                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="service" value="1"
                                                       @if($admin_permission->service == 1) checked @endif>
                                                        <label>الخدمات الرئيسية
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="brand" value="1"
                                                               @if($admin_permission->brand == 1) checked @endif>

                                                        <label>شركاء النجاح
                                                        </label>
                                                    </fieldset>
                                                </div>


                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="category" value="1"
                                                               @if($admin_permission->category == 1) checked @endif>
                                                        <label>التصنيفات الرئيسية
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="subcategory" value="1"
                                                               @if($admin_permission->subcategory == 1) checked @endif>
                                                        <label>التصنيفات الفرعية
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="product" value="1"
                                                               @if($admin_permission->product == 1) checked @endif>

                                                        <label>  المنتجات
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="coupon" value="1"
                                                               @if($admin_permission->coupon == 1) checked @endif>

                                                        <label>أشعارات الخصم
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="order" value="1"
                                                               @if($admin_permission->order == 1) checked @endif>

                                                        <label>الاستعلامات
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="role" value="1"
                                                               @if($admin_permission->role == 1) checked @endif>

                                                        <label>مديرى لوحة التحكم
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="user" value="1"
                                                               @if($admin_permission->user == 1) checked @endif>

                                                        <label> المستخدمين
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="report" value="1"
                                                               @if($admin_permission->report == 1) checked @endif>

                                                        <label>التقارير </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="setting" value="1"
                                                               @if($admin_permission->setting == 1) checked @endif>

                                                        <label>الإعدادات
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="stock" value="1"
                                                               @if($admin_permission->stock == 1) checked @endif>

                                                        <label>المخزن
                                                        </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="post" value="1"
                                                               @if($admin_permission->post == 1) checked @endif>

                                                        <label>الاخبار </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="gallery" value="1"
                                                               @if($admin_permission->gallery == 1) checked @endif>

                                                        <label>معرض الصور </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="employee" value="1"
                                                               @if($admin_permission->employee == 1) checked @endif>

                                                        <label>الموظفين </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="subscriber" value="1"
                                                               @if($admin_permission->subscriber == 1) checked @endif>

                                                        <label>المتابعين </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="slider" value="1"
                                                               @if($admin_permission->slider == 1) checked @endif>

                                                        <label>سلايدر </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="advs" value="1"
                                                               @if($admin_permission->advs == 1) checked @endif>

                                                        <label>الاعلانات </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="message" value="1"
                                                               @if($admin_permission->message == 1) checked @endif>

                                                        <label>الرسائل  </label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="comment" value="1"
                                                               @if($admin_permission->comment == 1) checked @endif>

                                                        <label>التعليقات</label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="review" value="1"
                                                               @if($admin_permission->review == 1) checked @endif>

                                                        <label>اراء العملاء</label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <input type="checkbox" name="company" value="1"
                                                               @if($admin_permission->company == 1) checked @endif>

                                                        <label>شركات خارجية</label>
                                                    </fieldset>
                                                </div>

                                            </div><!-- row -->
                                            <br>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" > تعديل مدير <i class="ft-thumbs-up position-right"></i></button>


                                        </div>
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

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('backend/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
   <!-- BEGIN MODERN JS-->
    <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
    {{--<!-- END MODERN JS-->--}}
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('backend/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>

    <!-- END PAGE LEVEL JS-->


@endsection