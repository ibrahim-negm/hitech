@extends('admin.admin_master')
@section('title-content') Kidzoo store - تحديث الملف الشخصى @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">تحديث البيانات  </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.show.admin') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المديرين</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small ">تحديث الملف الشخصى
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">

            <!-- horizontal grid start -->
            <section class="horizontal-grid" id="horizontal-grid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">

                                <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
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
                                <div class="card-body">
                                    <form action="{{ route('update.admin_profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <img src="{{ (!empty( $admin->profile_photo_path))
                                                                    ? url('upload/backend/users/'.$admin->profile_photo_path)
                                                                     : url('upload/avatar.png')}}"
                                                             class="rounded-circle  height-150" alt="Card image" id="three">
                                                    </div>
                                                        <label for="">الصورة الشخصية</label>
                                                        <input type="file" class="form-control mb-1" value="{{ $admin->name }}" name="image" id="file" onchange="readURL3(this);">

                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">أسم المستخدم</label>
                                                        <input type="text" class="form-control" value="{{ $admin->name }}" name="name" required>

                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">الاميل الشخصى </label>
                                                        <input type="email" class="form-control" value="{{ $admin->email }}" name="email" required>

                                                        @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">التليفون </label>
                                                    <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone" required>

                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">تحديث <i class="ft-thumbs-up position-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- horizontal grid end -->

        </div>
    </div>
    <script type="text/javascript">
        function readURL3(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>



@endsection
