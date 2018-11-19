<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <transition name="modal">
                <div class="modal-mask">
                  <div class="modal-wrapper">
                    <div class="modal-container">


                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Role</th>
                            <th scope="col">Accion</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="text" v-model="save.name"></td>
                            <td><input type="text" v-model="save.email"></td>
                            <td><input type="text" v-model="save.password"></td>
                            <td>
                              <select type="text" class="form-control select_pase_usuarios" v-model="save.id_role">
                              <option   :value="'1'">Administrador</option>
                              <option   :value="'2'">Usuario</option>
                            </select>
                          </td>
                            <td><input class="btn btn-primary" type="submit" @click="guardar()" value="Guardar"></td>
                          </tr>
                        </tbody>
                      </table>

                      <br>
                      <br>
                      <br>
                      <br>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Email</th>
                              <th scope="col">Contraseña</th>
                              <th scope="col">Role</th>
                              <th scope="col">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="data in usuarios">
                                <th v-if="data.id == identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id == identificador">
                                  <input type="text" v-model="data.name">
                                </td>
                                <td v-if="data.id == identificador" >
                                  <input type="text" v-model="data.email">
                                </td>
                                <td v-if="data.id == identificador">
                                  <input type="password" v-model="data.password">
                                </td>
                                <td v-if="data.id == identificador">
                                  <select type="text" class="form-control select_pase_usuarios" v-model="data.id_role">
                                    <option   :value="'1'">Administrador</option>
                                    <option   :value="'2'">Usuario</option>
                                  </select>
                                </td>

                                <th v-if="data.id !== identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id !== identificador">{{data.name}}</td>
                                <td v-if="data.id !== identificador">{{data.email}}</td>
                                <td v-if="data.id !== identificador">{{data.password}}</td>
                                <td v-if="data.id !== identificador"><div v-if="data.id_role == 1">Administrador</div><div v-if="data.id_role == 2">Usuario</div></td>

                              <td>
                                <input class="btn btn-primary" @click="edit_save(data)" v-if="data.id == identificador"  type="submit" value="Guardar">
                                <input class="btn btn-primary" type="submit" @click="editar(data.id)" value="Editar" style="cursor : pointer;" v-if="data.id !== identificador">
                                <input class="btn btn-primary" type="submit" @click="borrar(data.id)" value="Borrar" style="cursor : pointer;" v-if="data.id !== identificador">
                             </td>
                            </tr>
                          </tbody>
                        </table>



                    </div>
                  </div>
                </div>
              </transition>
          </div>
      </div>
 </div>
</template>


<script>

export default {
    data(){
        return {

          usuarios: [],
          save: {
            name : '',
            email : '',
            password : '',
            id_role  : '',
                  },
          identificador : ''

        }
    },
     methods: {
       fill(){
         axios.get('usuarios/')
             .then(response => {
                 this.usuarios = response.data;
                 console.log(this.usuarios);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       guardar(){
         axios.post('usuarios/', this.save)
             .then(response => {
                 this.usuarios = response.data;
                 console.log(this.usuarios);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       editar(id){
         if(this.identificador == id){
           this.identificador = ''
         }else{
          this.identificador = id;
         }
       },
       edit_save(data){
         axios.post('edit_usuarios/'+data.id, data)
             .then(response => {
                 this.identificador = '';
                 this.usuarios = response.data;
                 console.log(this.usuarios);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       borrar(id){
         let ok = confirm("Estas seguro que quiere borrar?");
         if (ok) {
           axios.post('delete_usuarios/'+id)
           .then(response => {
               this.identificador = '';
               this.usuarios = response.data;
               console.log(this.usuarios);
           })
           .catch(error => {
               console.log(error.response);
           })
         }
       }

     },
     mounted(){
       this.fill();
     }
}

</script>

<style>
  .selec_area_usuarios{
    width : 150px !important;
  }
  .select_pase_usuarios{
    width: 80px !important;
  }
</style>
