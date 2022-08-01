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
                        type="number"
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
                        <label for="first-name">Nombre Observador</label>
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
                        >Olvidaste ingresar el nombre del observador
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
                          <md-button
                            type="button"
                            class="md-dense md-raised md-primary"
                            :disabled="sending"
                            @click="abrirModal()"
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
                       <tbody v-if="arrayTarget.length">
                          <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                            <td>
                              <md-field>
                                  <md-textarea v-model="target.element" md-autogrow></md-textarea>
                              </md-field>
                            </td>               
                            <td>
                               <md-radio  v-model="target.zarpe" value="1"><small>SI</small></md-radio>
                               <md-radio  v-model="target.zarpe" value="0" class="md-primary"><small>NO</small></md-radio>
                            </td>
                            <td>
                               <md-radio  v-model="target.characterState" value="1"><small>SI</small></md-radio>
                               <md-radio  v-model="target.characterState" value="0" class="md-primary"><small>NO</small></md-radio>
                            </td>
                            <td>
                               <md-radio  v-model="target.regFot" value="1"><small>SI</small></md-radio>
                               <md-radio  v-model="target.regFot" value="0" class="md-primary"><small>NO</small></md-radio>
                            </td>                       
                            <td>
                              <md-field>
                                  <md-textarea v-model="target.observation" md-autogrow></md-textarea>
                              </md-field>
                            </td>                           
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
                        <tbody v-else>
                          <tr>
                            <td colspan="6" class="text-center">
                              No existen elementos agregados 
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
    <!-- inicioModal -->
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
            <h4 class="modal-title"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="md-layout">
                  <div class="md-layout-item md-size-50">
                    <md-field md-clearable>
                        <label for="first-name">Equipo</label>
                        <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="element"
                            :disabled="sending"
                        />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;              
              </div>
              <div class="md-layout">
                <div class="md-layout-item md-size-30">                 
                    <label for="first-name">Zarpe (S/N)</label>
                    <div>
                      <md-radio  v-model="zarpe" value="1"><small>SI</small></md-radio>
                      <md-radio  v-model="zarpe" value="0" class="md-primary"><small>NO</small></md-radio>
                    </div>                     
                </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout-item md-size-30">                 
                    <label for="first-name">Desembarque (S/N)</label>
                    <div>
                      <md-radio  v-model="characterState" value="1"><small>SI</small></md-radio>
                      <md-radio  v-model="characterState" value="0" class="md-primary"><small>NO</small></md-radio>
                    </div>                     
                </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout-item md-size-30">                 
                    <label for="first-name">Registro fotográfico (S/N)</label>
                    <div>
                      <md-radio  v-model="regFot" value="1"><small>SI</small></md-radio>
                      <md-radio  v-model="regFot" value="0" class="md-primary"><small>NO</small></md-radio>
                    </div>                                    
                </div>&nbsp;&nbsp;&nbsp;
                <v-collapse-wrapper v-if="this.regFot == 1">
                        <div class="content" v-collapse-content>
                            <div
                              class="uploader"
                              @dragenter="OnDragEnter"
                              @dragleave="OnDragLeave"
                              @dragover.prevent
                              @drop="onDrop"
                              :class="{ dragging: isDragging }"
                            >
                              <div class="upload-control" v-show="images.length">
                                <!-- <label for="file">Anexar otra Imágen</label> -->
                                <!-- <button @click="upload">Guardar Imágenes</button>
                                <button @click="abrirList">Cancelar</button> -->
                              </div>

                              <div v-show="!images.length">
                                <i class="fa fa-cloud-upload"></i>
                                <p>Arrastra tus imágenes aquí</p>
                                <div>O</div>
                                <div class="file-input">
                                  <label for="file">Selecciona una Imágen</label>
                                  <input
                                    type="file"
                                    id="file"
                                    @change="onInputChange"
                                    multiple
                                  />
                                </div>
                              </div>

                              <div class="images-preview" v-show="images.length">
                                <div
                                  class="img-wrapper"
                                  v-for="(image, index) in images"
                                  :key="index"
                                >
                                  <img :src="image" :alt="`Image Uplaoder ${index}`" />
                                    <button
                                      type="button"
                                      @click="eliminarImg(index)"
                                      class="btn btn-dark btn-sm"
                                    >
                                      <i class="material-icons Color4">delete</i>
                                    </button>
                                  <div class="details">
                                    <span class="name" v-text="files[index].name"></span>
                                    <span
                                      class="size"
                                      v-text="getFileSize(files[index].size)"
                                    ></span>
                                  </div>
                                </div>
                              </div>
                            </div> 
                        </div>
                </v-collapse-wrapper>                   
              </div> 
              <!-- <div class="md-layout"> -->
                  <!-- <div class="collapse" id="collapseExample" >
                      <div class="card card-body">
                        <div
                          class="uploader"
                          @dragenter="OnDragEnter"
                          @dragleave="OnDragLeave"
                          @dragover.prevent
                          @drop="onDrop"
                          :class="{ dragging: isDragging }"
                        >
                          <div class="upload-control" v-show="images.length">
                          </div>

                          <div v-show="!images.length">
                            <i class="fa fa-cloud-upload"></i>
                            <p>Arrastra tus imágenes aquí</p>
                            <div>O</div>
                            <div class="file-input">
                              <label for="file">Selecciona una Imágen</label>
                              <input
                                type="file"
                                id="file"
                                @change="onInputChange"
                                multiple
                              />
                            </div>
                          </div>

                          <div class="images-preview" v-show="images.length">
                            <div
                              class="img-wrapper"
                              v-for="(image, index) in images"
                              :key="index"
                            >
                              <img :src="image" :alt="`Image Uplaoder ${index}`" />
                                <button
                                  type="button"
                                  @click="eliminarImg(index)"
                                  class="btn btn-dark btn-sm"
                                >
                                  <i class="material-icons Color4">delete</i>
                                </button>
                              <div class="details">
                                <span class="name" v-text="files[index].name"></span>
                                <span
                                  class="size"
                                  v-text="getFileSize(files[index].size)"
                                ></span>
                              </div>
                            </div>
                          </div>
                        </div> 
                          
                      </div>
                  </div> -->
                <!-- </div>  -->
              <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field>
                        <label>Observaciones</label>
                        <md-textarea v-model="observation"></md-textarea>
                    </md-field> 
                  </div>&nbsp;&nbsp;&nbsp;     
              </div>                      
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button type="button" class="md-raised" @click="cerrarModal()">Cerrar</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button
                type="submit"
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="addItemTarget()"
              >registrar</md-button>
            </md-card-actions>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- filModal -->
  </main>
</template>

<script>

   import format from "date-fns/format"; 
    import { validationMixin } from "vuelidate";
    import Multiselect from "vue-multiselect";
    import Toasted from 'vue-toasted';
    import vSelect from "vue-select";
    import VueCollapse from "vue2-collapse";
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
        // equipment: "",
        // desemb: "",
        // photoRecord: "",
      },

      element: "",
      zarpe: null,
      regFot: null,
      characterState: null,
      observation: "",
      dateZarpe: 0,
      dateDesemb: 0,
      

      arrayPresenVerifics: [],
      id_presenVerific: 0,

      arrayTarget: [],
      arrayTargetAct: [],
      
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
      modal2: 0,
      modal: 0,

      tipoAccion: 1,
      listado: 1,
      idMcpio: 0,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0,

      selectedFile: null,
      isDragging: false,
      dragCount: 0,
      files: [],     
      images: [],
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
      // equipment: {
      //   required
      // },
      // zarpe: {
      //   required
      // },
      // desemb: {
      //   required
      // },
      // photoRecord: {
      //   required
      // },
    }
  },

  computed: {

  },
  methods: {
    OnDragEnter(e) {
      e.preventDefault();

      this.dragCount++;
      this.isDragging = true;

      return false;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;

      if (this.dragCount <= 0) this.isDragging = false;
    },
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach((file) => this.addImage(file));
    },
    onInputChange2(e) {
      const files = e.target.files;

      Array.from(files).forEach((file) => this.addImage2(file));
    },
    addImage2(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.images2.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = (e) => this.images2.push(e.target.result);

      reader.readAsDataURL(file);
    },
    upload() {
      let me = this;
      const formData = new FormData();

      this.files.forEach((file) => {
        formData.append("images[]", file, file.name);
      });
      formData.append("idEquipo", this.idEquipo);
      formData.append("numCerti", this.form.numCertifica);
      formData.append("laborat", this.form.laboratorio);
      formData.append("fecCerti", this.form.fecCertifica);

      axios.post("/detcerti/registrar", formData).then((response) => {
        me.mensaje("Guardado", "Todos los certificados se han almacenado ");
        // this.$toastr.s("All images uplaoded successfully");
        me.getDetCertifica();
        this.images = [];
        this.files = [];
      });
    },
    changeImg() {
      this.listado = 0;
    },
    abrirList() {
      this.listado = 1;
    },
    eliminarImg(index){
      this.images.splice(index, 1);
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;

      const files = e.dataTransfer.files;

      Array.from(files).forEach((file) => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = (e) => this.images.push(e.target.result);

      reader.readAsDataURL(file);
    },
    getFileSize(size) {
      const fSExt = ["Bytes", "KB", "MB", "GB"];
      let i = 0;

      while (size > 900) {
        size /= 1024;
        i++;
      }
      return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
    },
    getImage(event) {
      //Asignamos la imagen a  nuestra data
      // console.log(event)
      this.selectedFile = event.target.files[0];
      // this.upload();
    },
    abrirModal(){
      console.log("abrirModal");
        this.modal=1;
    },
     cerrarModal() {
      this.modal = 0;
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
      this.form.insNo = null;
      this.form.nameShip = null;
      this.form.cruise = null;
      this.form.nameFish = null;
      this.form.nameCaptain = null;
      this.dateZarpe = null;
      this.dateDesemb = null;
      this.arrayFg = {id:0, name:''};
      this.arrayTarget = [];
      this.arrayTargetAct = [];
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    addItemTarget(){
      this.arrayTarget.push({
        element:this.element,
        zarpe:this.zarpe,
        characterState:this.characterState,
        regFot:this.regFot,
        observation:this.observation,
      });
      this.arrayTargetAct.push({
        element:this.element,
        zarpe:this.zarpe,
        characterState:this.characterState,
        regFot:this.regFot,
        observation:this.observation,
      });
      this.clearTarget();
      this.cerrarModal();
    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
    },
    clearTarget() {
      this.element = null;
      this.zarpe = null;
      this.characterState = null;
      this.regFot = null;
      this.observation = null;
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
      this.dataTarget();
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
          'target':this.arrayTarget,
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
          'target':this.arrayTargetAct,
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
    dataTarget(){
      let me = this;

      var url = "/presenVerifics/target?id_PresenVerific="+this.id_presenVerific;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTarget = respuesta.presenVerific;
        })
        .catch(function(error) {
          console.log(error);
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

.uploader {
  width: 100%;
  background: #2196f3;
  color: #fff;
  padding: 40px 15px;
  text-align: center;
  border-radius: 10px;
  border: 3px dashed #fff;
  font-size: 20px;
  position: relative;
}
.uploader:dragging {
  background: #fff;
  color: #2196f3;
  border: 3px dashed #2196f3;
}
.uploader1 {
  width: 100%;
  background: #ff7777;
  color: #fff;
  padding: 40px 15px;
  text-align: center;
  border-radius: 10px;
  border: 3px dashed #fff;
  font-size: 20px;
  position: relative;
}
.uploader1:dragging {
  background: #fff;
  color: #2196f3;
  border: 3px dashed #2196f3;
}

i.fa.fa-cloud-upload {
  font-size: 58px;
}
.file-input {
  width: 200px;
  margin: auto;
  height: 68px;
  position: relative;
}
.file-input label {
  background: #fff;
  color: #2196f3;
  width: 105%;
  position: absolute;
  left: 0;
  top: 0;
  padding: 10px;
  border-radius: 4px;
  margin-top: 7px;
  cursor: pointer;
}

.file-input input {
  opacity: 0;
  z-index: -2;
}

.images-preview {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.img-wrapper {
  width: 160px;
  display: flex;
  flex-direction: column;
  margin: 10px;
  height: 150px;
  justify-content: space-between;
  background: #fff;
  box-shadow: 5px 5px 20px #3e3737;
}
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
.img {
  max-height: 105px;
}
.imgNew {
  max-height: 300px;
}
.details {
  font-size: 12px;
  background: #fff;
  color: #000;
  display: flex;
  flex-direction: column;
  align-items: self-start;
  padding: 3px 6px;
}
.name {
  overflow: hidden;
  height: 18px;
}

.upload-control {
  position: absolute;
  width: 100%;
  background: #fff;
  top: 0;
  left: 0;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
  padding: 10px;
  padding-bottom: 4px;
  text-align: right;
}
.upload-control button {
  background: #3ab458;
  border: 2px solid #3ab458;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
}
.upload-control label {
  background: #F5A528;
  border: 2px solid #F5A528;
  border-radius: 3px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
  padding: 2px 5px;
  margin-right: 10px;
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
