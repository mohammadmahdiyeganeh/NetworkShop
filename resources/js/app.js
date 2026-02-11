import './bootstrap';
import axios from 'axios';

// افزودن هدر CSRF برای همه درخواست‌ها
axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// بروزرسانی شمارنده سبد خرید در هدر
function updateCartCount(count) {
    const cartCount = document.getElementById('cart-count');
    if (!cartCount) return;
    cartCount.textContent = count;
    cartCount.classList.toggle('hidden', count <= 0);
}

// =====================================================
// افزودن محصول به سبد خرید
// =====================================================
window.addToCart = async function (productId) {
    try {
        const res = await axios.post(`/cart/add/${productId}`);
        if (res.data.success) {
            updateCartCount(res.data.count);
            const msg = document.getElementById('add-to-cart-message');
            if (msg) {
                msg.classList.remove('hidden');
                msg.classList.add('opacity-100');
                setTimeout(() => {
                    msg.classList.add('hidden');
                    msg.classList.remove('opacity-100');
                }, 2000);
            }
        }
    } catch (err) {
        console.error('خطا در افزودن به سبد خرید:', err);
        alert('خطایی در افزودن محصول به سبد خرید رخ داد.');
    }
};

// =====================================================
// تغییر تعداد محصول در سبد
// =====================================================
window.updateCart = async function (id, qty) {
    if (!qty || qty < 1) qty = 1;
    try {
        const res = await axios.post('/cart/update', { id, quantity: qty });
        const itemTotal = document.querySelector(`#item-total-${id}`);
        if (itemTotal) {
            itemTotal.textContent = res.data.item_total.toLocaleString() + ' تومان';
        }
        const cartTotal = document.getElementById('cart-total');
        if (cartTotal) {
            cartTotal.textContent = res.data.cart_total.toLocaleString() + ' تومان';
        }
        updateCartCount(res.data.count);
    } catch (err) {
        console.error('خطا در بروزرسانی سبد خرید:', err);
        alert('خطا در به‌روزرسانی سبد خرید.');
    }
};

// =====================================================
// حذف محصول از سبد خرید
// =====================================================
window.removeFromCart = async function (id) {
    if (!confirm('آیا از حذف این محصول مطمئن هستید؟')) return;
    try {
        const res = await axios.delete(`/cart/remove/${id}`);
        const item = document.querySelector(`#cart-item-${id}`);
        if (item) item.remove();

        const cartTotal = document.getElementById('cart-total');
        if (cartTotal) {
            cartTotal.textContent = res.data.cart_total.toLocaleString() + ' تومان';
        }

        updateCartCount(res.data.count);

        // اگر سبد خالی شد → مخفی کن جمع کل و دکمه
        if (res.data.count === 0) {
            const container = document.getElementById('cart-items-container');
            const summary = document.getElementById('cart-summary');
            const emptyMsg = document.getElementById('empty-cart-message');

            if (container) container.classList.add('hidden');
            if (summary) summary.classList.add('hidden');
            if (emptyMsg) emptyMsg.classList.remove('hidden');
        }
    } catch (err) {
        console.error('خطا در حذف محصول از سبد خرید:', err);
        alert('خطا در حذف محصول.');
    }
};

// =====================================================
// مقدار اولیه شمارنده سبد خرید
// =====================================================
document.addEventListener('DOMContentLoaded', () => {
    const initialCount = window.initialCartCount || 0;
    updateCartCount(initialCount);
});