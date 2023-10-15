@extends('frontend.layout.main')
@section('main-section')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>@php try { echo "+".$settings->phone_no;} catch (\Exception $e) {echo "+01521380065";}@endphp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>@php try { echo $settings->address;} catch (\Exception $e) {echo "Dhaka,Bangladesh";}@endphp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>@php try { echo $settings->office_time;} catch (\Exception $e) {echo "10:00 am to 23:00 pm";}@endphp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>@php try { echo $settings->email;} catch (\Exception $e) {echo "admin@meranaint.com";}@endphp</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>{{$settings->address ?? 'Dhaka,Bangladesh'}}</h4>
                <ul>
                    <li>Phone: @php try { echo "+".$settings->phone_no;} catch (\Exception $e) {echo "+01521380065";}@endphp</li>
                    <li>Add: @php try { echo $settings->address;} catch (\Exception $e) {echo "Dhaka,Bangladesh";}@endphp</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="../contact" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input name="name" type="text" placeholder="Your name">
                        <span class="text-danger">
                            @error('name')
                              {{$message}}
                            @enderror
                          </span>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" name="email" placeholder="Your Email">
                        <span class="text-danger">
                            @error('email')
                              {{$message}}
                            @enderror
                          </span>
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="message" placeholder="Your message"></textarea>
                        <span class="text-danger">
                            @error('message')
                              {{$message}}
                            @enderror
                          </span>

                        <button type="submit" class="site-btn">SEND MESSAGE</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

@endsection
