const table_grid = document.getElementsByClassName("table-grid")[0];
const filters = {
    userId: null, // Aquí puedes inicializar con un ID de usuario si está disponible
    year: null,
    month: null
};

// Fetch y render de archivos
async function fetchArchivos() {
    try {
        let url = `${APP_ROOT}Controllers/listarArchivos.php`;
        const params = new URLSearchParams(filters);
        if (params.toString()) url += `?${params.toString()}`;
        
        const response = await fetch(url);
        const jsonRes = await response.json();

        if (jsonRes.Error) {
            throw new Error(jsonRes.Error);
        }

        renderArchivos(jsonRes);
    } catch (error) {
        alert("Ha ocurrido un error: " + error);
    }
}

// Renderizar archivos en la tabla
function renderArchivos(archivos) {
    table_grid.querySelector("tbody").innerHTML = ""; // Limpia la tabla

    archivos.forEach(archive => {
        const info = `
            <tr class="archivo-info" id="archivo-${archive.id}">
                <td>${archive.id}</td>
                <td>${archive.nombre_archivo}</td>
                <td>${archive.descripcion}</td>
                <td>${archive.extension}</td>
                <td>${archive.tamaño}</td>
                <td>${archive.fecha_subido}</td>
                <td>${archive.es_publico ? "Público" : "Privado"}</td>
                <td>${archive.favorito ? "⭐" : ""}</td>
                <td>
                    <button class="btn-admin" data-id="${archive.id}" data-tipo="${archive.es_publico}">Administrar</button>
                    <button class="btn-eliminar" data-id="${archive.id}">Eliminar</button>
                    <button class="btn-favorito" data-id="${archive.id}" data-favorito="${archive.favorito}">${archive.favorito ? "Quitar" : "Marcar"} Favorito</button>
                </td>
            </tr>`;
        table_grid.insertAdjacentHTML('beforeend', info);
    });

    attachEventListeners();
}

// Filtros de año y mes
document.getElementById("year-filter").addEventListener("change", (e) => {
    filters.year = e.target.value;
    fetchArchivos();
});

document.getElementById("month-filter").addEventListener("change", (e) => {
    filters.month = e.target.value;
    fetchArchivos();
});

// Listeners dinámicos
function attachEventListeners() {
    document.querySelectorAll(".btn-admin").forEach(button => {
        button.addEventListener("click", handleAdmin);
    });

    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", handleEliminar);
    });

    document.querySelectorAll(".btn-favorito").forEach(button => {
        button.addEventListener("click", handleFavorito);
    });
}

// Gestionar favorito
async function handleFavorito(event) {
    const archivoId = event.target.getAttribute("data-id");
    const isFavorito = event.target.getAttribute("data-favorito") === "true";

    try {
        const response = await fetch(`${APP_ROOT}Controllers/listarArchivos.php`, {
            method: "POST", // Puedes ajustar según tu backend
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: archivoId, favorito: !isFavorito })
        });

        const data = await response.json();
        if (data.success) {
            alert(`Archivo ${!isFavorito ? "marcado como" : "quitado de"} favorito.`);
            fetchArchivos(); // Actualiza la tabla
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al actualizar favorito:", error);
        alert("Hubo un error al intentar cambiar el estado de favorito.");
    }
}

// Inicializar
fetchArchivos();
