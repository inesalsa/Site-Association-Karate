const news = [
    {
        titre: "Passage de grades : Juin 2026",
        date: "12 Fév 2026",
        description: "Félicitations aux 15 nouveaux gradés du club ! Le travail paie.",
        image: "https://via.placeholder.com/300x150?text=Karate+Grades"
    },
    {
        titre: "Stage avec un expert Japonais",
        date: "05 Fév 2026",
        description: "Nous accueillons Sensei Tanaka pour un stage exceptionnel de Kata.",
        image: "https://via.placeholder.com/300x150?text=Stage+Expert"
    }
];

const container = document.getElementById('news-container');

news.forEach(item => {
    const card = `
        <div class="news-card">
            <img src="${item.image}" alt="news">
            <div class="news-content">
                <span>${item.date}</span>
                <h3>${item.titre}</h3>
                <p>${item.description}</p>
                <button class="btn-read">Lire la suite</button>
            </div>
        </div>
    `;
    container.innerHTML += card;
});

const observerOptions = {
    threshold: 0.15 
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);
document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll('.reveal');
    targets.forEach(target => observer.observe(target));
});
const animateCounters = () => {
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
};
const iframe = document.getElementById('googleForm');
const loader = document.getElementById('loader');

if (iframe) {
    iframe.onload = function() {
        
        loader.style.display = 'none';
        iframe.style.display = 'block';
    };
}
const dot = document.querySelector(".cursor-dot");
const outline = document.querySelector(".cursor-outline");

window.addEventListener("mousemove", (e) => {
    const posX = e.clientX;
    const posY = e.clientY;

    dot.style.left = `${posX}px`;
    dot.style.top = `${posY}px`;

    
    outline.animate({
        left: `${posX}px`,
        top: `${posY}px`
    }, { duration: 500, fill: "forwards" });
});
document.addEventListener("DOMContentLoaded", () => {
    console.log("Vérification de la session...");

    fetch('pages/get_user.php')
        .then(response => response.json())
        .then(data => {
            console.log("Réponse du serveur :", data); 

            if (data.loggedin) {
                const navLinks = document.querySelectorAll('nav a');
                navLinks.forEach(link => {
                    
                    if (link.href.includes('login.html')) {
                        link.innerHTML = "🥋 Mon Profil";
                        link.href = "profile.php"; 
                        link.style.color = "#bc002d"; 
                        link.style.fontWeight = "bold";
                    }
                });
            }
        })
        .catch(error => console.error('Erreur Fetch :', error));
});