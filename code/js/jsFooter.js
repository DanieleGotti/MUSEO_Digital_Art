
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = window.location.pathname.split("/").pop();

    if (currentPage === 'index.php') {
        let footer = document.getElementById('footer');
        if (footer) {
            footer.classList.add('nonFixed');
            document.body.appendChild(footer);
        } else {
            console.error('Footer non trovato');
        }
    }
});
