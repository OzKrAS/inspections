<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato Inspección Embarcación de Carga</strong>          
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
                    <th>No. Formulario</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Total Carga (Ton.)</th>
                    <th>Nombre Embarcación de Carga</th>
                    <th>Nombre Representante</th>
                    <th>Notificación Previa</th>
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Formulario</th>
                      <th>Lugar</th>
                      <th>Fecha</th>
                      <th>Total Carga (Ton.)</th>
                      <th>Nombre Embarcación de Carga</th>
                      <th>Nombre Representante</th>
                      <th>Notificación Previa</th>
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
                  <div class="md-layout-item md-size-70">
                    <md-field md-clearable :class="getValidationClass('noForm')">
                      <label for="first-name">No. Formulario</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.noForm"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.noForm.required"
                      >Olvidaste ingresar el número de formulario</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('place')">
                      <label for="first-name">lugar</label>
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
                      >Olvidaste ingresar el lugar</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-16">
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('businessColombia')">
                      <label for="first-name">Empresa Colombia</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.businessColombia"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.businessColombia.required"
                      >Olvidaste ingresar nombre de la empresa</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
                    <md-field md-clearable :class="getValidationClass('fullCargo')">
                      <label for="first-name">Total Carga (Ton.)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.fullCargo"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.fullCargo.required"
                      >Olvidaste ingresar nombre de la empresa</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-70">
                    <md-field md-clearable :class="getValidationClass('nameBoatCargo')">
                      <label for="first-name">Nombre Embarcación de Carga</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameBoatCargo"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nameBoatCargo.required"
                      >Olvidaste ingresar el nombre de la embarcación</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Transbordo de la Carga</label>
                      <multiselect v-model="arrayPt" :options="arrayPort"
                          placeholder="Seleccione puerto de transbordo de la carga"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
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
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Zarpe</label>
                      <multiselect v-model="arrayPtZarpe" :options="arrayPort"
                          placeholder="Seleccione puerto de zarpe"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Desembarque</label>
                      <multiselect v-model="arrayPtDisemb" :options="arrayPort"
                          placeholder="Seleccione puerto de desembarque"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp; 
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Área de Operación</label>
                      <md-select v-model="areaOperation" name="areaOperation" id="areaOperation" placeholder="Área de operación">
                        <md-option value="atlantico">Atlantico</md-option>
                        <md-option value="pacifico - OPO">Pacifico - OPO</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <md-select v-model="notification" name="notification" id="notification" placeholder="Notificación Previa">
                        <md-option value="si">Si</md-option>
                        <md-option value="no">No</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                
                <label>INFORMACIÓN DE TRANSBORDO SOBRE EMBARCACIONES DONANTES</label>

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
                      >Olvidaste ingresar el nombre de la embarcación</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Bandera</label>
                        <multiselect v-model="arrayFgDonor" :options="arrayFlag"
                            placeholder="Seleccione una bandera"
                            :custom-label="nameWithFlag"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noIdOmi')">
                      <label for="first-name">No. Identificador (OMI)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.noIdOmi"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.noIdOmi.required"
                      >Olvidaste ingresar el identificador (OMI)</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('placeTransfer')">
                      <label for="first-name">Lugra de transbordo</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.placeTransfer"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.placeTransfer.required"
                      >Olvidaste ingresar el lugar de transbordo</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <div>
                        <md-datepicker 
                          v-model="dateTransfer"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                        >
                          <label>Fecha de Transbordo</label>
                        </md-datepicker>
                      </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('areasCapture')">
                      <label for="first-name">Áreas de Captura</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.areasCapture"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.areasCapture.required"
                      >Olvidaste ingresar el nombre de las áreas de captura</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                
                <label>PRODUCTO POR ESPECIE (TON.)</label>

                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('species')">
                      <label for="first-name">Especie</label>
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
                      >Olvidaste ingresar el nombre de la especie</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('shapeProduct')">
                      <label for="first-name">Forma del Producto</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.shapeProduct"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.shapeProduct.required"
                      >Olvidaste ingresar el número de indentidad</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-15">
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-21">
                    <md-field md-clearable :class="getValidationClass('productLanded')">
                      <label for="first-name">Total Producto Desembarcado</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.productLanded"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.productLanded.required"
                      >Olvidaste ingresar el número de identidad</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field> 
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameCaptain')">
                      <label for="first-name">Nombre Capitán Barco Carguero</label>
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
                      >Olvidaste ingresar el nombre del capitán del barco</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field> 
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameBusiness')">
                      <label for="first-name">Nombre Empresa Responsable</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameBusiness"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nameBusiness.required"
                      >Olvidaste ingresar el nombre de la empresa responsable</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">  
                  <div class="md-layout-item">       
                    <md-field>
                          <label>Observaciones</label>
                          <md-textarea v-model="observation"></md-textarea>
                    </md-field> 
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
    return {
      form: {
        place: "",
        noForm: "",
        businessColombia: "",
        fullCargo: "",
        nameBoatCargo: "",
        nameBoat: "",
        noIdOmi: "",
        placeTransfer: "",
        areasCapture: "",
        species: "",
        shapeProduct: "",
        amount: "",
        productLanded: "",
        nameOfficial: "",
        nameCaptain: "",
        nameBusiness: "",
      
      },
      
      date: format(now, dateFormat),
      dateTransfer: format(now, dateFormat),
      notification: "",
      areaOperation: "",
      observation: "",

      arrayInspectionBoatCargo: [],
      id_inspectionBoatCargo: 0,

      arrayPt: {id:0, namePort:'',name:''},
	    arrayPort: [],
      id_port: 0,
      arrayPtZarpe: {id:0, namePort:'',name:''},
      id_portZarpe: 0,
      arrayPtDisemb: {id:0, namePort:'',name:''},
      id_disemb: 0,
      arrayFg: {id:0, name:''},
      arrayFgDonor: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      id_flagDonor: 0,

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
      place: {
        required
      },
      noForm: {
        required
      },
      businessColombia: {
        required
      },
      fullCargo: {
        required
      },
      nameBoatCargo: {
        required
      },
      nameBoat: {
        required
      },
      noIdOmi: {
        required
      },
      placeTransfer: {
        required
      },
      areasCapture: {
        required
      },
      species: {
        required
      },
      shapeProduct: {
        required
      },
      amount: {
        required
      },
      productLanded: {
        required
      },
      nameOfficial: {
        required
      },
      nameCaptain: {
        required
      },
      nameBusiness: {
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
      this.form.place = null;
      this.date = null;
      this.form.noForm = null;
      this.form.businessColombia = null;
      this.form.fullCargo = null;
      this.form.nameBoatCargo = null;
      this.areaOperation = null;
      this.notification = null;
      this.form.nameBoat = null;
      this.form.noIdOmi = null;
      this.form.placeTransfer = null;
      this.dateTransfer = null;
      this.form.areasCapture = null;
      this.form.species = null;
      this.form.shapeProduct = null;
      this.form.amount = null;
      this.form.productLanded = null;
      this.form.nameOfficial = null;
      this.form.nameCaptain = null;
      this.form.nameBusiness = null;
      this.observation = null;
      
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtDisemb = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayFgDonor = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_inspectionBoatCargo = data["id"]);
      this.form.place = data["place"];
      this.date = data["date"];
      this.form.noForm = data["noForm"];
      this.form.businessColombia = data["businessColombia"];
      this.form.fullCargo = data["fullCargo"];
      this.form.nameBoatCargo = data["nameBoatCargo"];
      this.areaOperation = data["areaOperation"];
      this.notification = data["notification"];
      this.form.nameBoat = data["nameBoat"];
      this.form.noIdOmi = data["noIdOmi"];
      this.form.placeTransfer = data["placeTransfer"];
      this.dateTransfer = data["dateTransfer"];
      this.form.areasCapture = data["areasCapture"];
      this.form.species = data["species"];
      this.form.shapeProduct = data["shapeProduct"];
      this.form.amount = data["amount"];
      this.form.productLanded = data["productLanded"];
      this.form.nameOfficial = data["nameOfficial"];
      this.form.nameCaptain = data["nameCaptain"];
      this.form.nameBusiness = data["nameBusiness"];
      this.observation = data["observation"];

      this.arrayPt.id = data["id_port"];
      this.arrayPt.name = data["namePort"];
      this.arrayPtZarpe.id = data["id_portZarpe"];
			this.arrayPtZarpe.name = data["namePort"];
      this.arrayPtDisemb.id = data["id_portDisemb"];
			this.arrayPtDisemb.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
	    this.arrayFg.name = data["nameFlag"];
      this.arrayFgDonor.id = data["id_flagDonor"];
	    this.arrayFgDonor.name = data["nameFlag"];
    },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    selectFlag() {
            let me = this;
            var url = "inspectionBoatCargo/selectFlags";
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
        "/inspectionBoatCargo";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayInspectionBoatCargo = respuesta.inspections.data;
          me.myTable(me.arrayInspectionBoatCargo);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/inspectionBoatCargo/save", {
    
        place: this.form.place.toUpperCase(),
        date: this.date,
        noForm: this.form.noForm.toUpperCase(),
        businessColombia: this.form.businessColombia.toUpperCase(),
        fullCargo: this.form.fullCargo,
        nameBoatCargo: this.form.nameBoatCargo.toUpperCase(),
        areaOperation: this.areaOperation.toUpperCase(),
        notification: this.notification.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        noIdOmi: this.form.noIdOmi.toUpperCase(),
        placeTransfer: this.form.placeTransfer.toUpperCase(),
        dateTransfer: this.dateTransfer.toUpperCase(),
        areasCapture: this.form.areasCapture.toUpperCase(),
        species: this.form.species.toUpperCase(),
        shapeProduct: this.form.shapeProduct,
        amount: this.form.amount.toUpperCase(),
        productLanded: this.form.productLanded.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        nameBusiness: this.form.nameBusiness.toUpperCase(),
        observation: this.observation.toUpperCase(),
       
        'id_port': this.arrayPt.id,
        'id_portZarpe': this.arrayPtZarpe.id,
        'id_portDisemb': this.arrayPtDisemb.id,
        'id_flag': this.arrayFg.id,
        'id_flagDonor': this.arrayFgDonor.id,
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
        .put("/inspectionBoatCargo/update", {
        id: this.id_inspectionBoatCargo,
        place: this.form.place.toUpperCase(),
        date: this.date,
        noForm: this.form.noForm.toUpperCase(),
        businessColombia: this.form.businessColombia.toUpperCase(),
        fullCargo: this.form.fullCargo,
        nameBoatCargo: this.form.nameBoatCargo.toUpperCase(),
        areaOperation: this.areaOperation.toUpperCase(),
        notification: this.notification.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        noIdOmi: this.form.noIdOmi.toUpperCase(),
        placeTransfer: this.form.placeTransfer.toUpperCase(),
        dateTransfer: this.dateTransfer.toUpperCase(),
        areasCapture: this.form.areasCapture.toUpperCase(),
        species: this.form.species.toUpperCase(),
        shapeProduct: this.form.shapeProduct,
        amount: this.form.amount.toUpperCase(),
        productLanded: this.form.productLanded.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        nameBusiness: this.form.nameBusiness.toUpperCase(),
        observation: this.observation.toUpperCase(),
       
        'id_port': this.arrayPt.id,
        'id_portZarpe': this.arrayPtZarpe.id,
        'id_portDisemb': this.arrayPtDisemb.id,
        'id_flag': this.arrayFg.id,
        'id_flagDonor': this.arrayFgDonor.id,
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
        title: "Esta seguro de Eliminar esta Inspección " + data["name"],
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
            .post("/inspectionBoatCargo/delete", {
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

            { "data": "noForm" },
            { "data": "place" },
            { "data": "date" },
            { "data": "fullCargo" },
            { "data": "nameBoatCargo" },
            { "data": "nameOfficial" },
            { "data": "notification" },
            
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
