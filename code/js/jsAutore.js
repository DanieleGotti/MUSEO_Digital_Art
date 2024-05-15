
  function showOptions() {
    var optionsDiv = document.getElementById("options");
    var CRUDRadio = document.getElementById("CRUD");
    if (optionsDiv.style.display === "none") {
      optionsDiv.style.display = "block";
    } else {
      optionsDiv.style.display = "none";
      CRUDRadio.checked = false; // reimposta il pulsante radio su non selezionato
    }
  }


  function showCreateForm() {
    var createFormDiv = document.getElementById("createForm");
    createFormDiv.style.display = "block";
  }

  function validateForm() {
      var codice = document.getElementById("codice").value;
      var nome = document.getElementById("nome").value;
      var cognome = document.getElementById("cognome").value;
      var nazione = document.getElementById("nazione").value;
      var dataNascita = document.getElementById("dataNascita").value;
      var dataMorte = document.getElementById("dataMorte").value;

      if (codice === "" || nome === "" || cognome === "" || nazione === "" || dataNascita === "" || dataMorte === "") {
          alert("Per favore, compila tutti i campi.");
          return false;
      }

      // Creazione dell'oggetto XMLHttpRequest
      var xhttp = new XMLHttpRequest();

      // Definizione della funzione di callback quando la richiesta AJAX è completata
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              // Gestisci la risposta dal server se necessario
              console.log(this.responseText);
          }
      };

      // Apertura della richiesta AJAX
      xhttp.open("POST", "insertAuthor.php", true);

      // Impostazione dell'intestazione della richiesta per indicare che si inviano dati di tipo JSON
      xhttp.setRequestHeader("Content-Type", "application/json");

      // Creazione dell'oggetto con i dati da inviare al server
      var data = {
          codice: codice,
          nome: nome,
          cognome: cognome,
          nazione: nazione,
          dataNascita: dataNascita,
          dataMorte: dataMorte
      };

      // Conversione dell'oggetto in formato JSON
      var jsonData = JSON.stringify(data);

      // Invio della richiesta con i dati JSON
      xhttp.send(jsonData);

      return true; // Se tutti i campi sono validati correttamente, il form verrà inviato
  }
