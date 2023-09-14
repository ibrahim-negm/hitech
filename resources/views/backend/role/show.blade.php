@extends('admin.admin_master')
@section('title-content')  أدوار المديرين - هاى تك للتقسيط @endsection

@section('admin-content')

        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">أدوار المديرين</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.show.admin') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المديرين</a>
                                </li>
                                <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small ">عرض الكل
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
                                    <a href="{{route('admin.create.admin')}}" class="btn btn-sm btn-warning" style="float: right;" > أضافة مدير مسئول</a>

                                </div>
                                @include('alerts.success')
                                @include('alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th width="15%">الاسم</th>
                                                <th width="15%">التليفون</th>
                                                <th  width="15%">البريد الالكترونى</th>
                                                <th  width="35%">الادوار</th>
                                                <th width="15%">Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $admins as $row)
                                            <tr>
                                                <td>{{$row->admin->name}}</td>
                                                <td>{{ $row->admin->phone }}</td>
                                                <td>{{$row->admin->email}} </td>
                                                <td>
                                                        @if($row->category ==1)
                                                            <span class="badge btn-primary">التصنيفات الرئيسية</span>
                                                        @endif
                                                        @if($row->subcategory ==1)
                                                            <span class="badge btn-warning">التصنيفات الفرعية</span>
                                                        @endif
                                                        @if($row->product ==1)
                                                            <span class="badge btn-success">المنتجات</span>
                                                        @endif
                                                        @if($row->brand ==1)
                                                            <span class="badge btn-info">شركاء النجاح</span>
                                                        @endif
                                                        @if($row->coupon ==1)
                                                            <span class="badge btn-danger">اشعارات الخصم</span>
                                                        @endif
                                                        @if($row->order ==1)
                                                            <span class="badge btn-primary">الاستعلامات</span>
                                                        @endif
                                                        @if($row->user ==1)
                                                            <span class="badge btn-warning">المستخدمين</span>
                                                        @endif
                                                        @if($row->report ==1)
                                                            <span class="badge btn-success">التقارير</span>
                                                        @endif
                                                        @if($row->setting ==1)
                                                            <span class="badge btn-info">الاعدادات</span>
                                                        @endif
                                                        @if($row->stock ==1)
                                                            <span class="badge btn-warning">المخزن</span>
                                                        @endif
                                                        @if($row->subscriber ==1)
                                                            <span class="badge btn-danger">المتابعين</span>
                                                        @endif
                                                        @if($row->slider ==1)
                                                            <span class="badge btn-primary">السلايدر</span>
                                                        @endif
                                                        @if($row->advs ==1)
                                                            <span class="badge btn-warning">الاعلانات</span>
                                                        @endif
                                                        @if($row->gallery ==1)
                                                            <span class="badge btn-success"> معرض الصور</span>
                                                        @endif
                                                        @if($row->employee ==1)
                                                            <span class="badge btn-info">الموظفين </span>
                                                        @endif
                                                        @if($row->message ==1)
                                                            <span class="badge btn-danger">الرسائل</span>
                                                        @endif
                                                        @if($row->comment ==1)
                                                            <span class="badge btn-primary">التعليقات</span>
                                                        @endif
                                                            @if($row->role ==1)
                                                                <span class="badge btn-warning">مديرى لوحة التحكم</span>
                                                            @endif
                                                            @if($row->post ==1)
                                                                <span class="badge btn-info">الاخبار</span>
                                                            @endif
                                                            @if($row->review ==1)
                                                                <span class="badge btn-success"> اراء العملاء </span>
                                                            @endif
                                                            @if($row->company ==1)
                                                                <span class="badge btn-info">شركات خارجية </span>
                                                            @endif

                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/edit/admin/'.$row->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/admin/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th width="15%">الاسم</th>
                                                <th width="15%">التليفون</th>
                                                <th  width="15%">البريد الالكترونى</th>
                                                <th  width="30%">الادوار</th>
                                                <th width="20%">Action</th>

                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  {{--//  {{ $categories->links() }}--}}
                    <!-- ########## END: MAIN PANEL ########## -->


                </section>


            </div>
        </div>


@endsection