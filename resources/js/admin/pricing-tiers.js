/**
 * Pricing Tiers Admin JavaScript
 * All functionality for Pricing Tiers management
 */

(function() {
    'use strict';

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {

        // ============================================
        // 1. User Selection Management
        // ============================================
        const selectAllBtn = document.getElementById('select-all-btn');
        const deselectAllBtn = document.getElementById('deselect-all-btn');
        const selectVisibleBtn = document.getElementById('select-visible-btn');
        const userCheckboxes = document.querySelectorAll('.user-checkbox-input');
        const selectedCountSpan = document.getElementById('selected-count');

        // Update selected users count
        function updateSelectedCount() {
            if (!selectedCountSpan) return;
            const checkedCount = document.querySelectorAll('.user-checkbox-input:checked').length;
            selectedCountSpan.textContent = `Выбрано: ${checkedCount}`;
        }

        // Select all users
        function selectAllUsers() {
            const visibleCheckboxes = document.querySelectorAll('.user-checkbox:not(.hidden) .user-checkbox-input');
            visibleCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
        }

        // Deselect all users
        function deselectAllUsers() {
            const visibleCheckboxes = document.querySelectorAll('.user-checkbox:not(.hidden) .user-checkbox-input');
            visibleCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
        }

        // Select only visible (filtered) users
        function selectVisibleUsers() {
            const visibleCheckboxes = document.querySelectorAll('.user-checkbox:not(.hidden) .user-checkbox-input');
            visibleCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
        }

        // Add event listeners for user selection
        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', selectAllUsers);
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', deselectAllUsers);
        }

        if (selectVisibleBtn) {
            selectVisibleBtn.addEventListener('click', selectVisibleUsers);
        }

        // Add change listeners to each checkbox
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Initialize selected count
        updateSelectedCount();

        // ============================================
        // 2. User Search Functionality
        // ============================================
        const searchInput = document.getElementById('user-search');
        const clearSearchBtn = document.getElementById('clear-search');
        const userItems = document.querySelectorAll('.user-checkbox');

        function filterUsers() {
            if (!searchInput) return;

            const searchTerm = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            userItems.forEach(item => {
                const userName = item.getAttribute('data-user-name') || '';
                const userEmail = item.getAttribute('data-user-email') || '';

                if (searchTerm === '' || userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            // Show/hide clear button
            if (clearSearchBtn) {
                clearSearchBtn.style.display = searchTerm ? 'block' : 'none';
            }

            // Show "no results" message if needed
            const usersList = document.getElementById('users-list');
            const existingNoResults = usersList?.querySelector('.no-results-message');

            if (visibleCount === 0 && userItems.length > 0) {
                if (!existingNoResults) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-results no-results-message';
                    noResultsDiv.textContent = 'Пользователи не найдены';
                    usersList?.appendChild(noResultsDiv);
                }
            } else if (existingNoResults) {
                existingNoResults.remove();
            }
        }

        function clearSearch() {
            if (searchInput) {
                searchInput.value = '';
                filterUsers();
                searchInput.focus();
            }
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', filterUsers);
            searchInput.addEventListener('search', filterUsers);
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', clearSearch);
        }

        // ============================================
        // 3. Dynamic Value Hint
        // ============================================
        const typeSelect = document.getElementById('type-select');
        const valueHint = document.getElementById('value-hint');

        function updateValueHint() {
            if (!valueHint || !typeSelect) return;

            if (typeSelect.value === 'percentage') {
                valueHint.textContent = '(10 = 10% скидка)';
            } else {
                valueHint.textContent = '(1000 = 1000 դր. скидка)';
            }
        }

        if (typeSelect) {
            typeSelect.addEventListener('change', updateValueHint);
            updateValueHint();
        }

        // ============================================
        // 4. Form Validation
        // ============================================
        const pricingTierForm = document.getElementById('pricing-tier-form');

        if (pricingTierForm) {
            pricingTierForm.addEventListener('submit', function(e) {
                const nameInput = this.querySelector('input[name="name"]');
                const valueInput = this.querySelector('input[name="value"]');
                let hasError = false;

                // Validate name
                if (nameInput && !nameInput.value.trim()) {
                    showFieldError(nameInput, 'Название обязательно для заполнения');
                    hasError = true;
                } else if (nameInput) {
                    clearFieldError(nameInput);
                }

                // Validate value
                if (valueInput && (!valueInput.value || parseFloat(valueInput.value) < 0)) {
                    showFieldError(valueInput, 'Значение должно быть положительным числом');
                    hasError = true;
                } else if (valueInput) {
                    clearFieldError(valueInput);
                }

                if (hasError) {
                    e.preventDefault();
                    const firstError = document.querySelector('.error-message');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }

        function showFieldError(field, message) {
            clearFieldError(field);
            field.classList.add('error');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        }

        function clearFieldError(field) {
            field.classList.remove('error');
            const errorDiv = field.parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        // ============================================
        // 5. Delete Confirmation
        // ============================================
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const tierName = this.getAttribute('data-tier-name') || 'этот уровень';
                if (!confirm(`Вы уверены, что хотите удалить "${tierName}"? Все связи с пользователями будут потеряны.`)) {
                    e.preventDefault();
                }
            });
        });

        // ============================================
        // 6. Toggle Status Confirmation
        // ============================================
        const toggleForms = document.querySelectorAll('.toggle-form');

        toggleForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const tierName = this.getAttribute('data-tier-name') || 'этот уровень';
                const currentStatus = this.getAttribute('data-current-status');
                const action = currentStatus === 'active' ? 'деактивировать' : 'активировать';

                if (!confirm(`Вы уверены, что хотите ${action} "${tierName}"?`)) {
                    e.preventDefault();
                }
            });
        });

        // ============================================
        // 7. Remove Users Confirmation
        // ============================================
        const removeUserForms = document.querySelectorAll('.remove-user-form');

        removeUserForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const userName = this.getAttribute('data-user-name') || 'этого пользователя';
                if (!confirm(`Удалить ${userName} из этого pricing tier?`)) {
                    e.preventDefault();
                }
            });
        });

        // ============================================
        // 8. Filter Form Auto-submit
        // ============================================
        const filterSelects = document.querySelectorAll('.filter-auto-submit');

        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });

        // ============================================
        // 9. Table Row Click Handler
        // ============================================
        const tableRows = document.querySelectorAll('.clickable-row');

        tableRows.forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't trigger if clicking on a button or link
                if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' ||
                    e.target.closest('a') || e.target.closest('button')) {
                    return;
                }

                const url = this.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });
        });

        // ============================================
        // 10. Copy to Clipboard
        // ============================================
        const copyButtons = document.querySelectorAll('.copy-btn');

        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy-text');
                if (textToCopy) {
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        const originalText = this.textContent;
                        this.textContent = '✓ Скопировано!';
                        setTimeout(() => {
                            this.textContent = originalText;
                        }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                    });
                }
            });
        });

    }); // End DOMContentLoaded

})(); // End IIFE
