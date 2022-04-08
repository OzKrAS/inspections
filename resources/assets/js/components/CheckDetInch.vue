<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Verificación DETs 71 Pulgadas</strong>          
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
                  <div class="md-layout-item">
                
                        <div>
                          <md-datepicker 
                            v-model="date"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label>Regional</label>
                      <multiselect v-model="arrayRegl" :options="arrayRegional"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('office')">
                    <label for="first-name">Oficina</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.office"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.office.required"
                     >Olvidaste ingresar el nombre de la oficina</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('official')">
                    <label for="first-name">Funcionario</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.official"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.official.required"
                     >Olvidaste ingresar el nombre del funcionario</span>
                  </md-field>
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
                  </md-field>
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
                     >Olvidaste ingresar el nombre de la matrícula</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('outhFhisher')">
                    <label for="first-name">Pesquería Autorizada</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.outhFhisher"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.outhFhisher.required"
                     >Olvidaste ingresar el nombre de la pesqueria autorizada</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('fishLicense')">
                    <label for="first-name">Pantente de Pesca</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.fishLicense"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.fishLicense.required"
                     >Olvidaste ingresar el nombre de la patente de pesca</span>
                  </md-field>
                  <div class="md-layout-item">
                      <label>Empresa</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithCompany"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('owner')">
                    <label for="first-name">Armador</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.owner"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.owner.required"
                     >Olvidaste ingresar el nombre del armador</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('fishCaptain')">
                    <label for="first-name">Capitán de Pesca</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.fishCaptain"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.fishCaptain.required"
                     >Olvidaste ingresar el nombre del capitán de pesca</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('location')">
                    <label for="first-name">Localización</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.location"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.location.required"
                     >Olvidaste ingresar el nombre de la localización</span>
                  </md-field>
                  <img src="/img/img1.png" alt="Workplace" usemap="#workmap" width="263" height="278">
                  <map name="workmap">
                    <area @click="demo('B')" shape="rect" coords="33,67,72,101" alt="" >
                    <area @click="demo('A')" class="puntoa" id="puntoa" shape="rect" coords="116,13,151,45" alt="" >
                    <area @click="demo('C')" shape="rect" coords="117,165,150,196" alt="" >
                  </map>
                  <img src="/img/img2.png" alt="Workplace" usemap="#workmap2" width="263" height="278">
                  <map name="workmap2">
                    <area @click="demo('D')" shape="rect" coords="132,197,161,226" alt="" >
                    <area @click="demo('E')" shape="rect" coords="232,180,263,210" alt="" >
                  </map>
                  <img src="/img/img3.png" alt="Workplace" usemap="#workmap3" width="273" height="295">
                  <map name="workmap3">
                     <area @click="demo('I')" shape="rect" coords="25,150,57,173" alt="" >
                     <area @click="demo('F')" shape="rect" coords="73,102,104,132" alt="" >
                     <area @click="demo('G')" shape="rect" coords="113,28,144,57" alt="" >
                     <area @click="demo('H')" shape="rect" coords="190,65,222,92" alt="" >
                  </map>
                  <img alt="Graficos" width="263" height="278" src="/img/img4.png">
                </div>
                <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                        <thead>         
                            <!-- <md-button
                              type="button"
                              v-if="tipoAccion==1"
                              class="md-dense md-raised md-primary"
                              :disabled="sending"
                              @click="addItemFauna()"
                            >Agregar
                            </md-button> -->
                          <tr>
                            <th>PUNTO</th>              
                            <th>DETs</th>    
                            <th>BABOR 1</th>    
                            <th>BABOR 2</th>    
                            <th>ESTRIBOR 1</th>    
                            <th>ESTRIBOR 2</th>    
                            <th style="width: 90px">Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(dets,index) in arrayDets" :key="`dets-${index}`">
                            <td v-text="dets.punto"></td>
                            <td v-text="dets.tituloModal"></td>
                            <td v-text="dets.babor1"></td>
                            <td v-text="dets.babor2"></td>
                            <td v-text="dets.estribor1"></td>
                            <td v-text="dets.estribor2"></td>
                     
                            <td>  
                              <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                data-tooltip
                                title="Eliminar"
                                @click="deleteFauna(index)"
                              >
                                <i class="icon-trash"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                          <tfoot>
                            <tr>
                              <th>PUNTO</th>              
                              <th>DETs</th>    
                              <th>BABOR 1</th>    
                              <th>BABOR 2</th>    
                              <th>ESTRIBOR 1</th>    
                              <th>ESTRIBOR 2</th>  
                              <th style="width: 90px">Opciones</th>
                            </tr>
                          </tfoot>
                          <tbody>
                          </tbody>
                      </table>
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
      <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
     
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <md-card-content>
                <div class="md-layout">
                  <div class="md-layout-item md-size-60">
                    <md-field>
                      <label for="first-name">Babor 1</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="babor1"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-60">
                    <md-field>
                      <label for="first-name">Babor 2</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="babor2"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-60">
                    <md-field>
                      <label for="first-name">Estribor 1</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="estribor1"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-60">
                    <md-field>
                      <label for="first-name">Estribor 2</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="estribor2"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item md-size-25">
                  </div>
                </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="cerrarModal()">Cerrar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==1"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="addDets()"
              >registrar</md-button>
            </md-card-actions>

            <md-card-actions>
              <md-button
                type="submit"
                v-if="tipoAccion==2"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="actualizarAccesorio()"
              >Actualizar</md-button>
            </md-card-actions>
   
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
        office: "",
        official: "",
        boat: "",
        enrollment: "",
        outhFhisher: "",
        fishLicense: "",
        owner: "",
        fishCaptain: "",
        location: "",
      },
      
      modal: 0,
      tituloModal: "",
      punto: "",
      babor1:0,
      babor2:0,
      estribor1:0,
      estribor2:0,
      arrayDets: [],
      arrayCheckDet: [],
      id_CheckDet: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_company: 0,
      arrayRegional: {id:0, name:''},
	    arrayRegl: [],
      id_regional: 0,

      date: format(now, dateFormat),
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
      
      office: {
        required
      },
      official:  {
        required
      },
      boat:  {
        required
      },
      enrollment:  {
        required
      },
      outhFhisher:  {
        required
      },
      fishLicense:  {
        required
      },
      owner:  {
        required
      },
      fishCaptain:  {
        required
      },
      location:  {
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
    addItemT() {
      let me = this;
      var total = me.arrayDets.push({
        babor1:this.babor1,
        babor2:this.babor2,
        estribor1:this.estribor1,
        estribor2:this.estribor2,
     
      
      });
      console.log(total);
      // me.clearTarget();
    
    },
    demo(punto){
      // alert('demoooo'+punto)
      var dets="";
      if(punto=='A'){ 
        dets='Ancho solpa (>= 71 "  cuando esta estirada)'    ;   
       
      }else if(punto =='B'){
        dets='Medir el corte delantero de ambos lados de la solapa, desde el marco del DET hacia adelante (<=26 " cuando esta estirada)' ; 
      }
      if(punto=='C'){ 
        dets='Ancho solpa (>= 71 "  cuando esta estirada)'    ;   
       
      }else if(punto =='D'){
        dets='Borde trasero de la solapa, desde el borde posterior del marco del DET (centro) al borde de la solapa (<=24 " no estirada)' ; 
      }
      if(punto=='E'){ 
        dets='Desde donde la solapa va cosida mas alla del borde posterior de marco DET (centro) en posicion colgante (<= 6 ")'    ;   
       
      }else if(punto =='F'){
        dets='Amcho DET' ; 
      }
      if(punto=='G'){ 
        dets='Alto DET'    ;   
       
      }else if(punto =='H'){
        dets='Distancia entre varillas' ; 
      }
      this.abrirModal(dets,punto)
      
    },
    abrirModal(dets,punto){
      this.tituloModal=dets;
        this.punto=punto;
        this.modal=1;

    },
     cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
     // this.clearForm();
    },
    addDets(){
      this.arrayDets.push({
        punto:this.punto,
        tituloModal:this.tituloModal,
        babor1:this.babor1,
        babor2:this.babor2,
        estribor1:this.estribor1,
        estribor2:this.estribor2,
      })
      this.punto = "";
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
      this.form.official = null;
      this.form.boat = null;
      this.form.enrollment = null;
      this.form.outhFhisher = null;
      this.form.fishLicense = null;
      this.form.owner = null;
      this.form.fishCaptain = null;
      this.form.location = null;
      this.date = null;

      this.arrayComp = {id:0, name:''};
      this.arrayRegl = {id:0, name:''};
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
    nameWithCompany ({ name }) {
            return `${name}`
    },
    nameWithRegional ({ name }) {
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
    selectCompanies() {
            let me = this;
            var url = "/checkDetInchs/selectCompanies";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCompany= respuesta.company;
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
