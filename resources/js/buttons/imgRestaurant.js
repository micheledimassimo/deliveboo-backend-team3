document.addEventListener('DOMContentLoaded', () => {
    const imgInput = document.getElementById('img');
    const removeImgButton = document.querySelector('.remove-img-btn');
    const imgPreview = document.querySelector('.img-thumbnail');
    const removeImgCheckbox = document.getElementById('remove_img');
    const imgLabel = document.querySelector('[for="img"]');

    if (imgPreview?.src) {
        toggleImageControls(true);
    }

    imgInput?.addEventListener('change', ({ target }) => {
        const file = target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                imgPreview.src = e.target.result;
                toggleImageControls(true); 
                removeImgCheckbox.checked = false; 
            };
            reader.readAsDataURL(file);
        }
    });

    removeImgButton?.addEventListener('click', () => {
        removeImgCheckbox.checked = true;
        imgPreview.src = ''; 
        imgInput.value = ''; 
        toggleImageControls(false); 
    });

    function toggleImageControls(hasImage) {
        imgPreview.style.display = hasImage ? 'block' : 'none'; 
        removeImgButton.style.display = hasImage ? 'flex' : 'none'; 
        imgLabel.textContent = hasImage ? 'Modifica immagine' : 'Carica una nuova immagine'; 
    }

   
});

