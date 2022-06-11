<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-0">
                <div class="card">
                    <div class="card-header bg-primary text-white pt-2 pb-0 px-3">
                        <h6 class="d-flex justify-content-between align-items-center">
                            Gestionar empleados
                            <a href="javascript:void(0);"  @click="modificar=false; abrirModal();" class="btn btn-light btn-sm float-end">Ingresar nuevo empleado</a>
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
        <div class="modal" :class="{mostrar: modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{tituloModal}}</h4>
                    <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="nombre">Nombre</label>
                        <input v-model="empleado.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del empleado">
                    </div>
                    <div class="my-4">
                        <label for="edad">Edad</label>
                        <input v-model="empleado.edad" type="number" class="form-control" id="edad" placeholder="Descripcion del empleado">
                    </div>
                    <div class="my-4">
                        <label for="sueldo_base">Sueldo base</label>
                        <input v-model="empleado.sueldo_base" type="number" class="form-control" id="sueldo_base" placeholder="Sueldo base del empleado">
                    </div>
                    <div class="my-4">
                        <label for="direccion">Direccion</label>
                        <input v-model="empleado.direccion" type="text" class="form-control" id="direccion" placeholder="Direccion del empleado">
                    </div>
                    <div class="my-4">
                        <label for="foto">Foto</label>
                        <input v-model="empleado.foto" type="text" class="form-control" id="foto" placeholder="foto del empleado">
                    </div>
                    <div class="my-4">
                        <label>Sucursal</label>
                        <select v-model="empleado.id_sucursal" class="form-select">
                            <option v-for="sucursal in sucursals"
                                :key="sucursal.id"
                                :value="sucursal.id"
                            >
                                {{sucursal.nombre}}
                            </option>
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            empleado:{
                nombre:'',
                edad:18,
                sueldo_base:0,
                direccion:'',
                foto:'',
                id_sucursal:'',
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            empleados: [],
            sucursals: [],
        };
    },
    mounted() {
        this.initialize();
    },
    methods: {
        async initialize() {
            this.loading = true;
            const res = await axios.get('/sucursal');
            this.sucursals = res.data;
            this.loading = false;
        },
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
            if(this.modificar){
                this.id=data.id;
                this.tituloModal="Modificar empleado";
                this.empleado.nombre=data.nombre;
                this.empleado.edad=data.edad;
                this.empleado.sueldo_base=data.sueldo_base;
                this.empleado.direccion=data.direccion;
                this.empleado.foto=data.foto;
                this.empleado.id_sucursal=data.id_sucursal;
            }else{
                this.id=0;
                this.tituloModal="Crear empleado";
                this.empleado.nombre='';
                this.empleado.edad=18;
                this.empleado.sueldo_base='';
                this.empleado.direccion='';
                this.empleado.foto='';
                this.empleado.id_sucursal='';
            }
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