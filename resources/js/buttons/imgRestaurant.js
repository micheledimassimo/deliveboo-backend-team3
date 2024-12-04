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

    // Typologies dropdown functionality
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownList = document.querySelector('.dropdown-list');
    const selectedSpan = document.querySelector('.selected-values');
    const placeholderSpan = document.querySelector('.dropdown-placeholder');
    
    dropdownButton?.addEventListener('click', e => {
        e.preventDefault();
        dropdownList.classList.toggle('show');
    });

    document.querySelectorAll('.dropdown-list input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedValues);
    });

    function updateSelectedValues() {
        const selectedValues = [...document.querySelectorAll('.dropdown-list input[type="checkbox"]:checked')]
            .map(checkbox => checkbox.parentElement.textContent.trim());
        selectedSpan.textContent = selectedValues.join(', ');
        placeholderSpan.style.display = selectedValues.length ? 'none' : 'inline';
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.custom-dropdown')) dropdownList?.classList.remove('show');
    });
});

