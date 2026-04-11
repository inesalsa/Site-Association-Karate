document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('inscriptionForm');

    if (form) {
        form.addEventListener('submit', function(event) {
            
            const nom = document.getElementById('nom');
            const email = document.getElementById('email');
            const mdp = document.getElementById('mdp');

            
            const errorNom = document.getElementById('error-nom');
            const errorEmail = document.getElementById('error-email');
            const errorMdp = document.getElementById('error-mdp');

            let estValide = true;

            
            if (nom.value.trim().length < 3) {
                errorNom.innerText = "Le nom est trop court (min. 3 caractères).";
                nom.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorNom.innerText = "";
                nom.style.borderColor = "#ddd";
            }

            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                errorEmail.innerText = "Veuillez entrer une adresse email valide.";
                email.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorEmail.innerText = "";
                email.style.borderColor = "#ddd";
            }

            
            if (mdp.value.length < 8) {
                errorMdp.innerText = "Le mot de passe doit faire au moins 8 caractères.";
                mdp.style.borderColor = "var(--rouge-karate)";
                estValide = false;
            } else {
                errorMdp.innerText = "";
                mdp.style.borderColor = "#ddd";
            }

           
            if (!estValide) {
                event.preventDefault();
                const btn = form.querySelector('.btn-martial');
                btn.style.animation = "shake 0.5s";
                setTimeout(() => btn.style.animation = "", 500);
            }
        });
    }
});