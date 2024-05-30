document.addEventListener("DOMContentLoaded", function() {
    var containers = document.querySelectorAll('.horizontalScroll');
    var scrollAmount = 1; // La quantità di pixel da scorrere ad ogni intervallo
    var scrollSpeed = 30; // La velocità dello scroll (in millisecondi)

    containers.forEach(function(container) {
        var scrollInterval;

        function startScrolling() {
            scrollInterval = setInterval(function() {
                container.scrollLeft += scrollAmount;
                // Verifica se ha raggiunto il fondo
                if (container.scrollLeft >= container.scrollWidth - container.clientWidth) {
                    container.scrollLeft = 0; // Riparti da capo
                }
            }, scrollSpeed);
        }

        function stopScrolling() {
            clearInterval(scrollInterval);
        }

        // Inizia lo scrolling quando la pagina è caricata
        startScrolling();

        // Ferma lo scrolling al passaggio del mouse sul contenitore
        container.addEventListener("mouseover", stopScrolling);

        // Riprende lo scrolling quando il mouse lascia il contenitore
        container.addEventListener("mouseout", startScrolling);
    });
});
