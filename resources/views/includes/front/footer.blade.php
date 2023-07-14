<footer>

    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
                    <div class="widget">
                        <div class="footer-logo"><img style="width: 100px;height: 100px;"
                                src=" {{ URL::asset('assets/img/logo.png') }}" alt=""></div>
                        <div class="textwidget">
                            <p>Buy and sell everything from used cars to mobile phones and computers, or search for
                                property, jobs and more</p>
                        </div>
                        <ul class="mt-3 footer-social">
                            <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title">Quick Link</h3>
                        <ul class="menu">
                            <li> <a class="nav-link dropdown-toggle" href="{{ route('home') }}" aria-haspopup="true"
                                    aria-expanded="false">
                                    Home
                                </a></li>
                            <li> <a class="nav-link" href="{{ route('userCategory.create') }}">
                                    Packages
                                </a></li>
                            <li><a class="nav-link" href="{{ route('category-page') }}">
                                    Categories
                                </a></li>
                            <li> <a class="nav-link" href="{{ route('wishlist.show') }}">
                                    <span> Favourites</span>
                                </a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title">Contact Info</h3>
                        <ul class="contact-footer">
                            <li>
                                <strong><i class="lni-phone"></i></strong><span>+1 555 444 66647 <br> </span>
                            </li>
                            <li>
                                <strong><i class="lni-envelope"></i></strong><span><a href="https://your-beauty.online"
                                        class="__cf_email__"
                                        data-cfemail="cdaea2a3b9acaeb98da0aca4a1e3aea2a0">https://your-beauty.online</a>
                                    <br> </span>
                            </li>
                            <li>
                                <strong><i class="lni-map-marker"></i></strong><span><a href="#">9870 St
                                        Vincent Place, Glasgow, DC 45 <br>Fr 45</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info text-center">
                        <p><a target="_blank" href="{{ route('home') }}">Designed by OAN</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
