function obtenerProyectos() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var proyectos = JSON.parse(xhr.responseText);
            mostrarProyectos(proyectos);
        }
    };
    xhr.open("GET", "./../Backend/allProyects.php", true);
    xhr.send();
    console.log("Proyectos Obtenidos")
}


function mostrarProyectos(proyectos) {
    var tbody = document.getElementById("proyectosBody");
    tbody.innerHTML = ""; 

       proyectos.forEach(function(proyecto) {
        var row = document.createElement("tr");
        row.innerHTML = "<td>" + proyecto.nombre + "</td><td>" + proyecto.fechaI + "</td><td>" + proyecto.fechaF + "</td>";
           tbody.appendChild(row);
    });
}

obtenerProyectos();