document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('inscriptionForm');

    if (form) {
        form.addEventListener('submit', function(event) {
            // Récupération des éléments
            const nom = document.getElementById('nom');
            const email = document.getElementById('email');
            const mdp = document.getElementById('mdp');

            // Récupération des zones d'erreur
            const errorNom = document.getElementById('error-nom');
            const errorEmail = document.getElementById('error-email');
            const errorMdp = document.getElementById('error-mdp');

            let estValide = true;

            // 1. Validation du Nom
            if (nom.value.trim().length < 3) {
                errorNom.innerText = "Le nom est trop court (min. 3 caractères).";
                nom.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorNom.innerText = "";
                nom.style.borderColor = "#ddd";
            }

            // 2. Validation de l'Email (Regex simple)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                errorEmail.innerText = "Veuillez entrer une adresse email valide.";
                email.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorEmail.innerText = "";
                email.style.borderColor = "#ddd";
            }

            // 3. Validation du Mot de Passe
            if (mdp.value.length < 8) {
                errorMdp.innerText = "Le mot de passe doit faire au moins 8 caractères.";
                mdp.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorMdp.innerText = "";
                mdp.style.borderColor = "#ddd";
            }

            // Bloquer l'envoi si invalide
            if (!estValide) {
                event.preventDefault();
                // Petit effet de vibration sur le bouton si tu veux
                const btn = form.querySelector('.btn-martial');
                btn.style.animation = "shake 0.5s";
                setTimeout(() => btn.style.animation = "", 500);
            }
        });
    }
});