const formsumbmit = document.getElementById("register-user");

const today = new Date();
const formatDate = (date) => date.toISOString().split('T')[0];
document.getElementById("date-birthday").max = formatDate(today);

formsumbmit.addEventListener('submit', async (e) => {

    e.preventDefault();

    const user = document.getElementById("txt-username").value.trim();
    const name = document.getElementById("txt-name").value.trim();
    const lastname = document.getElementById("txt-lastname").value.trim();
    const gender = document.getElementById("tag-gender").value;
    const birthday = document.getElementById("date-birthday").value;
    let rol = parseInt(document.getElementById("select-rol").value);
    const password = document.getElementById("txt-password").value;
    const confirm_passwd = document.getElementById("txt-confirmPassword").value;

    // Se valida los campos del usuario
    if (!name){
        alert("se requiere nombre");
        return;
    }
    
    if (!lastname){
        alert("se requiere apellido");
        return;
    }

    if (gender != "masculino" && gender != "femenino" && gender != "no binario"){
        alert("se requiere apellido");
    }

    if (!birthday){
        alert("se requiere una fecha de nacimiento");
        return;
    }

    if (!user|| !/^[a-zA-Z0-9_]+$/.test(user)){
        alert("usuario no valido");
        return;
    }

    if (!rol){
        rol = 0;
    }

    if (password != confirm_passwd){
        alert("las constraseñas no coinciden");
        return;
    }

    if (!/^(?=.*[A-Z])[a-zA-Z0-9_]{8,}$/.test(password)){
        alert("la contraseña debil")
        return;
    }

    // Para enviar el archivo se hará una petición de tipo
    // multipart/form-data, para esto ocuparemos un object de 
    // tipo FormData para serializar los archivos y datos a enviar
    const datos = new FormData();
    datos.append('name', name);
    datos.append('lastname', lastname);
    datos.append('gender', gender);
    datos.append('birthday', birthday);
    datos.append('user', user);
    datos.append('rol', rol);
    datos.append('password', password);

    // Se hace la petición AJAX usando la API de fetch, esta
    // petición es de tipo POST y dentro del payload de este
    // request (content-type: multipart/form-data) estará
    // el archivo y otro dato.
    try{

        console.log(`${APP_ROOT}controlles/do_register.php`)

        const res = await fetch(    // AJAX call
                `${APP_ROOT}do_register_ajax.php`, 
                { method: "POST", body: datos });

        // Obtenemos un JS object a partir del JSON regresado por el server
        const resObj = await res.json();
        
        if (resObj.ErrMesg) {   // si regresa un error, lo mostramos
            alert(resObj.ErrMesg);
        }
        if (resObj.success) {  // mensaje
            alert("El usuario se ha reguistrado correctamente");
            window.location.href = `${APP_ROOT}index.php`;

        }
    }
    catch(error){
        console.error("Hubo un problema en la peticion: ", error);
    }

});