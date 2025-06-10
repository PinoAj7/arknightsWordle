import React, { useEffect, useState } from 'react';

function App() {
  const [tareas, setTareas] = useState([]);
  const apiUrl = process.env.REACT_APP_API_URL;

  useEffect(() => {
    fetch(`${apiUrl}/api/tareas`)
      .then(response => response.json())
      .then(data => setTareas(data))
      .catch(error => console.error('Error fetching tareas:', error));
  }, [apiUrl]);

  return (
    <div>
      <h1>Lista de Tareas</h1>
      <ul>
        {tareas.length > 0 ? (
          tareas.map(tarea => (
            <li key={tarea.id}>{tarea.nombre}</li>
          ))
        ) : (
          <li>No hay tareas disponibles</li>
        )}
      </ul>
    </div>
  );
}

export default App;