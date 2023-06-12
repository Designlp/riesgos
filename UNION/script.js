const riesgos = JSON.parse(localStorage.getItem('riesgos')) || [];
const riesgosTable = document.getElementById('riesgos-table');
const riesgosBody = document.getElementById('riesgos-body');
const agregarBtn = document.getElementById('agregar-btn');
const reiniciarBtn = document.getElementById('reiniciar-btn');
const impactoSelect = document.getElementById('impacto-select');
const frecuenciaSelect = document.getElementById('frecuencia-select');
const descripcionInput = document.getElementById('descripcion-input');
const nombreInput = document.getElementById('nombre-input');
const matrizCalor = document.getElementById('matriz-calor');
const enviarBtn = document.getElementById('enviar-btn');

agregarBtn.addEventListener('click', agregarRiesgo);
reiniciarBtn.addEventListener('click', reiniciarDatos);

mostrarRiesgos();
generarMatrizCalor();
enviarBtn.addEventListener('click', agregarRiesgo);

function agregarRiesgo() {
  const nombre = document.getElementById('nombre-input').value;
  const impacto = parseFloat(impactoSelect.value);
  const frecuencia = parseFloat(frecuenciaSelect.value);
  const descripcion = descripcionInput.value;
  const resultado = impacto * frecuencia; // Calcula el resultado

  const riesgo = {
    nombre,
    descripcion,
    impacto,
    frecuencia,
    resultado // Agrega el resultado al objeto
  };

  fetch('agregar_riesgo.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(riesgo),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error("Error en la red");
    }
    return response.json();
  })
  .then(data => {
    riesgos.push(data);
    mostrarRiesgos();
    generarMatrizCalor();
    descripcionInput.value = '';

    // Mostrar un mensaje de validación al usuario
    alert("Datos enviados a la base de datos con éxito");
  })
  .catch(error => {
    // Mostrar un mensaje de error al usuario
    alert("Ocurrió un error al enviar los datos a la base de datos: " + error.message);
  });
}

function mostrarRiesgos() {
  riesgosBody.innerHTML = '';

  riesgos.forEach((riesgo, index) => {
    const numCell = document.createElement('td');
    const riesgoCell = document.createElement('td');

    const impactoCell = document.createElement('td');
    const frecuenciaCell = document.createElement('td');

    numCell.textContent = index + 1;
    riesgoCell.textContent = riesgo.descripcion;
    riesgoCell.textContent = riesgo.nombre;

    impactoCell.textContent = riesgo.impacto;
    frecuenciaCell.textContent = riesgo.frecuencia;

    const row = document.createElement('tr');
    row.appendChild(numCell);
    row.appendChild(riesgoCell);

    row.appendChild(impactoCell);
    row.appendChild(frecuenciaCell);

    riesgosBody.appendChild(row);
  });
}

function generarMatrizCalor() {
  const celdasMatriz = matrizCalor.getElementsByClassName('celda-matriz');

  Array.from(celdasMatriz).forEach(celda => {
    celda.textContent = '';
  });

  riesgos.forEach((riesgo, index) => {
    const impactoIndex = getIndexByPercentage(riesgo.impacto);
    const frecuenciaIndex = getIndexByPercentage(riesgo.frecuencia);

    const celdaMatriz = matrizCalor.rows[frecuenciaIndex + 1].cells[impactoIndex + 1];
    const numeroAnterior = celdaMatriz.textContent;

    if (numeroAnterior === '') {
      celdaMatriz.textContent = index + 1;
    } else {
      celdaMatriz.textContent = numeroAnterior + ', ' + (index + 1);
    }
  });
}

function getIndexByPercentage(percentage) {
  if (percentage === 1) {
    return 0;
  } else if (percentage === 2) {
    return 1;
  } else if (percentage === 3) {
    return 2;
  } else if (percentage === 4) {
    return 3;
  } else if (percentage === 5) {
    return 4;
  }
}

function guardarDatosEnCache() {
  localStorage.setItem('riesgos', JSON.stringify(riesgos));
}

function reiniciarDatos() {
  riesgos.length = 0;
  guardarDatosEnCache();
  mostrarRiesgos();
  generarMatrizCalor();
}

// Actualiza este código en la sección de scripts

const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalDescription = document.getElementById('modal-description');
const resultadoCalculado = document.getElementById('resultado-calculado');
const modalRiskLevel = document.getElementById('modal-risk-level');
const modalResult = document.getElementById('modal-result');
const closeBtn = document.getElementsByClassName('close')[0];
const celdasMatriz = matrizCalor.getElementsByClassName('celda-matriz');

// Matriz de colores de la matriz de calor
const matrizColores = [
  ['green', 'green', 'yellow', 'yellow', 'orange'],
  ['green', 'yellow', 'yellow', 'orange', 'red'],
  ['yellow', 'yellow', 'orange', 'red', 'red'],
  ['yellow', 'orange', 'red', 'red', 'darkred'],
  ['orange', 'red', 'red', 'darkred', 'darkred']
];

// Agrega el evento clic a todas las celdas de la matriz de calor
Array.from(celdasMatriz).forEach(celda => {
  celda.addEventListener('click', () => {
    const riesgoIndex = celda.textContent.split(', ')[0] - 1;
    const riesgo = riesgos[riesgoIndex];

    modalTitle.textContent = 'Riesgo #' + (riesgoIndex + 1);
    modalDescription.textContent = riesgo.descripcion;
    modalDescription.textContent = riesgo.nombre;
    modalRiskLevel.style.backgroundColor = getColorByPercentage(riesgo.impacto);
    modalRiskLevel.style.color = '#ffffff'; // Color del texto en el cuadro de riesgo
    modalResult.textContent = 'Resultado: ' + Math.round(riesgo.impacto * riesgo.frecuencia);
    //modalResult.style.color = getColorByPercentage(riesgo.impacto);  Color del texto del resultado
    modal.style.display = 'block';
  });
});

// Cierra la ventana emergente al hacer clic en el botón de cerrar
closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

// Cierra la ventana emergente al hacer clic fuera del área del modal
window.addEventListener('click', (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

function getColorByPercentage(percentage) {
  if (percentage === 1) {
    return matrizColores[0][0];
  } else if (percentage === 2) {
    return matrizColores[1][1];
  } else if (percentage === 3) {
    return matrizColores[2][2];
  } else if (percentage === 4) {
    return matrizColores[3][3];
  } else if (percentage === 5) {
    return matrizColores[4][4];
  }
}


const generarBtn = document.getElementById('generar-btn');

generarBtn.addEventListener('click', () => {
  fetch('generar_reporte.php')
    .then(response => response.json())
    .then(data => {
      // Abre el PDF en una nueva ventana del navegador
      window.open(data.ubicacion);
    });
});
