@extends('admin.admin_master')
@section('title-content')  تحديث الخدمات الرئيسية - هاى تك للتقسيط  @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> تحديث الخدمات الرئيسية</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.service') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الخدمات الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> تحديث خدمة {{ $service->service_name}} </li>
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
                                    <form action="{{ url('admin/update/service/'.$service->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> اسم الخدمة</label>
                                                <input type="text" class="form-control @error('service_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       placeholder="اسم الخدمة" name="service_name" value="{{$service->service_name}}" required>

                                                @error('service_name')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> صورة الخدمة</label>
                                                <input type="file" class="form-control @error('service_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       placeholder="صورة الخدمة" name="service_image" onchange="readURL(this);">
                                                <small> الصورة لا تتجاوز 350 كيلو - العرض يفضل ان يكون 700 والارتفاع 500</small>


                                                @error('service_image')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <img src="{{ asset('upload/services/'.$service->service_image) }}"  id="one">

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

    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(500)
                        .height(300);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection