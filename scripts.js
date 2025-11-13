// ------------------ Affichage du jour et de la date ------------------
const verseDayElem = document.getElementById('verse-day');
const verseDateElem = document.getElementById('verse-date');

const now = new Date();
const optionsDay = { weekday: 'long' }; // Lundi, Mardi...
const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' }; // 12 novembre 2025

verseDayElem.textContent = "Jour : " + now.toLocaleDateString('fr-FR', optionsDay);
verseDateElem.textContent = "Date : " + now.toLocaleDateString('fr-FR', optionsDate);

// ------------------ Boutons de partage ------------------
function openShare(url) {
    window.open(url, '_blank', 'width=600,height=600');
}

document.querySelector('.whatsapp').addEventListener('click', () => {
    openShare(`https://api.whatsapp.com/send?text=${encodeURIComponent(document.getElementById('verse-text').textContent)}`);
});

document.querySelector('.facebook').addEventListener('click', () => {
    openShare(`https://www.facebook.com/sharer/sharer.php?u=&quote=${encodeURIComponent(document.getElementById('verse-text').textContent)}`);
});

document.querySelector('.x').addEventListener('click', () => {
    openShare(`https://twitter.com/intent/tweet?text=${encodeURIComponent(document.getElementById('verse-text').textContent)}`);
});

document.querySelector('.instagram').addEventListener('click', () => {
    alert("Partage direct vers Instagram non disponible, mais vous pouvez copier le texte !");
});

document.querySelector('.tiktok').addEventListener('click', () => {
    alert("Partage direct vers TikTok non disponible, mais vous pouvez copier le texte !");
});

// ------------------ Télécharger le verset en image ------------------
document.querySelector('.download').addEventListener('click', () => {
    alert("Fonction téléchargement en préparation...");
});
