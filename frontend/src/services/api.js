const API_URL = process.env.REACT_APP_API_URL;

export async function getAllCharacters() {
  const res = await fetch(`${API_URL}/api/characters`);
  if (!res.ok) throw new Error('Error cargando personajes');
  return res.json();
}

export async function getCharacterById(id) {
  const res = await fetch(`${API_URL}/api/characters/${id}`);
  if (!res.ok) throw new Error('Error cargando personaje');
  return res.json();
}
