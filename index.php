<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/sweetalert2.min.css"/>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h3 class="text-center text-dark text-success">Quiz Online Tecnologico</h3>
<div id="appMoviles">
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <select name="" id="" class="form-control" v-model="seleccionarTema" @change="onChange()">
                    <option v-bind:value="tema.tema_id" v-for="tema of temas">{{tema.tema_nombre}}</option>
                </select>
            </div>
            <div class="col text-right">
                <h5>Stock Total: <span class="badge badge-success">{{total}}</span></h5>
            </div>
        </div>

        <div class="card" v-if="!iniciar">
            <div class="card-header text-center text-muted">
                <div class="jumbotron">
                    <input type="button" value="Iniciar Quiz Online" class="btn btn-success btn-lg" @click="iniciarQuiz">
                </div>
            </div>
        </div>

        <div class="card" v-if="reiniciar">
            <div class="card-header text-center text-muted">
                <div class="jumbotron">
                    <h4>Quiz Online de Angular finalizado</h4>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{contCorrectas}}</h1>
                                </div>
                                <div class="card-footer bg-success">
                                    <h5 class="text-white">Correctas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{contIncorrectas}}</h1>
                                </div>
                                <div class="card-footer bg-danger">
                                    <h5 class="text-white">Incorrectas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{puntos}}</h1>
                                </div>
                                <div class="card-footer bg-success">
                                    <h5 class="text-white">Puntos</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" value="Reiniciar" class="btn btn-success btn-lg mt-5" @click="reiniciar">
                </div>
            </div>
        </div>

        <div class="row" v-if="iniciar">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">¿ {{preguntas[numero].pre_pregunta}} ?</h4>
                    </div>
                    <div class="card-body" v-if="respuestas">
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" name="pregunta" v-model="respuesta" v-bind:value="respuestas[0].res_correcta" class="custom-control-input" id="pregunta1">
                            <label for="pregunta1" class="custom-control-label">{{respuestas[0].res_respuesta}}</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" name="pregunta" v-model="respuesta" v-bind:value="respuestas[1].res_correcta" class="custom-control-input" id="pregunta2">
                            <label for="pregunta2" class="custom-control-label">{{respuestas[1].res_respuesta}}</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" name="pregunta" v-model="respuesta" v-bind:value="respuestas[2].res_correcta" class="custom-control-input" id="pregunta3">
                            <label for="pregunta3" class="custom-control-label">{{respuestas[2].res_respuesta}}</label>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between text-item-center">
                        <div class="col-md-3">
                            <input type="button" name="" value="Calificar" class="btn btn-success form-control" @click="calificar">                                
                        </div>
                        <div class="col-md-auto correcto" v-if="correcto">
                            <img src="img/correcto.png" width="30" height="30">                               
                        </div>
                        <div class="col-md-auto incorrecto" v-if="incorrecto">
                            <img src="img/incorrecto.png" width="30" height="30">                                
                        </div>
                        <div class="col-md-3">
                            <input type="button" name="" value="Siguiente" class="btn btn-primary form-control" @click="siguiente">                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(movil,indice) of moviles">
                            <td>{{movil.id}}</td>
                            <td>{{movil.marca}}</td>
                            <td>{{movil.modelo}}</td>
                            <td>
                                <div class="col-md-8">
                                    <input type="number" v-model.number="movil.stock" class="form-control text-right" disabled >
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary" title="editar" @click="btnEditar(movil.id,movil.marca,movil.modelo,movil.stock)">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(movil.id)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>-->
    </div>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>  
<script src="js/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>  
<script src="main.js"></script>
</body>
</html>