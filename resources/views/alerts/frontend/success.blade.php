@if(Session::has('success'))
       <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-content box-sort-in m-b30">
                    <div class="alert alert-success"> <strong><i class="fa fa-thumbs-o-up"></i> Success!</strong>
                        {{Session::get('success')}} </div>
                </div>
            </div>
        </div>
    </div>


@endif