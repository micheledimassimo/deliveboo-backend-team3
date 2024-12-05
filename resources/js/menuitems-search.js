document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('searchMenuItems').addEventListener('keyup', function () {
        const searchValue = this.value.toLowerCase();
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            const name = item.getAttribute('data-name');
            item.style.display = name.includes(searchValue) ? 'flex' : 'none';
        });
    });
});