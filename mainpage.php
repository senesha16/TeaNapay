<?php

session_start();
require_once('classes/database.php');
$con = new database();

function carouselItems($category, $carouselId, $imgPath = './img/') {
    global $con;
    $products = $con->displayProducts($category);
    if (!$products || count($products) === 0) {
        echo '<div class="carousel-item active"><div class="mt-2">No products available.</div></div>';
        return;
    }
    $active = 'active';
    foreach ($products as $prod) {
        $img = htmlspecialchars($imgPath . $prod['Prod_Image']);
        $name = htmlspecialchars($prod['Prod_Name']);
        $desc = htmlspecialchars($prod['Prod_Desc']);
        echo <<<HTML
        <div class="carousel-item $active">
            <a href="menu.html#{$category}">
                <img src="{$img}" alt="{$name}" class="gallery-thumb" title="{$desc}">
            </a>
            <div class="mt-2">{$name}</div>
        </div>
HTML;
        $active = '';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEA-Napay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!--NAV BAR -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid position-relative">
                <!-- Offcanvas Toggler -->
                <button class="navbar-toggler d-lg-none position-absolute top-50 start-0 translate-middle-y ms-2"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mainNavDrawer"
                    aria-controls="mainNavDrawer" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <a class="navbar-brand d-none d-lg-block" href="#home">TEA-Napay</a>
                <a class="navbar-brand d-none d-md-block d-lg-none mx-auto" href="#home">TEA-Napay</a>
                <a class="navbar-brand d-block d-md-none ms-5" href="#home">TEA-Napay</a>
                <div class="navbar-nav icons-nav flex-row align-items-center position-absolute top-50 end-0 translate-middle-y me-2">
                    <a class="nav-link px-2" href="cart.php" aria-label="View cart"><i class="bi bi-cart4 fs-4"></i></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                          <li>
                              <a class="dropdown-item" href="profile.html">
                                  <i class="bi bi-person-circle me-2"></i> See Profile Information
                              </a>
                            </li>
                          <li>
                            <button class="dropdown-item" onclick="updatePersonalInfo()">
                              <i class="bi bi-pencil-square me-2"></i> Update Personal Information
                            </button>
                          </li>
                          <li>
                            <button class="dropdown-item" onclick="updatePassword()">
                              <i class="bi bi-key me-2"></i> Update Password
                            </button>
                          </li>
                          <li>
                            <button class="dropdown-item text-danger" onclick="logout()">
                              <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                          </li>
                        </ul>
                    </li>
                </div>
                <!-- Desktop Navbar -->
                <div class="collapse navbar-collapse d-none d-lg-block" id="mainNav">
                    <div class="navbar-nav-container d-flex justify-content-center w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="#home">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="#service">SERVICE</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#menu" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRODUCTS</a>
                                <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Donuts</a></li>
                                    <li><a class="dropdown-item" href="menu.php#bread">Bread</a></li>
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Cakes</a></li>
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Offcanvas Drawer for Mobile/Tablet -->
                <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mainNavDrawer" aria-labelledby="mainNavDrawerLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="mainNavDrawerLabel">TEA-Napay</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#home" data-bs-dismiss="offcanvas">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#about" data-bs-dismiss="offcanvas">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#service" data-bs-dismiss="offcanvas">SERVICE</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="mainpage.php#menu" id="menuDropdownDrawer" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRODUCTS</a>
                                <ul class="dropdown-menu" aria-labelledby="menuDropdownDrawer">
                                    <li><a class="dropdown-item" href="#">Donuts</a></li>
                                    <li><a class="dropdown-item" href="#">Bread</a></li>
                                    <li><a class="dropdown-item" href="#">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="#">Cakes</a></li>
                                    <li><a class="dropdown-item" href="#">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-bs-dismiss="offcanvas">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    
    <main>
        <!-- HOME SECTION -->
        <section id="home" class="home d-flex align-items-center justify-content-center min-vh-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                        <img src="img/homedonut.png" alt="Berry Donut" class="home-image spin-donut">
                    </div>
                    <div class="col-lg-6 z-2 text-center text-lg-start">
                        <h2 class="welcome-badge mb-1 d-inline-block animate__animated animate__fadeInDown">Welcome to <span class="fw-bold">TEA-Napay</span></h2>
                        <h1 class="home-headline mb-3 animate__animated animate__fadeInUp">
                            Tea & Donuts:<br><span class="highlight">A Taste of Home</span>
                        </h1>
                        <p class="lead mb-4 animate__animated animate__fadeInUp" style="font-size: 1.2rem; color: var(--white);">
                            Indulge in our handcrafted donuts, artisanal breads, and refreshing Fruit Teas.
                        </p>
                        <div class="mt-4 d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                            <a href="#menu" class="btn btn-custom rounded-pill px-5">SEE PRODUCTS</a>
                            <a href="#contact" class="btn btn-contact rounded-pill px-5 py-3">CONTACT US</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ABOUT SECTION -->
        <section class="about animate__animated animate__fadeIn" id="about">
            <div class="container">
                <div class="about-card text-center p-4">
                    <h2>ABOUT US</h2>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4 text-md-start">
                            <img src="img/teanapay_logo.jpg" alt="TEA-Napay Logo" class="img-fluid mb-4 mb-md-0">
                        </div>
                        <div class="col-12 col-md-8">
                            <h4>Our Story</h4>
                            <p>
Founded in April 2021 in the heart of San Antonio, Quezon, <strong>TEA-Napay</strong> is the product of a lifelong passion for bread-making. Our founder, <strong>Jesus Lalunio</strong>, grew up surrounded by the sights, smells, and traditions of a family bakery. His early exposure to the craft, combined with a drive for innovation, inspired him to take the next step: building a bakery that blends classic Filipino flavors with modern quality and creativity.
At TEA-Napay, we’re proud to serve <strong>affordable yet high-quality breads</strong>—the kind you’d find in major malls, but made with heart and offered at prices our local community can enjoy. But we’re more than just a bakery.
We also offer:
• A variety of milk teas and specialty drinks
• Custom cakes for birthdays, weddings, anniversaries, and special occasions
• Pre-orders and bulk bread orders for big events
• And a lot more exciting creations to satisfy your cravings
Driven by passion, skill, and a desire to elevate every bite, TEA-Napay is your neighborhood bakeshop with a modern twist.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="service animate__animated animate__fadeIn" id="service">
            <div class="container">
                <h2>OUR SERVICES</h2>
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <div class="service-card text-center p-4">
                            <i class="bi bi-cup-hot service-icon"></i>
                            <h4>Handcrafted Donuts</h4>
                            <p>
                                Our donuts are freshly made daily, offering a perfect balance of fluffiness and flavor, glazed or dusted to perfection.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="service-card text-center p-4">
                            <i class="bi bi-basket service-icon"></i>
                            <h4>Artisanal Breads</h4>
                            <p>
                                Baked fresh each morning, our breads range from crusty sourdough to soft brioche, crafted with premium ingredients.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="service-card text-center p-4">
                            <i class="bi bi-cup-straw service-icon"></i>
                            <h4>Signature Fruit Teas</h4>
                            <p>
                                Brewed with premium tea leaves, our Fruit Teas offer customizable flavors, delivering a refreshing and delightful experience.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- MENU SECTION -->
        <section class="menu animate__animated animate__fadeIn" id="menu">
            <div class="container">
                <h2 class="mb-5 text-center">MENU</h2>
                <div class="row g-4">
                    <!-- Bread Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Bread</h4>
                                <div id="breadCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Breads', 'breadCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#breadCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#breadCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Doughnut Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Doughnut</h4>
                                <div id="doughnutCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Doughnuts', 'doughnutCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#doughnutCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#doughnutCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cakes Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Cakes</h4>
                                <div id="cakesCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Cakes', 'cakesCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#cakesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#cakesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fruit Tea Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Fruit Tea</h4>
                                <div id="fruitteaCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Fruit Tea', 'fruitteaCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#fruitteaCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#fruitteaCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bites Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Bites</h4>
                                <div id="bitesCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Bites', 'bitesCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#bitesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#bitesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Milk Tea Category -->
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-body py-4">
                                <h4 class="mb-3 text-center" style="color:var(--primary-color);">Milk Tea</h4>
                                <div id="milkteaCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner text-center">
                                      <?php carouselItems('Milk Tea', 'milkteaCarousel'); ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#milkteaCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#milkteaCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="menu.html" class="btn btn-custom rounded-pill px-5 py-3 animate__animated animate__pulse animate__infinite">ORDER NOW</a>
                </div>
            </div>
        </section>

        <!-- Gallery Modal -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
              <div class="modal-body p-0 text-center">
                <img id="galleryModalImg" src="" alt="Gallery Image" class="img-fluid rounded shadow">
              </div>
            </div>
          </div>
        </div>
    </main>
    <footer class="footer animate__animated animate__fadeIn" id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-1 text-md-start">
                    <ul class="nav justify-content-center flex-row flex-md-column">
                        <li class="nav-item m-3"><a class="nav-link" href="mainpage.php#home">HOME</a></li>
                        <li class="nav-item m-3"><a class="nav-link" href="mainpage.php#about">ABOUT</a></li>
                        <li class="nav-item m-3"><a class="nav-link" href="mainpage.php#service">SERVICE</a></li>
                        <li class="nav-item m-3"><a class="nav-link" href="mainpage.php#menu">MENU</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-5 text-center">
                    <h5 class="footer-heading">CONTACT DETAILS</h5>
                    <p class="footer-text">
                        Customer Hotline: +639687153421<br>
                        racapacia@yahoo.com
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100067176574296" class="social-icon" aria-label="Visit our Facebook page"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.facebook.com/messages/t/102498215320537" class="social-icon" aria-label="Visit our Facebook page"><i class="bi bi-messenger"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center text-md-start">
                    <h5 class="footer-heading">SEND US A MESSAGE</h5>
                    <div class="contact-form">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name *" required aria-label="Your name">                            
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email *" required aria-label="Your email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="Message *" rows="3" required aria-label="Your message"></textarea>
                        </div>
                        <button type="button" class="btn btn-custom rounded-pill px-4">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>