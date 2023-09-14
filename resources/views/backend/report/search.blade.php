@extends('admin.admin_master')
@section('title-content')  التقارير البحث عن - هاى تك للتقسيط @endsection

@section('admin-content')
    @php
    $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $year =date('Y');
    @endphp

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">البحث بـ</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.new.order') }}" style="font-family:'Cairo', sans-serif; font-size: small">الاستعلامات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">البحث بـ
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
                    <div class="col-sm-4">
                        <div class="card ">

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('search.by.date') }}" method="POST" >
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">البحث باليوم</label>
                                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                       name="date">

                                            </div>


                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" >البحث باليوم</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card ">


                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('search.by.month') }}" method="POST" >
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">البحث بالشهر</label>
                                                <select name="month" class="form-control @error('month') is-invalid @enderror">
                                                    @foreach($month as $row)
                                                        <option value="{{$row}}">{{$row}}</option>
                                                    @endforeach
                                                </select>


                                            </div>

                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" >البحث بالشهر</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-4">
                        <div class="card ">

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('search.by.year') }}" method="POST" >
                                        @csrf
                                        <div class="modal-body pd-20">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">البحث بالسنة</label>
                                                <select name="year" class="form-control @error('year') is-invalid @enderror">
                                                    <option value="{{$year-2}}">{{$year-2}}</option>
                                                    <option value="{{$year-1}}">{{$year-1}}</option>
                                                    @for($i=$year; $i<$year+10; $i++ )
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>


                                            </div>

                                        </div><!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info pd-x-20" >البحث السنة</button>

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


@endsection