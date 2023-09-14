@extends('admin.admin_master')
@section('title-content')  اعدادات محركات البحث - هاى تك للتقسيط@endsection


@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">  اعدادات محركات البحث</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.seo') }}" style="font-family:'Cairo', sans-serif; font-size: small "> اعدادات محركات البحث</a>
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
                            <br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('admin.update.seo') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$seo->id}}">
                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">إسم الموقع<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="إسم الموقع" name="meta_title" value="{{ $seo->meta_title }}" required>

                                                        @error('meta_title')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">إسم الشركة المنفذة للموقع<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('meta_auth') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="إسم صاحب الموقع" name="meta_auth"  value="{{ $seo->meta_auth }}" disabled>

                                                        @error('meta_auth')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الكلمات الاسترشادية للموقع <span class="text-danger"> * </span></label>
                                                        <input type="text" class="input-selectize @error('meta_tag') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="meta_tag[]" value="{{$seo->meta_tag }}" required>

                                                        @error('meta_tag')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">وصف الموقع<span class="text-danger"> * </span></label>
                                                        <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror" aria-describedby="emailHelp"
                                                                  name="meta_description" rows="6" required>{{ $seo->meta_description }}</textarea>

                                                        @error('meta_description')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">تحليلات جوجل </label>
                                                        <input type="text" class="form-control @error('google_analytics') is-invalid @enderror " id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="تحليلات جوجل" name="google_analytics" value="{{ $seo->google_analytics }}">

                                                        @error('google_analytics')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>



                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > تحديث <i class="ft-thumbs-up position-right"></i></button>


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
    <script src="{{ asset('backend/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
    {{--<!-- END MODERN JS-->--}}
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>

@endsection