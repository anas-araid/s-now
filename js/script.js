// funzioni per aprire e chiudere la sidebar
function apriMenu() {
    document.getElementById("menuLat").style.display = "block";
    document.getElementById("opacita").style.display = "block";
    document.getElementById("mapdiv").style.display = "none"; // la mappa sovrapponeva la sidebar
}

function chiudiMenu() {
    document.getElementById("menuLat").style.display = "none";
    document.getElementById("opacita").style.display = "none";
    document.getElementById("mapdiv").style.display = "block";
}
var indice=0;
function slideImmagini(){
  var img = document.getElementById("galleria");
  img.src = "img/img" + indice + ".jpg";
  indice += 1;
  if (indice === 5){
    indice = 0;
  }
  setTimeout(slideImmagini, 2000);
}
function alertElimina(){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Perderai tutti i dati relativi al tuo account",
      icon: "error",
      buttons: {
        cancel: {
          text: "Annulla",
          visible: true,
        },
        button: {
          text: "Continua",
          visible: true,
        }
      }
    }
  ).then(Elimina => {
    if (Elimina){
      swal(" ", "Account eliminato con successo", "success").then(Elimina => {
        location.href='php/delete_user.php';
      });
    }else{
      swal.close();
    }
  });
}
function flatAlert(titolo, testo, icona, url){
  swal({
    title: titolo,
    text: testo,
    icon: icona,
  }).then(azione => {
    if (azione){
      location.href = url;
    }else{
      location.href = url;
    }
  });
}
