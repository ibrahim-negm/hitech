@extends('backend.layouts.admin_master')
@section('title-content') تحديث بيانات الموظف - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تحديث بيانات الموظف</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee') }}" style="font-family:'Cairo', sans-serif; font-size: small">الموظفين</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">    تحديث بيانات الموظف  {{$employee->employee_name}}
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
                                    <form action="{{ url('admin/update/employee/'.$employee->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <input type="hidden" value="{{ $employee->image }}" name="old_image">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم الموظف</label>
                                                <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->employee_name }}" name="employee_name">

                                                @error('employee_name')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">صورة الموظف</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       name="image" onchange="readURL(this);">
                                                <small>حجم الصورة لايتعدى 350 كيلو , العرض يفضل 500 والطول 600</small>


                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <img src="{{ asset($employee->image) }}"  id="one" style="width: 100px; height: 100px">

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">وظيفة الموظف</label>
                                                <input type="text" class="form-control @error('position') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->position}}" name="position">

                                                @error('position')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Facebook</label>
                                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->facebook }}" name="facebook">

                                                @error('facebook')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Twitter</label>
                                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->twitter }}" name="twitter">

                                                @error('twitter')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Instgram</label>
                                                <input type="text" class="form-control @error('instgram') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->instgram }}" name="instgram">

                                                @error('instgram')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Whats-up</label>
                                                <input type="text" class="form-control @error('whats-up') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $employee->whatsup }}" name="whatsup" placeholder="like ->   https://wa.me/201224194220">

                                                @error('whatsup')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>



                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" > تحديث بيانات الموظف</button>

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
                        .width(50)
                        .height(50);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection