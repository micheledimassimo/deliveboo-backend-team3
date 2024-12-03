
const carousel = document.getElementById('ordersCarousel');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Aggiungi evento per aggiornare lo stato dei pulsanti
carousel.addEventListener('slid.bs.carousel', function() {
    const totalItems = document.querySelectorAll('.carousel-item').length;
    const activeIndex = Array.from(document.querySelectorAll('.carousel-item')).indexOf(document.querySelector('.carousel-item.active')) + 1;

    // Disabilita il pulsante "prev" se siamo sulla prima pagina
    if (activeIndex === 1) {
        prevBtn.setAttribute('disabled', 'true');
    } else {
        prevBtn.removeAttribute('disabled');
    }

    // Disabilita il pulsante "next" se siamo sull'ultima pagina
    if (activeIndex === totalItems) {
        nextBtn.setAttribute('disabled', 'true');
    } else {
        nextBtn.removeAttribute('disabled');
    }
});

