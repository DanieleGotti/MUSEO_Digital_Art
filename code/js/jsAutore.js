// Funzione per mostrare il pulsante "Creare"
function showCreateButton() {
  var createButton = document.getElementById("createButton");
  createButton.style.display = "block";
}

// Funzione per nascondere il pulsante "Creare"
function hideCreateButton() {
  var createButton = document.getElementById("createButton");
  createButton.style.display = "none";
}

// Funzione per gestire la visibilità delle opzioni
function showOptions() {
  var optionsDiv = document.getElementById("options");

  if (optionsDiv.style.display === "none") {
    optionsDiv.style.display = "block";
    showCreateButton(); // Mostra il pulsante "Creare"
  } else {
    optionsDiv.style.display = "none";
    hideCreateButton(); // Nasconde il pulsante "Creare"
  }
}

// Funzione per gestire il pulsante "Back"
function handleBackButton() {
  hideCreateButton(); // Nasconde il pulsante "Creare" quando viene premuto il pulsante "Back"
}



function showCreateForm() {
  var createFormDiv = document.getElementById("createForm");
  if (createFormDiv.style.display === "none") {
    createFormDiv.style.display = "block";
  }
}




function salvaModifiche(codice) {
    var editForm = document.getElementById('editForm' + codice);
    // Ottieni i valori modificati dagli input del form
    var nuovoNome = editForm.elements['editNome'].value;
    // Invia i dati al server per salvare le modifiche
    // Qui dovresti usare AJAX o un metodo simile per inviare i dati al server
}

function hideCreateForm() {
  var createFormDiv = document.getElementById("createForm");
  createFormDiv.style.display = "none";
}



function cancellaAutore(codice) {
    if (confirm("Sei sicuro di voler cancellare questo autore?")) {
        // Se l'utente conferma, invia una richiesta AJAX per cancellare l'autore dal database
        $.ajax({
            type: "POST",
            url: "deleteAuthor.php", // Sostituisci con il percorso del tuo script PHP per eliminare l'autore
            data: { codice: codice },
            success: function(response) {
                // Gestisci la risposta qui, ad esempio aggiornando la tabella dei risultati
                console.log("Autore eliminato con successo!");
                // Ricarica la pagina dopo aver eliminato l'autore
                window.location.href = 'autore.php';
            },
            error: function(xhr, status, error) {
                // Gestisci gli errori qui
                console.error("Errore durante la cancellazione dell'autore:", error);
            }
        });
    }
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

    function showEditForm(codice) {
      var formRow = document.getElementById('editFormRow' + codice);
      if (formRow.style.display === 'none' || formRow.style.display === '') {
        formRow.style.display = 'table-row';
      } else {
        formRow.style.display = 'none';
      }
    }
