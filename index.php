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
<h4 class="text-center text-dark text-success">Crud con vue y php</h4>
<div id="appMoviles">
    <div class="container">
        <div class="row">
            <div class="col">
                <button @click="btnAlta" class="btn btn-success"><i class="fas fa-plus-circle fa-2xs"></i></button>
            </div>
            <div class="col text-right">
                <h5>Stock Total: <span class="badge badge-success">{{totalStock}}</span></h5>
            </div>
        </div>

        <div class="row mt-5">
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
        </div>
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