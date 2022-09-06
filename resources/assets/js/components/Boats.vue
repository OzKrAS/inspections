<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Gestión de Embarcaciones</strong>
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
                    <th>Nombre Embarcación</th>
                    <th>No. Resolución</th>
                    <th>Fecha Resolución</th>
                    <th>Fecha Vigencia</th>
                    <th>Bandera</th>
                    <th>Matrícula</th>
                    <th>No. Patente</th>
                    <th>Fecha Vigencia Patente</th>
                    <th style="width: 90px">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Resolución</th>
                      <th>Nombre Embarcación</th>
                      <th>Bandera</th>
                      <th>Matrícula</th>
                      <th>No. Patente</th>
                      <th>Fecha Vigencia Patente</th>
                      <th>Fecha Resolución</th>
                      <th>Fecha Vigencia</th>
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
                  <div class="md-layout-item md-size-35">
                      <md-field md-clearable :class="getValidationClass('noResolution')">
                        <label for="first-name">No. Resolución</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noResolution"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noResolution.required"
                        >Olvidaste ingresar el número de resolución</span>
                      </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                        <div>
                          <md-datepicker
                            md-clearable :class="getValidationClass('dateResolution')"
                            v-model="form.dateResolution"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Resolución</label>
                            <span
                              class="md-error"
                              v-if="!$v.form.dateResolution.required"
                              >Olvidaste ingresar la fecha de resolución
                            </span>
                          </md-datepicker>
                        </div>
                    </div> &nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-datepicker
                        md-clearable :class="getValidationClass('dateValid')"
                        v-model="form.dateValid"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Fecha Vigencia</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateValid.required"
                          >Olvidaste ingresar la fecha de vigencia
                        </span>
                      </md-datepicker>
                    </div> &nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                    <div class="md-layout-item">
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
                        >Olvidaste ingresar un nombre para la embarcación</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('enrollment')">
                        <label for="first-name">Matrícula</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.enrollment"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.enrollment.required"
                        >Olvidaste ingresar la matrícula</span>
                      </md-field>
                    </div>  &nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('noPatent')">
                        <label for="first-name">No. de Patente</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noPatent"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noPatent.required"
                        >Olvidaste ingresar el número de patente</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                        <div>
                          <md-datepicker
                            md-clearable :class="getValidationClass('dateValidityPat')"
                            v-model="form.dateValidityPat"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Vigencia Patente</label>
                            <span
                              class="md-error"
                              v-if="!$v.form.dateValidityPat.required"
                              >Olvidaste ingresar la fecha de vigencia
                            </span>
                          </md-datepicker>

                        </div>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                    <div class="md-layout">
                      <label class="text-muted">Bandera</label>
                          <multiselect v-model="arrayFg" :options="arrayFlag"
                              placeholder="Seleccione una bandera"
                              :custom-label="nameWithName"
                              label="name"
                              track-by="name">
                          </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                        <div class="md-layout">
                           <label class="text-muted">Empresa</label>
                        <multiselect v-model="arrayComp" :options="arrayCompany"
                            placeholder="Seleccione una empresa"
                            :custom-label="nameWithName"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>
                       <div class="md-layout">
                      <md-field md-clearable :class="getValidationClass('nameRepresent')">
                        <label for="first-name">Representante Legal</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.nameRepresent"
                          :disabled="sending"
                          type="text"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.nameRepresent.required"
                        >Olvidaste ingresar el nombre del representante</span>
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
    import format from "date-fns/format";
    import { validationMixin } from "vuelidate";
    import Multiselect from "vue-multiselect";
    import Toasted from 'vue-toasted';
    import vSelect from "vue-select";
    import jsPDF from 'jspdf';
    import 'jspdf-autotable';
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
        enrollment: "",
        noPatent: "",
        noResolution: "",
        nameRepresent: "",
        dateValidityPat: format(now, dateFormat),
        dateResolution: format(now, dateFormat),
        dateValid: format(now, dateFormat),
      },
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      // dateValidityPat: format(now, dateFormat),
      // dateResolution: format(now, dateFormat),
      // dateValid: format(now, dateFormat),

      edo:1,
      tipoAccion: 1,
      listado: 1,
      idFlag: 0,
      sending: false,

      arrayData: [],
      arrayBoat: [],
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_boats: 0,
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
      nameBoat: {
        required
      },
        enrollment: {
        required
      },
        noPatent: {
        required
      },
        noResolution: {
        required
      },
        nameRepresent: {
        required
      },
        dateValidityPat: {
        required
      },
        dateResolution: {
        required
      },
        dateValid: {
        required
      },
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
      this.form.nameBoat = null;
      this.form.enrollment = null;
      this.form.noPatent = null;
      this.form.noResolution = null;
      this.form.nameRepresent = null;
      this.form.dateValidityPat = null;
      this.form.dateValid = null;
      this.form.dateResolution = null;

      this.arrayFg = {id:0, name:''};

    },
    nameWithName ({ name }) {
            return `${name}`
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_boats = data["id"]);

      this.form.nameBoat = data["nameBoat"];
      this.form.enrollment = data["enrollment"];
      this.form.noPatent = data["noPatent"];
      this.form.noResolution = data["noResolution"];
      this.form.nameRepresent = data["nameRepresent"];
      this.form.dateValidityPat = data["dateValidityPat"];
      this.form.dateValid = data["dateValid"];
      this.form.dateResolution = data["dateResolution"];
      this.arrayComp.name=data['nameCompany'];
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
      this.edo = 1;
      this.listado = 1;
      this.listData();
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
    listData() {
      let me = this;
      var url = "/boats";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayBoat = respuesta.data;
          me.myTable(me.arrayBoat.data);

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    saveData() {
      let me = this;

      axios
        .post("/boats/save", {
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent,
          noResolution: this.form.noResolution,
          nameRepresent: this.form.nameRepresent,
          dateValidityPat: this.form.dateValidityPat,
          dateValid: this.form.dateValid,
          dateResolution: this.form.dateResolution,
          id_company: this.arrayComp.id,
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
        .put("/boats/update", {
          id: this.id_boats,
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent,
          noResolution: this.form.noResolution,
          nameRepresent: this.form.nameRepresent,
          dateValidityPat: this.form.dateValidityPat,
          dateValid: this.form.dateValid,
          dateResolution: this.form.dateResolution,
          id_company: this.arrayComp.id,
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
        title: "Esta seguro de Eliminar la embarcacion " + data["nameBoat"],
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
            .post("/boats/delete", {
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

            { "data": "nameBoat" },
            { "data": "noResolution" },
            { "data": "dateResolution" },
            { "data": "dateValid" },
            { "data": "nameFlag" },
            { "data": "enrollment" },
            { "data": "noPatent" },
            { "data": "dateValidityPat" },
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
    });
    }
  },

  mounted() {
    this.listData();
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
