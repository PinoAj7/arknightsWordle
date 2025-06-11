import React from 'react';
import { FaUser } from 'react-icons/fa';

const Header = () => {
  const isLoggedIn = false; // Sustituir por auth real
  const isAdmin = false;    // Sustituir por auth real

  return (
    <header className="flex justify-between items-center p-4 bg-gray-200 shadow">
      <h1 className="text-xl font-bold">Arknights Wordle</h1>
      <div className="flex gap-4 items-center">
        {isLoggedIn ? (
          <>
            <button className="text-sm bg-white px-3 py-1 rounded shadow">Ver Puntuaciones</button>
            {isAdmin && (
              <button className="text-sm bg-white px-3 py-1 rounded shadow">Panel Admin</button>
            )}
          </>
        ) : (
          <button className="text-sm flex items-center gap-2 bg-white px-3 py-1 rounded shadow">
            <FaUser /> Login / Registro
          </button>
        )}
      </div>
    </header>
  );
};

export default Header;