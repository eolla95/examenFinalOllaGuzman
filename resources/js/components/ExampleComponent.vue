<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-0">
                <div class="card">
                    <div class="card-header bg-primary text-white pt-2 pb-0 px-3">
                        <h6 class="d-flex justify-content-between align-items-center">
                            Gestionar empleados
                            <a href="javascript:void(0);"  @click="modificar=false; abrirModal();" class="btn btn-light btn-sm float-end">Ingresar nuevo empleadoo</a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Sueldo base</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Foto</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empleado in empleados" :key="empleado.id">
                                    <th scope="row">{{ empleado.id }}</th>
                                    <td>{{ empleado.nombre }}</td>
                                    <td>{{ empleado.edad }}</td>
                                    <td>{{ empleado.sueldo_base }}</td>
                                    <td>{{ empleado.direccion }}</td>
                                    <td>{{ empleado.foto }}</td>
                                    <td>
                                        <button  @click="modificar=true; abrirModal(empleado);" class="btn btn-warning text-white">Editar</button>
                                    </td>
                                    <td>
                                        <button @click="eliminar(empleado.id)" class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="modal" :class="{mostrar: modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{tituloModal}}</h4>
                    <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="name">Nombre</label>
                        <input v-model="empleado.name" type="text" class="form-control" id="name" placeholder="Nombre del Articulo">
                    </div>
                    <div class="my-4">
                        <label for="description">descripcion</label>
                        <input v-model="empleado.description" type="text" class="form-control" id="description" placeholder="Descripcion del Articulo">
                    </div>
                    <div class="my-4">
                        <label for="stock">stock</label>
                        <input v-model="empleado.stock" type="number" class="form-control" id="stock" placeholder="Stock del Articulo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                </div>
                </div>
            </div>
        </div>
        -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            /*
            empleado:{
                nombre:'',
                edad:18,
                sueldo_base:0,
                direccion:'',
                foto:''
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            */
            empleados: [],
        };
    },
    methods: {
        async listar() {
            const res = await axios.get('/empleado');
            this.empleados = res.data;
        },
        async eliminar(id) {
            const res = await axios.delete('/empleado/' + id);
            this.listar();
        },
        async guardar() {
            if(this.modificar){
                const res = await axios.put('/empleado/'+this.id, this.empleado);
            }else{
                const res = await axios.post('/empleado/', this.empleado);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data={}){
            this.modal=1;
        /*
            if(this.modificar){
                this.id=data.id;
                this.tituloModal="Modificar empleadoo";
                this.empleado.name=data.name;
                this.empleado.description=data.description;
                this.empleado.stock=data.stock;
            }else{
                this.id=0;
                this.tituloModal="Crear empleadoo";
                this.empleado.name='';
                this.empleado.description='';
                this.empleado.stock=1;
            }
        */
        },
        cerrarModal(){
            this.modal=0;
        },
    },
    created() {
        this.listar();
    },
};
</script>

<style>
    .mostrar{
        display: list-item;
        opacity: 1;
        background: #444;
    }
</style>