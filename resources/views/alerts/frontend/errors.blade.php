@if(Session::has('error'))
       <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <div class="section-content box-sort-in m-b30">
                       <div class="alert alert-danger"> <strong><i class="fa fa-remove"></i> Error!</strong>
                           {{Session::get('error')}}</div>
                    </div>
                </div>
            </div>
        </div>

@endif