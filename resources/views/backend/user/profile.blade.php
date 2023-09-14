@extends('admin.admin_master')
@section('title-content') Kidzoo store - الملف الشخصى @endsection

@section('admin-content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">الملف الشخصى</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item " ><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.show.admin') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المديرين</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small ">الملف الشخصى
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">

            </div>
        </div>
        <div class="content-body">

            <!-- Simple User Cards with Border-->
            <section id="simple-user-cards-with-border" class="row mt-2">


                <div class="col-xl-8 col-md-8 col-8 offset-2">
                    <div class="card border-pink border-lighten-2">
                        <div class="text-center">
                            <div class="card-body">
                                @include('alerts.success')
                                @include('alerts.errors')

                                <img src="{{ (!empty( $admin->profile_photo_path))
                                ? url('upload/backend/users/'.$admin->profile_photo_path)
                                : url('upload/avatar.png')}}"
                                     class="rounded-circle  height-150" alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $admin->name }}</h4>
                                <h6 class="card-subtitle text-muted"><span class="text-danger">Email: &nbsp;</span>{{ $admin->email }}</h6><br>
                                <h6 class="card-subtitle text-muted"><span class="text-danger">Phone: &nbsp;</span>{{ $admin->phone }}</h6>

                            </div>
                            <div class="text-center">
                                <a href="{{ route('edit.admin_profile') }}" class="btn btn-primary  mr-1 mb-1">تحديث البيانات  <i class="ft-thumbs-up position-right"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- Simple User Cards with Border-->

        </div>
    </div>


@endsection

