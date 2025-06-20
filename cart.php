<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - TEA-Napay</title>
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

    <!-- Cart Section -->
    <section class="cart py-5">
    <div class="container">
        <h2 class="text-center mb-4">Your Cart</h2>
        <!-- Cart Table (Desktop) -->
        <div class="cart-table d-none d-md-block">
            <div class="cart-card bg-white p-4 rounded shadow">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="select-all" checked></th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="item-checkbox" checked data-price="2.50" data-quantity="1" data-name="Strawberry Sprinkle Donut" data-image="https://via.placeholder.com/80x80/d14d72/ffffff?text=Donut"></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80x80/d14d72/ffffff?text=Donut" alt="Strawberry Donut" class="me-3" style="width: 60px; height: 60px;">
                                    <div>
                                        <p class="mb-0">Strawberry Sprinkle Donut</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">$2.50</td>
                            <td class="text-center">
                                <div class="input-group input-group-sm w-75 mx-auto">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, -1)">-</button>
                                    <input type="number" class="form-control form-control-sm text-center item-quantity" value="1" min="1">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, 1)">+</button>
                                </div>
                            </td>
                            <td class="text-center item-total">$2.50</td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm" onclick="removeItem(this)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="item-checkbox" checked data-price="4.00" data-quantity="2" data-name="Strawberry Matcha Milk Tea" data-image="https://via.placeholder.com/80x80/d14d72/ffffff?text=Milk+Tea"></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80x80/d14d72/ffffff?text=Milk+Tea" alt="Milk Tea" class="me-3 rounded" style="width: 60px; height: 60px;">
                                    <div>
                                        <p class="mb-0">Strawberry Matcha Milk Tea</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">$4.00</td>
                            <td class="text-center">
                                <div class="input-group input-group-sm w-75 mx-auto">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, -1)">-</button>
                                    <input type="number" class="form-control form-control-sm text-center item-quantity" value="2" min="1">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, 1)">+</button>
                                </div>
                            </td>
                            <td class="text-center item-total">$8.00</td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm" onclick="removeItem(this)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="cart-footer d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <div>
                        <button class="btn btn-outline-danger me-2 mb-2" onclick="selectAllItems()">Select All (2)</button>
                        <button class="btn btn-outline-danger mb-2" onclick="deleteSelected()">Delete</button>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <h4 class="mb-0">Total (2 items): <span id="cart-total">$10.50</span></h4>
                        <a href="checkout.html" class="btn btn-outline-danger btn-lg rounded-pill px-4">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Card Layout -->
        <div class="cart-items d-md-none">
            <div class="cart-item card bg-white p-3 mb-3 shadow-sm">
                <div class="d-flex align-items-start">
                    <input type="checkbox" class="item-checkbox me-2" checked data-price="2.50" data-quantity="1" data-name="Strawberry Sprinkle Donut" data-image="https://via.placeholder.com/80x80/d14d72/ffffff?text=Donut">
                    <img src="https://via.placeholder.com/80x80/d14d72/ffffff?text=Donut" alt="Strawberry Donut" class="me-3 rounded" style="width: 50px; height: 50px;">
                    <div class="flex-grow-1">
                        <p class="mb-1">Strawberry Sprinkle Donut</p>
                        <p class="mb-1">Unit Price: $2.50</p>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm w-50 me-3">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, -1)">-</button>
                                <input type="number" class="form-control form-control-sm text-center item-quantity" value="1" min="1">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, 1)">+</button>
                            </div>
                            <p class="mb-0">Total: <span class="item-total">$2.50</span></p>
                        </div>
                        <button class="btn btn-outline-danger btn-sm mt-2" onclick="removeItem(this)">Delete</button>
                    </div>
                </div>
            </div>
            <div class="cart-item card bg-white p-3 mb-3 shadow-sm">
                <div class="d-flex align-items-start">
                    <input type="checkbox" class="item-checkbox me-2" checked data-price="4.00" data-quantity="2" data-name="Strawberry Matcha Milk Tea" data-image="https://via.placeholder.com/80x80/d14d72/ffffff?text=Milk+Tea">
                    <img src="https://via.placeholder.com/80x80/d14d72/ffffff?text=Milk+Tea" alt="Milk Tea" class="me-3 rounded" style="width: 50px; height: 50px;">
                    <div class="flex-grow-1">
                        <p class="mb-1">Strawberry Matcha Milk Tea</p>
                        <p class="mb-1">Unit Price: $4.00</p>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm w-50 me-3">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, -1)">-</button>
                                <input type="number" class="form-control form-control-sm text-center item-quantity" value="2" min="1">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQuantity(this, 1)">+</button>
                            </div>
                            <p class="mb-0">Total: <span class="item-total">$8.00</span></p>
                        </div>
                        <button class="btn btn-outline btn-sm mt-2" onclick="removeItem(this)">Delete</button>
                    </div>
                </div>
            </div>
            <div class="cart-footer d-flex justify-content-between align-items-center mt-4 flex-wrap">
                <div>
                    <button class="btn btn-outline-danger me-2 mb-2" onclick="selectAllItems()">Select All (2)</button>
                    <button class="btn btn-outline-danger mb-2" onclick="deleteSelected()">Delete</button>
                    <button class="btn btn-outline-secondary mb-2">Move to Likes</button>
                </div>
                <div>
                    <h4 class="mb-0">Total (2 items): <span id="cart-total-mobile">$10.50</span></h4>
                    <a href="checkout.html" class="btn btn-custom rounded-pill w-100 rounded-pill px-4 mt-2">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Footer (same as homepage) -->
    <footer class="cartcontact footer animate__animated animate__fadeIn" id="contact">
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