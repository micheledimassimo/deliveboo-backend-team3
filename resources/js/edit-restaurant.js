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
         // Evita di attivare la checkbox se l'utente ha cliccato direttamente su di essa
         if (event.target.tagName === 'INPUT') return;

         // Trova la checkbox associata
         const checkboxId = this.getAttribute('data-checkbox-id');
         const checkbox = document.getElementById(checkboxId);

         if (checkbox) {
             // Cambia lo stato della checkbox
             checkbox.checked = !checkbox.checked;
             // Triggera l'evento 'change' per aggiornare lo stato se necessario
             checkbox.dispatchEvent(new Event('change'));
         }
     });
 });

 function handleCheckboxChange() {
     const selectedCheckboxes = [...checkboxes].filter(cb => cb.checked);
     
     // Disabilita checkbox e <li> non selezionati se sono selezionate 4 opzioni
     if (selectedCheckboxes.length >= 4) {
         checkboxes.forEach(cb => {
             if (!cb.checked) {
                 cb.disabled = true; // Disable unchecked checkboxes
                 findParentLi(cb).classList.add('disabled'); // Disable corresponding <li>
             }
         });
     } else {
         // Riabilita tutti i checkbox e <li> se meno di 4 sono selezionati
         checkboxes.forEach(cb => {
             cb.disabled = false;
             findParentLi(cb).classList.remove('disabled');
         });
     }

     updateSelectedValues();
 }

 setTimeout(handleCheckboxChange, 1000);

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
     if (!e.target.closest('.custom-dropdown')) dropdownList?.classList.remove('show');
 });