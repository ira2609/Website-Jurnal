const menuButtons = document.querySelectorAll('[data-menu-toggle]');
const sideMenu = document.querySelector('[data-side-menu]');

if (menuButtons.length && sideMenu) {
    menuButtons.forEach((button) => {
        button.addEventListener('click', () => {
            sideMenu.classList.toggle('-translate-x-full');
        });
    });
}

