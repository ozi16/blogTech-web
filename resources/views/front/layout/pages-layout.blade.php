<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_tags')
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="/front/assets/img/favicon.ico">



    <!-- CSS here -->
    <link rel="stylesheet" href="/front/assets/css/bootstrap.min.css ">
    <link rel="stylesheet" href="/front/assets/css/owl.carousel.min.css ">
    <link rel="stylesheet" href="/front/assets/css/ticker-style.css">
    <link rel="stylesheet" href="/front/assets/css/flaticon.css">
    <link rel="stylesheet" href="/front/assets/css/slicknav.css">
    <link rel="stylesheet" href="/front/assets/css/animate.min.css">
    <link rel="stylesheet" href="/front/assets/css/magnific-popup.css ">
    <link rel="stylesheet" href="/front/assets/css/fontawesome-all.min.css ">
    <link rel="stylesheet" href="/front/assets/css/themify-icons.css ">
    <link rel="stylesheet" href="/front/assets/css/slick.css ">
    <link rel="stylesheet" href="/front/assets/css/nice-select.css ">
    <link rel="stylesheet" href="/front/assets/css/style.css ">
    <link rel="stylesheet" href="/front/assets/css/cardArticles.css">

    

    @stack('stylesheets')
</head>

<body>

    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><img src="/front/assets/img/icon/header_icon1.png" alt="">34ºc,
                                            Sunny </li>
                                        <li><img src="/front/assets/img/icon/header_icon1.png" alt="">Tuesday,
                                            18th June, 2019</li>
                                    </ul>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Ambil elemen yang berisi tanggal
                                        let dateElement = document.querySelector(".header-info-left ul li:nth-child(2)");
                                    
                                        // Format hari dan tanggal
                                        let options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                                        let today = new Date();
                                        let formattedDate = today.toLocaleDateString('en-US', options); // Format bahasa Inggris
                                    
                                        // Perbarui konten elemen
                                        dateElement.innerHTML = `<img src="/front/assets/img/icon/header_icon1.png" alt="">${formattedDate}`;
                                    });
                                    </script>
                                    
                                
                                @auth
                                    
                                <div class="user-info-dropdown">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <span class="user-icon">
                                                <img src="" alt="">
                                            </span>
                                            <span class="user-name">{{auth()->user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" style="">
                                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="ti-dashboard"></i> Dashboard</a>
                                            <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="ti-user"></i> Profile</a>
                                            @if (auth()->user()->type == 'superAdmin')
                                                <a class="dropdown-item" href="{{route('admin.setting')}}"><i class="ti-settings"></i> Settings</a>
                                            @endif
                                            <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault();document.getElementById('front-logout-form').submit();"><i class="ti-power-off"></i> Log Out</a>
                                            <form action="{{route('admin.logout')}}" id="front-logout-form" method="POST">
                                                @csrf              
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-mid d-none d-md-block">
                    <div class="container">
                        <div class="row d-flex justify-content-center align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo ">
                                    <a href="index.html"><img style="max-height: 120px;width: auto;" src="/front/assets/img/logo/BlogTech.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                <div class="sticky-logo ">
                                    <a href="index.html"><img style="max-height: 90px;" src="/front/assets/img/logo/BlogTech.png" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{route('home')}}">Home</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="latest_news.html">Latest News</a></li>
                                            {{-- <li><a href="#" data-toggle="dropdown">Pages <i class="ti-angle-down ml-1"></i> </a>
                                                <ul class="submenu">
                                                    <li><a href="">Author</a></li>
                                                    <li><a href="">Category Post</a></li>
                                                    <li><a href="">Search result</a></li>
                                                    <li><a href="">Post Details</a></li>
                                                    <li><a href="">Privacy Policy</a></li>
                                                    <li><a href="">Terms Conditions</a></li>
                                                </ul>
                                            </li> --}}
                                            {!! navigations() !!}
                                            <li><a href="{{route('contact')}}">Contact</a></li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="{{route('search_posts')}}" method="GET">
                                            <input type="search" name="s" placeholder="Search" value="{{request('q') ? request('q') : ''}}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            

                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Header End -->
    </header>



    <section class="blog_area section-padding">
        <div class="container">
            @yield('content')

        </div>
    </section>




    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="single-footer-caption">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png"
                                            alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Suscipit mauris pede for con sectetuer sodales adipisci for cursus fames
                                            lectus tempor da blandit gravida sodales Suscipit mauris pede for con
                                            sectetuer sodales adipisci for cursus fames lectus tempor da blandit gravida
                                            sodales Suscipit mauris pede for sectetuer.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                        <div class="single-footer-caption mt-60">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <p>Heaven fruitful doesn't over les idays appear creeping</p>
                                <!-- Form -->
                                <div class="footer-form">
                                    <div id="mc_embed_signup">
                                        @livewire('newsletter-form');
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50 mt-60">
                            <div class="footer-tittle">
                                <h4>Instagram Feed</h4>
                            </div>
                            <div class="instagram-gellay">
                                <ul class="insta-feed">
                                    <li><a href="#"><img src="/front/assets/img/post/instra1.jpg"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="/front/assets/img/post/instra2.jpg"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="/front/assets/img/post/instra3.jpg"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="/front/assets/img/post/instra4.jpg"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="/front/assets/img/post/instra5.jpg"
                                                alt=""></a></li>
                                    <li><a href="#"><img src="/front/assets/img/post/instra6.jpg"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom aera -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i
                                        class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                        target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>
                                    <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="{{route('contact')}}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="/front/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="/front/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/front/assets/js/popper.min.js"></script>
    <script src="/front/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="/front/assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="/front/assets/js/owl.carousel.min.js"></script>
    <script src="/front/assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="/front/assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="/front/assets/js/wow.min.js"></script>
    <script src="/front/assets/js/animated.headline.js"></script>
    <script src="/front/assets/js/jquery.magnific-popup.js"></script>

    <!-- Breaking New Pluging -->
    <script src="/front/assets/js/jquery.ticker.js"></script>
    <script src="/front/assets/js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="/front/assets/js/jquery.scrollUp.min.js"></script>
    <script src="/front/assets/js/jquery.nice-select.min.js"></script>
    <script src="/front/assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="/front/assets/js/contact.js"></script>
    <script src="/front/assets/js/jquery.form.js"></script>
    <script src="/front/assets/js/jquery.validate.min.js"></script>
    <script src="/front/assets/js/mail-script.js"></script>
    <script src="/front/assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="/front/assets/js/plugins.js"></script>
    <script src="/front/assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('showToast', function (event) {
                console.log('Event received:', event);  // Debugging event
                console.log('Event Detail:', event.detail);  // Menampilkan detail untuk melihat bentuknya
        
                // Mengakses elemen array
                const type = event.detail[0]?.type;  // Mengambil nilai type dari event.detail[0]
                const message = event.detail[0]?.message;  // Mengambil pesan dari event.detail[0]

                console.log('Type:', type);  // Output: success or error
                console.log('Message:', message);  // Output: Pesan yang dikirim

                // Menampilkan SweetAlert2 berdasarkan tipe
                Swal.fire({
                    title: type === 'success' ? 'Success!' : 'Error!',
                    text: message,
                    icon: type === 'success' ? 'success' : 'error',  // Sesuaikan icon dengan type
                    confirmButtonText: 'OK',
                    confirmButtonColor: type === 'success' ? '#00b09b' : '#d33',  // Sesuaikan warna tombol
                    background: '#fff',
                    width: '400px',
                    padding: '20px',
                    backdrop: true
                });
            });
        });
    </script>
    

    @stack('script')

</body>

</html>
