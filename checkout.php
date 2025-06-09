<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TEA-Napay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header (same as homepage) -->
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
                <a class="navbar-brand d-none d-lg-block" href="mainpage.php#home">TEA-Napay</a>
                <a class="navbar-brand d-none d-md-block d-lg-none mx-auto" href="mainpage.php#home">TEA-Napay</a>
                <a class="navbar-brand d-block d-md-none ms-5" href="mainpage.php#home">TEA-Napay</a>
                <div class="navbar-nav icons-nav flex-row align-items-center position-absolute top-50 end-0 translate-middle-y me-2">
                    <a class="nav-link px-2" href="mainpage.phpcart.php" aria-label="View cart"><i class="bi bi-cart4 fs-4"></i></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                          <li>
                              <a class="dropdown-item" href="profile.php">
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
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#home">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#about">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#service">SERVICE</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="mainpage.php#menu" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRODUCTS</a>
                                <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                                    <li><a class="dropdown-item" href="menu.php#bread">Bread</a></li>
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Donuts</a></li>
                                    <li><a class="dropdown-item" href="menu.php#cakes">Cakes</a></li>
                                    <li><a class="dropdown-item" href="menu.php#fruittea">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="menu.php#others">Others</a></li>
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
                                    <li><a class="dropdown-item" href="menu.php#bread">Bread</a></li>
                                    <li><a class="dropdown-item" href="menu.php#donuts">Donuts</a></li>
                                    <li><a class="dropdown-item" href="menu.php#cakes">Cakes</a></li>
                                    <li><a class="dropdown-item" href="menu.php#fruittea">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="menu.php#others">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-bs-dismiss="offcanvas">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Checkout Section -->
    <section class="checkout py-5">
        <div class="container">
            <h2 class="text-center mb-4">Checkout Information</h2>
            <div class="row g-4">
                <!-- Shipping and Payment Form -->
                <div class="col-12 col-md-8">
                    <div class="checkout-card bg-white p-4 rounded shadow">
                        <h4>Delivery Options</h4>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="delivery" value="delivery" checked>
                                <label class="form-check-label" for="delivery">Delivery</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="pickup" value="pickup">
                                <label class="form-check-label" for="pickup">Pick Up at the Store</label>
                            </div>
                        </div>

                        <!-- Delivery Form -->
                        <div id="delivery-form">
                            <h4>Shipping Information</h4>
                            <div class="mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" placeholder="Full Name" required aria-label="Your full name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" placeholder="Street Address" required aria-label="Your street address">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City *</label>
                                    <input type="text" class="form-control" placeholder="City" required aria-label="Your city">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" placeholder="Postal Code" required aria-label="Your postal code">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" required aria-label="Your phone number">
                            </div>
                            <div class="mb-3">
                                <p><strong>Shipping Fee:</strong> <span id="shipping-fee">$5.00</span></p>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div id="payment-method" class="mt-4">
                            <h4>Payment Method</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="gcash" value="gcash" checked>
                                <label class="form-check-label" for="gcash">GCash</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="pay-at-store" value="pay-at-store">
                                <label class="form-check-label" for="pay-at-store">Pay at the Store</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="col-12 col-md-4">
                    <div class="checkout-card bg-white p-4 rounded shadow">
                        <h4>Order Summary</h4>
                        <div id="order-summary-items">
                            <!-- Items will be dynamically inserted here -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <strong>Subtotal</strong>
                            <strong id="subtotal">$0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span id="shipping">$5.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong id="total">$5.00</strong>
                        </div>
                        <button class="btn btn-custom rounded-pill w-100">Place Order</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="cart.html" class="btn btn-outline-danger btn-lg rounded-pill px-4">Back to Cart</a>
            </div>
        </div>
    </section>

    <!-- Footer (same as homepage) -->
    <footer class="footer animate__animated animate__fadeIn" id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-1 text-md-start">
                    <ul class="nav justify-content-center flex-row flex-md-column">
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#home">HOME</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#about">ABOUT</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#service">SERVICE</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#menu">MENU</a></li>
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