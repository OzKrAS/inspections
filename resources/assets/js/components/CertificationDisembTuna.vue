<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card"  style="width: 100%">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato Certificación Desembarque de Atún para Exportación</strong>
          <button v-if="edo" type="button" @click="showData()" class="btn btn-success btn-sm">
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado == 1">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered display" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Nombre Embarcación de Carga</th>
                    <!-- <th>Nombre Representante</th> -->
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
                    <!-- <th>Nombre Representante</th> -->
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
        <template v-else-if="listado == 0">
          <div class="card-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <md-input v-model="form.user_id" type="hidden" />
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-datepicker md-clearable :class="getValidationClass('date')" v-model="form.date" @input="toString"
                      md-immediately :md-model-type="String">
                      <label>Seleccione Fecha (Date)</label>
                      <span class="md-error" v-if="!$v.form.date.required">Olvidaste ingresar la fecha
                      </span>
                    </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <label class="text-muted">Empresa (Company)</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany" placeholder="Seleccione una empresa"
                        :custom-label="nameWithCompany" label="name" track-by="name">
                      </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                </div>
                <div class="md-layout">
                  <!-- <div class="md-layout-item"> -->
                  <!-- <md-field md-clearable :class="getValidationClass('nameBoat')">
                      <label for="first-name">Nombre Embarcación (Ship Name)</label>
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
                    </md-field> -->
                  <!-- </div> -->
                  <div class="md-layout">
                    <label class="text-muted">Nombre de la embarcación (Ship Name)</label>
                    <multiselect v-model="arrayBt" :options="arrayBoat" @input="setBoats()"
                      placeholder="Seleccione una embarcación" :custom-label="nameWithBoat" label="nameBoat"
                      track-by="nameBoat">
                    </multiselect>
                  </div>
                  &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Bandera (Flag)</label>
                    <multiselect v-model="arrayFg" :options="arrayFlag" placeholder="Seleccione una bandera"
                      :custom-label="nameWithFlag" label="name" track-by="name">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>

                <div>
                  <strong>CERTIFICA</strong>
                </div>
                <div>
                  <strong>QUE LA EMBARCACIÓN EN CUESTIÓN, DESEMBARCÓ EN PUERTO COLOMBIANO EL SIGUIENTE PRODUCTO CAPTURADO
                    DURANTE LA FAENA DESCRITA A CONTINUACIÓN:</strong>
                </div>

                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-datepicker md-clearable :class="getValidationClass('dateBeginningFaena')"
                      v-model="form.dateBeginningFaena" @input="toString" md-immediately :md-model-type="String">
                      <label>Fecha Inicio de Faena (Fishing Task Start Date)</label>
                      <span class="md-error" v-if="!$v.form.dateBeginningFaena.required">Olvidaste ingresar la fecha
                        inicio de faena
                      </span>
                    </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-datepicker md-clearable :class="getValidationClass('dateEndFaena')" v-model="form.dateEndFaena"
                      @input="toString" md-immediately :md-model-type="String">
                      <label>Fecha Fin de Faena (Fishing Task End Date)</label>
                      <span class="md-error" v-if="!$v.form.dateEndFaena.required">Olvidaste ingresar la fecha fin de
                        faena
                      </span>
                    </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Zona de Pesca Autorizada (Fishing Zone)</label>
                    <multiselect v-model="arrayZoneAuto.name" :options="arrayZoneAutoFish"
                      placeholder="Zona de Pesca Autorizada" label="name"
                      track-by="id">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;

                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Desembarque (Landing Port)</label>
                    <multiselect v-model="arrayPt" :options="arrayPort" placeholder="Seleccione puerto de desembarque"
                      :custom-label="nameWithPort" label="name" track-by="name">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <md-divider style="background-color: #2090E8 "></md-divider>
                <div class="card-body">

                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field>
                        <label class="text-muted">Clasificación en Libras</label>
                        <md-select v-model="poundRating" name="poundRating" id="poundRating"
                          placeholder="Clasificación en Libras">
                          <md-option value="menos de 3">Menos de 3</md-option>
                          <md-option value="de 3 a 6">De 3 a 6</md-option>
                          <md-option value="de 7 a 20">De 7 a 20</md-option>
                          <md-option value="de 21 a 30">De 21 a 30</md-option>
                          <md-option value="más de 30">Mas de 30</md-option>
                          <md-option value="otra">Otra</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Aleta Amarilla - YFT (Kg.)</label>
                        <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="yellowFin"
                          :disabled="sending" type="number" />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Barrilete - SKJ (Kg.)</label>
                        <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="barrilete"
                          :disabled="sending" type="number" />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Patudo - BET (Kg.)</label>
                        <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="patudo"
                          :disabled="sending" type="number" />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Otro</label>
                        <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="other"
                          :disabled="sending" />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <md-button type="button" class="md-dense md-raised md-primary" :disabled="sending"
                    @click="addItemTarget()">Agregar
                  </md-button>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>CLASIFICACIÓN EN LIBRAS</th>
                          <th>ALETA AMARILLA - YFT (Kg.)</th>
                          <th>BARRILETE - SKJ (Kg.)</th>
                          <th>PATUDO - BET (Kg.)</th>
                          <th>OTRO</th>
                          <th style="width: 90px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody v-if="decimalData.length">
                        <tr v-for="(target, index) in decimalData" :key="`target-${index}`">
                          <td align="right" v-text="target.poundRating"></td>
                          <td align="right" v-text="target.yellowFin"></td>
                          <td align="right" v-text="target.barrilete"></td>
                          <td align="right" v-text="target.patudo"></td>
                          <td align="right" v-text="target.other"></td>
                          <td>
                            <button type="button" class="btn btn-danger btn-sm" data-tooltip title="Eliminar"
                              @click="deleteTarget(index)">
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="10" class="text-center">
                            No existen elementos agregados
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr style="background-color: darkgray;">
                          <td align="right"><strong>SubTotal Kg.</strong></td>
                          <td align="right"><strong> {{ totalYellow.toLocaleString('de-DE') }}</strong></td>
                          <td align="right"><strong> {{ totalBarrilete.toLocaleString('de-DE') }}</strong></td>
                          <td align="right"><strong> {{ totalPatudo.toLocaleString('de-DE') }}</strong></td>
                          <td align="right"><strong> {{ totalOther.toLocaleString('de-DE') }}</strong></td>
                          <td colspan="8"> </td>
                        </tr>
                        <tr style="background-color: darkgray;">
                          <td align="right"><strong>TOTAL DESEMBARCADO Kg.</strong></td>
                          <td align="right"><strong>{{ totalDesemb.toLocaleString('de-DE') }}</strong></td>
                          <td colspan="8"> </td>
                        </tr>
                        <!-- <tr>
                            <th>CLASIFICACIÓN EN LIBRAS</th>
                            <th>ALETA AMARILLA - YFT (Kg.)</th>
                            <th>BARRILETE - SKJ (Kg.)</th>
                            <th>PATUDO - BET (Kg.)</th>
                            <th>OTRO</th>
                            <th style="width: 90px">Opciones</th>
                          </tr> -->
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('observation')">
                      <label>Observaciones</label>
                      <md-textarea v-model="form.observation"></md-textarea>
                      <span class="md-error" v-if="!$v.form.observation.required">Olvidaste ingresar las observaciones
                      </span>
                    </md-field>
                  </div>
                </div>
                <!-- <div class="md-layout">
                  <div class="md-layout-item md-size-70">
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
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div> -->
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="hideForm()">Cerrar</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button type="submit" v-if="tipoAccion == 1" class="md-dense md-raised md-primary" :disabled="sending"
                @click="validateData()">Guardar</md-button>
              <md-button type="submit" v-if="tipoAccion == 2" class="md-dense md-raised md-primary" :disabled="sending"
                @click="updateData()">Actualizar</md-button>
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

Vue.use(Toasted, {
  iconPack: 'material' // set your iconPack, defaults to material. material|fontawesome|custom-class
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
    Vue.material.locale.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    Vue.material.locale.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();
    return {
      form: {
        nameBoat: "",
        // nameOfficial: "",
        observation: "",
        date: format(now, dateFormat),
        dateBeginningFaena: format(now, dateFormat),
        dateEndFaena: format(now, dateFormat),
      },

      poundRating: "menos de 3",
      yellowFin: 0,
      barrilete: 0,
      patudo: 0,
      other: 0,
      arrayTarget: [],
      arrayTargetAct: [],

      arrayDisembTuna: [],
      id_disembTuna: 0,

      arrayPt: { id: 0, namePort: '', name: '' },
      arrayPort: [],
      id_port: 0,
      arrayFg: { id: 0, name: '' },
      arrayFlag: [],
      id_flag: 0,
      arrayComp: { id: 0, name: '' },
      arrayCompany: [],
      arrayBt: {id: 0, nameBoat: ''},
      arrayBoat: [],
      id_Company: 0,
      arrayZoneAuto: { id: 0, name: '' },
      arrayZoneAutoFish: [],
      id_zoneAutoFisher: 0,
      edo: 1,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      arrayData: [],
      modal: 0,
      arrayYellow: [],
      arrayBarrilete: [],
      arrayPatudo: [],
      arrayOther: [],

    };
  },

  validations: {
    form: {
      nameBoat: {
        required
      },
      // nameOfficial: {
      //   required
      // },
      // yellowFin: {
      //   required
      // },
      // barrilete: {
      //   required
      // },
      // patudo: {
      //   required
      // },
      observation: {
        required
      },
      dateEndFaena: {
        required
      },
      dateBeginningFaena: {
        required
      },
      date: {
        required
      },

    }
  },

  computed: {

    decimalData() {
      return this.arrayTarget.map(item => {
        return {
          poundRating: item.poundRating,
          yellowFin: parseFloat(item.yellowFin).toLocaleString('de-DE'),
          barrilete: parseFloat(item.barrilete).toLocaleString('de-DE'),
          patudo: parseFloat(item.patudo).toLocaleString('de-DE'),
          other: parseFloat(item.other).toLocaleString('de-DE')
        }
      });
    },
    totalYellow: function () {
      return this.arrayTarget.reduce((total, item) => total + parseFloat(item.yellowFin), 0).toFixed(2);
    },
    totalBarrilete: function () {
      return this.arrayTarget.reduce((total, item) => total + parseFloat(item.barrilete), 0).toFixed(2);
    },
    totalPatudo: function () {
      return this.arrayTarget.reduce((total, item) => total + parseFloat(item.patudo), 0).toFixed(2);
    },
    totalOther: function () {
      return this.arrayTarget.reduce((total, item) => total + parseFloat(item.other), 0).toFixed(2);
    },
    totalDesemb: function () {
      var total5 = 0;
      for (let i = 0; i < this.arrayTarget.length; i++) {
        total5 = parseInt(this.totalOther) + parseInt(this.totalYellow) + parseInt(this.totalBarrilete) + parseInt(this.totalPatudo);
      }
      return total5;
    },
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
      this.form.nameBoat = this.arrayBt.nameBoat;
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.saveData();
        this.clearForm();
      }
    },
    addItemTarget() {
      let me = this;

      this.arrayYellow.push({ saldo: this.yellowFin });
      this.arrayBarrilete.push({ saldo: this.barrilete });
      this.arrayPatudo.push({ saldo: this.patudo });
      this.arrayOther.push({ saldo: this.other });

      var total1 = me.arrayTarget.push({
        poundRating: this.poundRating,
        yellowFin: this.yellowFin,
        barrilete: this.barrilete,
        patudo: this.patudo,
        other: this.other,
      });
      var total2 = me.arrayTargetAct.push({
        poundRating: this.poundRating,
        yellowFin: this.yellowFin,
        barrilete: this.barrilete,
        patudo: this.patudo,
        other: this.other,
      });
      me.clearTarget();
    },
    deleteTarget(index) {
      this.arrayTarget.splice(index, 1);
    },
    clearTarget() {
      this.poundRating = "menos de 3";
      this.yellowFin = 0;
      this.barrilete = 0;
      this.patudo = 0;
      this.other = 0;
    },
    clearForm() {
      this.$v.$reset();
      this.form.nameBoat = null;
      this.form.date = null;
      this.form.dateBeginningFaena = null;
      this.form.dateEndFaena = null;
      this.arrayZoneAuto.id = null;
      this.arrayZoneAuto.name = null;
      this.form.observation = null;
      this.arrayTarget = [];
      this.arrayTargetAct = [];

      this.arrayPt = { id: 0, namePort: '', name: '' };
      this.arrayFg = { id: 0, name: '' };
      this.arrayComp = { id: 0, name: '' };
    },

   getUser () {
      let me = this;
      var url =
        "/user/getuser";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.form.user_id = respuesta;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    showUpdate(data = []) {
      console.log(data);
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_disembTuna = data["id"]);
      this.form.nameBoat = data["nameBoat"];
      this.arrayBt = { id: 0, nameBoat: data["nameBoat"]};
      this.form.date = data["date"];
      this.form.dateBeginningFaena = data["dateBeginningFaena"];
      this.form.dateEndFaena = data["dateEndFaena"];
      this.arrayZoneAuto.id = data["ZoneFisher"];
      this.arrayZoneAuto.name = data["nameZoneFisher"];
      this.form.observation = data["observation"];

      this.arrayPt.id = data["id_port"]; 5
      this.arrayPt.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
      this.arrayFg.name = data["nameFlag"];
      this.arrayComp.id = data["id_company"];
      this.arrayComp.name = data["nameCompany"];
      this.dataTable1();
    },
    nameWithPort({ namePort, name }) {
      return `${namePort} / ${name}  `
    },
    nameWithFlag({ name }) {
      return `${name}`
    },
    nameWithBoat({nameBoat}) {
      return `${nameBoat}`
    },
    nameWithCompany({ name }) {
      return `${name}`
    },
    nameWithZoneAutoFish({ name }) {
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
        me.arrayCompany = respuesta.company;
      }).catch(function (error) {
        console.log(error);
      });
    },
    setBoats() {
      this.arrayFg.id = this.arrayBt.id_flag;
      this.arrayFg.name = this.arrayBt.nameFlag;
    },
    selectBoats() {
      let me = this;
      var url = "/selectboats?type=0";
      axios.get(url).then(function (response) {
        var respuesta = response.data;
        me.arrayBoat = respuesta.boat;
      }).catch(function (error) {
        console.log(error);
      });
    },
    showData() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      this.edo = 0;
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
          'user_id': this.form.user_id,
          nameBoat: this.form.nameBoat.toUpperCase(),
          date: this.form.date,
          dateBeginningFaena: this.form.dateBeginningFaena,
          dateEndFaena: this.form.dateEndFaena,
          ZoneFisher: this.arrayZoneAuto.id,
          observation: this.form.observation.toUpperCase(),
          target: this.arrayTarget,
          'id_port': this.arrayPt.id,
          'id_flag': this.arrayFg.id,
          'id_company': this.arrayComp.id,
        })
        .then(function (response) {
          console.log("RESPONSE ATUNA ", response);
          me.hideForm();
          me.message("Guardado", "Guardo ");
          me.listData();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectZoneAutoFisher() {
      let me = this;
      var url = "/arrivals/selectZoneAutoFisher";
      axios.get(url).then(function (response) {
        var respuesta = response.data;
        me.arrayZoneAutoFish = respuesta.autoFisher;
      }).catch(function (error) {
        console.log(error);
      });
    },
    updateData() {
      let me = this;
      axios
        .put("/certificationDisembTuna/update", {
          id: this.id_disembTuna,
          nameBoat: this.form.nameBoat.toUpperCase(),
          date: this.form.date,
          dateBeginningFaena: this.form.dateBeginningFaena,
          dateEndFaena: this.form.dateEndFaena,
          ZoneFisher: this.arrayZoneAuto.id,
          observation: this.form.observation.toUpperCase(),
          'target': this.arrayTargetAct,
          'id_port': this.arrayPt.id,
          'id_flag': this.arrayFg.id,
          'id_company': this.arrayComp.id,
        })
        .then(function (response) {
          me.hideForm();
          me.message("Actualizado", "Actualizó ");
          me.listData();
        })
        .catch(function (error) {
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
            .then(function (response) {
              me.hideForm();
              me.message("Eliminado", "Eliminó ");
              me.listData();
            })
            .catch(function (error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    dataTable1() {
      let me = this;

      var url = "/certificationDisembTuna/table1?id_DisembTuna=" + this.id_disembTuna;
      axios
        .get(url)
        .then(function (response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTarget = respuesta.confTable1;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    message(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    },
    myTable(datas) {
      let me = this;

      $(document).ready(function () {

        var table = $('#dataTable').DataTable({
          destroy: true,
          stateSave: true,
          data: datas,
          "createdRow": function (row, data, dataIndex) {
            if (data[6] == `0`) {
              $(row).addClass('redClass');
            }
          },
          "language": {
            "lengthMenu": "Ver _MENU_ registros por página",
            "zeroRecords": "NO existen Datos",
            "info": "mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "search": "Buscar:",
            "paginate": {
              "first": "Prim",
              "last": "Ant",
              "next": "Sig",
              "previous": "Ant"
            },
            "infoFiltered": "(filtrado de _MAX_ total registros)"
          },
          responsive: "true",
          "columns": [

            { "data": "date" },
            { "data": "nameBoat" },
            // { "data": "nameOfficial" },
            { "data": "dateBeginningFaena" },
            { "data": "dateEndFaena" },
            { "defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>  " },

          ]

        });

        $('#dataTable tbody').on('click', '.editar', function () {
          me.datos = table.row($(this).parents('tr')).data();
          me.showUpdate(me.datos);
        });
        $('#dataTable tbody').on('click', '.eliminar', function () {
          me.datos = table.row($(this).parents('tr')).data();
          me.deleteData(me.datos);
        });
      });
    }
  },

  mounted() {
    this.getUser();
    this.selectZoneAutoFisher();
    this.listData();
    this.selectPort();
    this.selectFlag();
    this.selectCompanies();
    this.selectBoats();
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

.material-icons.Color1 {
  color: rgb(31, 33, 34);
}

.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}

.material-icons.Color3 {
  color: rgb(12, 170, 91);
}

.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
