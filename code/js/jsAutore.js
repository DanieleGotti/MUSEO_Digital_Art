
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
