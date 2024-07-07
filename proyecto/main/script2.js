document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('miFormulario').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío tradicional del formulario

        let nombre = document.getElementById('nombre').value;
        obtenerDatos(nombre);
    });

    function obtenerDatos(nombre) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {

            if (xhr.readyState === XMLHttpRequest.DONE) {

                if (xhr.status === 200) {

                    var datos = JSON.parse(xhr.responseText);

                    mostrarDatos(datos);

                } else {

                    console.error('Hubo un problema con la solicitud.');

                }

            }

        };

        xhr.open("GET", `./Backend/index.php?nombre=${encodeURIComponent(nombre)}`, true);

        xhr.send();
    }

    function mostrarDatos(datos) {
        var tbody = document.getElementById("worksBody");
        tbody.innerHTML = ""; 

       datos.forEach(function(proyecto) {
        var row = document.createElement("tr");
        row.innerHTML = "<td>" + proyecto.tarea + "</td><td>" + proyecto.fechaIT + "</td><td>" + proyecto.fechaFT + "</td>";
           tbody.appendChild(row);
        });
    }
});