var habitaciones = undefined; //Almacena todas las habitaciones

function cambiarEstado(habitacionId, habitacionEstado) {
  var parametros = {
    habitacionEstado: habitacionEstado,
    habitacionId: habitacionId,
  };
  console.log(parametros);

  $.ajax({
    data: parametros,
    url: "codigo_php.php",
    type: "POST",
    error: function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 0) {
        alert("Not connect: Verify Network.");
      } else if (jqXHR.status == 404) {
        alert("Requested page not found [404]");
      } else if (jqXHR.status == 500) {
        alert("Internal Server Error [500].");
      } else if (textStatus === "parsererror") {
        alert("Requested JSON parse failed.");
      } else if (textStatus === "timeout") {
        alert("Time out error.");
      } else if (textStatus === "abort") {
        alert("Ajax request aborted.");
      } else {
        alert("Uncaught Error: " + jqXHR.responseText);
      }
    },
    success: function (r) {
      if ((r = 1)) {
        setTimeout(function(){
          $(location).attr('href','index.php');
          }, 50);
      }
    },
  });
}



