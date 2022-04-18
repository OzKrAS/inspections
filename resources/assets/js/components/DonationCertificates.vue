<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Acta de Donación</strong>          
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
                    <th>Acta No.</th>
                    <th>Regional</th>
                    <th>Nombre Científico</th>
                    <th>Nombre Común</th>
                    <!-- <th>Estado</th> -->
                    <th>Presentacion</th>
                    <th>Cant. (UN)</th>
                    <th>Peso (KG)</th>
                    <th>Valor Comercial</th>
                    <!-- <th>Foto</th> -->
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>Acta No.</th>
                      <th>Regional</th>
                      <th>Nombre Científico</th>
                      <th>Nombre Común</th>
                      <!-- <th>Estado</th> -->
                      <th>Presentacion</th>
                      <th>Cant. (UN)</th>
                      <th>Peso (KG)</th>
                      <th>Valor Comercial</th>
                      <!-- <th>Foto</th> -->
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
                  <md-field md-clearable :class="getValidationClass('noActa')">
                    <label for="first-name">No. Acta</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noActa"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noActa.required"
                    >Olvidaste ingresar el número de acta</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                      <label>Regional</label>
                      <multiselect v-model="arrayRegl" :options="arrayRegional"
                          placeholder="Seleccione una opción"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field>
                        <md-textarea v-model="form.observation"></md-textarea>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('nameScientific')">
                    <label for="first-name">Nombre Científico</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameScientific"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameScientific.required"
                    >Olvidaste ingresar el nombre científico</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('nameCommon')">
                    <label for="first-name">Nombre Común</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameCommon"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameCommon.required"
                    >Olvidaste ingresar el nombre nombre común</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('presentation')">
                    <label for="first-name">Presentación</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.presentation"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.presentation.required"
                    >Olvidaste ingresar la presentación</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('amount')">
                    <label for="first-name">Cantidad</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.amount"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.amount.required"
                    >Olvidaste ingresar la cantidad</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('weight')">
                    <label for="first-name">Peso</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.weight"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.weight.required"
                    >Olvidaste ingresar el peso</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('commercialValue')">
                    <label for="first-name">Valor Comercial</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.commercialValue"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.commercialValue.required"
                    >Olvidaste ingresar el valor comercial</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                        <!-- <label class="negrita">Fecha</label> -->
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
                  <md-field md-clearable :class="getValidationClass('nameOfficial')">
                    <label for="first-name">Nombre Funcionario AUNAP</label>
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
                  <md-field md-clearable :class="getValidationClass('noDocumentId1')">
                    <label for="first-name">Documento de Identidad</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noDocumentId1"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noDocumentId1.required"
                    >Olvidaste ingresar el número de indentidad</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('nameRepresentative')">
                    <label for="first-name">Nombre Representante Autoridad Acompañante</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameRepresentative"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameRepresentative.required"
                    >Olvidaste ingresar el nombre del representante</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('noDocumentId2')">
                    <label for="first-name">Documento de identidad</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noDocumentId2"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noDocumentId2.required"
                    >Olvidaste ingresar el número de identidad</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('noPlateCertificate')">
                    <label for="first-name">No. de Placa o Cédula Militar</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noPlateCertificate"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noPlateCertificate.required"
                    >Olvidaste ingresar el número de placa o cédula militar</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   

                  <label>DATOS DE LA INSTITUCIÓN QUE RECIBE LA DONACIÓN</label>

                  <md-field md-clearable :class="getValidationClass('name')">
                    <label for="first-name">Nombre</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.name"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.name.required"
                    >Olvidaste ingresar el nombre</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('legalStatus')">
                    <label for="first-name">Personería Jurídica</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.legalStatus"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.legalStatus.required"
                    >Olvidaste ingresar el nombre de la personería jurídica</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('address')">
                    <label for="first-name">Dirección</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.address"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.address.required"
                    >Olvidaste ingresar la dirección</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('representativeDonation')">
                    <label for="first-name">Representante Legal</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.representativeDonation"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.representativeDonation.required"
                    >Olvidaste ingresar la dirección</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('identification')">
                    <label for="first-name">C.C.</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.identification"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.identification.required"
                    >Olvidaste ingresar la cedula de ciudadania</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('municipality')">
                    <label for="first-name">Municipio</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.municipality"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.municipality.required"
                    >Olvidaste ingresar el nombre del municipio</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('corregimiento')">
                    <label for="first-name">Corregimiento</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.corregimiento"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.corregimiento.required"
                    >Olvidaste ingresar el nombre del corregimiento</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('place')">
                    <label for="first-name">Vereda</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.place"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.place.required"
                    >Olvidaste ingresar el nombre de la vereda</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>   
                  <md-field md-clearable :class="getValidationClass('telephone')">
                    <label for="first-name">Teléfono</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.telephone"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.telephone.required"
                    >Olvidaste ingresar el numero de télefono</span>
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
        noActa: "",
        nameScientific: "",
        observation: "",
        nameCommon: "",
        presentation: "",
        amount: "",
        weight: "",
        commercialValue: "",
        nameOfficial: "",
        noDocumentId1: "",
        nameRepresentative: "",
        noDocumentId2: "",
        noPlateCertificate: "",
        name: "",
        legalStatus: "",
        address: "",
        representativeDonation: "",
        identification: "",
        municipality: "",
        corregimiento: "",
        place: "",
        telephone: "",
      
      },
      

      arrayDonationCertificate: [],
      id_donationCertificate: 0,

      arrayRegional: {id:0, name:''},
	    arrayRegl: [],
      id_regional: 0,

      date: format(now, dateFormat),

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
      noActa: {
        required
      },
      nameScientific: {
        required
      },
      nameCommon: {
        required
      },
      presentation: {
        required
      },
      amount: {
        required
      },
      weight: {
        required
      },
      commercialValue: {
        required
      },
      nameOfficial: {
        required
      },
      noDocumentId1: {
        required
      },
      noDocumentId2: {
        required
      },
      nameRepresentative: {
        required
      },
      noPlateCertificate: {
        required
      },
      name: {
        required
      },
      legalStatus: {
        required
      },
      address: {
        required
      },
      representativeDonation: {
        required
      },
      identification: {
        required
      },
      municipality: {
        required
      },
      corregimiento: {
        required
      },
      place: {
        required
      },
      telephone: {
        required
      },
      observation: {
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
      this.form.noActa = null;
      this.form.nameScientific = null;
      this.form.observation = null;
      this.form.nameCommon = null;
      this.form.presentation = null;
      this.form.amount = null;
      this.form.weight = null;
      this.form.commercialValue = null;
      this.date = null;
      this.form.nameOfficial = null;
      this.form.noDocumentId1 = null;
      this.form.nameRepresentative = null;
      this.form.noDocumentId2 = null;
      this.form.noPlateCertificate = null;
      this.form.name = null;
      this.form.legalStatus = null;
      this.form.address = null;
      this.form.representativeDonation = null;
      this.form.identification = null;
      this.form.municipality = null;
      this.form.corregimiento = null;
      this.form.place = null;
      this.form.telephone = null;
      
      this.arrayRegl = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_donationCertificate = data["id"]);
      this.form.noActa = data["noActa"];
      this.form.nameScientific = data["nameScientific"];
      this.form.observation = data["observation"];
      this.form.nameCommon = data["nameCommon"];
      this.form.presentation = data["presentation"];
      this.form.amount = data["amount"];
      this.form.weight = data["weight"];
      this.form.commercialValue = data["commercialValue"];
      this.date = data["date"];
      this.form.nameOfficial = data["nameOfficial"];
      this.form.noDocumentId1 = data["noDocumentId1"];
      this.form.nameRepresentative = data["nameRepresentative"];
      this.form.noDocumentId2 = data["noDocumentId2"];
      this.form.noPlateCertificate = data["noPlateCertificate"];
      this.form.name = data["name"];
      this.form.legalStatus = data["legalStatus"];
      this.form.address = data["address"];
      this.form.representativeDonation = data["representativeDonation"];
      this.form.identification = data["identification"];
      this.form.municipality = data["municipality"];
      this.form.corregimiento = data["corregimiento"];
      this.form.place = data["place"];
      this.form.telephone = data["telephone"];
    
      this.arrayRegl.id = data["id_regional"];
	    this.arrayRegl.name = data["nameRegional"];
    },
    nameWithRegional ({ name }) {
            return `${name}`
    },
    selectRegional() {
            let me = this;
            var url = "/donationCertificates/selectRegional";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegional= respuesta.regional;
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
        "/donationCertificates";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayDonationCertificate = respuesta.donations.data;
          me.myTable(me.arrayDonationCertificate);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/donationCertificates/save", {
    
        noActa: this.form.noActa.toUpperCase(),
        nameScientific: this.form.nameScientific.toUpperCase(),
        nameCommon: this.form.nameCommon.toUpperCase(),
        observation: this.form.observation,
        presentation: this.form.presentation.toUpperCase(),
        amount: this.form.amount.toUpperCase(),
        weight: this.form.weight.toUpperCase(),
        commercialValue: this.form.commercialValue.toUpperCase(),
        date: this.date,
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        noDocumentId1: this.form.noDocumentId1,
        nameRepresentative: this.form.nameRepresentative.toUpperCase(),
        noDocumentId2: this.form.noDocumentId2,
        noPlateCertificate: this.form.noPlateCertificate.toUpperCase(),
        name: this.form.name.toUpperCase(),
        legalStatus: this.form.legalStatus.toUpperCase(),
        address: this.form.address.toUpperCase(),
        representativeDonation: this.form.representativeDonation.toUpperCase(),
        identification: this.form.identification,
        municipality: this.form.municipality.toUpperCase(),
        corregimiento: this.form.corregimiento.toUpperCase(),
        place: this.form.place.toUpperCase(),
        telephone: this.form.telephone,
       
        'id_regional': this.arrayRegl.id,
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
        .put("/donationCertificates/update", {
        id: this.id_donationCertificate,
        noActa: this.form.noActa.toUpperCase(),
        nameScientific: this.form.nameScientific.toUpperCase(),
        observation: this.form.observation,
        nameCommon: this.form.nameCommon.toUpperCase(),
        presentation: this.form.presentation.toUpperCase(),
        amount: this.form.amount.toUpperCase(),
        weight: this.form.weight.toUpperCase(),
        commercialValue: this.form.commercialValue.toUpperCase(),
        date: this.date,
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        noDocumentId1: this.form.noDocumentId1,
        nameRepresentative: this.form.nameRepresentative.toUpperCase(),
        noDocumentId2: this.form.noDocumentId2,
        noPlateCertificate: this.form.noPlateCertificate.toUpperCase(),
        name: this.form.name.toUpperCase(),
        legalStatus: this.form.legalStatus.toUpperCase(),
        address: this.form.address.toUpperCase(),
        representativeDonation: this.form.representativeDonation.toUpperCase(),
        identification: this.form.identification,
        municipality: this.form.municipality.toUpperCase(),
        corregimiento: this.form.corregimiento.toUpperCase(),
        place: this.form.place.toUpperCase(),
        telephone: this.form.telephone,
       
        'id_regional': this.arrayRegl.id,
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
        title: "Esta seguro de Eliminar la Donación " + data["name"],
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
            .post("/donationCertificates/delete", {
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

            { "data": "noActa" },
            { "data": "nameRegional" },
            { "data": "nameScientific" },
            { "data": "nameCommon" },
            { "data": "presentation" },
            { "data": "amount" },
            { "data": "weight" },
            { "data": "commercialValue" },
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
    this.selectRegional();
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
