// LOGIN PAGE SCRIPT
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const forgotPasswordLink = document.getElementById('forgot-password');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const rememberMe = document.getElementById('rememberMe').checked;

        // Store login state in localStorage (for demo purposes)
        localStorage.setItem('isLoggedIn', 'true');
        localStorage.setItem('userEmail', email);
        if (rememberMe) {
            localStorage.setItem('rememberMe', 'true');
        } else {
            localStorage.removeItem('rememberMe');
        }

        // Redirect to homepage
        window.location.href = 'homepage.html';
    });

    forgotPasswordLink.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Password reset functionality is not implemented. Please contact support at racapacia@yahoo.com.');
    });
});

// REGISTER PAGE SCRIPT
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('regName').value.trim();
        const email = document.getElementById('regEmail').value.trim();
        const password = document.getElementById('regPassword').value;
        const confirm = document.getElementById('regConfirm').value;
        if (password !== confirm) {
            alert('Passwords do not match!');
            return;
        }
        // Save registration info (for demo only)
        localStorage.setItem('registeredUser', JSON.stringify({ name, email, password }));
        alert('Registration successful! Please login.');
        window.location.href = 'login.html';
    });
});

// CART PAGE SCRIPT
// script.js
function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('.item-quantity');
    let quantity = parseInt(input.value) + change;
    if (quantity < 1) quantity = 1;
    input.value = quantity;
    const row = button.closest('tr') || button.closest('.cart-item');
    const checkbox = row.querySelector('.item-checkbox');
    checkbox.dataset.quantity = quantity;
    const price = parseFloat(checkbox.dataset.price);
    const total = (price * quantity).toFixed(2);
    row.querySelector('.item-total').textContent = `$${total}`;
    updateCartTotal();
}

function removeItem(button) {
    const row = button.closest('tr') || button.closest('.cart-item');
    row.remove();
    updateCartTotal();
}

function selectAllItems() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectAll = document.querySelector('#select-all');
    const allChecked = selectAll.checked;
    checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
    selectAll.checked = !allChecked;
    document.querySelectorAll('.btn-outline-danger[onclick="selectAllItems()"]').forEach(btn => {
        btn.textContent = `Select All (${document.querySelectorAll('.item-checkbox:checked').length})`;
    });
    updateCartTotal();
}

function deleteSelected() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    checkboxes.forEach(checkbox => {
        const row = checkbox.closest('tr') || checkbox.closest('.cart-item');
        row.remove();
    });
    updateCartTotal();
}

function moveToLikes() {
    // Placeholder: Implement logic to move selected items to a "Likes" list
    alert('Move to Likes functionality not implemented yet.');
}

function updateCartTotal() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    let total = 0;
    let itemCount = 0;
    const selectedItems = [];
    checkboxes.forEach(checkbox => {
        const quantity = parseInt(checkbox.dataset.quantity);
        const price = parseFloat(checkbox.dataset.price);
        total += quantity * price;
        itemCount += quantity;
        selectedItems.push({
            name: checkbox.dataset.name,
            price: checkbox.dataset.price,
            quantity: checkbox.dataset.quantity,
            image: checkbox.dataset.image
        });
    });
    document.querySelector('#cart-total').textContent = `$${total.toFixed(2)}`;
    document.querySelector('#cart-total-mobile').textContent = `$${total.toFixed(2)}`;
    document.querySelectorAll('.btn-outline-danger[onclick="selectAllItems()"]').forEach(btn => {
        btn.textContent = `Select All (${itemCount})`;
    });
    // Save selected items to localStorage for checkout
    localStorage.setItem('cartItems', JSON.stringify(selectedItems));
}

document.addEventListener('DOMContentLoaded', () => {
    updateCartTotal();
    // Ensure checkboxes trigger total update
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateCartTotal);
    });
});

// CHECKOUT PAGE SCRIPT
document.addEventListener('DOMContentLoaded', function() {
    const deliveryForm = document.getElementById('delivery-form');
    const paymentMethodSection = document.getElementById('payment-method');
    const orderSummary = document.getElementById('order-summary-items');
    const subtotalElement = document.getElementById('subtotal');
    const shippingElement = document.getElementById('shipping');
    const totalElement = document.getElementById('total');
    const deliveryRadio = document.getElementById('delivery');
    const pickupRadio = document.getElementById('pickup');
    const shippingFeeElement = document.getElementById('shipping-fee');
    const selectedItems = JSON.parse(localStorage.getItem('selectedCartItems')) || [];

    // Initialize form visibility
    function updateFormVisibility() {
        if (deliveryRadio.checked) {
            deliveryForm.style.display = 'block';
            shippingElement.textContent = '$5.00';
            updateTotal();
        } else {
            deliveryForm.style.display = 'none';
            shippingElement.textContent = '$0.00';
            updateTotal();
        }
    }

    // Update total based on delivery option
    function updateTotal() {
        let subtotal = 0;
        selectedItems.forEach(item => {
            subtotal += item.total;
        });
        const shippingCost = deliveryRadio.checked ? 5.00 : 0.00;
        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        totalElement.textContent = `$${(subtotal + shippingCost).toFixed(2)}`;
    }

    // Populate order summary
    if (selectedItems.length === 0) {
        orderSummary.innerHTML = '<p>No items selected for checkout.</p>';
        subtotalElement.textContent = '$0.00';
        shippingElement.textContent = deliveryRadio.checked ? '$5.00' : '$0.00';
        totalElement.textContent = deliveryRadio.checked ? '$5.00' : '$0.00';
    } else {
        selectedItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'd-flex justify-content-between mb-2';
            itemElement.innerHTML = `
                <div class="d-flex align-items-center">
                    <img src="${item.image}" alt="${item.name}" class="img-fluid rounded-circle me-3" style="width: 40px; height: 40px;">
                    <span>${item.name} x${item.quantity}</span>
                </div>
                <span>$${item.total.toFixed(2)}</span>
            `;
            orderSummary.appendChild(itemElement);
        });
        updateTotal();
    }

    // Toggle form visibility on radio change
    deliveryRadio.addEventListener('change', updateFormVisibility);
    pickupRadio.addEventListener('change', updateFormVisibility);

    // Store order details on Place Order
    document.querySelector('.btn-custom').addEventListener('click', function() {
        const deliveryOption = deliveryRadio.checked ? 'delivery' : 'pickup';
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        const orderDetails = {
            items: selectedItems,
            deliveryOption: deliveryOption,
            paymentMethod: paymentMethod,
            shippingInfo: deliveryOption === 'delivery' ? {
                fullName: document.querySelector('input[placeholder="Full Name"]').value,
                address: document.querySelector('input[placeholder="Street Address"]').value,
                city: document.querySelector('input[placeholder="City"]').value,
                postalCode: document.querySelector('input[placeholder="Postal Code"]').value,
                phoneNumber: document.querySelector('input[placeholder="Phone Number"]').value
            } : null,
            subtotal: parseFloat(subtotalElement.textContent.replace('$', '')),
            shipping: parseFloat(shippingElement.textContent.replace('$', '')),
            total: parseFloat(totalElement.textContent.replace('$', ''))
        };
        localStorage.setItem('orderDetails', JSON.stringify(orderDetails));
        // Optionally redirect to a confirmation page
        // window.location.href = 'confirmation.html';
    });

    // Initial form visibility
    updateFormVisibility();
});

// SMOOTH SCROLL SCRIPT (for all pages)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// PARALLAX EFFECT SCRIPT (for home section)
window.addEventListener('scroll', function () {
    const homeSection = document.querySelector('.home');
    const scrollPosition = window.pageYOffset;
    homeSection.style.backgroundPositionY = -(scrollPosition * 0.3) + 'px';
});


