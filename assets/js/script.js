// Smooth scrolling for navigation links
document.addEventListener('DOMContentLoaded', function() {
    console.log("Website Bisfa Farm siap!");

    // Smooth scroll for anchor links
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Form validation for contact form
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const name = document.querySelector('input[name="name"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const message = document.querySelector('textarea[name="message"]').value.trim();

            if (!name || !email || !message) {
                e.preventDefault();
                alert('Mohon isi semua field yang diperlukan.');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Mohon masukkan alamat email yang valid.');
                return;
            }

            alert('Terima kasih! Pesan Anda telah dikirim.');
        });
    }

    // Add hover effects for product cards
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Simple image lazy loading
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Mobile menu toggle (if needed in future)
    // This can be expanded if a hamburger menu is added

    // Cart functionality
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Add to cart
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart')) {
            e.preventDefault();
            const id = e.target.dataset.id;
            const name = e.target.dataset.name;
            const price = parseInt(e.target.dataset.price);

            // Check if item already in cart
            const existingItem = cart.find(item => item.id == id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Produk ditambahkan ke keranjang!');
            updateCartCount();
        }
    });

    // Update cart count (if we add a cart icon)
    function updateCartCount() {
        // This can be expanded to show cart count in navbar
    }

    // Load cart on page load
    updateCartCount();

    // Checkout form handling
    const checkoutForm = document.querySelector('.checkout-form form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const cartData = JSON.parse(localStorage.getItem('cart')) || [];
            if (cartData.length === 0) {
                e.preventDefault();
                alert('Keranjang kosong. Tambahkan produk terlebih dahulu.');
                return;
            }

            // Add cart data to form
            const cartInput = document.createElement('input');
            cartInput.type = 'hidden';
            cartInput.name = 'cart';
            cartInput.value = JSON.stringify(cartData);
            checkoutForm.appendChild(cartInput);
        });
    }
});
