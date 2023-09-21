@extends('backend.layouts.admin_master')
@section('title-content') تحديث شركاء النجاح( ماركات تجارية ) - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تحديث شركاء النجاح(ماركة تجارية)</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.brand') }}" style="font-family:'Cairo', sans-serif; font-size: small">شركاء النجاح(ماركات تجارية)</a>
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
                                                <label for="exampleInputEmail1">اسم شريك نجاح(ماركة تجارية)</label>
                                                <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       value="{{ $brand-> brand_name }}" name="brand_name">

                                                @error('brand_name')
                                                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم المستخدم</label>
                                                <select name="admin_id" class="form-control">
                                                    <option label="أختر اسم المستخدم" selected="" ></option>
                                                    @foreach($admins as $admin)
                                                        @if($admin->permission->type == 3)
                                                            <option value="{{ $admin->id }}"
                                                                    @if($admin->id == $brand->admin_id) selected @endif
                                                            >{{ $admin->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>


                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">صورة شريك نجاح(ماركة تجارية)</label>
                                                <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       name="brand_logo" onchange="readURL3(this);">
                                                <small> الصورة لا تتجاوز 100 كيلو - العرض يفضل ان يكون 300 والارتفاع 200</small>


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
                                            <button type="submit" class="btn btn-info pd-x-20" > تحديث الماركة تجارية</button>

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




