@extends('backend.layouts.admin_master')
@section('title-content')الموظفين - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">الموظفين</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee') }}" style="font-family:'Cairo', sans-serif; font-size: small">الموظفين</a>
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
                                   data-target="#modal"> أضافة موظف</a>

                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم الموظف</th>
                                            <th>المسمى الوظيفى</th>
                                            <th> صورة الموظف</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $key =>$employee)
                                            <tr>
                                                <td>{{ $key +1}}</td>
                                                <td>{{ $employee->employee_name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td><img src="{{ asset($employee->image) }}" alt="" style="width: 100px; height: 100px"></td>
                                                <td>
                                                    <a href="{{ url('admin/edit/employee/'.$employee->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/employee/'.$employee->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>اسم الموظف</th>
                                            <th>المسمى الوظيفى</th>
                                            <th> صورة الموظف</th>
                                            <th>Action</th>

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
                                <h4 style="font-family:'Cairo', sans-serif; font-size: large"> أضافة موظف</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.store_employee') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pd-20">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم الموظف</label>
                                        <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="اسم الموظف" name="employee_name">

                                        @error('employee_name')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">صورة الموظف</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                name="image">
                                        <small>حجم الصورة لايتعدى 350 كيلو , العرض يفضل 500 والطول 600</small>

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">وظيفة الموظف</label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="وظيفة الموظف"  name="position">

                                        @error('position')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook</label>
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="Facebook"  name="facebook">

                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instgram</label>
                                        <input type="text" class="form-control @error('instgram') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="Instgram"  name="instgram">

                                        @error('instgram')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter</label>
                                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="Twitter"  name="twitter">

                                        @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Whats-up</label>
                                        <input type="text" class="form-control @error('whats-up') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="اكتب رفم تليفونك مثل 201224194220"  name="whatsup">

                                        @error('whatsup')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>


                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20" > اضف الموظف</button>
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