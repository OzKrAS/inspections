<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card" style="width: 100%;">
        <div class="card-header">
          Perfil de Usuario
        </div>
        <template v-if="listado == 1">
          <div class="card-body">
            <div>
              <div class="md-title">Información Personal
                <button class="btn btn-success btn-md" @click="abrirModal()"><i class="fa fa-key"></i> Actualizar
                  Contraseña</button>
              </div>
              <div class="md-subhead">Actualice sus datos</div>
            </div>

            <div>
              <div class="md-layout">
                <div class="md-layout-item">
                  <md-field md-clearable :class="getValidationClass('nombre')">
                    <label for="first-name">Nombre</label>
                    <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="form.nombre"
                      :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.nombres.required">Es necesario ingresar un Nombre</span>
                    <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                  </md-field>
                </div>&nbsp;&nbsp;&nbsp;
              </div>
              <div class="md-layout">
                <md-field md-clearable>
                  <label>Tipo Documento</label>
                  <md-input name="tipo_documento" id="first-name" autocomplete="given-name" v-model="form.tipo_documento"
                    :disabled="sending" />
                </md-field>
              </div>
              <div class="md-layout">
                <md-field md-clearable>
                  <label>Número Documento</label>
                  <md-input class="form-control" v-model="form.num_documento" type="text"></md-input>
                </md-field>
              </div>
              <div class="md-layout">
                <div class="md-layout-item">
                  <md-field md-clearable>
                    <label>Teléfono</label>
                    <md-input name="telefono" id="telefono" v-model="form.telefono" />
                  </md-field>
                </div>
              </div>
              <div class="md-layout">
                <div class="md-layout-item">
                  <md-field md-clearable>
                    <label>Dirección</label>
                    <md-input name="direccion" id="direccion" v-model="form.direccion" />
                  </md-field>
                </div>
              </div>
              <div class="md-layout">
                <md-field md-clearable :class="getValidationClass('email')">
                  <label>Email</label>
                  <span class="md-prefix">
                    <i class="material-icons">email</i>
                  </span>
                  <md-input v-model="form.email" md-counter="80" type="text"></md-input>
                  <span class="md-error" v-if="!$v.form.email.email">Email incorrecto</span>
                </md-field>
              </div>

              <md-input v-model="form.usuario" type="hidden"></md-input> 
            </div>

            <button type="submit" class="md-dense md- btn btn-primary" :disabled="sending"
              @click="actualizarPersona()">Actualizar</button>
          </div>
        </template>
      </div>

      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->

    <!-- /.modal-dialog -->
    <div class="modal fade" tabindex="-1" :class="{ 'mostrar': modal }" role="dialog" aria-labelledby="myModalLabel"
      style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dark modal-lg" role="document">
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
                <p class="text-center">¿Estás completamente seguro de cambiar tu contraseña para iniciar sesion?, este
                  proceso no se puede revertir.</p>

                <div id="paso1">
                  <md-field>
                    <label>Contraseña</label>
                    <md-input v-model="passwordactual" type="password"></md-input>
                  </md-field>
                  <button type="button" class="btn btn-sm btn-outline-primary" @click="checkPassword()">Validar
                    Contraseña</button>
                </div>

                <div class="alert alert-warning mt-3" id="msg-modal" style="display: none;"></div>

                <hr>
                <div id="npass" style="display:none">
                  <md-field>
                    <label>Contraseña</label>
                    <md-input v-model="password" type="password" :disabled="sending"></md-input>
                  </md-field>

                  <md-field>
                    <label>Confirme su Contraseña</label>
                    <md-input v-model="password2" type="password" :disabled="sending"></md-input>
                  </md-field>
                  <span class="md-error" v-if="!$v.password2.sameAspassword2">El password NO coincide</span>
                </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer" style="display: none">
              <button type="button" class="md-raised btn btn-white" @click="cerrarModal()">Cerrar</button>
              <button type="submit" class="md-dense btn md-raised btn-primary" @click="actualizarPw()">Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
let user = document.head.querySelector('meta[name="user"]');
// console.log(user.content);
import { validationMixin } from "vuelidate";
// importar libreria
import Multiselect from "vue-multiselect";
import FileComponent from "./common/FileComponent";
import {
  MdButton,
  MdContent,
  MdField,
  MdCard,
  MdMenu,
  MdRipple,
  MdList
} from "vue-material/dist/components";
// import VueMaterial from 'vue-material'
// Vue.use(VueMaterial)
Vue.use(MdButton);
Vue.use(MdContent);
Vue.use(MdField);
Vue.use(MdCard);
Vue.use(MdMenu);
Vue.use(MdRipple);
Vue.use(MdList);
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
  components: {
    Multiselect,
    FileComponent,
  },
  mixins: [validationMixin],

  data() {
    return {

      form: {
        nombres: "",
        tipo_documento: "",
        num_documento: "",
        telfono: "",
        direccion: "",
        email: "",
      },
      demo: 0,
      tipoAccion: 1,
      listado: 1,
      sending: false,
      idMarca: 0,
      foto: "nn.png",
      modelo_id: 0,
      //variables imagen
      selectedFile: null,
      isDragging: false,
      dragCount: 0,
      files: [],
      images: [],
      direccion: "",
      cargo: "",
      telefono: "",
      arrayDatos: [],
      arrayImg: [],
      arrayPerso: [],
      arrayM: { id: 0, nombre: "" },
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      nombreFull: "",
      password: "",
      password2: "",
      passwordactual: "",
      fecNac: "",

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "nombre",
      buscar: ""
    };
  },

  validations: {
    password2: {
      sameAspassword2: sameAs("password")
    },
    form: {
      nombres: {
        required
      },
      apellidos: {
        required
      },
      email: {
        email
      },
      email2: {
        sameAsemail2: sameAs("email")
      }
    }
  },

  computed: {

    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
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
    changeImg() {
      this.listado = 0;
    },
    abrirList() {
      this.listado = 1;
    },
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

      Array.from(files).forEach(file => this.addImage(file));
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;

      const files = e.dataTransfer.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = e => this.images.push(e.target.result);

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
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    upload() {
      let me = this;
      const formData = new FormData();

      this.files.forEach(file => {
        formData.append("images[]", file, file.name);
      });

      axios.post("/user/imagen", formData).then(response => {
        this.listado = 1;
        this.getImg();
        me.mensaje("Guardado", "Todas las imagenes se han almacenado ");

        // this.$toastr.s("All images uplaoded successfully");
        this.images = [];
        this.files = [];
      });
    },
    getUsuario(buscar) {
      let me = this;

      var url = "/persona/getusuario";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPerso = respuesta.personas;
          console.log(me.arrayPerso)
          me.form.nombre = me.arrayPerso['nombre'];
          me.form.tipo_documento = me.arrayPerso["tipo_documento"];
          me.form.num_documento = me.arrayPerso["num_documento"];
          me.form.telefono = me.arrayPerso["telefono"];
          me.form.direccion = me.arrayPerso["direccion"];
          me.form.email = me.arrayPerso["email"];
          me.form.usuario = me.arrayPerso["id"];

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getImg() {
      let me = this;

      var url = "/persona/getImg";
      axios
        .get(url)
        .then(function (response) {
          console.log(response);
          me.foto = response;
          
          $("#imgperfil").attr('src', me.foto);

          console.log(me.foto)
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    actualizarPersona() {
      let me = this;

      axios
        .put("/persona/actualizarPerfil", {
          nombre: this.form.nombre,
          tipo_documento: this.form.tipo_documento,
          num_documento: this.form.num_documento,
          direccion: this.form.direccion,
          telefono: this.form.telefono,
          email: this.form.email,
        })
        .then( async function (response) {
          await me.$refs.fileComponent.uploadFiles();
          me.cerrarModal();
          me.mensaje("Actualizado", "Se actualizó el perfil del usuario");
          me.getUsuario('');
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    checkPassword() {
      let me = this;

      axios
        .post("/persona/checkPassword", {
          password: this.passwordactual
        })
        .then(function (response) {
          // me.cerrarModal();
          // me.mensaje("Actualizado", "Actualizó ");
          console.log(response.data);
          if( response.data == true){
            $("#msg-modal").text("La contraseña que ingresaste es la correcta, ahora se habilitará el formulario para crear la nueva contraseña!");
            $("#paso1").hide();
            $("#msg-modal").hide();
            $("#npass").show();
            $(".modal-footer").show();
          }
          else {
            $("#msg-modal").show();
            $("#msg-modal").text("La contraseña que ingresaste es incorrecta, por favor intentalo nuevamente!");
            $("#paso1").show();
            $("#npass").hide();
            $(".modal-footer").hide();
          }
          // me.listarPersona(1, "", "nombre");
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    actualizarPw() {
      let me = this;

      axios
        .put("/persona/actualizarPw", {
          password: this.password
        })
        .then(function (response) {
          me.cerrarModal();
          me.mensaje("Actualizado", "Actualizaste tu contraseña!");
          $("#paso1").show();
          $("#msg-modal").hide();
          $("#npass").hide();
          $(".modal-footer").hide();
          // me.listarPersona(1, "", "nombre");
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    clearForm() {
      this.$v.$reset();
      this.form.nombre = null;
    },
    abrirModal() {
      // this.idRefE=data["idref"];

      this.modal = 1;
      this.tituloModal = "Asigne un Password para " + this.form.nombre;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
    },
    mostrarDetalle() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
    },
    ocultarDetalle() {
      this.listado = 1;
    },

    mensaje(tipo, crud) {
      swal(tipo, crud, "success");
    }
  },

  mounted() {
    this.getUsuario();
    this.getImg();

  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}

.md-card {
  width: 45%;
  margin: 4px;
  display: inline-block;
  vertical-align: top;
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
