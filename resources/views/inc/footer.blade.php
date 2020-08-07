<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>F4NTAST1CS</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{ url('/') }}">Home Page</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{ route('order.track.view') }}">Track Order</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="/cart">Shopping Cart</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{ url('/') }}">Products</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Privacy Policy</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Delivery Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Rruga A1 <br>Prishtine, Kosove</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+38344121212">+38344121212</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">F4NTAST1CS@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footer-copyright">
    <p class="footer-company">All Rights Reserved. &copy; {{now()->year}} <a href="{{ url('/') }}">F4NTAST1CS</a></p>
</div>