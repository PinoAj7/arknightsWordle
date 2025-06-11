import React from 'react';
import Header from './components/Header';
import Gameboard from './components/Gameboard';

function App() {
  return (
    <div className="min-h-screen bg-gray-100 text-gray-900">
      <Header />
      <main className="max-w-4xl mx-auto p-4">
        <Gameboard />
      </main>
    </div>
  );
}

export default App;