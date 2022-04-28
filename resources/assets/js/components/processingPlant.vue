<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato Reporte Planta Proceso</strong>          
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
                    <th>Fecha</th>
                    <th>Nombre Embarcación de Carga</th>
                    <th>Nombre Representante</th>
                    <th>Fecha Inicio de Faena</th>                   
                    <th>Fecha Fin de Faena</th>                   
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>Fecha</th>
                      <th>Nombre Embarcación de Carga</th>
                      <th>Nombre Representante</th>
                      <th>Fecha Inicio de Faena</th>
                      <th>Fecha Fin de Faena</th>
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
                      <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="date"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Seleccione una fecha</label>
                          </md-datepicker>
                        </div>
                     </div> &nbsp;&nbsp;&nbsp;
                     <div class="md-layout-item">
                        <label class="text-muted">Empresa</label>
                        <multiselect v-model="arrayComp" :options="arrayCompany"
                            placeholder="Seleccione una empresa"
                            :custom-label="nameWithCompany"
                            label="name"
                            track-by="name">
                        </multiselect>
                     </div>&nbsp;&nbsp;&nbsp;
                     <md-field md-clearable :class="getValidationClass('boat')">
                        <label for="first-name">Embarcación</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.boat"
                        :disabled="sending"
                        />
                        <span
                        class="md-error"
                        v-if="!$v.form.boat.required"
                        >Olvidaste ingresar el nombre de la embarcación</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                     </md-field>
                     <div class="md-layout-item">
                        <label class="text-muted">Bandera</label>
                            <multiselect v-model="arrayFg" :options="arrayFlag"
                                placeholder="Seleccione una bandera"
                                :custom-label="nameWithFlag"
                                label="name"
                                track-by="name">
                            </multiselect>
                     </div>&nbsp;&nbsp;&nbsp;
                     <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="dateBeginningFaena"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Inicio Faena</label>
                          </md-datepicker>
                        </div>
                     </div> &nbsp;&nbsp;&nbsp;
                     <div class="md-layout-item">
                            <div>
                            <md-datepicker 
                                v-model="dateEndFaena"
                                @input="toString"
                                md-immediately
                                :md-model-type="String"
                            >
                                <label>Fecha Fin Faena</label>
                            </md-datepicker>
                            </div>
                     </div> &nbsp;&nbsp;&nbsp;
                     <md-field md-clearable :class="getValidationClass('zoneFisher')">
                        <label for="first-name">Zona de Pesca</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.zoneFisher"
                        :disabled="sending"
                        />
                        <span
                        class="md-error"
                        v-if="!$v.form.zoneFisher.required"
                        >Olvidaste ingresar el nombre de la zona de pesca</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                     </md-field>
                     <div class="md-layout-item">
                        <label class="text-muted">Puerto de Desembarque</label>
                        <multiselect v-model="arrayPt" :options="arrayPort"
                            placeholder="Puerto de desembarque"
                            :custom-label="nameWithPort"
                            label="name"
                            track-by="name">
                        </multiselect>
                     </div>&nbsp;&nbsp;&nbsp;  

                     <label>REPORTE POR ESPECIES</label> 


                     <!-- espacio datos de la tabla -->


                    <md-field md-clearable :class="getValidationClass('processingPlant')">
                        <label for="first-name">Planta Procesadora</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.processingPlant"
                        :disabled="sending"
                        />
                        <span
                        class="md-error"
                        v-if="!$v.form.processingPlant.required"
                        >Olvidaste ingresar el nombre de la planta procesadora</span>
                    </md-field>
                    <md-field md-clearable :class="getValidationClass('processorResponsible')">
                        <label for="first-name">Responsable de la Procesadora</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.processorResponsible"
                        :disabled="sending"
                        />
                        <span
                        class="md-error"
                        v-if="!$v.form.processorResponsible.required"
                        >Olvidaste ingresar el nombre del responsable de la procesadora</span>
                    </md-field>
                    <md-field>
                        <label>Observaciones</label>
                        <md-textarea v-model="observation"></md-textarea>
                    </md-field>
                    <md-field md-clearable :class="getValidationClass('nameOfficial')">
                        <label for="first-name">Nombre Funcionario</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameOfficial"
                        :disabled="sending"
                        />
                        <span
                        class="md-error"
                        v-if="!$v.form.nameOfficial.required"
                        >Olvidaste ingresar el nombre del funcionario</span>
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
                @click="validateData()"
              >Guardar</md-button>
              <md-button
                type="submit"
                v-if="tipoAccion==2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="updateData()"
              >Actualizar</md-button>
            </md-card-actions>
          </div>
        </template>
      </div>

    </div>

  </main>
</template>

<script>
import format from "date-fns/format"; 
    import { validationMixin } from "vuelidate";
    import Multiselect from "vue-multiselect";
    import Toasted from 'vue-toasted';
    import vSelect from "vue-select";
    import {
		MdButton,  
		MdContent,
		MdField,
		MdCard,
		MdMenu,
		MdSwitch,
		MdDatepicker,
    MdDialog,
		MdList
    } from "vue-material/dist/components";

    Vue.use(Toasted,  {
        iconPack : 'material' // set your iconPack, defaults to material. material|fontawesome|custom-class
    });
    Vue.use(MdButton);
    Vue.use(MdContent);
    Vue.use(MdField);
    Vue.use(MdCard);
    Vue.use(MdMenu);
    Vue.use(MdSwitch);
    Vue.use(MdList);
    Vue.use(MdDatepicker);
    Vue.use(MdDialog);
    import { required, minLength, maxLength, email, sameAs } from "vuelidate/lib/validators";

export default {
	mixins: [validationMixin],
	props: ['ruta'],
	
	data() {

		Vue.material.locale.shortDays = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
		Vue.material.locale.shorterDays = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];
		Vue.material.locale.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul','Ago','Sep','Oct','Nov','Dic'];
		Vue.material.locale.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
		let now = new Date();
    return {
      form: {
          boat: "",
          zoneFisher: "",
          processingPlant: "", 
          processorResponsible: "", 
          nameOfficial: "",
      },

      date: format(now, dateFormat),
      dateBeginningFaena: format(now, dateFormat),
      dateEndFaena: format(now, dateFormat),
      observation: "",

      arrayNoticePreviousZarpe: [],
      id_noticePreviousZarpe: 0,

      arrayPt: {id:0,namePort:'',name:''},
	  arrayPort: [],
      id_port: 0,
      arrayComp: {id:0, name:''},
	  arrayCompany: [],
      id_Company: 0,
      arrayFg: {id:0, name:''},
	  arrayFlag: [],
      id_flag: 0,

      edo:1,
      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0
    };
  },

  validations: {
    form: {
        boat: {
          required
        },
        zoneFisher: {
          required
        },
        processingPlant: {
            required
        },  
        processorResponsible: {
            required
        },  
        nameOfficial: {
          required
        },  
      
    }
  },

  computed: {

  },
  components: {
		vSelect,
		Multiselect
	},
  methods: {
    toString() {
      this.toDate();
      this.dynamicByModel =
        this.dynamicByModel && format(this.dynamicByModel, this.dateFormat);
    },
    toDate() {
      switch (this.type) {
        case "string":
          this.dynamicByModel = parse(
            this.dynamicByModel,
            this.dateFormat,
            new Date()
          );
          break;
      }
    },
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
      this.date = null;
      this.dateBeginningFaena = null;
      this.form.boat = null;
      this.dateEndFaena = null;
      this.form.zoneFisher = null;
      this.form.processingPlant = null;
      this.form.processorResponsible = null;
      this.observation = null;
      this.form.nameOfficial = null;

      this.arrayComp = {id:0, name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayPt = {id:0, namePort:'',name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_noticePreviousZarpe = data["id"]);
      this.date = data["date"];
      this.dateBeginningFaena = data["dateBeginningFaena"];
      this.form.boat = data["boat"];
      this.dateEndFaena = data["dateEndFaena"];
      this.form.zoneFisher = data["zoneFisher"];
      this.form.processingPlant = data["processingPlant"];
      this.form.processorResponsible = data["processorResponsible"];
      this.observation = data["observation"];
      this.form.nameOfficial = data["nameOfficial"];

      this.arrayComp.id = data["id_company"];
	  this.arrayComp.name = data["nameCompany"];
      this.arrayFg.id = data["id_flag"];
	  this.arrayFg.name = data["nameFlag"];
      this.arrayPt.id = data["id_port"];
      this.arrayPt.name = data["namePort"];
       
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    nameWithCompany ({ name }) {
            return `${name}`
    },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    selectFlag() {
            let me = this;
            var url = "flags/selectFlags";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFlag = respuesta.flag;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectPort() {
            let me = this;
            var url = "/noticePreviousZarpe/selectDocks";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPort = respuesta.port;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectCompanies() {
            let me = this;
            var url = "/zarpes/selectCompanies";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCompany= respuesta.company;
                }).catch(function (error) {
                    console.log(error);
            });
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
        "/noticePreviousZarpe";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayNoticePreviousZarpe = respuesta.noticezarpes.data;
          me.myTable(me.arrayNoticePreviousZarpe);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/noticePreviousZarpe/save", {
    
        date: this.date,
        dateBeginningFaena: this.dateBeginningFaena,
        boat: this.form.boat.toUpperCase(),
        dateEndFaena: this.dateEndFaena,
        zoneFisher: this.form.zoneFisher.toUpperCase(),
        processingPlant: this.form.processingPlant.toUpperCase(),
        processorResponsible: this.form.processorResponsible.toUpperCase(),
        observation: this.observation.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),

        'id_company': this.arrayComp.id,
        'id_flag': this.arrayFg.id,
        'id_port': this.arrayPt.id,
    
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
        .put("/noticePreviousZarpe/update", {
        id: this.id_noticePreviousZarpe,
        date: this.date,
        dateBeginningFaena: this.dateBeginningFaena,
        boat: this.form.boat.toUpperCase(),
        dateEndFaena: this.dateEndFaena,
        zoneFisher: this.form.zoneFisher.toUpperCase(),
        processingPlant: this.form.processingPlant.toUpperCase(),
        processorResponsible: this.form.processorResponsible.toUpperCase(),
        observation: this.observation.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),

        'id_company': this.arrayComp.id,
        'id_flag': this.arrayFg.id,
        'id_port': this.arrayPt.id,

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
        title: "Esta seguro de Eliminar el Acta " + data["name"],
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
            .post("/noticePreviousZarpe/delete", {
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

            { "data": "date" },
            { "data": "boat" },
            { "data": "informationBoat" },
            { "data": "dateEndFaena" },
            { "data": "processingPlant" },
             {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>  "},

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
    });
    }
  },

  mounted() {
    this.listData();
    this.selectPort();
    this.selectCompanies(); 
    this.selectFlag();
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
