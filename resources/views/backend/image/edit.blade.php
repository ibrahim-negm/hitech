@extends('admin.admin_master')
@section('title-content')  تحديث الصورة - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تحديث الصورة</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.image') }}" style="font-family:'Cairo', sans-serif; font-size: small">معرض الصور</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">   تحديث الصورة {{$image->image_name}}
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


                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ url('admin/update/gallery/'.$image->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <input type="hidden" value="{{ $image->image }}" name="old_image">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">عنوان الصور</label>
                                                <input type="text" required class="form-control @error('image_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $image->image_name }}" name="image_name">

                                                @error('image_name')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم الخدمة<span class="text-danger"> * </span></label>
                                                <select class="form-control  @error('service_id') is-invalid @enderror" name="service_id"
                                                        data-placeholder="اسم الخدمة" required>
                                                    <option label="أختر الخدمة " selected="" disabled=""></option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}" @if( $image->service_id == $service->id ) selected @endif >{{ $service->service_name }} </option>
                                                    @endforeach
                                                </select>

                                                @error('service_id')
                                                <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                @enderror


                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">الصورة</label>
                                                <input type="file"  class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       name="image" onchange="readURL(this);">
                                                <small>الصورة لاتتعدى 350 كيلو . عرض الصورة يفضل ان يكون 1000 والطول 674.</small>


                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <img src="{{ asset('upload/gallery/'.$image->image) }}" style="width: 500px; height: 333px" id="one">

                                            </div>



                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" > تحديث الصورة</button>

                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ########## END: MAIN PANEL ########## -->




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
                        .height(333);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection