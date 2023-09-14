@extends('admin.admin_master')
@section('title-content') إضافة أعلان جديد - هاى تك للتقسيط@endsection


@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> إضافة أعلان</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.adv') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الاعلانات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> إضافة أعلان جديد </li>
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
                                    <form action="{{ route('admin.store.adv') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عنوان الاعلان</label>
                                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="عنوان الاعلان" name="title"  >
                                                        <small>لا يتجاوز 200 حرف</small>

                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">وصف الاعلان</label>
                                                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                  name="description" >
                                                        <small>لا يتجاوز 200 حرف</small>

                                                        @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>


                                            <br>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > اضافة الاعلان <i class="ft-thumbs-up position-right"></i></button>
                                                <button type="reset" class="btn btn-warning pd-x-20" > إعادة <i class="ft-refresh-cw position-right"></i></button>


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


    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(325)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>




@endsection