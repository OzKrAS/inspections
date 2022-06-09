<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Verificaión Presencia del Equipo de Rescate de Delfines Abordo de Barcos Atuneros de Cerco</strong>          
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
                    <th>Nombre del Barco</th>
                    <th>Bandera</th>
                    <th>No. Crucero/RSA</th>
                    <th>Nombre Pescador</th>
                    <th>Fecha de Zarpe</th>
                    <th>Fecha desembarque</th>
                    <th>Nombre Capitán</th> 
                    <th>Opciones</th> 
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                     <tr>
                        <th>Nombre del Barco</th>
                        <th>Bandera</th>
                        <th>No. Crucero/RSA</th>
                        <th>Nombre Pescador</th>
                        <th>Fecha de Zarpe</th>
                        <th>Fecha desembarque</th>
                        <th>Nombre Capitán</th> 
                        <th>Opciones</th>  
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
                    <md-field md-clearable :class="getValidationClass('nameShip')">
                        <label for="first-name">Nombre del Barco</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameShip"
                        :disabled="sending"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.nameShip.required"
                        >Olvidaste ingresar el nombre del barco
                        </span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;   
                  <div class="md-layout-item">
                      <label class="text-muted">Bandera</label>
                      <multiselect v-model="arrayFg" :options="arrayFlag"
                          placeholder="Seleccione una bandera"
                          :custom-label="nameWithFlag"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('cruise')">
                        <label for="first-name">No. Crucero/RSA</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.cruise"
                        :disabled="sending"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.cruise.required"
                        >Olvidaste ingresar el número de crucero/RSA
                        </span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameFish')">
                        <label for="first-name">Nombre Pescador</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameFish"
                        :disabled="sending"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.nameFish.required"
                        >Olvidaste ingresar el nombre del pescador
                        </span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>      
                <div class="md-layout">
                  <div class="md-layout-item md-size-45">
                    <md-field md-clearable :class="getValidationClass('nameCaptain')">
                        <label for="first-name">Nombre Capitán</label>
                        <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.nameCaptain"
                            :disabled="sending"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.nameCaptain.required"
                        >Olvidaste ingresar el nombre del capitán</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                          <div>
                            <md-datepicker 
                              v-model="dateZarpe"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                            >
                              <label>Fecha Zarpe</label>
                            </md-datepicker>
                          </div>
                    </div> &nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="dateDesemb"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Desembarque</label>
                          </md-datepicker>
                        </div>
                    </div> &nbsp;&nbsp;&nbsp;
                </div>                
                <div class="md-layout">                   
                        <div class="card-body">   
                          <div class="md-layout">
                            <div class="md-layout-item">
                              <md-field md-clearable :class="getValidationClass('equipment')">
                                <label for="first-name">Equipo</label>
                                <md-input
                                  name="first-name"
                                  id="first-name"
                                  autocomplete="given-name"
                                  v-model="form.equipment"
                                  :disabled="sending"
                                />
                                <span
                                  class="md-error"
                                  v-if="!$v.form.equipment.required"
                                >Olvidaste ingresar el nombre</span>
                              </md-field>
                            </div>&nbsp;&nbsp;&nbsp;                  
                            <div class="md-layout-item">
                              <md-field md-clearable :class="getValidationClass('zarpe')">
                                <label for="first-name">Zarpe</label>
                                <md-input
                                  name="first-name"
                                  id="first-name"
                                  autocomplete="given-name"
                                  v-model="form.zarpe"
                                  :disabled="sending"
                                />
                                <span
                                  class="md-error"
                                  v-if="!$v.form.zarpe.required"
                                >Olvidaste ingresar la cantidad unitaria</span>
                              </md-field>
                            </div>&nbsp;&nbsp;&nbsp;                  
                            <div class="md-layout-item">
                              <md-field md-clearable :class="getValidationClass('desemb')">
                                <label for="first-name">Desembarque</label>
                                <md-input
                                  name="first-name"
                                  id="first-name"
                                  autocomplete="given-name"
                                  v-model="form.desemb"
                                  :disabled="sending"
                                />
                                <span
                                  class="md-error"
                                  v-if="!$v.form.desemb.required"
                                >Olvidaste ingresar </span>
                              </md-field>
                            </div>&nbsp;&nbsp;&nbsp;                 
                            <div class="md-layout-item">
                              <md-field md-clearable :class="getValidationClass('photoRecord')">
                                <label for="first-name">Registro Fotográfico</label>
                                <md-input
                                  name="first-name"
                                  id="first-name"
                                  autocomplete="given-name"
                                  v-model="form.photoRecord"
                                  :disabled="sending"
                                />
                                <span
                                  class="md-error"
                                  v-if="!$v.form.photoRecord.required"
                                >Olvidaste ingresar </span>
                              </md-field>
                            </div>&nbsp;&nbsp;&nbsp;                 
                            <div class="md-layout-item">
                              <md-field md-clearable :class="getValidationClass('observation')">
                                <label for="first-name">Observaciones</label>
                                <md-input
                                  name="first-name"
                                  id="first-name"
                                  autocomplete="given-name"
                                  v-model="form.observation"
                                  :disabled="sending"
                                />
                                <span
                                  class="md-error"
                                  v-if="!$v.form.observation.required"
                                >Olvidaste ingresar </span>
                              </md-field>
                            </div>&nbsp;&nbsp;&nbsp;                 
                          </div>                  
                          <md-button
                            type="button"
                            class="md-dense md-raised md-primary"
                            :disabled="sending"
                            @click="addItemTarget()"
                          >Agregar
                          </md-button>
                      <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">      
                        <thead>    
                          <tr>
                            <th>EQUIPO</th>    
                            <th>ZARPE (S/N)</th>    
                            <th>DESEMBARQUE (S/N)</th>    
                            <th>REGISTRO FOTOGRAFICO (S/N)</th>    
                            <th>OBSERVACIONES</th>    
                            <th style="width: 90px">Opciones</th>
                          </tr>
                        </thead>
                       <tbody>
                          <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                            <td v-text="target.element"></td>
                            <td v-text="target.amount2"></td>
                            <td v-text="target.characterState"></td>
                            <td v-text="target.commercialValue2"></td>                    
                            <td>                      
                              <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-tooltip
                                title="Eliminar"
                                @click="deleteTarget(index)"
                              >
                                <i class="icon-trash"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                          <tfoot>
                            <tr>
                              <th>EQUIPO</th>    
                              <th>ZARPE (S/N)</th>    
                              <th>DESEMBARQUE (S/N)</th>    
                              <th>REGISTRO FOTOGRAFICO (S/N)</th> 
                              <th>OBSERVACIONES</th> 
                              <th style="width: 90px">Opciones</th>
                            </tr>
                          </tfoot>
                          <tbody>
                          </tbody>
                    </table>
                  </div>  
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
    
      return {form: {

        nameShip: "",
        cruise: "",
        nameFish: "",
        nameCaptain: "",
        
        equipment: "",
        zarpe: "",
        desemb: "",
        photoRecord: "",
        observation: "",

      },

      dateZarpe: 0,
      dateDesemb: 0,
      

      arrayPresenVerifics: [],
      id_presenVerific: 0,

      arrayTarget: [],
      
      arrayTable: [{ nameTeam: 'Marcas del PPD*', zarpe: '', disemb: '', photoRecord: '', observation: ''},
                   { nameTeam: 'Balsa', zarpe: '', disemb: '', photoRecord: '', observation: ''},
                   { nameTeam: 'Reflector', zarpe: '', disemb: '', photoRecord: '', observation: ''},
                   { nameTeam: 'Visores de Buceo', zarpe: '', disemb: '', photoRecord: '', observation: ''},
                   { nameTeam: 'Lanchas con Bridas', zarpe: '', disemb: '', photoRecord: '', observation: ''},
                  ],
    
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      
      edo: 1,

      tipoAccion: 1,
      listado: 1,
      idMcpio: 0,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0
    };
  },
  components: {
		vSelect,
		Multiselect
	},

  validations: {
    form: {

      nameShip: {
        required
      },
      cruise: {
        required
      },
      nameFish: {
        required
      },
      nameCaptain: {
        required
      },
      equipment: {
        required
      },
      zarpe: {
        required
      },
      desemb: {
        required
      },
      photoRecord: {
        required
      },
      observation: {
        required
      },
    }
  },

  computed: {

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
      this.form.insNo = null;
      this.form.nameShip = null;
      this.form.cruise = null;
      this.form.nameFish = null;
      this.form.nameCaptain = null;
      this.dateZarpe = null;
      this.dateDesemb = null;
      this.arrayFg = {id:0, name:''};
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    listData() {
      let me = this;
      var url =
        "/presenVerifics";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPresenVerifics= respuesta.presenVerifics.data;
          me.myTable(me.arrayPresenVerifics);
    

        })
        .catch(function (error) {
          console.log(error);
        });
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
    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_presenVerific = data["id"]);
      this.form.nameShip = data["nameShip"];
      this.form.cruise = data["cruise"];
      this.form.nameFish = data["nameFish"];
      this.form.nameCaptain = data["nameCaptain"];
      this.dateZarpe = data["dateZarpe"];
      this.dateDesemb = data["dateDesemb"];
      
      this.arrayFg.id = data["id_flag"];
			this.arrayFg.name = data["nameFlag"];
    },
    showData() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      this.edo=0;
    },
    hideForm() {
      this.listData();
      this.edo = 1;
      this.listado = 1;
    },    
    saveData() {
      let me = this;
      axios
        .post("/presenVerifics/save", {
  
          nameShip: this.form.nameShip.toUpperCase(),
          cruise: this.form.cruise.toUpperCase(),
          nameFish: this.form.nameFish.toUpperCase(),
          nameCaptain: this.form.nameCaptain.toUpperCase(),
          dateZarpe: this.dateZarpe,
          dateDesemb: this.dateDesemb,
          'id_flag': this.arrayFg.id,
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
        .put("/presenVerifics/update", {
          id: this.id_presenVerific,
          nameShip: this.form.nameShip.toUpperCase(),
          cruise: this.form.cruise.toUpperCase(),
          nameFish: this.form.nameFish.toUpperCase(),
          nameCaptain: this.form.nameCaptain.toUpperCase(),
          dateZarpe: this.dateZarpe,
          dateDesemb: this.dateDesemb,
        
          'id_flag': this.arrayFg.id,
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
        title: "Esta seguro de Eliminar este Zarpe " + data["name"],
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
            .post("/presenVerifics/delete", {
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

            // { "data": "name" },
            { "data": "nameShip" },
            { "data": "cruise" },
            { "data": "nameFish" },
            { "data": "nameCaptain" },
            { "data": "dateZarpe" },
            { "data": "dateDesemb" },
            { "data": "nameFlag" },
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
