const API_URL = "http://localhost:8000";

let characters = [];
let targetCharacter = null;
let gameOver = false;
let attempts = 0;
let maxAttempts = 10;
let score = 1000;

const bgBase = "bg-gray-300";
const bgCorrect = "bg-green-500";
const bgWrong = "bg-red-500";

function getDailyCharacterId(total) {
    const today = new Date().toISOString().slice(0, 10);
    let hash = 0;
    for (let i = 0; i < today.length; i++) {
        hash = today.charCodeAt(i) + ((hash << 5) - hash);
    }
    const index = Math.abs(hash) % total;
    return index + 1;
}

async function fetchCharacters() {
    const res = await fetch(`${API_URL}/api/characters`);
    if (!res.ok) return alert("Error al cargar personajes");
    characters = await res.json();
}

async function fetchTarget() {
    const id = getDailyCharacterId(characters.length);
    const stored = localStorage.getItem('targetCharacter');
    if (stored) {
        const parsed = JSON.parse(stored);
        if (parsed.id === id) {
            targetCharacter = parsed;
            return;
        }
    }
    const res = await fetch(`${API_URL}/api/characters/${id}`);
    if (!res.ok) return alert("Error al cargar personaje objetivo");
    targetCharacter = await res.json();
    localStorage.setItem('targetCharacter', JSON.stringify(targetCharacter));
}

let labelsAdded = false;

function createRow(character) {
    const fields = ['image', 'name', 'faction', 'class', 'archetype', 'rarity', 'dp_cost'];
    const fieldLabels = {
        image: "Imagen",
        name: "Nombre",
        faction: "Facción",
        class: "Clase",
        archetype: "Arquetipo",
        rarity: "Rareza",
        dp_cost: "Costo DP"
    };

    if (!labelsAdded) {
        const labelRow = document.createElement('div');
        labelRow.className = "grid grid-cols-7 gap-2 mb-1 px-2";

        fields.forEach(field => {
            const label = document.createElement('div');
            label.textContent = fieldLabels[field];
            label.className = "text-xs font-semibold text-center text-black-600";
            labelRow.appendChild(label);
        });

        document.getElementById('attempts').appendChild(labelRow);
        labelsAdded = true;
    }

    const row = document.createElement('div');
    row.className = "grid grid-cols-7 gap-2 items-center bg-gray-100 p-2 rounded shadow";

    fields.forEach(field => {
        const cell = document.createElement('div');
        cell.className = "flex justify-center items-center h-16 rounded text-sm text-center";

        if (field === 'image') {
            const img = document.createElement('img');
            img.src = character.image;
            img.className = "w-12 h-12 object-contain";
            cell.classList.add(bgBase);
            cell.appendChild(img);
        } else if (['faction', 'class', 'archetype'].includes(field)) {
            const match = targetCharacter[field] === character[field];
            const img = document.createElement('img');
            img.src = character[field];
            img.className = "w-8 h-8 object-contain";
            cell.classList.add(match ? bgCorrect : bgWrong);
            cell.appendChild(img);
        } else {
            const match = targetCharacter[field] === character[field];
            const higher = character[field] > targetCharacter[field];
            let textContent = character[field];
            if (field !== 'name') {
                const arrow = !match ? (higher ? '↓' : '↑') : '';
                textContent += ` ${arrow}`;
            }
            cell.textContent = textContent;
            cell.classList.add(match ? bgCorrect : bgWrong);
        }

        row.appendChild(cell);
    });

    document.getElementById('attempts').appendChild(row);

    if (character.name === targetCharacter.name) {
        document.getElementById('guess-input').disabled = true;
        alert(`¡Correcto! Has adivinado el personaje del día 🎉\nPuntuación final: ${score}`);
        gameOver = true;
        localStorage.setItem('gameOver', 'true');
    } else {
        attempts++;
        score = Math.max(0, 1000 - attempts * 100);
        if (attempts >= maxAttempts) {
            gameOver = true;
            document.getElementById('guess-input').disabled = true;
            alert(`¡Se acabaron los intentos! El personaje era: ${targetCharacter.name}\nPuntuación final: ${score}`);
            localStorage.setItem('gameOver', 'true');
        }
    }
    localStorage.setItem('attempts', attempts);
    localStorage.setItem('score', score);
}

document.addEventListener('DOMContentLoaded', async () => {
    await fetchCharacters();
    await fetchTarget();

    attempts = parseInt(localStorage.getItem('attempts')) || 0;
    score = parseInt(localStorage.getItem('score')) || 1000;
    gameOver = localStorage.getItem('gameOver') === 'true';

    const input = document.getElementById('guess-input');
    const suggestions = document.getElementById('suggestions');

    if (gameOver) input.disabled = true;

    input.addEventListener('input', () => {
        if (gameOver) return;
        const value = input.value.toLowerCase();
        suggestions.innerHTML = '';
        if (!value) {
            suggestions.classList.add('hidden');
            return;
        }

        const filtered = characters.filter(c => c.name.toLowerCase().startsWith(value));
        filtered.forEach(c => {
            const li = document.createElement('li');
            li.textContent = c.name;
            li.className = "p-2 hover:bg-gray-200 cursor-pointer";
            li.addEventListener('click', () => {
                createRow(c);
                input.value = '';
                suggestions.innerHTML = '';
                suggestions.classList.add('hidden');
            });
            suggestions.appendChild(li);
        });

        suggestions.classList.remove('hidden');
    });
});