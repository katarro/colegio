document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".input");

    function addcl(){
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }

    function remcl(){
        let parent = this.parentNode.parentNode;
        if(this.value == ""){
            parent.classList.remove("focus");
        }
    }

    inputs.forEach(input => {
        input.addEventListener("focus", addcl);
        input.addEventListener("blur", remcl);
    });

    document.getElementById("showRegister").addEventListener("click", function() {
        console.log("Botón Registrarse clickeado");  // Mensaje de depuración
        document.getElementById("registerComponent").style.display = "block";
    });

    function register() {
        const username = document.getElementById("registerUsername").value;
        const password = document.getElementById("registerPassword").value;

        // Aquí puedes agregar el código para enviar estos datos al servidor
        // ...
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const registrationForm = document.getElementById("registrationForm");
    const rutInput = document.getElementById("rutInput");

    registrationForm.addEventListener("submit", function(event) {
        const rutValue = rutInput.value;
        // Actualización de la expresión regular para incluir el dígito verificador
        const rutPattern = /^\d{2}\.\d{3}\.\d{3}-[\dkK]$/;

        if (!rutPattern.test(rutValue)) {
            // El formato del RUT es incorrecto
            alert("El formato del RUT debe ser XX.XXX.XXX-X");
            event.preventDefault(); // Detiene el envío del formulario
        }
    });
});

