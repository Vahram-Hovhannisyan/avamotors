// resources/js/cart.js

class CartManager {
    constructor() {
        this.badge = document.getElementById('cart-badge');
        this.init();
    }

    init() {
        // Инициализация бейджа
        this.updateBadge();

        // Добавляем обработчики для форм
        this.attachHandlers();

        // Слушаем события
        window.addEventListener('cart:updated', () => this.updateBadge());
    }

    attachHandlers() {
        const forms = document.querySelectorAll('.add-to-cart-form');

        forms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                await this.addToCart(form);
            });
        });
    }

    async addToCart(form) {
        const btn = form.querySelector('.add-btn');
        if (!btn) return;

        const originalText = btn.textContent;
        const originalDisabled = btn.disabled;

        try {
            // Loading state
            btn.disabled = true;
            btn.classList.add('loading');
            btn.textContent = '';

            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.error || data.message || 'Ошибка при добавлении');
            }

            // Success state
            btn.classList.remove('loading');
            btn.classList.add('added');
            btn.textContent = '✓ Добавлено';

            // Update badge
            if (data.cart_count !== undefined) {
                this.updateBadge(data.cart_count);
            } else {
                this.updateBadge();
            }

            // Show notification
            this.showNotification(data.message || 'Товар добавлен в корзину!', 'success');

            // Reset button
            setTimeout(() => {
                btn.classList.remove('added');
                btn.textContent = originalText;
                btn.disabled = originalDisabled;
            }, 2000);

        } catch (error) {
            console.error('Add to cart error:', error);
            btn.classList.remove('loading');
            btn.textContent = originalText;
            btn.disabled = originalDisabled;
            this.showNotification(error.message, 'error');
        }
    }

    updateBadge(count = null) {
        if (!this.badge) return;

        if (count !== null) {
            if (count > 0) {
                this.badge.textContent = count;
                this.badge.style.display = 'inline-flex';
                this.badge.classList.add('animate');
                setTimeout(() => this.badge.classList.remove('animate'), 200);
            } else {
                this.badge.style.display = 'none';
            }
        } else {
            fetch('/cart/count', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.count > 0) {
                        this.badge.textContent = data.count;
                        this.badge.style.display = 'inline-flex';
                    } else {
                        this.badge.style.display = 'none';
                    }
                })
                .catch(err => console.error('Error updating badge:', err));
        }
    }

    showNotification(message, type = 'success') {
        const existing = document.querySelector('.ajax-notification');
        if (existing) existing.remove();

        const notification = document.createElement('div');
        notification.className = `ajax-notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">${type === 'success' ? '✓' : '✕'}</span>
                <span class="notification-message">${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);

        notification.addEventListener('click', () => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        });
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    if (!window.cartManager) {
        window.cartManager = new CartManager();
    }
});

export default CartManager;
