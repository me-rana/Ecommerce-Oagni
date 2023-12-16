  <!-- Footer Section Begin -->
  <footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="../assets/img/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: @php try { echo $settings->address;} catch (\Exception $e) {echo "Dhaka,Bangladesh";}@endphp</li>
                        <li>Phone: @php try { echo "+".$settings->phone_no;} catch (\Exception $e) {echo "+0123456789";}@endphp</li>
                        <li>Email: @php try { echo $settings->email;} catch (\Exception $e) {echo "admin@meranaint.com";}@endphp</li>
                    </ul>
                </div>
            </div>
            @include('frontend.layout.useful-links')
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        @include('frontend.layout.social-links')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy; {{ $settings->Copyright ?? 'Rana Bepari' }} - <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    <div class="footer__copyright__payment"><img src="../assets/img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>
<script src="../assets/js/jquery.slicknav.js"></script>
<script src="../assets/js/mixitup.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/main.js"></script>



</body>

</html>
