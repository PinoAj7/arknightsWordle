import React, { useEffect, useState } from 'react';
import { getAllCharacters, getCharacterById } from '../services/api';
import GuessInput from './GuessInput';

function Gameboard() {
  const [personajeDelDia, setPersonajeDelDia] = useState(null);
  const [personajes, setPersonajes] = useState([]);
  const [guess, setGuess] = useState(null);
  const [error, setError] = useState('');

  useEffect(() => {
    async function fetchPersonajes() {
      try {
        // Cargar lista completa para autocompletado
        const lista = await getAllCharacters();
        setPersonajes(lista);

        const randomId = Math.floor(Math.random() * 374) + 1;
        const personaje = await getCharacterById(randomId);
        setPersonajeDelDia(personaje);
      } catch (e) {
        console.error(e);
        setError('Error cargando datos del juego');
      }
    }
    fetchPersonajes();
  }, []);

  function getColorYAtributo(attr, guess, real) {
  let color = 'red';
  let icon = null;

  if (guess === real) {
    color = 'green';
  } else {
    if (attr === 'rarity' || attr === 'dp_cost') {
      if (guess > real) {
        icon = '↑'; // Puedes usar un icono real más adelante
      } else if (guess < real) {
        icon = '↓';
      }
    }
  }

  return { color, icon };
}


  // Cuando el usuario hace un guess, validar que exista
  function handleGuess(personaje) {
    if (!personaje) {
      setError('Personaje no válido');
      return;
    }
    setError('');
    setGuess(personaje);
  }

  if (error) return <div>{error}</div>;
  if (!personajeDelDia || personajes.length === 0) return <div>Cargando personaje...</div>;

  return (
    <div style={{ maxWidth: '500px', margin: 'auto', fontFamily: 'Arial, sans-serif' }}>
      <h2>Personaje del Día</h2>
      <img
        src={personajeDelDia.image}
        alt={personajeDelDia.name}
        style={{ width: '150px', display: 'block', marginBottom: '20px' }}
      />

      <GuessInput personajes={personajes} onGuess={handleGuess} />

      {guess && (
        <div style={{ marginTop: '30px' }}>
          <h3>Tu intento:</h3>
          <p style={{ color: getColorYAtributo('name', guess.name, personajeDelDia.name) }}>
            Nombre: {guess.name}
          </p>
          <p style={{ color: getColorYAtributo('faction', guess.faction, personajeDelDia.faction) }}>
            Facción: {guess.faction}
          </p>
          <p style={{ color: getColorYAtributo('class', guess.class, personajeDelDia.class) }}>
            Clase: {guess.class}
          </p>
          <p style={{ color: getColorYAtributo('archetype', guess.archetype, personajeDelDia.archetype) }}>
            Arquetipo: {guess.archetype}
          </p>
          <p style={{ color: getColorYAtributo('rarity', guess.rarity, personajeDelDia.rarity) }}>
            Rareza: {guess.rarity}
          </p>
          <p style={{ color: getColorYAtributo('dp_cost', guess.dp_cost, personajeDelDia.dp_cost) }}>
            DP Cost: {guess.dp_cost}
          </p>
        </div>
      )}
    </div>
  );
}

export default Gameboard;