<?php

session_start();
require_once('classes/database.php');
$con = new database();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | TEA-Napay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>
  <div id="menuPage">
    <!-- NAV BAR -->
    <header class="main-header">
        <!-- ...existing code... -->
    </header>

    <main>
        <div class="container mt-5">
            <section id="menu">
                <h2 class="text-center menu-title animate__animated animate__fadeIn">Our Menu</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="filter-section shadow-sm rounded-4 p-4">
                            <h4 class="mb-3 text-center">Filter Products</h4>
                            <div class="category-filter mb-3">
                                <label for="categorySelect" class="form-label">Category</label>
                                <select id="categorySelect" class="form-select">
                                    <option value="all" selected>All</option>
                                    <option value="Bread">Bread</option>
                                    <option value="Doughnut">Doughnut</option>
                                    <option value="Cakes">Cakes</option>
                                    <option value="Fruit Tea">Fruit Tea</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="price-range mb-3">
                                <label class="form-label" for="priceSlider">
                                    Price Range: ₱<span id="minPrice">0</span> - ₱<span id="maxPrice">1500</span>
                                </label>
                                <input type="range" class="form-range" id="priceSlider" min="0" max="1500" value="1500">
                            </div>
                            <div class="availability-filter">
                                <input type="checkbox" class="form-check-input" id="availableOnly" checked>
                                <label class="form-check-label" for="availableOnly" style="color: var(--primary-color);">Show Available Products Only</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="row justify-content-center">

                            <!-- Breads Section -->
                            <section id="breads" class="col-12 menu-section rounded-4" data-category="Breads">
                                <h2 class="text-center mb-4">Breads</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $breads = $con->displayProducts('Breads');
                                foreach ($breads as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Breads"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                            <!-- Doughnuts Section -->
                            <section id="doughnuts" class="col-12 menu-section rounded-4" data-category="Doughnuts">
                                <h2 class="text-center mb-4">Doughnuts</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $doughnuts = $con->displayProducts('Doughnuts');
                                foreach ($doughnuts as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Doughnuts"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                            <!-- Cakes Section -->
                            <section id="cakes" class="col-12 menu-section rounded-4" data-category="Cakes">
                                <h2 class="text-center mb-4">Cakes</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $cakes = $con->displayProducts('Cakes');
                                foreach ($cakes as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Cakes"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                            <!-- Fruit Tea Section -->
                            <section id="fruittea" class="col-12 menu-section rounded-4" data-category="Fruit Tea">
                                <h2 class="text-center mb-4">Fruit Tea</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $fruittea = $con->displayProducts('Fruit Tea');
                                foreach ($fruittea as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Fruit Tea"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                            <!-- Bites Section -->
                            <section id="bites" class="col-12 menu-section rounded-4" data-category="Bites">
                                <h2 class="text-center mb-4">Bites</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $bites = $con->displayProducts('Bites');
                                foreach ($bites as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Bites"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                            <!-- Milk Tea Section -->
                            <section id="milktea" class="col-12 menu-section rounded-4" data-category="Milk Tea">
                                <h2 class="text-center mb-4">Milk Tea</h2>
                                <div class="d-flex flex-wrap align-items-stretch justify-content-center">
                                <?php
                                $milktea = $con->displayProducts('Milk Tea');
                                foreach ($milktea as $prod) {
                                    $img = !empty($prod['Prod_Image']) ? $prod['Prod_Image'] : './img/placeholder.png';
                                    $price = number_format($prod['Price'], 2);
                                    ?>
                                    <div class="product-item col-md-4 col-sm-6 mb-4 animate__animated animate__fadeInUp d-flex align-items-stretch"
                                         data-category="Milk Tea"
                                         data-price="<?php echo $prod['Price']; ?>"
                                         data-available="true">
                                        <div class="card w-100 d-flex flex-column justify-content-between text-center shadow-sm">
                                            <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($prod['Prod_Name']); ?>">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['Prod_Name']); ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($prod['Prod_Desc']); ?></p>
                                                <p class="product-price">₱<?php echo $price; ?> PHP</p>
                                                <button class="add-to-cart btn btn-custom mt-auto">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>

                <!-- CART NOTIFICATION -->
                <div class="cart-notification" id="cartNotification" role="alert" aria-live="assertive">
                    <button class="close-btn" onclick="hideCartNotification()">×</button>
                    <p class="status">✓ Item added to your cart</p>
                    <div class="product-info">
                        <img src="./img/placeholder.png" alt="Product Image" class="product-image">
                        <div class="product-details">
                            <strong class="product-name">Product Name</strong><br>
                            <span class="product-size">Default</span> - <span class="product-price">₱0.00 PHP</span>
                        </div>
                    </div>
                    <a href="cart.php" class="view-cart btn btn-custom">View My Cart (0)</a>
                    <button class="checkout btn btn-custom">Check Out</button>
                    <a href="#" class="continue-shopping">Continue Shopping</a>
                </div>

            </section>
        </div>
    </main>

    <footer class="footer animate__animated animate__fadeIn" id="contact">
        <!-- ...existing code... -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </div>
</body>
</html>