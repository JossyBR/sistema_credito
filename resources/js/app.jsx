import "./bootstrap.js";

import React from "react";
import ReactDOM from "react-dom";
import HelloWorld from "./components/HelloWorld.jsx";

function App() {
    return (
        <div>
            <HelloWorld />
        </div>
    );
}

// Aquí renderizas tu aplicación en el elemento con id 'app'
if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}

export default App;
