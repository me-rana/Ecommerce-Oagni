<div class="row">
    <div class="col-7"></div>
    <div class="col-5">@if (session('message'))
        <div class="alert alert-success row alert-dismissible">
            <div class="col-11 py-3"><strong>Success!</strong> {{session('message')}}</div>
            <div class="col-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
          </div>
    @endif</div>

  </div>
