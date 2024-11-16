const toggleButton = document.getElementById('toggleButton');
const sidebar = document.getElementById('sidebar');
const dashboard = document.getElementById('dashboard');

toggleButton.addEventListener('click', () => {
    if (sidebar.classList.contains('w-64')) {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-16'); // Reduced width for the collapsed state
    } else {
        sidebar.classList.remove('w-16');
        sidebar.classList.add('w-64'); // Original width for the expanded state
    }
});
