var url = 'db/crud.php';

new Vue({
    el:'#appMoviles',
    data:{
        moviles:[],
        temas:[],
        preguntas:[],
        respuestas:[],
        total:0,
        contador:1,
        iniciar:false,
        temasId:0,
        seleccionarTema:1,
        numero:0,
        respuesta:'',
        reiniciar:false,
        califico:false,
        correcto:false,
        incorrecto:false,
        contCorrectas:0,
        contIncorrectas:0
    },
    methods:{
        btnAlta: async function(){
            html = '<div class="row"><div class="col-md-12"><div class="form-group"><label for="" class="text-align-right">Marca</label><input type="text" id="marca" class="form-control"></div>';
            html+= '<div class="form-group"><label>Modelo</label><input type="text" id="modelo" class="form-control"></div>';
            html+= '<div class="form-group"><label for="">Stock</label><input type="number" id="stock" class="form-control"></div></div></div>';

            const  {value:formValues} = await Swal.fire({
                title:'NUEVO',
                html:html,
                focusConfirm:false,
                showCancelButton:true,
                confirmButtonText:'Guardar',
                confirmButtonColor:'#lcc88a',
                cancelButtonColor:'#3085d6',
                preConfirm:()=>{
                    return[
                        this.marca = document.getElementById('marca').value,
                        this.modelo = document.getElementById('modelo').value,
                        this.stock = document.getElementById('stock').value
                    ]
                }
            })
            if(this.marca == "" || this.modelo== "" || this.stock == 0){
                Swal.fire({
                    type:'info',
                    title:'Datos incompletos'
                })
            }else{
                this.altaMovil();
                const Toast = Swal.mixin({
                    toast:true,
                    position:'top-end',
                    showConfirmButton:false,
                    timer:3000
                });
                Toast.fire({
                    type:'success',
                    title:'!Producto agregado'
                })

            }
        },
        btnEditar: async function(id,marca,modelo,stock){
            html = '<div class="row"><div class="col-md-12"><div class="form-group"><label for="">Marca</label><input type="text" id="marca" value="'+marca+'" class="form-control"></div>';
            html+= '<div class="form-group"><label>Modelo</label><input type="text" id="modelo" value="'+modelo+'" class="form-control"></div>';
            html+= '<div class="form-group"><label for="">Stock</label><input type="number" id="stock" value="'+stock+'" class="form-control"></div></div></div>';

            await Swal.fire({
                title:'EDITAR',
                html:html,
                focusConfirm:false,
                showCancelButton:true,
            }).then( (result)=>{
                if(result.value){
                    this.marca = document.getElementById('marca').value,
                    this.modelo = document.getElementById('modelo').value,
                    this.stock = document.getElementById('stock').value,

                    this.editarMovil(id,this.marca,this.modelo,this.stock);
                    Swal.fire(
                        'Actualizado',
                        'El registro a sido actualizado',
                        'success'
                    )
                }
            })
        },
        btnBorrar:function(id){
            Swal.fire({
                title:'¿ Esta seguro de borrar el registro: ' + id + '?',
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#dd3',
                cancelButtonColor:'red',
                confirmButtonText:'Borrar'
            }).then( (result)=>{
                if(result.value){
                    this.borrarMovil(id);
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido borrado correctamente',
                        'success'
                    )
                }
            })
        },
        onChange:function(){
            this.listarPreguntas(this.seleccionarTema);
        },
        iniciarQuiz:function(){
            let id_pregunta = this.preguntas[this.numero].pre_id;
            axios.post(url,{opcion:'getRespuestas',id:id_pregunta}).then(response=>{
                console.log(response.data);
                this.respuestas = response.data;
            })

            this.iniciar = true;
        },
        siguiente:function(){
            //VERIFICA SE SE CALIFICO LA PREGUNTA
            if( this.califico){
                this.respuesta = '';
                //VERIFICA EL NUMERO DE PREGUNTAS
                if( this.contador == this.preguntas.lenght){
                    this.reiniciar = true;
                }else{
                    this.numero += 1;
                    let id_pregunta = this.preguntas[this.numero].pre_id;
                    //REALIZA LA PETICION
                    axios.post(url,{opcion:'getRespuestas',id:id_pregunta}).then(response=>{
                        console.log(response.data);
                        this.respuestas = response.data;
                    })
    
                    this.califico = false;
                    this.correcto = false;
                    this.incorrecto = false;
                }
            }else{
                alert("Es necesario calificar antes tu respuesta");
            }
        },
        calificar:function(){
            if(this.respuesta == "S"){
              this.total += parseInt(this.preguntas[this.numero].pre_valor);
              this.califico = true;
              this.correcto = true;
              this.contCorrectas += 1;
            }else{
                this.califico = true;
                this.incorrecto = true;
                this.contIncorrectas += 1;
                console.log("Respuesta incorrecta");
            }
        },

        //PROCEDIMIENTOS LISTAR
        listarMoviles:function(){
            axios.post(url,{opcion:4}).then( response=>{
                this.moviles = response.data;
            })
        },
        //LISTAR TEMAS
        listarTemas:function(){
            axios.post(url,{opcion:'getTemas'}).then( response=>{
                this.temas = response.data;
            })
        },
        //LISTADO DE PREGUNTAS
        listarPreguntas:function(id){
            axios.post(url,{opcion:'getPreguntas',id:id}).then( response=>{
                this.preguntas = response.data;
            });
        },
        

        //PROCEDIMIENTO CREAR
        altaMovil:function(){
            axios.post(url,{opcion:1,marca:this.marca,modelo:this.modelo,stock:this.stock}).then( response=>{
                this.listarMoviles();
            })
            this.marca = '';
            this.modelo='';
            this.stock = 0;
        },
        //PROCEDIMIENTO EDITAR
        editarMovil:function(id,marca,modelo,stock){
            axios.post(url,{opcion:2,id:id,marca:marca,modelo:modelo,stock:stock}).then( response=>{
                this.listarMoviles();
            })
        },
        //PROCEDIMIENTO EDITAR
        borrarMovil:function(id){
            axios.post(url,{opcion:3,id:id}).then( response=>{
                this.listarMoviles();
            })
        },
    },
    created:function(){
        this.listarMoviles();
        this.listarTemas();
        this.listarPreguntas(this.seleccionarTema);
    },
    computed:{
        totalStock(){
            this.total = 0;
            for(movil of this.moviles){
                this.total = this.total + parseInt(movil.stock);
            }
            return this.total
        }
    }
});