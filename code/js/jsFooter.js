// Cambia classe al footer in base alla pagina visualizzata. In fondo se in index.php, fixed se negli altri .php
document.addEventListener('DOMContentLoaded', function() {
  let currentPage = window.location.pathname.split("/").pop();

  document.body.appendChild(footer);
  if (currentPage !== 'index.php') {
    let footer = document.getElementById('footer');
    if (footer) {
      footer.classList.remove('fixed');
    } else {
      console.error('Footer non trovato');
    }
  }
});
