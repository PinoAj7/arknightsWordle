import React, { useState } from 'react';

function GuessInput({ personajes, onGuess }) {
  const [input, setInput] = useState('');
  const [sugerencias, setSugerencias] = useState([]);

  function handleChange(e) {
    const valor = e.target.value;
    setInput(valor);

    if (valor.length > 0) {
      const matches = personajes.filter(p =>
        p.name.toLowerCase().startsWith(valor.toLowerCase())
      );
      setSugerencias(matches);
    } else {
      setSugerencias([]);
    }
  }

  function handleSelect(personaje) {
    setInput(personaje.name);
    setSugerencias([]);
    onGuess(personaje);
  }

  return (
    <div style={{ position: 'relative' }}>
      <input
        type="text"
        placeholder="Adivina el personaje"
        value={input}
        onChange={handleChange}
        autoComplete="off"
        style={{ width: '100%', padding: '8px', fontSize: '16px' }}
      />
      {sugerencias.length > 0 && (
        <ul
          style={{
            position: 'absolute',
            top: '100%',
            left: 0,
            right: 0,
            border: '1px solid #ccc',
            backgroundColor: 'white',
            margin: 0,
            padding: 0,
            listStyle: 'none',
            maxHeight: '150px',
            overflowY: 'auto',
            zIndex: 1000,
          }}
        >
          {sugerencias.map((p) => (
            <li
              key={p.id}
              onClick={() => handleSelect(p)}
              style={{
                padding: '8px',
                cursor: 'pointer',
                borderBottom: '1px solid #eee',
              }}
              onMouseDown={e => e.preventDefault()} // evitar que el input pierda focus al clickar
            >
              {p.name}
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}

export default GuessInput;