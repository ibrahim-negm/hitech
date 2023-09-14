@extends('admin.admin_master')
@section('title-content')  عرض الخبر - هاى تك للتقسيط@endsection

@section('admin-content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> عرض الخبر</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الاخبار</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> عرض الخبر {{ $post_data-> post_title }} </li>
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

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon"> عنوان الخبر</label><br>
                                                       <strong>{{ $post_data-> post_title }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon"> تحت الخدمة الرئيسية</label><br>
                                                        <strong>
                                                            @if($post_data->service == null)
                                                                لايوجد
                                                            @else
                                                                {{ $post_data->service->service_name }}

                                                            @endif
                                                        </strong>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">من قام بادخال الخبر</label><br>
                                                             <strong>
                                                                 @if($post_data->admin == null)
                                                                     لايوجد
                                                                 @else
                                                                     {{ $post_data->admin->name }}

                                                                 @endif
                                                             </strong>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">نبذة مختصرة عن الخبر</label><br>

                                                       {{ $post_data->post_short_details }}

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">تفاصيل الخبر</label><br>

                                                         {!! $post_data->post_details !!}

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">الكلمات الاسترشادية </label><br>


                                                       <strong>{{ $post_data->post_tags }}</strong>


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">صورة الخبر</label> <br>
                                                        @if($post_data->post_image)
                                                            <img src="{{ asset('upload/blog/'. $post_data->post_image ) }}" style="width: 700px; height: 500px" >
                                                        @endif

                                                    </div>
                                                </div>



                                            </div>
                                            <hr>
                                            <div class="row skin skin-flat mg-b-25">

                                                <div class="col-lg-4">
                                                    <fieldset>
                                                        <label>الحالة</label> &nbsp;
                                                        @if($post_data->status == 1)
                                                            <span class="badge badge-success">فعال</span>
                                                        @else
                                                            <span class="badge badge-danger">غير فعال</span>
                                                        @endif
                                                    </fieldset>
                                                </div>





                                            </div><!-- row -->
                                            <br>


                                        </div>


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
