<div class="image-upload-component">
    <div class="image-upload-preview" id="imagePreviewBox">
        @if(isset($currentImage) && $currentImage)
            <img src="{{ Storage::url($currentImage) }}" alt="{{ __('admin.products.image.current') }}" class="image-preview-img">
        @else
            <div class="image-placeholder">
                <svg class="placeholder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
                <span class="placeholder-text">{{ __('admin.products.image.no_image') }}</span>
            </div>
        @endif
    </div>

    <div class="image-upload-actions">
        <label class="image-upload-btn">
            <input type="file" name="image" id="imageInput" accept="image/*" style="display: none;">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>
            <span>{{ __('admin.products.image.choose_file') }}</span>
        </label>

        <button type="button" class="image-remove-btn" id="removeImageBtn" style="display: none;">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            <span>{{ __('admin.products.image.remove') }}</span>
        </button>
    </div>

    <div class="image-upload-info">
        <span class="info-icon">ℹ️</span>
        <span class="info-text">{{ __('admin.products.image.info') }}</span>
    </div>
</div>

@push('styles')
    <style>
        .image-upload-component {
            margin-bottom: 1.5rem;
        }

        .image-upload-preview {
            width: 100%;
            min-height: 200px;
            background: var(--surface2);
            border: 2px dashed var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .image-upload-preview:hover {
            border-color: var(--brand);
            background: rgba(10, 27, 72, 0.02);
        }

        .image-preview-img {
            max-width: 100%;
            max-height: 200px;
            object-fit: contain;
        }

        .image-placeholder {
            text-align: center;
            padding: 2rem;
        }

        .placeholder-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 0.75rem;
            color: var(--muted);
        }

        .placeholder-text {
            display: block;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .image-upload-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .image-upload-btn,
        .image-remove-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .image-upload-btn {
            background: var(--brand);
            color: #fff;
        }

        .image-upload-btn:hover {
            background: var(--brand-dk);
            transform: translateY(-1px);
        }

        .image-remove-btn {
            background: #ef4444;
            color: #fff;
        }

        .image-remove-btn:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .btn-icon {
            width: 18px;
            height: 18px;
        }

        .image-upload-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: #fef3c7;
            border-radius: 8px;
            font-size: 0.75rem;
            color: #92400e;
        }

        .info-icon {
            font-size: 1rem;
        }

        .info-text {
            line-height: 1.4;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageInput');
            const previewBox = document.getElementById('imagePreviewBox');
            const removeBtn = document.getElementById('removeImageBtn');

            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewBox.innerHTML = `<img src="${event.target.result}" alt="Preview" class="image-preview-img">`;
                            if (removeBtn) removeBtn.style.display = 'inline-flex';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (imageInput) {
                        imageInput.value = '';
                        previewBox.innerHTML = `
                    <div class="image-placeholder">
                        <svg class="placeholder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                            <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        <span class="placeholder-text">{{ __('admin.products.image.no_image') }}</span>
                    </div>
                `;
                        removeBtn.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endpush
