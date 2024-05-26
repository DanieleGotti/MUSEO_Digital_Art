
function controllaNumero() {
  var numero = document.getElementById("numero").value;
  // Verifica se il numero contiene solo numeri
  if (!/^\d+$/.test(numero)) {
      // Se il numero non contiene solo numeri, mostra un alert
      alert("I numeri delle sale devono essere numerici!");
      // Pulisci il campo del numero
      document.getElementById("numero").value = "";
  }
}
