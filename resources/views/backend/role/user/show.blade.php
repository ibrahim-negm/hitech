@extends('admin.admin_master')
@section('title-content')  المستخدمين - هاى تك للتقسيط @endsection

@section('admin-content')

        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> المستخدمين</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.show.user') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المستخدمين</a>
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

                                @include('alerts.success')
                                @include('alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered setting-defaults">
                                            <thead>
                                            <tr>
                                                <th width="5%">الاسم</th>
                                                <th width="5%">التليفون</th>
                                                <th  width="15%">البريد الالكترونى</th>
                                                <th width="15%">النوع</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $users as $row)
                                            <tr>
                                                <td width="5%">{{str_limit($row->name,50)}}</td>
                                                <td width="5%">
                                                    @if($row->phone == NULL)
                                                       لايوجد
                                                    @else
                                                        {{ $row->phone }}
                                                    @endif
                                                    </td>
                                                <td width="15%">{{$row->email}} </td>
                                                <td width="15%">
                                                        @if($row->social_type== NULL)
                                                            <span class="badge btn-warning">الموقع</span>
                                                        @else
                                                            @if($row->social_type== 'facebook')
                                                                <span class="badge btn-info">{{ $row->social_type }}</span>
                                                            @elseif($row->social_type== 'google')
                                                                <span class="badge btn-danger">{{ $row->social_type }}</span>
                                                            @endif
                                                        @endif

                                                </td>


                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th width="5%">الاسم</th>
                                                <th width="5%">التليفون</th>
                                                <th  width="15%">البريد الالكترونى</th>
                                                <th width="15%">النوع</th>

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