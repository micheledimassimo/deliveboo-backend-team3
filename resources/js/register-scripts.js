
    // Typologies dropdown functionality
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownList = document.querySelector('.dropdown-list');
    const selectedSpan = document.querySelector('.selected-values');
    const placeholderSpan = document.querySelector('.dropdown-placeholder');
    const checkboxes = document.querySelectorAll('.dropdown-list input[type="checkbox"]');
    const listItems = document.querySelectorAll('.dropdown-list li');

    dropdownButton?.addEventListener('click', e => {
        e.preventDefault();
        dropdownList.classList.toggle('show');
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    listItems.forEach(li => {
        li.addEventListener('click', function (event) {
            if (event.target.tagName === 'INPUT') return;

            const checkboxId = this.getAttribute('data-checkbox-id');
            const checkbox = document.getElementById(checkboxId);

            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });

    function handleCheckboxChange() {
        const selectedCheckboxes = [...checkboxes].filter(cb => cb.checked);
        
        if (selectedCheckboxes.length >= 4) {
            checkboxes.forEach(cb => {
                if (!cb.checked) {
                    cb.disabled = true; 
                    findParentLi(cb).classList.add('disabled'); 
                }
            });
        } else {
            checkboxes.forEach(cb => {
                cb.disabled = false;
                findParentLi(cb).classList.remove('disabled');
            });
        }

        updateSelectedValues();
    }

    function updateSelectedValues() {
        const selectedValues = [...checkboxes]
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.parentElement.textContent.trim());
        selectedSpan.textContent = selectedValues.join(', ');
        placeholderSpan.style.display = selectedValues.length ? 'none' : 'inline';
    }

    function findParentLi(checkbox) {
        return checkbox.closest('li');
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.custom-dropdown-register')) dropdownList?.classList.remove('show');
    });
