<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Acta de Decomiso Preventivo</strong>          
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
                    <th>Regional</th>
                    <th>Oficina</th>
                    <th>Funcionario</th>
                    <th>Embarcación</th>
                    <th>Matrícula</th>
                    <th>Pesquería Autorizada</th>
                    <th>Patente de Pesca</th>
                    <th>Empresa</th>
                    <th>Armador</th>
                    <th>Capitán de Pesca</th>
                    <th>Localización</th>
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>Fecha</th>
                      <th>Regional</th>
                      <th>Oficina</th>
                      <th>Funcionario</th>
                      <th>Embarcación</th>
                      <th>Matrícula</th>
                      <th>Pesquería Autorizada</th>
                      <th>Patente de Pesca</th>
                      <th>Empresa</th>
                      <th>Armador</th>
                      <th>Capitán de Pesca</th>
                      <th>Localización</th>
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
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('departament')">
                    <label for="first-name">Departamento</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.departament"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.departament.required"
                     >Olvidaste ingresar el nombre del departamento</span>
                  </md-field>
                  <div class="md-layout-item">
                      <label>Municipio</label>
                      <multiselect v-model="arrayMpality" :options="arrayMunicipality"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithMunicipality"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field>
                        <md-textarea v-model="form.text"></md-textarea>
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
                  <div class="md-layout-item">
                    <md-field>
                      <md-select v-model="state" name="national" id="national" placeholder="Estado">
                        <md-option value="fresco entero">Fresco entero</md-option>
                        <md-option value="fresco eviscerado ">Fresco eviscerado </md-option>
                        <md-option value="congelado entero">Congelado entero </md-option>
                        <md-option value="congelado eviscerado">Congelado eviscerado</md-option>
                        <md-option value="descabezado">Descabezado</md-option>
                        <md-option value="tronco">Tronco</md-option>
                        <md-option value="aletas">Aletas</md-option>
                        <md-option value="seco">Seco</md-option>
                        <md-option value="vivos">Vivos</md-option>
                        <md-option value="otros">Otros</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <div class="md-layout-item">
                    <md-field>
                      <md-select v-model="presentation" name="national" id="national" placeholder="presentación">
                        <md-option value="unidades">Unidades</md-option>
                        <md-option value="zartas ">Zartas </md-option>
                        <md-option value="bolsas o bultos">Bolsas o Bultos </md-option>
                        <md-option value="canastas">Canastas</md-option>
                        <md-option value="grupos">Grupos</md-option>
                        <md-option value="otros">Otros</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('amount')">
                    <label for="first-name">Cantidad (Un)</label>
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
                  <md-field md-clearable :class="getValidationClass('average')">
                    <label for="first-name">Promedio Talla (Cm)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.average"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.average.required"
                    >Olvidaste ingresar el promedio talla</span>
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
                  <md-field>
                        <md-textarea v-model="form.text2"></md-textarea>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('element')">
                    <label for="first-name">Elemento</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.element"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.element.required"
                     >Olvidaste ingresar el nombre del elemento</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('amount2')">
                    <label for="first-name">Cantidad (Un)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.amount2"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.amount2.required"
                    >Olvidaste ingresar la cantidad</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('featuresState')">
                    <label for="first-name">Características y Estado</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.featuresState"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.featuresState.required"
                    >Olvidaste ingresar las características y estado</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('commercialValue2')">
                    <label for="first-name">Valor Comercial</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.commercialValue2"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.commercialValue2.required"
                    >Olvidaste ingresar el valor comercial</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                  <md-field>
                        <md-textarea v-model="form.text3"></md-textarea>
                  </md-field>

                  <!-- MOTIVOS DEL DECOMISO PREVENTIVO -->

                  <label>Los recursos, productos pesqueros y/o elementos fueron decomisados cuendo se encontraban en(describa la situación):</label>
                  <md-field>
                        <md-textarea v-model="form.text4"></md-textarea>
                  </md-field>

                  <label>Para constancia se firma la presente acta por cada uno de los que intervienen en el decomiso preventivo.</label>
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
                  <md-field md-clearable :class="getValidationClass('officialName')">
                    <label for="first-name">Nombre Funcionario AUNAP</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.officialName"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.officialName.required"
                     >Olvidaste ingresar el nombre del funcionario de la AUNAP</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('documentIdOfficial')">
                    <label for="first-name">Documento de Identidad</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.documentIdOfficial"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.documentIdOfficial.required"
                     >Olvidaste ingresar el documento de identidad</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('representativeName')">
                    <label for="first-name">Nombre Representante Autoridad Acompañante</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.representativeName"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.representativeName.required"
                     >Olvidaste ingresar el nombre representante autoridad acompañante</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('documentIdRepresentative')">
                    <label for="first-name">Documento de Identidad</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.documentIdRepresentative"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.documentIdRepresentative.required"
                     >Olvidaste ingresar el documento de identidad</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('plateCertificate')">
                    <label for="first-name">No. Placa o Cedula</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.plateCertificate"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.plateCertificate.required"
                     >Olvidaste ingresar la placa o cedula</span>
                  </md-field>

                  <label>DATOS DEL PRESUNTO INFRACTOR</label>

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
                     >Olvidaste ingresar el nombre del infractor</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('documentIdOffender')">
                    <label for="first-name">Documento de Identidad</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.documentIdOffender"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.documentIdOffender.required"
                     >Olvidaste ingresar el documento de identidad del infractor</span>
                  </md-field>
                  <div class="md-layout-item">
                    <div>
                        <md-datepicker 
                        v-model="dateExpedition"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Fecha de expediciòn C.C.</label>
                        </md-datepicker>
                    </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('expeditionPlace')">
                    <label for="first-name">Lugar de Expedidión C.C.</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.expeditionPlace"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.expeditionPlace.required"
                     >Olvidaste ingresar el lugar de expedición del documento de identidad</span>
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('homeAddress')">
                    <label for="first-name">Dirección de Domicilio</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.homeAddress"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.homeAddress.required"
                     >Olvidaste ingresar la dirección de domicilio</span>
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
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('neighborhood')">
                    <label for="first-name">Vereda</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.neighborhood"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.neighborhood.required"
                     >Olvidaste ingresar el nombre de la vereda</span>
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
                     >Olvidaste ingresar el número de teléfono</span>
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('mobile')">
                    <label for="first-name">Celular</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.mobile"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.mobile.required"
                     >Olvidaste ingresar el número de celular</span>
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('email')">
                    <label for="first-name">Correo Electrónico</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.email"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.email.required"
                     >Olvidaste ingresar el correo electrónico</span>
                  </md-field> 
                  <label>Observaciones</label>
                  <md-field>
                        <md-textarea v-model="form.observation"></md-textarea>
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
        departament: "",
        text: "",
        nameScientific: "",
        nameCommon: "",
        amount: "",
        average: "",
        weight: "",
        commercialValue: "",
        text2: "",
        element: "",
        amount2: "",
        featuresState: "",
        commercialValue2: "",
        text3: "",
        text4: "",
        officialName: "",
        documentIdOfficial: "",
        representativeName: "",
        documentIdRepresentative: "",
        plateCertificate: "",
        name: "",
        documentIdOffender: "",
        expeditionPlace: "",
        homeAddress: "",
        municipality: "",
        corregimiento: "",
        neighborhood: "",
        telephone: "",
      },

      state: "",
      presentation: "",
      date: format(now, dateFormat),
      dateExpedition: format(now, dateFormat),
      observation: "",
      

      arrayCheckDet: [],
      id_CheckDet: 0,
      arrayRegional: {id:0, name:''},
	  arrayRegl: [],
      id_regional: 0,
      arrayMunicipality: {id:0, name:''},
	  arrayMpality: [],
      id_municipality: 0,

      idCheckDelt: 0,

      edo:1,
      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayData: [],
      tipoAccion: 0
    };
  },

  validations: {
    form: {
      
      official:  {
        required
      },
      noActa:  {
        required
      },
        departament:  {
        required
      },
        text:  {
        required
      },
        nameScientific:  {
        required
      },
        nameCommon:  {
        required
      },
        amount:  {
        required
      },
        average:  {
        required
      },
        weight:  {
        required
      },
        commercialValue:  {
        required
      },
        text2:  {
        required
      },
        element:  {
        required
      },
        amount2:  {
        required
      },
        featuresState:  {
        required
      },
        commercialValue2:  {
        required
      },
        text3:  {
        required
      },
        text4:  {
        required
      },
        officialName:  {
        required
      },
        documentIdOfficial:  {
        required
      },
        representativeName:  {
        required
      },
        documentIdRepresentative:  {
        required
      },
        plateCertificate:  {
        required
      },
        name:  {
        required
      },
        documentIdOffender:  {
        required
      },
        expeditionPlace:  {
        required
      },
        homeAddress:  {
        required
      },
        municipality:  {
        required
      },
        corregimiento:  {
        required
      },
        neighborhood:  {
        required
      },
        telephone:  {
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
    alerta() {
       alert('test');
    },   
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
    
      this.form.office = null;
      

   
      this.arrayRegl = {id:0, name:''};
      this.arrayMunicipality = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_CheckDet = data["id"]);
      this.form.office = data["office"];
      this.form.official = data["official"];
      this.form.boat = data["boat"];
      this.form.enrollment = data["enrollment"];
      this.form.outhFhisher = data["outhFhisher"];
      this.form.fishLicense = data["fishLicense"];
      this.form.owner = data["owner"];
      this.form.fishCaptain = data["fishCaptain"];
      this.form.location = data["location"];
      this.date = data["date"];

      this.arrayComp.id = data["id_company"];
			this.arrayComp.name = data["nameCompany"];
      this.arrayRegl.id = data["id_regional"];
			this.arrayRegl.name = data["nameRegional"];
    },
    nameWithRegional ({ name }) {
            return `${name}`
    },
    nameWithMunicipality ({ name }) {
            return `${name}`
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
        "/checkDetInchs";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayCheckDet = respuesta.CheckDetInchs.data;
          me.myTable(me.arrayCheckDet);

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectMunicipality() {
            let me = this;
            var url = "/confiscationCertificates/selectMunicipality";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMunicipality= respuesta.municipalities;
                }).catch(function (error) {
                    console.log(error);
            });
    }, 
    selectRegional() {
            let me = this;
            var url = "/checkDetInchs/selectRegional";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegional= respuesta.regional;
                }).catch(function (error) {
                    console.log(error);
            });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/checkDetInchs/save", {
    
        office: this.form.office.toUpperCase(),
        official: this.form.official.toUpperCase(),
        boat: this.form.boat.toUpperCase(),
        enrollment: this.form.enrollment.toUpperCase(),
        outhFhisher: this.form.outhFhisher.toUpperCase(),
        fishLicense: this.form.fishLicense.toUpperCase(),
        owner: this.form.owner.toUpperCase(),
        fishCaptain: this.form.fishCaptain.toUpperCase(),
        location: this.form.location.toUpperCase(),
        date: this.date,
        'id_company': this.arrayComp.id,
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
        .put("/checkDetInchs/update", {

          id: this.id_CheckDet,
          office: this.form.office.toUpperCase(),
          official: this.form.official.toUpperCase(),
          boat: this.form.boat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          outhFhisher: this.form.outhFhisher.toUpperCase(),
          fishLicense: this.form.fishLicense.toUpperCase(),
          owner: this.form.owner.toUpperCase(),
          fishCaptain: this.form.fishCaptain.toUpperCase(),
          location: this.form.location.toUpperCase(),
          date: this.date,
          
          'id_company': this.arrayComp.id,
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
        title: "Esta seguro de Eliminar la Región " + data["name"],
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
            .post("/checkDetInchs/delete", {
              id: this.id_CheckDet,
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
            { "data": "nameRegional" },
            { "data": "office" },
            { "data": "official" },
            { "data": "boat" },
            { "data": "enrollment" },
            { "data": "outhFhisher" },
            { "data": "fishLicense" },
            { "data": "nameCompany" },
            { "data": "owner" },
            { "data": "fishCaptain" },
            { "data": "location" },
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
    this.selectCompanies();  
    this.selectRegional();
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
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
