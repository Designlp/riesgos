
        function calcularRiesgo() {
            var impacto = parseFloat(document.getElementById("impacto").value);
            var frecuencia = parseFloat(document.getElementById("frecuencia").value);
            var nivelRiesgo = impacto * frecuencia;

            var tablaRiesgo = document.getElementById("tablaRiesgo");
            var resultado = document.getElementById("resultado");
            var titulo = document.getElementById("titulo").value;

            tablaRiesgo.innerHTML = ""; // Limpiar la tabla

            var row = tablaRiesgo.insertRow();
            var nivelCell = row.insertCell(0);
            var colorCell = row.insertCell(1);

            nivelCell.innerHTML = titulo;
            
            if (nivelRiesgo <= 0.2) {
                colorCell.innerHTML = "Insignificante";
                colorCell.className = "insignificante";
            } else if (nivelRiesgo <= 0.4) {
                colorCell.innerHTML = "Menor";
                colorCell.className = "menor";
            } else if (nivelRiesgo <= 0.6) {
                colorCell.innerHTML = "Moderado";
                colorCell.className = "moderado";
            } else if (nivelRiesgo <= 0.8) {
                colorCell.innerHTML = "Mayor";
                colorCell.className = "mayor";
            } else {
                colorCell.innerHTML = "Catastrófico";
                colorCell.className = "catastrofico";
            }

            resultado.innerHTML = "Nivel de riesgo: " + colorCell.innerHTML;
            resultado.style.color = colorCell.style.backgroundColor;
        }
