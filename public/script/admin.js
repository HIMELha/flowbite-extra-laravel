const toggleButton = document.getElementById('toggleSidebarMobile');
const closeBtn = document.getElementById('toggleSidebarMobileClose');
const hambgBtn = document.getElementById("toggleSidebarMobileHamburger");
const sidebar = document.getElementById('sidebar');
const dashboard = document.getElementById('dashboardContent');

toggleButton.addEventListener('click', () => {
    if (hambgBtn.classList.contains('hidden')) {
        hambgBtn.classList.remove('hidden');
        closeBtn.classList.add('hidden');
    } else {
        hambgBtn.classList.add('hidden');
        closeBtn.classList.remove('hidden');
    }
    if (sidebar.classList.contains('hidden')) {

        sidebar.classList.remove('hidden');
    } else {
        sidebar.classList.add('hidden');

    }
});


function toggleMenu(button) {
    const dropdown = button.nextElementSibling;
    const icon = button.querySelector('.fa-chevron-up');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
        if (icon.classList.contains('rotate-180')) {
            icon.classList.remove('rotate-180');
        } else {
            icon.classList.add('rotate-180');

        }

    }
}