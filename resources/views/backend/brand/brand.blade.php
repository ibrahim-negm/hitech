@extends('admin.admin_master')
@section('title-content')  شركاء النجاح( ماركات تجارية ) - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">شركاء النجاح(ماركات تجارية)</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.brand') }}" style="font-family:'Cairo', sans-serif; font-size: small">شركاء النجاح(ماركات تجارية)</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">عرض الكل
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
                            <div class="card-header">
                                <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                                   data-target="#modal"> أضافة شريك نجاح</a>

                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم شريك نجاح</th>
                                            <th> الصورة</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($brands as $key =>$brand)
                                            <tr>
                                                <td>{{ $key +1}}</td>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td><img src="{{ asset($brand->brand_logo) }}" alt="" style="width: 100px; height: 60px"></td>
                                                <td>
                                                    <a href="{{ url('admin/edit/brand/'.$brand->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/brand/'.$brand->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم شريك نجاح</th>
                                            <th> الصورة</th>

                                            <th width="20%">Action</th>


                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ########## END: MAIN PANEL ########## -->

                <!-- LARGE MODAL -->
                <div id="modal" class="modal fade">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content tx-size-sm">
                            <div class="modal-header pd-x-20" >
                                <h4 style="font-family:'Cairo', sans-serif; font-size: large"> أضافة شركاء النجاح(ماركات تجارية)</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.store_brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pd-20">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم شريك نجاح(ماركة تجارية)</label>
                                        <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="اسم شريك نجاح(ماركة تجارية)" name="brand_name">

                                        @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">صورة شريك نجاح(ماركة تجارية)</label>
                                        <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                name="brand_logo">
                                        <small> الصورة لا تتجاوز 350 كيلو - العرض يفضل ان يكون 300 والارتفاع 200</small>


                                        @error('brand_logo')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم المستخدم </label>
                                        <select name="admin_id" class="form-control">
                                            <option label="أختر اسم المستخدم" selected="" disabled=""></option>
                                            @foreach($admins as $admin)
                                                @if($admin->permission->type == 3)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>


                                    </div>

                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20" > اضف ماركة تجارية</button>
                                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">خروج</button>

                                </div>
                            </form>
                        </div>
                    </div><!-- modal-dialog -->
                </div><!-- modal -->


            </section>


        </div>
    </div>


@endsection