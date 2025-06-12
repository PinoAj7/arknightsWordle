const API_URL = "http://localhost:8000";

let characters = [];
let targetCharacter = null;
let gameOver = false;

// Fondo y celdas
const bgBase = "bg-gray-300";
const bgCorrect = "bg-green-500";
const bgWrong = "bg-red-500";

// Calcula ID del personaje del día
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
    const res = await fetch(`${API_URL}/api/characters/${id}`);
    if (!res.ok) return alert("Error al cargar personaje objetivo");
    targetCharacter = await res.json();
    console.log("🎯 Personaje del día:", targetCharacter.name);
}

function createRow(character) {
    const row = document.createElement('div');
    row.className = "grid grid-cols-7 gap-2 items-center bg-gray-100 p-2 rounded shadow";

    const fields = ['image', 'name', 'faction', 'class', 'archetype', 'rarity', 'dp_cost'];

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
        alert("¡Correcto! Has adivinado el personaje del día 🎉");
        gameOver = true;
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    await fetchCharacters();
    await fetchTarget();

    const input = document.getElementById('guess-input');
    const suggestions = document.getElementById('suggestions');

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

    const modal = document.getElementById('auth-modal');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginBtn = document.getElementById('login-button');
    const registerBtn = document.getElementById('register-button');
    const toggleRegisterBtn = document.getElementById('toggle-register');
    const toggleLoginBtn = document.getElementById('toggle-login');
    const authButton = document.getElementById('auth-button');

    loginBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        showLoginForm();
    });

    toggleRegisterBtn.addEventListener('click', showRegisterForm);
    toggleLoginBtn.addEventListener('click', showLoginForm);

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        const res = await fetch(`${API_URL}/api/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password }),
        });

        if (!res.ok) return alert("Login fallido");

        const data = await res.json();
        localStorage.setItem('token', data.token);
        modal.classList.add('hidden');
        alert("Sesión iniciada correctamente");
        updateUI();
    });

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const name = document.getElementById('register-name').value;
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;

        const res = await fetch(`${API_URL}/api/register`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email, password }),
        });

        if (!res.ok) return alert("Registro fallido");

        const data = await res.json();
        localStorage.setItem('token', data.token);
        modal.classList.add('hidden');
        alert("Usuario registrado y logueado");
        updateUI();
    });

    updateUI();
});

function showLoginForm() {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
}

function showRegisterForm() {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
}

function updateUI() {
    const token = localStorage.getItem('token');
    if (token) {
        document.getElementById('auth-button').textContent = 'Logout';
        document.getElementById('auth-button').onclick = () => {
            localStorage.removeItem('token');
            alert("Sesión cerrada");
            location.reload();
        };
    }
}