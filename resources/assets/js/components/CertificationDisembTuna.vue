<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato Certificación Desembarque de Atún para Exportación</strong>          
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
                            <label>Seleccione Fecha</label>
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
                  <md-field md-clearable :class="getValidationClass('nameBoat')">
                    <label for="first-name">Nombre Embarcación</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameBoat.required"
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

                  <label>CERTIFICA</label>

                  <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="dateBeginningFaena"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Inicio de Faena</label>
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
                            <label>Fecha Inicio de Faena</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('ZoneFisher')">
                    <label for="first-name">Zona de Pesca</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.ZoneFisher"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.ZoneFisher.required"
                    >Olvidaste ingresar el nombre de la zona de pesca</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Desembarque</label>
                      <multiselect v-model="arrayPt" :options="arrayPort"
                          placeholder="Seleccione puerto de desembarque"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('yellowFin')">
                    <label for="first-name">Aleta Amarilla - YFT (Kg.)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.yellowFin"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.yellowFin.required"
                    >Olvidaste ingresar la cantidad de aleta amarilla</span>
                  </md-field>
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Clasificación en Libras Aleta Amarilla</label>
                      <md-select v-model="poundRating1" name="poundRating1" id="poundRating1" placeholder="Clasificación en Libras Aleta Amarilla">
                        <md-option value="menos de 3">Menos de 3</md-option>
                        <md-option value="de 3 a 6">De 3 a 6</md-option>
                        <md-option value="de 7 a 20">De 7 a 20</md-option>
                        <md-option value="de 21 a 30">De 21 a 30</md-option>
                        <md-option value="más de 30">Mas de 30</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('barrilete')">
                    <label for="first-name">Barrilete - SKJ (Kg.)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.barrilete"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.barrilete.required"
                    >Olvidaste ingresar la cantidad de barrilete</span>
                  </md-field>
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Clasificación en Libras Barrilete</label>
                      <md-select v-model="poundRating2" name="poundRating2" id="poundRating2" placeholder="Clasificación en Libras Barrilete">
                        <md-option value="menos de 3">Menos de 3</md-option>
                        <md-option value="de 3 a 6">De 3 a 6</md-option>
                        <md-option value="de 7 a 20">De 7 a 20</md-option>
                        <md-option value="de 21 a 30">De 21 a 30</md-option>
                        <md-option value="más de 30">Mas de 30</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('patudo')">
                    <label for="first-name">Patudo - BET (Kg.)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.patudo"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.patudo.required"
                    >Olvidaste ingresar la cantidad de patudo</span>
                  </md-field> 
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Clasificación en Libras Patudo</label>
                      <md-select v-model="poundRating3" name="poundRating3" id="poundRating3" placeholder="Clasificación en Libras Patudo">
                        <md-option value="menos de 3">Menos de 3</md-option>
                        <md-option value="de 3 a 6">De 3 a 6</md-option>
                        <md-option value="de 7 a 20">De 7 a 20</md-option>
                        <md-option value="de 21 a 30">De 21 a 30</md-option>
                        <md-option value="más de 30">Mas de 30</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable>
                    <label for="first-name">Otro</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="other"
                      :disabled="sending"
                    />
                  </md-field> 
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Clasificación en Libras Otro</label>
                      <md-select v-model="poundRating4" name="poundRating4" id="poundRating4" placeholder="Clasificación en Libras otro">
                        <md-option value="menos de 3">Menos de 3</md-option>
                        <md-option value="de 3 a 6">De 3 a 6</md-option>
                        <md-option value="de 7 a 20">De 7 a 20</md-option>
                        <md-option value="de 21 a 30">De 21 a 30</md-option>
                        <md-option value="más de 30">Mas de 30</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <label>Observaciones</label>
                  <md-field>
                        <md-textarea v-model="observation"></md-textarea>
                  </md-field>        
                  <md-field md-clearable :class="getValidationClass('nameOfficial')">
                    <label for="first-name">Nombre funcionario</label>
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
                    >Olvidaste ingresar nombre del funcionario</span>
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
          nameBoat: "",
          ZoneFisher: "",
          nameOfficial: "", 
          yellowFin: "", 
          barrilete: "", 
          patudo: "", 

      },
      
      date: format(now, dateFormat),
      dateBeginningFaena: format(now, dateFormat),
      dateEndFaena: format(now, dateFormat),
      observation: "",
      other: "",
      poundRating1: "",
      poundRating2: "",
      poundRating3: "",
      poundRating4: "",

      arrayDisembTuna: [],
      id_disembTuna: 0,

      arrayPt: {id:0, namePort:'', name:''},
	    arrayPort: [],
      id_port: 0,
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_Company: 0,

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
        nameBoat: {
          required
        },
        ZoneFisher: {
          required
        }, 
        nameOfficial: {
          required
        },  
        yellowFin: {
          required
        },  
        barrilete: {
          required
        },  
        patudo: {
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
      this.form.nameBoat = null;
      this.date = null;
      this.dateBeginningFaena = null;
      this.dateEndFaena = null;
      this.form.ZoneFisher = null;
      this.observation = null;
      this.form.nameOfficial = null;
      this.form.yellowFin = null;
      this.poundRating1 = null;
      this.form.barrilete = null;
      this.poundRating2 = null;
      this.form.patudo = null;
      this.poundRating3 = null;
      this.other = null;
      this.poundRating4 = null;
  
      
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayComp = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_disembTuna = data["id"]);
      this.form.nameBoat = data["nameBoat"];
      this.date = data["date"];
      this.dateBeginningFaena = data["dateBeginningFaena"];
      this.dateEndFaena = data["dateEndFaena"];
      this.form.ZoneFisher = data["ZoneFisher"];
      this.observation = data["observation"];
      this.form.nameOfficial = data["nameOfficial"];
      this.form.yellowFin = data["yellowFin"];
      this.poundRating1 = data["poundRating1"];
      this.form.barrilete = data["barrilete"];
      this.poundRating2 = data["poundRating2"];
      this.form.patudo = data["patudo"];
      this.poundRating3 = data["poundRating3"];
      this.other = data["other"];
      this.poundRating4 = data["poundRating4"];
       
      this.arrayPt.id = data["id_port"];
      this.arrayPt.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
	    this.arrayFg.name = data["nameFlag"];
      this.arrayComp.id = data["id_company"];
	    this.arrayComp.name = data["nameCompany"];
    },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    nameWithCompany ({ name }) {
            return `${name}`
    },
    selectFlag() {
            let me = this;
            var url = "certificationDisembTuna/selectFlags";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFlag = respuesta.flag;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectPort() {
            let me = this;
            var url = "/docks/selectDocks";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPort = respuesta.port;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectCompanies() {
            let me = this;
            var url = "certificationDisembTuna/selectCompanies";
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
        "/certificationDisembTuna";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayDisembTuna = respuesta.tunas.data;
          me.myTable(me.arrayDisembTuna);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/certificationDisembTuna/save", {
    
        nameBoat: this.form.nameBoat.toUpperCase(),
        date: this.date,
        dateBeginningFaena: this.dateBeginningFaena,
        dateEndFaena: this.dateEndFaena,
        ZoneFisher: this.form.ZoneFisher.toUpperCase(),
        observation: this.observation.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        yellowFin: this.form.yellowFin.toUpperCase(),
        poundRating1: this.poundRating1.toUpperCase(),
        barrilete: this.form.barrilete.toUpperCase(),
        poundRating2: this.poundRating2.toUpperCase(),
        patudo: this.form.patudo.toUpperCase(),
        poundRating3: this.poundRating3.toUpperCase(),
        other: this.other.toUpperCase(),
        poundRating4: this.poundRating4.toUpperCase(),
       
    
        'id_port': this.arrayPt.id,
        'id_flag': this.arrayFg.id,
        'id_company': this.arrayComp.id,
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
        .put("/certificationDisembTuna/update", {
        id: this.id_disembTuna,
        nameBoat: this.form.nameBoat.toUpperCase(),
        date: this.date,
        dateBeginningFaena: this.dateBeginningFaena,
        dateEndFaena: this.dateEndFaena,
        ZoneFisher: this.form.ZoneFisher.toUpperCase(),
        observation: this.observation.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        yellowFin: this.form.yellowFin.toUpperCase(),
        poundRating1: this.poundRating1.toUpperCase(),
        barrilete: this.form.barrilete.toUpperCase(),
        poundRating2: this.poundRating2.toUpperCase(),
        patudo: this.form.patudo.toUpperCase(),
        poundRating3: this.poundRating3.toUpperCase(),
        other: this.other.toUpperCase(),
        poundRating4: this.poundRating4.toUpperCase(),
    
        'id_port': this.arrayPt.id,
        'id_flag': this.arrayFg.id,
        'id_company': this.arrayComp.id,
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
            .post("/certificationDisembTuna/delete", {
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
            { "data": "nameBoat" },
            { "data": "nameOfficial" },
            { "data": "dateBeginningFaena" },
            { "data": "dateEndFaena" },
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
    this.selectFlag();
    this.selectCompanies();
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
