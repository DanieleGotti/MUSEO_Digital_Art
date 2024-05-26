
function controllaCodice() {
  var codice = document.getElementById("codice").value;
  // Verifica se il codice contiene solo numeri
  if (!/^\d+$/.test(codice)) {
      // Se il codice non contiene solo numeri, mostra un alert
      alert("I codici devono essere numerici!");
      // Pulisci il campo del codice
      document.getElementById("codice").value = "";
  }
}
