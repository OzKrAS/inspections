<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card"  style="width: 100%">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato de Aviso Previo de arribo de Buque</strong>          
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
                    <md-field>
                      <label class="text-muted">Tipo de pesqueria</label>
                      <md-select v-model="typeFishery" name="typeFishery" id="typeFishery" placeholder="Tipo de pesqueria">
                        <md-option value="atun">Atún</md-option>
                        <md-option value="pesca Blanca">Pesca Blanca</md-option>
                        <md-option value="camaron">Camarónn</md-option>
                        <md-option value="otros">Otros</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label class="text-muted">Puerto de Zarpe Previsto</label>
                      <multiselect v-model="arrayPt" :options="arrayPort"
                          placeholder="Puerto de zarpe previsto"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>     
                <div class="md-layout">
                  <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="date"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Última Escala</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="datePlanned"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Prevista de Zarpe</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('time')">
                    <label for="first-name">Hora Prevista de Zarpe</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.time"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.time.required"
                    >Olvidaste ingresar la hora prevista del zarpe</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('portState')">
                    <label for="first-name">Estado Rector del Puerto</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.portState"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.portState.required"
                    >Olvidaste ingresar el estado rector del puerto</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                      <label class="text-muted">Puerto de la Úlitma Escala</label>
                      <multiselect v-model="arrayPtScale" :options="arrayPort"
                          placeholder="Puerto de la Última Escala"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp; 
                  <md-field md-clearable :class="getValidationClass('nameBoat')">
                    <label for="first-name">Nombre del Buque</label>
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
                    >Olvidaste ingresar el nombre del buque</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('statePavilion')">
                    <label for="first-name">Estado del Pabellón</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.statePavilion"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.statePavilion.required"
                    >Olvidaste ingresar el estado del pabellón</span>
                  </md-field>
                  <div class="md-layout-item">
                    <md-field>
                        <label class="text-muted">Tipo de Buque</label>
                      <md-select v-model="typeBoat" name="typeBoat" id="typeBoat" placeholder="Tipo de Buque">
                        <md-option value="pesquero">Pesquero</md-option>
                        <md-option value="carga">Carga</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('internationalSignal')">
                    <label for="first-name">Señal de Llamada Internacional</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.internationalSignal"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.internationalSignal.required"
                    >Olvidaste ingresar la señal de llamada internacional</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>        
                  <md-field md-clearable :class="getValidationClass('informationBoat')">
                    <label for="first-name">Información de Contacto del Buque</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.informationBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.informationBoat.required"
                    >Olvidaste ingresar la información de contacto del buque</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                          
                  <md-field md-clearable :class="getValidationClass('ownerBoat')">
                    <label for="first-name">Propietario(s) del Buque</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.ownerBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.ownerBoat.required"
                    >Olvidaste ingresar el nombre del propietario</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                          
                  <md-field md-clearable :class="getValidationClass('idEnrollment')">
                    <label for="first-name">Identificador del Certificado de Matrícula</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.idEnrollment"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.idEnrollment.required"
                    >Olvidaste ingresar el identificador del certificado de matrícula</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                          
                  <md-field md-clearable :class="getValidationClass('idOmi')">
                    <label for="first-name">Identificador OMI del Buque</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.idOmi"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.idOmi.required"
                    >Olvidaste ingresar el identificador OMI</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                          
                  <md-field md-clearable :class="getValidationClass('idExternal')">
                    <label for="first-name">Identificador Externo</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.idExternal"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.idExternal.required"
                    >Olvidaste ingresar el identificador externo</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                          
                  <md-field md-clearable :class="getValidationClass('idOrop')">
                    <label for="first-name">Identificador de la OROP</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.idOrop"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.idOrop.required"
                    >Olvidaste ingresar el identificador de la OROP</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">SLB/VMS</label>
                      <md-select v-model="slbVms" name="slbVms" id="slbVms" placeholder="SLB/VMS">
                        <md-option value="no">No</md-option>
                        <md-option value="nacional">Nacional</md-option>
                        <md-option value="orop">OROP</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('type')">
                    <label for="first-name">Tipo</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.type"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.type.required"
                    >Olvidaste ingresar el tipo</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>

                  <label>DIMENSIONES DEL BUQUE</label>     

                  <md-field md-clearable :class="getValidationClass('lengthBoat')">
                    <label for="first-name">Eslora</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.lengthBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.lengthBoat.required"
                    >Olvidaste ingresar la medida de la eslora</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                    
                  <md-field md-clearable :class="getValidationClass('sleeveBoat')">
                    <label for="first-name">Manga</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.sleeveBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.sleeveBoat.required"
                    >Olvidaste ingresar la medida de la manga</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                    
                  <md-field md-clearable :class="getValidationClass('draftBoat')">
                    <label for="first-name">Calado</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.draftBoat"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.draftBoat.required"
                    >Olvidaste ingresar la medida del calado</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>                    
                  <md-field md-clearable :class="getValidationClass('nameCaptain')">
                    <label for="first-name">Nombre del Capitán</label>
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
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field> 
                  <div class="md-layout-item">
                      <label class="text-muted">Nacionalidad</label>
                      <multiselect v-model="arrayNation" :options="arrayNationality"
                          placeholder="Seleccione una Nacionalidad"
                          :custom-label="nameWithNationality"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('noIdentification')">
                    <label for="first-name">No. Identificación</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noIdentification"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noIdentification.required"
                    >Olvidaste ingresar el número de identificación</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>    

                  <label>AUTORIZACIONES DE PESCA PERTINENTES</label>

                  <md-field md-clearable :class="getValidationClass('identifier')">
                    <label for="first-name">Identificador</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.identifier"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.identifier.required"
                    >Olvidaste ingresar el identificador</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <div class="md-layout-item">
                      <div>
                        <md-datepicker 
                          v-model="dateExp"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha de Expedición</label>
                        </md-datepicker>
                      </div>
                  </div> &nbsp;&nbsp;&nbsp;                
                  <div class="md-layout-item">
                      <div>
                        <md-datepicker 
                          v-model="dateExpiration"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha de Vencimiento</label>
                        </md-datepicker>
                      </div>
                  </div> &nbsp;&nbsp;&nbsp;    
                  <md-field md-clearable :class="getValidationClass('fishingAreas')">
                    <label for="first-name">Áreas de pesca</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.fishingAreas"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.fishingAreas.required"
                    >Olvidaste ingresar el nombre de las áreas de pesca</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>            
                  <md-field md-clearable :class="getValidationClass('species')">
                    <label for="first-name">Especies</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.species"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.species.required"
                    >Olvidaste ingresar el nombre de las especies</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>            
                  <md-field md-clearable :class="getValidationClass('arts')">
                    <label for="first-name">Artes</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.arts"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.arts.required"
                    >Olvidaste ingresar el nombre de las artes</span>
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
          time: "",
          portState: "",
          nameBoat: "", 
          statePavilion: "", 
          internationalSignal: "",
          informationBoat: "", 
          ownerBoat: "", 
          idEnrollment: "", 
          idOmi: "", 
          idExternal: "", 
          idOrop: "", 
          type: "", 
          lengthBoat: "", 
          sleeveBoat: "", 
          draftBoat: "", 
          nameCaptain: "", 
          noIdentification: "", 
          identifier: "", 
          fishingAreas: "", 
          species: "", 
          arts: "", 
      },

      typeFishery: "",
      date: format(now, dateFormat),
      datePlanned: format(now, dateFormat),
      typeBoat: "",
      slbVms: "",
      dateExp: format(now, dateFormat),
      dateExpiration: format(now, dateFormat),

      arrayNoticePreviousZarpe: [],
      id_noticePreviousZarpe: 0,

      arrayPt: {id:0,namePort:'',name:''},
      arrayPtScale: {id:0, namePort:'',name:''},
	    arrayPort: [],
      id_port: 0,
      id_port_scale: 0,
      arrayNation: {id:0, name:''},
	    arrayNationality: [],
      id_nationality: 0,

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
        time: {
          required
        },
        portState: {
          required
        },
        nameBoat: {
            required
        },  
        statePavilion: {
            required
        },  
        internationalSignal: {
          required
        },  
        informationBoat: {
          required
        },  
        ownerBoat: {
          required
        },  
        idEnrollment: {
          required
        },  
        idOmi: {
          required
        },  
        idExternal: {
          required
        },  
        idOrop: {
          required
        },     
        type: {
          required
        },  
        lengthBoat: {
          required
        },  
        sleeveBoat: {
          required
        },  
        draftBoat: {
          required
        },  
        nameCaptain: {
          required
        },  
        noIdentification: {
          required
        },  
        identifier: {
          required
        },  
        fishingAreas: {
          required
        },  
        species: {
          required
        },  
        arts: {
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
      this.form.time = null;
      this.date = null;
      this.typeFishery = null;
      this.datePlanned = null;
      this.form.portState = null;
      this.form.nameBoat = null;
      this.form.statePavilion = null;
      this.typeBoat = null;
      this.form.internationalSignal = null;
      this.form.informationBoat = null;
      this.form.ownerBoat = null;
      this.form.idEnrollment = null;
      this.form.idOmi = null;
      this.form.idExternal = null;
      this.form.idOrop = null;
      this.slbVms = null;
      this.form.type = null;
      this.form.lengthBoat = null;
      this.form.sleeveBoat = null;
      this.form.draftBoat = null;
      this.form.nameCaptain = null;
      this.form.noIdentification = null;
      this.form.identifier = null;
      this.dateExp = null;
      this.dateExpiration = null;
      this.form.fishingAreas = null;
      this.form.species = null;
      this.form.arts = null;
  
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtScale = {id:0, namePort:'',name:''};
      this.arrayNation = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_noticePreviousZarpe = data["id"]);
      this.form.time = data["time"];
      this.date = data["date"];
      this.typeFishery = data["typeFishery"];
      this.datePlanned = data["datePlanned"];
      this.form.portState = data["portState"];
      this.form.nameBoat = data["nameBoat"];
      this.form.statePavilion = data["statePavilion"];
      this.typeBoat = data["typeBoat"];
      this.form.internationalSignal = data["internationalSignal"];
      this.form.informationBoat = data["informationBoat"];
      this.form.ownerBoat = data["ownerBoat"];
      this.form.idEnrollment = data["idEnrollment"];
      this.form.idOmi = data["idOmi"];
      this.form.idExternal = data["idExternal"];
      this.form.idOrop = data["idOrop"];
      this.slbVms = data["slbVms"];
      this.form.type = data["type"];
      this.form.lengthBoat = data["lengthBoat"];
      this.form.sleeveBoat = data["sleeveBoat"];
      this.form.draftBoat = data["draftBoat"];
      this.form.nameCaptain = data["nameCaptain"];
      this.form.noIdentification = data["noIdentification"];
      this.form.identifier = data["identifier"];
      this.dateExp = data["dateExp"];
      this.dateExpiration = data["dateExpiration"];
      this.form.fishingAreas = data["fishingAreas"];
      this.form.species = data["species"];
      this.form.arts = data["arts"];
       
      this.arrayPt.id = data["id_port"];
      this.arrayPt.name = data["namePort"];
      this.arrayPtScale.id = data["id_port"];
      this.arrayPtScale.name = data["namePort"];
      this.arrayNation.id = data["id_nationality"];
			this.arrayNation.name = data["nameNationality"];
    },
    // nameWithPort ({ name }) {
    //         return `${name}`
    // },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    nameWithNationality ({ name }) {
            return `${name}`
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
    selectNationality() {
            let me = this;
            var url = "/noticePreviousZarpe/selectNationality";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNationality = respuesta.nationality;
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
    
        time: this.form.time,
        date: this.date,
        typeFishery: this.typeFishery,
        datePlanned: this.datePlanned,
        portState: this.form.portState.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        statePavilion: this.form.statePavilion.toUpperCase(),
        typeBoat: this.typeBoat.toUpperCase(),
        internationalSignal: this.form.internationalSignal.toUpperCase(),
        informationBoat: this.form.informationBoat.toUpperCase(),
        ownerBoat: this.form.ownerBoat.toUpperCase(),
        idEnrollment: this.form.idEnrollment.toUpperCase(),
        idOmi: this.form.idOmi.toUpperCase(),
        idExternal: this.form.idExternal.toUpperCase(),
        idOrop: this.form.idOrop.toUpperCase(),
        slbVms: this.slbVms.toUpperCase(),
        type: this.form.type.toUpperCase(),
        lengthBoat: this.form.lengthBoat,
        sleeveBoat: this.form.sleeveBoat,
        draftBoat: this.form.draftBoat,
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        noIdentification: this.form.noIdentification.toUpperCase(),
        identifier: this.form.identifier.toUpperCase(),
        dateExp: this.dateExp,
        dateExpiration: this.dateExpiration,
        fishingAreas: this.form.fishingAreas.toUpperCase(),
        species: this.form.species.toUpperCase(),
        arts: this.form.arts.toUpperCase(),
    
        'id_port': this.arrayPt.id,
        'id_port_scale': this.arrayPtScale.id,
        'id_nationality': this.arrayNation.id,
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
        time: this.form.time,
        date: this.date,
        typeFishery: this.typeFishery,
        datePlanned: this.datePlanned,
        portState: this.form.portState.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        statePavilion: this.form.statePavilion.toUpperCase(),
        typeBoat: this.typeBoat.toUpperCase(),
        internationalSignal: this.form.internationalSignal.toUpperCase(),
        informationBoat: this.form.informationBoat.toUpperCase(),
        ownerBoat: this.form.ownerBoat.toUpperCase(),
        idEnrollment: this.form.idEnrollment.toUpperCase(),
        idOmi: this.form.idOmi.toUpperCase(),
        idExternal: this.form.idExternal.toUpperCase(),
        idOrop: this.form.idOrop.toUpperCase(),
        slbVms: this.slbVms.toUpperCase(),
        type: this.form.type.toUpperCase(),
        lengthBoat: this.form.lengthBoat,
        sleeveBoat: this.form.sleeveBoat,
        draftBoat: this.form.draftBoat,
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        noIdentification: this.form.noIdentification.toUpperCase(),
        identifier: this.form.identifier.toUpperCase(),
        dateExp: this.dateExp,
        dateExpiration: this.dateExpiration,
        fishingAreas: this.form.fishingAreas.toUpperCase(),
        species: this.form.species.toUpperCase(),
        arts: this.form.arts.toUpperCase(),
    
        'id_port': this.arrayPt.id,
        'id_port_scale': this.arrayPtScale.id,
        'id_nationality': this.arrayNation.id,
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
            { "data": "time" },
            { "data": "informationBoat" },
            { "data": "datePlanned" },
            { "data": "nameBoat" },
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
    this.selectNationality();
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
