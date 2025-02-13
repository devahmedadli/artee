<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Welcome to Artee Engineering Consulting your trusted partner in excellence. With a rich heritage in architectural design to turn your thoughts into reality">
    <title>Artee</title>
    <!-- CSS only -->
    <link rel="icon" type="image/x-icon" href="/assets/imgs/favicon.ico">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css'
        integrity='sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=='
        crossorigin='anonymous' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
        integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=='
        crossorigin='anonymous' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>

    </div>
    <!--  Navbar -->
    <nav class="fw-semibold w-100 position-fixed start-0 end-0 border-bottom" style="--bs-border-opacity: .9;">
        <div class="container-fluid px-md-5 h-100 d-flex justify-content-between align-items-center">
            <a href="{{ route('index') }}" class="d-inline-block p-md-0 py-1">
                <img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="Artee Logo" class="img-fluid" height="85"
                    width="85">
            </a>
            <ul class="nav-links d-flex justify-content-center align-items-center list-unstyled m-0 d-none d-md-flex">
                <li class="nav-link mx-md-2"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li class="nav-link mx-md-2"><a href="#services">Services</a></li>
                <li class="nav-link mx-md-2"><a href="{{ route('index') }}#about">About</a></li>
                <li class="nav-link mx-md-2"><a href="#contact">Contact</a></li>
                <li class="nav-link mx-md-2"><a href="{{ route('offers') }}">Offers</a></li>
            </ul>
            <div class="login-signup">
                <a href="" class="btn btn-outline-light me-2">
                    Login
                </a>
                <a href="" class="btn bg-blur me-2 ">
                    Signup
                </a>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn d-block d-md-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
        </div>
    </nav>

    @yield('hero')

    @yield('content')

    <!-- Footer -->
    <footer class="py-5 bg-main text-white">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-3 col-md-4 col-12 mb-4">
                    <!-- <div class="logo mb-3">
                        <img src="/assets/imgs/logo.jpg" alt="The 1st Avenue Logo" class="img-fluid">
                    </div> -->
                    <h5 class="mb-4">Contact Us</h5>
                    <ul class="list-unstyled tesx-white ">
                        <li class="mb-2">
                            <a href="tel:+966111111111" class="text-white">Office: +966 11 111111</a>
                        </li>
                        <li class="mb-2">
                            <a href="mailto:info@royalcity.com" class="text-white">Email: info@royalcity.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-4">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled tesx-white ">
                        <li class="mb-2">
                            <a href="about.php" class="text-white">About Us</a>
                        </li>
                        <li class="mb-2">
                            <a href="services.php" class="text-white">Services</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-white">Offers</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mb-4">
                    <h5 class="mb-4">Our Services</h5>
                    <ul class="list-unstyled tesx-white ">
                        <li class="mb-2">
                            <a href="#services" class="text-white">Engineering Consulting</a>
                        </li>
                        <li class="mb-2">
                            <a href="#services" class="text-white">Construction supervision</a>
                        </li>
                        <li class="mb-2">
                            <a href="#services" class="text-white">Interior design</a>
                        </li>
                        <li class="mb-2">
                            <a href="#services" class="text-white">Project management</a>
                        </li>
                        <li class="mb-2">
                            <a href="#services" class="text-white">Architectural design</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <h5 class="mb-4">Our Location</h5>
                    <div class="">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3654.4074074577466!2d53.7299723753331!3d23.661384278731262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjPCsDM5JzQxLjAiTiA1M8KwNDMnNTcuMiJF!5e0!3m2!1sen!2seg!4v1720196047986!5m2!1sen!2seg"
                            height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4">
                <span class="d-block mb-3">
                    Copyright © First Avenue. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
        integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
        crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js'
        integrity='sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg=='
        crossorigin='anonymous'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("load", function() {
                var preloader = document.getElementById("preloader");
                var content = document.querySelector("main");
                var nav = document.querySelector("nav");

                // Hide the preloader
                preloader.style.display = "none";

                // Show the content
                content.style.display = "block";
                nav.style.display = "block";
            });
        });
    </script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
