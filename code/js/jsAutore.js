function showOptions() {
  var optionsDiv = document.getElementById("options");
  var CRUDRadio = document.getElementById("CRUD");
  if (optionsDiv.style.display === "none") {
    optionsDiv.style.display = "block";
  } else {
    optionsDiv.style.display = "none";
    CRUDRadio.checked = false; // reimposta il pulsante radio su non selezionato
    hideCreateForm(); // nascondi il form di creazione quando si nascondono le opzioni CRUD
  }
}

function showCreateForm() {
  var createFormDiv = document.getElementById("createForm");
  if (createFormDiv.style.display === "none") {
    createFormDiv.style.display = "block";
  }
}

function hideCreateForm() {
  var createFormDiv = document.getElementById("createForm");
  createFormDiv.style.display = "none";
}

function modificaAutore(codice) {
  // Implementa qui la logica per la modifica dell'autore con il codice specificato
  console.log("Modifica autore con codice: " + codice);
}

function cancellaAutore(codice) {
  // Implementa qui la logica per la cancellazione dell'autore con il codice specificato
  console.log("Cancella autore con codice: " + codice);
}


  function validateForm() {
      var codicecreate = document.getElementById("codicecreate").value.trim();
      var nomecreate = document.getElementById("nomecreate").value.trim();
      var cognomecreate = document.getElementById("cognomecreate").value.trim();
      var nazionecreate = document.getElementById("nazionecreate").value.trim();
      var dataNascitacreate = document.getElementById("dataNascitacreate").value.trim();
      var dataMortecreate = document.getElementById("dataMortecreate").value.trim();

      if (codicreate === "" || nomecreate === "" || cognomecreate === "" || nazionecraete === "" || dataNascitacreate === "" ) {
          alert("Per favore, compila tutti i campi.");
          return false;
      }

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4) {
              if (this.status == 200) {
                  console.log("Inserimento completato con successo.");
              } else {
                  console.error("Si è verificato un errore durante l'inserimento.");
              }
          }
      };

      xhttp.open("POST", "insertAuthor.php", true);
      xhttp.setRequestHeader("Content-Type", "application/json");

      var data = {
          codicecreate: codicecreate,
          nomecreate: nomecreate,
          cognomecreate: cognomecreate,
          nazionecreate: nazionecreate,
          dataNascitacreate: dataNascitacreate,
          dataMortecreate: dataMortecreate
      };

      var jsonData = JSON.stringify(data);
      xhttp.send(jsonData);

      return true;
  }

  function editAutore(codice) {
    // Qui devi implementare la logica per l'operazione di modifica dell'autore
    // Potresti ad esempio reindirizzare l'utente a una nuova pagina o mostrare un modulo di modifica in una finestra modale
    // Dovresti passare il codice dell'autore come parametro per identificarlo
}

function deleteAutore(codice) {
    // Chiedi conferma all'utente prima di procedere con l'eliminazione
    var conferma = confirm('Sei sicuro di voler eliminare questo autore?');

    if (conferma) {
        // Se l'utente conferma, esegui la richiesta di eliminazione tramite AJAX
        $.ajax({
            url: 'autoreManager.php',
            method: 'POST',
            data: { delete_codice: codice },
            success: function(response) {
                alert(response); // Mostra un messaggio di conferma o errore
                // Aggiorna l'interfaccia utente se necessario
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Si è verificato un errore durante la richiesta di eliminazione.');
            }
        });
    }
}
