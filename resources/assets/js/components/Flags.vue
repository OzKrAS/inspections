<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Gestión de Banderas</strong>          
          <button
            v-if="edo"
            type="button"
            @click="showData()"
            class="btn btn-success btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered display" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th style="width: 90px">Opciones</th>  
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>

              </table>
            </div>
      
          </div>
        </template>
        <template v-else-if="listado==0">
          <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <div class="md-layout">
                  <md-field md-clearable :class="getValidationClass('name')">
                    <label for="first-name">Nombre</label>
                    <md-input                 
                      @keyup.enter="validateData()"
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.name"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.name.required"
                    >Olvidaste ingresar un nombre para la bandera</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="hideForm()">Cerrar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"

                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click.prevent="validateData()"
              >Guardar</md-button>
              <md-button
                type="button"
                v-if="tipoAccion==2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click.prevent="updateData()"
              >Actualizar</md-button>
            </md-card-actions>
          </div>
        </template>
      </div>

    </div>

  </main>
</template>

<script>
import jsPDF from 'jspdf'
import { validationMixin } from "vuelidate";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdList);
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  data() {
    return {
      form: {
        name: "",
      },
      edo:1,
      tipoAccion: 1,
      listado: 1,
      idFlag: 0,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0
    };
  },

  validations: {
    form: {
      name: {
        required
      }
    }
  },

  computed: {

  },
  methods: {
    getValidationClass(fieldName) {
      const field = this.$v.form[fieldName];
      if (field) {
        return {
          "md-invalid": field.$invalid && field.$dirty
        };
      }
    },
    validateData() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.saveData();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.name = null;
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.idFlag = data["id"]);
      this.form.name = data["name"];
    },
    showData() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      this.edo=0;
    },
    hideForm() {
      this.edo = 1;
      this.listado = 1;
      this.listData();
    },   
    listData() {
      let me = this;
      var url =
        "/flags";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayData = respuesta.data;
          me.myTable(me.arrayData);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/flags/save", {
          name: this.form.name.toUpperCase(),
        })
        .then(function(response) {
          me.hideForm();
          me.message("Guardado", "Guardo ");
          me.listData();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    updateData() {
      let me = this;

      axios
        .put("/flags/update", {
          name: this.form.name.toUpperCase(),
          id: this.idFlag
        })
        .then(function(response) {
          me.hideForm();
          me.message("Actualizado", "Actualizó ");
          me.listData();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deleteData(data = []) {
      swal({
        title: "Esta seguro de Eliminar la bandera " + data["name"],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;      
          axios
            .post("/flags/delete", {
              id: data["id"],
            })
            .then(function(response) {
              me.hideForm();
              me.message("Eliminado", "Eliminó ");
              me.listData();
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
      carta(data = []) {
      let me = this;
      var doc = new jsPDF('p','mm','letter');
      (this.id_flag = data["id"]);
      console.log("ID " + me.datos.id);
        var logo = new Image();
        logo.src = '/img/logoAUNAP.png';
        doc.addImage(logo, 'png', 20, 10, 33, 15);
        doc.text("FORMATO DE AUTORIZACIÓN DE ZARPE", 60, 20);
        // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
        doc.setFont("arial");
        doc.setFontSize(11);
        doc.text(`_____________, ____ de ________ de 201_



Señor(a) (res)

_________________________________
__________________________________
Ciudad: ___________________________



Respetado(s) señor(a) (res):



Asunto: Autorización para Zarpe.


Para su información y fines pertinentes le comunico que una vez realizada la inspección a la 
Motonave _________________________________________ con matrícula ________________ 
vinculada al permiso de pesca comercial industrial según Resolución # ___________ otorgado al 
señor ___________________________________ identificado con la cedula de ciudadanía número 
______________________________, se constató que cumple con los requisitos mínimos 
establecidos en la Resolución 1026 del 2014, para realizar faenas de pesca dirigida a la captura de 
___________________ 


Por la AUNAP						

 

Nombre: ____________________________	
Cargo: ______________________________		
Dirección oficina: _____________________                     
Teléfono oficina: ______________________                    
Correo Electrónico: ___________________                     
`, 30, 45);
        doc.setFontSize(8);
        doc.setTextColor(100);
        doc.text(`Nota: Si este documento se encuentra impreso se considera Copia no Controlada. La versión vigente está publicada en la 
ntranet de la Autoridad Nacional de Acuicultura y Pesca.`, 30, 260);
             
           
      window.open(doc.output('bloburl'))
},

    message(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    },

    myTable(datas){
      let me = this;

      $(document).ready(function() {

      var table = $('#dataTable').DataTable({destroy: true,
      stateSave: true,
      data:datas,
               "createdRow": function( row, data, dataIndex){
                if( data[6] ==  `0`){
                    $(row).addClass('redClass');
                }
            },
      "language": {
                "lengthMenu": "Ver _MENU_ registros por página",
                "zeroRecords": "NO existen Datos",
                "info": "mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "search":         "Buscar:",
                 "paginate": {
                    "first":      "Prim",
                    "last":       "Ant",
                    "next":       "Sig",
                    "previous":   "Ant"
                },
                "infoFiltered": "(filtrado de _MAX_ total registros)"
            },
            responsive: "true",
          "columns": [

            { "data": "name" },
             {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>"},
              // <button type='button'id=carta' class='carta btn btn-success btn-sm' data-tooltip title='carta' > <i class='fas fa-trash-alt'></i> </button> 

        ]

        });

          $('#dataTable tbody').on( 'click', '.editar', function () {
                me.datos = table.row( $(this).parents('tr') ).data();
                me.showUpdate(me.datos);
            } );
          $('#dataTable tbody').on( 'click', '.eliminar', function () {
                me.datos= table.row( $(this).parents('tr') ).data();
                me.deleteData(me.datos);
            } );
          $('#dataTable tbody').on( 'click', '.carta', function () {
                me.datos= table.row( $(this).parents('tr') ).data();
                me.carta(me.datos);
            } );  
    });
    }
  },

  mounted() {
    this.listData();
  }
};
</script>
<style>

.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(167, 142, 5, 0.849); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
