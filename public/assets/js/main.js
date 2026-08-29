/**
 * Mursal Marble Client-side Interactive Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    // Auto-dismiss alert notifications after 5 seconds
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Admin Image File Upload Live Preview
    const imageInput = document.getElementById('productImageInput');
    const imagePreview = document.getElementById('productImagePreview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    imagePreview.src = event.target.result;
                    imagePreview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Client-side quick filter on catalog page
    const clientSearchInput = document.getElementById('clientProductSearch');
    if (clientSearchInput) {
        clientSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const productCards = document.querySelectorAll('.product-card-item');

            productCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const category = card.getAttribute('data-category')?.toLowerCase() || '';
                const origin = card.getAttribute('data-origin')?.toLowerCase() || '';

                if (name.includes(query) || category.includes(query) || origin.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
function changeMainImage(src){

document.getElementById('mainProductImage').src=src;

}