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
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="text" v-model="save.name"></td>
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
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="data in clientes">
                                <th v-if="data.id == identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id == identificador">
                                  <input type="text" v-model="data.name">
                                </td>

                                <th v-if="data.id !== identificador" scope="row">{{data.id}}</th>
                                <td v-if="data.id !== identificador">{{data.name}}</td>

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

          clientes: [],
          save: {
            name : '',
                  },
          identificador : ''

        }
    },
     methods: {
       fill(){
         axios.get('clientes/')
             .then(response => {
                 this.clientes = response.data;
                 console.log(this.clientes);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       guardar(){
         axios.post('clientes/', this.save)
             .then(response => {
                 this.clientes = response.data;
                 console.log(this.clientes);
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
         axios.post('edit_clientes/'+data.id, data)
             .then(response => {
                 this.identificador = '';
                 this.clientes = response.data;
                 console.log(this.clientes);
             })
             .catch(error => {
                 console.log(error.response);
             })
       },
       borrar(id){
         let ok = confirm("Estas seguro que quiere borrar?");
         if (ok) {
           axios.post('delete_clientes/'+id)
           .then(response => {
               this.identificador = '';
               this.clientes = response.data;
               console.log(this.clientes);
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
