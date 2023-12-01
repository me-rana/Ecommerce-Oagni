@extends('backend.admin.layout.admin')
@section('main-content')

<div class="pagetitle">
  <h1>{{Route::currentRouteName()}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('Dashboard (Admin)')}}">Home</a></li>
      <li class="breadcrumb-item active">{{Route::currentRouteName()}}</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

            @include('backend.admin.layout.message-notify')
            <div class="card">
                <div class="container">
                <form class="py-5" action="../admin/settings" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Title of The Website</label>
                        <input type="text" name="name" value="@php try { echo $settings->name;} catch (\Exception $e) {echo "Oagni";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">MERANA International</small>
                      </div>
                      <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Website Logo</label>
                                <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                                <div id="fileHelpId" class="form-text">Supported file jpg,png etc</div>
                              </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <p>Logo size is set 120x50</p>
                            <img src="@if ($settings->logo_path != null) {{'../../storage/image/'.$settings->logo_path}} @else ../../assets/img/logo.png @endif" width="120px" height="50px" alt="">
                        </div>
                      </div>


                      <div class="mb-3">
                          <label for="" class="form-label">Address</label>
                          <input type="text" name="address" value="@php try { echo $settings->address;} catch (\Exception $e) {echo "Dhaka,Bangladesh";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">House-04, Road-Bijoy Soroni</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Email</label>
                          <input type="email" name="email" value="@php try { echo $settings->email;} catch (\Exception $e) {echo "rana@meranaint.com";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">john@test.me</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Phone No</label>
                          <input type="number" name="phone_no" value="@php try { echo $settings->phone_no;} catch (\Exception $e) {echo +880123456789;}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">+1 (XXX) XXXX XXX</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Copyright Name</label>
                          <input type="text" name="copyright" id="" value="@php try { echo $settings->copyright;} catch (\Exception $e) {echo "MERANA International";}@endphp" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">MERANA International</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Office Hours</label>
                            <input type="text" name="office_time" id="" value="@php try { echo $settings->office_time;} catch (\Exception $e) {echo "10:00 am to 23:00 pm";}@endphp" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">10:00 am to 23:00 pm</small>
                          </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Facebook</label>
                          <input type="text" name="facebook" value="@php try { echo $settings->facebook;} catch (\Exception $e) {echo "#";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">facebook.com/merana</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Linkdin</label>
                          <input type="text" name="linkdin" value="@php try { echo $settings->linkdin;} catch (\Exception $e) {echo "#";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">linkedin.com/merana</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Twitter</label>
                          <input type="text" name="twitter" value="@php try { echo $settings->twitter;} catch (\Exception $e) {echo "#";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">twitter.com/merana</small>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">pinterest</label>
                          <input type="text" name="pinterest" value="@php try { echo $settings->pinterest;} catch (\Exception $e) {echo "#";}@endphp" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">pinterest.com/merana</small>
                        </div>
                        <input type="submit" value="Save">
                    </div>
                </form>
                <hr>
            </div>
          </div>

@endsection
