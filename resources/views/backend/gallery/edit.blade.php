
@extends('admin.admin_master')
@section('title-content') Kizoo store - تحديث الماركات العالمية @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تحديث الماركات العالمية</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.brand') }}" style="font-family:'Cairo', sans-serif; font-size: small">الماركات العالمية</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">    تحديث ماركة {{$brand->brand_name}}
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
                                    <form action="{{ url('admin/update/brand/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <input type="hidden" value="{{ $brand->brand_logo }}" name="old_image">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم الماركة العالمية</label>
                                                <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $brand-> brand_name }}" name="brand_name">

                                                @error('brand_name')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">صورة الماركة العالمية</label>
                                                <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       name="brand_logo" onchange="readURL3(this);">

                                                @error('brand_logo')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>
                                            <div class="form-group">
                                                <img src="{{ asset($brand->brand_logo) }}"  id="three">

                                            </div>



                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" > تحديث الماركة العالمية</button>

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
        function readURL3(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(163)
                        .height(85);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection