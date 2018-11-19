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
                            <th scope="col">Descripcion</th>
                            <th scope="col">Cliente</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><textarea  v-model="save.descripcion"></textarea></td>
                            <td>
                              <select  v-model="save.id_cliente">
                                  <option v-for='cliente in clientes'  :value="cliente.id">{{cliente.name}}</option>
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
                              <th scope="col">Descripcion</th>
                              <th scope="col">Cliente</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="data in pedidos">
                                <th v-if="data.id == identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id == identificador">
                                  <textarea v-model="data.descripcion"></textarea>
                                </td>
                                <td v-if="data.id == identificador" >
                                  <select  v-model="data.id_cliente">
                                      <option v-for='cliente in clientes'  :value="cliente.id">{{cliente.name}}</option>
                                  </select>
                                </td>

                                <th v-if="data.id !== identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id !== identificador">{{data.descripcion}}</td>
                                <td v-if="data.id !== identificador"><div v-for='cliente in clientes'><div v-if="cliente.id == data.id_cliente">{{cliente.name}}</div></div></td>

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
          pedidos : [],
          clientes : [],
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
         axios.get('pedidos/')
             .then(response => {
                 this.pedidos = response.data;
                 console.log(this.pedidos);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       clientes_method(){
         axios.get('clientes/')
             .then(response => {
                 this.clientes = response.data;
                 console.log(this.pedidos);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       guardar(){
         axios.post('pedidos/', this.save)
             .then(response => {
                 this.pedidos = response.data;
                 console.log(this.pedidos);
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
         axios.post('edit_pedidos/'+data.id, data)
             .then(response => {
                 this.identificador = '';
                 this.pedidos = response.data;
                 console.log(this.pedidos);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       borrar(id){
         let ok = confirm("Estas seguro que quiere borrar?");
         if (ok) {
           axios.post('delete_pedidos/'+id)
           .then(response => {
               this.identificador = '';
               this.pedidos = response.data;
               console.log(this.pedidos);
           })
           .catch(error => {
               console.log(error.response);
           })
         }
       }

     },
     mounted(){
       this.fill();
       this.clientes_method();
     }
}

</script>
