document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('ordersCarousel');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Funzione per aggiornare lo stato dei pulsanti
    function updateCarouselButtons() {
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        // Disabilita entrambi i pulsanti se non ci sono ordini
        if (totalItems === 0) {
            if (prevBtn) prevBtn.setAttribute('disabled', 'true');
            if (nextBtn) nextBtn.setAttribute('disabled', 'true');
            return;
        }

        const activeIndex = Array.from(items).indexOf(document.querySelector('.carousel-item.active')) + 1;

        // Disabilita il pulsante "prev" se siamo sulla prima pagina
        if (activeIndex === 1) {
            if (prevBtn) prevBtn.setAttribute('disabled', 'true');
        } else {
            if (prevBtn) prevBtn.removeAttribute('disabled');
        }

        // Disabilita il pulsante "next" se siamo sull'ultima pagina
        if (activeIndex === totalItems) {
            if (nextBtn) nextBtn.setAttribute('disabled', 'true');
        } else {
            if (nextBtn) nextBtn.removeAttribute('disabled');
        }
    }

    // Aggiungi evento per aggiornare lo stato dei pulsanti
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', updateCarouselButtons);
    }

    // Inizializza lo stato dei pulsanti all'avvio
    updateCarouselButtons();
});