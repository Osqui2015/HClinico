
setTimeout(() => {
  //Esta se llamma al medio segundo para asegurar que la informacion este lista
  updateInfo();
}, 500);

/**
 * Actualiza la informacion de las habitaciones cada segundo
 */
function updateInfo() {
  var parametros = {
    action: "refreshAll",
  };
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
      //Si falla se llama de una
    //   setTimeout(() => {
    //     updateInfo();
    //   }, 10); //Al segundo
    },
    success: function (r) {
      console.log(r);
      if (habitaciones == undefined) { //refresca
        // Primera ejecucion
        habitaciones = r;
      } else {
        console.clear()
        console.log(habitaciones)
        // habitaciones.map((habitacion) => {
        //   //Basicaente, por cada habitacion que se tenia, se busca en la nueva informaciony se compara el estado
        //   let nuevaHabitacion = r.find((newHabitacion) => {
        //     if (habitacion.id_habitacion == newHabitacion.id_habitacion) {
        //       //Revisa si es la misma habitacion
        //       if (habitacion.Estado != newHabitacion.Estado) {
        //         //Un log para ver si funciona
        //         console.log("Se actualiza habitacion " + habitacion.id_habitacion)
        //         actualizarEstado(habitacion.id_habitacion, habitacion.Estado);
        //       }
        //     }
        //   });
        // });
        // habitacion = r; //Actualiza la informacion para comparar en la siguiente ronda
        // //Cuando acaba se programa una nueva llamada ajax
        // setTimeout(() => {
        //   updateInfo();
        // }, 1000); //Al segundo
      }
    },
  });
}

function actualizarEstado(habitacion, estado) {
  /**
   * ESTADO:
   * 2 = deshabilitado
   * 3 = abilitado
   */
  if (estado == 2) {
    $(`#${habitacion}`)
      .addClass("btn-success")
      .removeClass("btn-danger")
      .html("INHABILITADA");
  } else {
    $(`#${habitacion}`)
      .addClass("btn-danger")
      .removeClass("btn-success")
      .html("HABILITADA");
  }
}