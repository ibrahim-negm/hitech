@extends('admin.admin_master')
@section('title-content') تعديل الخبر - هاى تك للتقسيط @endsection


@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> تعديل الخبر</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الاخبار</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> تعديل الخبر {{ $post_data->post_title}} </li>
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
                                <h4 class="card-title" style="font-family:'Cairo', sans-serif; font-size: large; color: maroon ">تحديث البيانات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('admin.update.post_data',$post_data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> عنوان الخبر<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('post_title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="عنوان المنشور" name="post_title"  value= "{{ $post_data->post_title }}" required>

                                                        @error('post_title')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">  اسم الخدمة الرئيسى<span class="text-danger"> * </span></label>
                                                        <select class="form-control  @error('service_id') is-invalid @enderror" name="service_id"
                                                                data-placeholder="أختر الخدمة الرئيسى" required>
                                                            <option label="أختر الخدمة الرئيسى" disabled="" selected=""></option>
                                                            @foreach($services as $service)
                                                                <option value="{{ $service->id }}" @if($service->id == $post_data->service_id) selected @endif>
                                                                    {{ $service->service_name }} </option>
                                                            @endforeach
                                                        </select>

                                                        @error('service_id')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">نبذة مختصرة عن الخبر<span class="text-danger"> * </span></label>
                                                        <textarea  type="text" class="form-control @error('post_short_details') is-invalid @enderror"   aria-describedby="emailHelp"
                                                                   name="post_short_details" rows="3" required>{{ $post_data->post_short_details }}</textarea>
                                                        <small>لا يزيد عن 75 حرف</small>

                                                        @error('post_short_details')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">تفاصيل الخبر<span class="text-danger"> * </span></label>
                                                        <textarea id ="editor1" type="text" class="form-control @error('post_details') is-invalid @enderror" aria-describedby="emailHelp"
                                                                  name="post_details" rows="6" required>{{ $post_data->post_details }}</textarea>

                                                        @error('post_details')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الكلمات الاسترشادية <span class="text-danger"> * هذا الحقل يقضل ان يكون به كلمات البحث الخاص بالخبر</span></label>
                                                        <input type="text" class="input-selectize @error('post_tags') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="post_tags[]" value="{{ $post_data->post_tags }}" required>

                                                        @error('post_tags')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">صورة الخبر </label>
                                                        <input type="file" class="form-control @error('post_image') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="post_image" onchange="readURL(this);" >
                                                        <small> حجم الصورة 350 كيلو . العرض يفضل ان يكون 1000 والطول 600 </small>
                                                        <br><br>
                                                        @if($post_data->post_image)
                                                        <img src="{{ asset('upload/blog/'.$post_data->post_image) }}" id="one" style="width: 500px; height: 350px">
                                                        @endif
                                                        @error('post_image')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>



                                            </div>


                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > تحديث الخبر <i class="ft-thumbs-up position-right"></i></button>


                                            </div>


                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>


        </div>
    </div>






    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(350);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>






@endsection