function redirect(url) {
    window.location.href = url;
}

const notyf = new Notyf({
    duration: 3000,
    position: {
        x: 'right',
        y: 'top',
    }
});

const loader = `<div class="w-6 h-6 border-2 border-dashed rounded-full animate-spin border-white"></div>`;