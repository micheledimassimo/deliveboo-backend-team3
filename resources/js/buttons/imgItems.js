document.addEventListener('DOMContentLoaded', () => {

     // Trova tutti i contenitori con il data-id
     const imageContainers = document.querySelectorAll('[data-id]');

     // Per ogni contenitore, recupera l'ID e inizializza la gestione dell'immagine
     imageContainers.forEach(container => {
         const id = container.getAttribute('data-id');
         setupImageHandler(id);
     });
    function setupImageHandler(id) {
        const imgInput = document.getElementById(`img_input${id}`);
        const removeImgButton = document.getElementById(`remove_image${id}`);
        const imgPreview = document.getElementById(`img_preview${id}`);
        const removeImgCheckbox = document.getElementById(`removeimage_input${id}`);
        const imgLabel = document.querySelector(`[for="img_input${id}"]`);
        const imageContainer = document.getElementById(`image_container${id}`);

        function toggleImageControls(hasImage) {
            if (imgPreview) imgPreview.style.display = hasImage ? 'block' : 'none';
            if (removeImgButton) removeImgButton.style.display = hasImage ? 'flex' : 'none';
            if (imgLabel) imgLabel.textContent = hasImage ? 'Modifica immagine' : 'Carica una nuova immagine';
        }

        // Initialize controls based on whether an image is present
        if (imgPreview && imgPreview.src) {
            toggleImageControls(true);
        } else {
            toggleImageControls(false);
        }

        // Handle image input change
        imgInput?.addEventListener('change', ({ target }) => {
            const file = target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (imgPreview) {
                        imgPreview.src = e.target.result;
                        toggleImageControls(true);
                    }
                    if (removeImgCheckbox) removeImgCheckbox.checked = false; // Reset the remove checkbox
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle remove image button click
        removeImgButton?.addEventListener('click', () => {
            if (removeImgCheckbox) removeImgCheckbox.checked = true;
            if (imgPreview) imgPreview.src = '';
            if (imgInput) imgInput.value = ''; // Clear the input value
            toggleImageControls(false);

            // Remove the image container if necessary
            if (imageContainer) {
                imageContainer.style.display = 'none';
            }
        });
    }

// Call the function with the specific menu item ID
    

});