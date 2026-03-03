   import { createRoot } from "react-dom/client";
  //import App from "./app/App.tsx";
  //import "./styles/index.css";
  

  // import ReactDOM from "react-dom/client";
  import React from "react";
  
  function App() {
      return (
          <>
              <h1>Lets Be Honest Pakistan</h1>
          </>
      );
  }
  

  const root = document.getElementById("root");

if (root) {
    createRoot(root).render(<App />);
}