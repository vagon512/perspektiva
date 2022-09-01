<?php
require_once 'include/config.php';
require_once 'include/db.php';
require_once 'class/perspektiva.php';

$perspektiva = new Perspektiva();
?>
<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="pic/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="pic/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="pic/favicon-16x16.png">
    <link rel="manifest" href="pic/site.webmanifest">
    <link rel="mask-icon" href="pic/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Перспектива</title>
</head>
<body>

<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">perspektiva-61@mail.ru</span></a>
                <span class="mx-md-2 d-inline-block"></span>
                <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">тел. 8-952-600-03-00</span></a>


            </div>

        </div>

    </div>
</div>
<!--<div class="site-mobile-menu site-navbar-target">-->
<!--    <div class="site-mobile-menu-header">-->
<!--        <div class="site-mobile-menu-close mt-3">-->
<!--            <span class="icon-close2 js-menu-toggle"></span>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="site-mobile-menu-body"></div>-->
<!--</div>-->
<!---->
<!---->
<!--<div class="top-bar">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span-->
<!--                            class="d-none d-md-inline-block">info@yourdomain.com</span></a>-->
<!--                <span class="mx-md-2 d-inline-block"></span>-->
<!--                <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">1+ (234)-->
<!--              5678 9101</span></a>-->
<!---->
<!---->
<!--                <div class="float-right">-->
<!---->
<!--                    <a href="#" class=""><span class="mr-2  icon-twitter"></span> <span-->
<!--                                class="d-none d-md-inline-block">Twitter</span></a>-->
<!--                    <span class="mx-md-2 d-inline-block"></span>-->
<!--                    <a href="#" class=""><span class="mr-2  icon-facebook"></span> <span-->
<!--                                class="d-none d-md-inline-block">Facebook</span></a>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->

<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center position-relative">


            <div class="site-logo">
                <a href="index.html" class="text-black"><span class="text-primary">Перспектива</a>
            </div>

            <div class="col-12">
                <nav class="site-navigation text-right ml-auto " role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                                                <li><a href="index.php" class="nav-link">Главная</a></li>
                                                <li><a href="#services-section" class="nav-link">Почему мы?</a></li>
                                                <li ><a href="sales.php" class="nav-link">Предложения</a></li>

                                                <li><a href="contacts.php" class="nav-link">Контакты</a></li>
                                                <li><a href="cabinet.php" class="nav-link">Кабинет</a></li>
                                            </ul>
<!--                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">-->
<!--                        <li><a href="#home-section" class="nav-link">Home</a></li>-->
<!--                        <li><a href="#services-section" class="nav-link">Services</a></li>-->
<!---->
<!---->
<!--                        <li class="has-children">-->
<!--                            <a href="#about-section" class="nav-link">About Us</a>-->
<!--                            <ul class="dropdown arrow-top">-->
<!--                                <li><a href="#team-section" class="nav-link">Team</a></li>-->
<!--                                <li><a href="#pricing-section" class="nav-link">Pricing</a></li>-->
<!--                                <li><a href="#faq-section" class="nav-link">FAQ</a></li>-->
<!--                                <li class="has-children">-->
<!--                                    <a href="#">More Links</a>-->
<!--                                    <ul class="dropdown">-->
<!--                                        <li><a href="#">Menu One</a></li>-->
<!--                                        <li><a href="#">Menu Two</a></li>-->
<!--                                        <li><a href="#">Menu Three</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!---->
<!--                        <li><a href="#why-us-section" class="nav-link">Why Us</a></li>-->
<!---->
<!--                        <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>-->
<!--                        <li><a href="#blog-section" class="nav-link">Blog</a></li>-->
<!--                        <li><a href="#contact-section" class="nav-link">Contact</a></li>-->
<!--                    </ul>-->
                </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#"
                                                                   class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
<!--<header class="site-navbar js-sticky-header site-navbar-target" role="banner">-->
<!---->
<!---->
<!--<div class="contaner">-->
<!--    <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--            <div class="site-logo">-->
<!--                <a href="index.php" class="text-black"><span class="text-primary">Перспектива</a>-->
<!--            </div>-->
<!---->
<!--            <div class="col-12">-->
<!--                <nav class="site-navigation text-right ml-auto " role="navigation">-->
<!---->
<!--                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">-->
<!--                        <li><a href="index.php" class="nav-link">Главная</a></li>-->
<!--                        <li><a href="#services-section" class="nav-link">Почему мы?</a></li>-->
<!--                        <li ><a href="sales.php" class="nav-link">Предложения</a></li>-->
<!---->
<!--                        <li><a href="contacts.php" class="nav-link">Контакты</a></li>-->
<!--                        <li><a href="cabinet.php" class="nav-link">Кабинет</a></li>-->
<!--                    </ul>-->
<!--                </nav>-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>-->
<!--    </nav>-->
<!--</div>-->
<!--</header>-->




<!--<script src="js/jquery-3.3.1.min.js"></script>-->
<!--<script src="js/popper.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/jquery.sticky.js"></script>-->
<!--<script src="js/main.js"></script>-->

<main role="main" class="container">

    <div class="starter-template">
        <div class="text-monospace">