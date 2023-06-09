<?php
session_start();

// if (!isset($_SESSION['username'])) {
//     header('Location: registro.html');
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>riesgos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="estilo.css" />
    <link rel="stylesheet" href="tabla.css" />
    <link rel="stylesheet" href="popup.css" />
</head>

<body>
    <div class="menu">
        <ul>
         
            <li>
                <span onmouseenter="hoverEnter(0)"><i class="fas fa-exclamation-triangle"></i></span>
            </li>
            <li>
                <span onmouseenter="hoverEnter(1)"><i class="fas fa-chart-bar"></i></span>

            </li>
            <!-- <li>
                <span><a href="index.php"><i class="fas fa-sign-in-alt"></i></a></span>

            </li> -->
            <li>
                <span><button id="logout-btn"><i class="fas fa-sign-out-alt"></i></button></span>

            </li>
       
            <span class="goo-index" id="goo-index"></span>



            
        </ul>
    </div>
    
    <div class="content-wrapper">
    
        <div id="screen_0" class="screen visible">
            <h2>Matriz de Riesgo - Auditoría Informática</h2>
            <div class="container">
                <a class="button btnAgregar" href="#popup">AGREGAR RIESGO</a>
                <div class="popup" id="popup">
                    <div class="popup-inner">
                        <div class="popup__photo">
                            <img src="../assets/img/reg.jpg" alt="">
                        </div>
                        <div class="popup__text new">
                            <div class="user-box">
                            <div> <input type="text" id="nombre-input" placeholder="Ingrese su Nombre" required="" />
                                    <!-- <label for="nombre-input">Nombre</label> -->
                                </div>
                                <div> <input type="text" id="descripcion-input" placeholder="Ingresa la Descripcion del Riesgo" required="" />
                                    <!-- <label for="descripcion-input">Descripción</label> -->
                                </div>
                           
                            </div>

                            <label class="labels" for="impacto-select">Impacto de riesgo:</label>
                            <div class="combobxx">
                                <select id="impacto-select" required="">
                                    <option value="1">Bajo 1</option>
                                    <option value="2">Moderado 2 </option>
                                    <option value="3">Alto 3</option>
                                    <option value="4">Crítico 4</option>
                                    <option value="5">Extremo 5</option>
                                </select>
                            </div>

                            <label class="labels" for="frecuencia-select">Probabilidad del riesgo:</label>
                            <div class="combobxx">
                                <select id="frecuencia-select" required="">
                                    <option value="1">Bajo 1</option>
                                    <option value="2">Moderado 2</option>
                                    <option value="3">Alto 3</option>
                                    <option value="4">Crítico 4</option>
                                    <option value="5">Extremo 5</option>
                                </select>
                            </div>

                            <button id="agregar-btn" class="btnAgregar">Agregar Riesgo</button>
                        </div>
                        <a class="popup__close" href="#">X</a>
                    </div>
                </div>
            </div>

            <div class="form-container">
                <h2>Riesgos Ingresados</h2>
                <br>
                <table class="table-fill" id="riesgos-table">
                    <thead>
                        <tr>
                            <th>Riesgo</th>
                            <th>Descripción</th>
                            <th>Impacto</th>
                            <th>Probabilidad</th>
                            <th>Riesgo Inherente</th>
                        </tr>
                    </thead>
                    <tbody id="riesgos-body">
                        <!-- Aquí se agregarán las filas de los riesgos ingresados -->
                    </tbody>
                </table>

                <button id="reiniciar-btn" class="btnAgregar">REINICIAR</button>
                <!-- Asegúrate de que este botón se encuentre dentro de tu formulario o donde sea relevante en tu HTML -->
                <button class="button btnAgregar" id="generar-btn" type="button">Generar PDF</button>


            </div>
        </div>
        <div id="screen_1" class="screen">
            <h2>Matriz de Calor</h2>
            <table id="matriz-calor">
                <thead>
                    <tr>
                        <th></th>
                        <th class="bajo noo">1</th>
                        <th class="moderado noo">2</th>
                        <th class="alto noo">3</th>
                        <th class="critico noo">4</th>
                        <th class="critico noo">5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="bajo noo">1</th>
                        <td class="celda-matriz bajo curva"></td>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz moderado curva1"></td>
                    </tr>
                    <tr>
                        <th class="moderado noo">2</th>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz moderado"></td>
                        <td class="celda-matriz moderado"></td>
                        <td class="celda-matriz alto"></td>
                    </tr>
                    <tr>
                        <th class="critico noo">3</th>
                        <td class="celda-matriz bajo"></td>
                        <td class="celda-matriz moderado"></td>
                        <td class="celda-matriz moderado"></td>
                        <td class="celda-matriz alto"></td>
                        <td class="celda-matriz alto"></td>
                    </tr>
                    <tr>
                        <th class="critico noo">4</th>
                        <td class="celda-matriz bajo "></td>
                        <td class="celda-matriz moderado"></td>
                        <td class="celda-matriz alto"></td>
                        <td class="celda-matriz alto"></td>
                        <td class="celda-matriz  critico "></td>
                    </tr>
                    <tr>
                        <th class="critico noo">5</th>
                        <td class="celda-matriz moderado curva3"></td>
                        <td class="celda-matriz alto"></td>
                        <td class="celda-matriz alto"></td>
                        <td class="celda-matriz critico"></td>
                        <td class="celda-matriz critico curva2"></td>
                    </tr>

                </tbody>
            </table>

            <!-- Agrega este elemento al final de tu archivo HTML -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 id="modal-title"></h2>
                    <h3>Descripción del Riesgo:</h3>
                    <p class="texte" id="modal-description"></p>
                    <h3>Riesgo Inherente</h3>
                    <p class="texte" id="modal-result"></p>
                </div>
            </div>


            <!-- POPUP -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 id="modal-title"></h2>
                    <p id="modal-description"></p>
                    <div id="modal-risk-level"></div>
                    <p id="modal-result"></p>
                </div>
            </div>

        </div>


        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: none">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7"
                        result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>

        <script src="animation.js"></script>
        <script src="script.js"></script>
</body>
</html>