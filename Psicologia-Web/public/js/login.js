
/* Visualizar senha Login */

document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const togglePasswordIcon = document.getElementById("togglePasswordIcon");
    const passwordInput = document.getElementById("password");

    if (togglePassword && passwordInput && togglePasswordIcon) {
        togglePassword.addEventListener("click", () => {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            // Troca o ícone
            togglePasswordIcon.src = isPassword
                ? "/images/lock_password_icon.png"  // Ex: cadeado fechado
                : "/images/unlock_password_icon.png"; // Ex: cadeado aberto

            togglePasswordIcon.alt = isPassword
                ? "Ocultar senha"
                : "Mostrar senha";
        });
    }
});

/* Fim Visualizar senha Login */