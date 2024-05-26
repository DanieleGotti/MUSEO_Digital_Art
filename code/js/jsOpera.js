
function controllaCodice() {
  var opera = document.getElementById("opera").value;
  // Verifica se il codice contiene solo numeri
  if (!/^\d+$/.test(opera)) {
      // Se il codice non contiene solo numeri, mostra un alert
      alert("I codici devono essere numerici!");
      // Pulisci il campo del codice
      document.getElementById("opera").value = "";
  }
}
