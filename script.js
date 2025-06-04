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
function updateCartTotal() {
    let total = 0;
    document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
        const price = parseFloat(checkbox.getAttribute('data-price'));
        const quantity = parseInt(checkbox.closest('.cart-item, tr').querySelector('.item-quantity').value);
        const itemTotal = price * quantity;
        checkbox.closest('.cart-item, tr').querySelector('.item-total').textContent = `$${itemTotal.toFixed(2)}`;
        total += itemTotal;
    });
    document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
    document.getElementById('cart-total-mobile').textContent = `$${total.toFixed(2)}`;
}

function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('.item-quantity');
    let quantity = parseInt(input.value) + change;
    if (quantity < 1) quantity = 1;
    input.value = quantity;
    const checkbox = button.closest('.cart-item, tr').querySelector('.item-checkbox');
    checkbox.setAttribute('data-quantity', quantity);
    if (checkbox.checked) {
        updateCartTotal();
    }
}

function removeItem(button) {
    button.closest('.cart-item, tr').remove();
    updateCartTotal();
    checkSelectAll();
}

function selectAllItems() {
    const selectAll = document.getElementById('select-all');
    if (selectAll) selectAll.checked = !selectAll.checked;
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    updateCartTotal();
}

function deleteSelected() {
    document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
        checkbox.closest('.cart-item, tr').remove();
    });
    updateCartTotal();
    checkSelectAll();
}

function checkSelectAll() {
    const selectAll = document.getElementById('select-all');
    if (selectAll) {
        selectAll.checked = document.querySelectorAll('.item-checkbox').length === 
                           document.querySelectorAll('.item-checkbox:checked').length;
    }
}

// Cart event listeners
document.getElementById('select-all')?.addEventListener('change', function() {
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateCartTotal();
});

document.querySelectorAll('.item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        checkSelectAll();
        updateCartTotal();
    });
});

document.querySelectorAll('.item-quantity').forEach(input => {
    input.addEventListener('input', function() {
        if (this.value < 1) this.value = 1;
        const checkbox = this.closest('.cart-item, tr').querySelector('.item-checkbox');
        checkbox.setAttribute('data-quantity', this.value);
        if (checkbox.checked) {
            updateCartTotal();
        }
    });
});

document.querySelectorAll('a[href="checkout.html"]').forEach(button => {
    button.addEventListener('click', function(e) {
        const selectedItems = [];
        document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
            const container = checkbox.closest('.cart-item, tr');
            const item = {
                name: checkbox.getAttribute('data-name'),
                price: parseFloat(checkbox.getAttribute('data-price')),
                quantity: parseInt(container.querySelector('.item-quantity').value),
                image: checkbox.getAttribute('data-image'),
                total: parseFloat(container.querySelector('.item-total').textContent.replace('$', ''))
            };
            selectedItems.push(item);
        });
        localStorage.setItem('selectedCartItems', JSON.stringify(selectedItems));
    });
});

// Initial calculation
updateCartTotal();

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


