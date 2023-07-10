<template>
  <main>
    <file-pond
        ref="pond"
        v-model="files"
        name="files"
        :max-file-size="maxFileSize"
        allow-multiple="true"
        :accepted-file-types="acceptedFileTypes"
        label-idle="Arrastra aquí tus archivos o <span class='filepond--label-action'> Buscar </span>"
    ></file-pond>
    <h4 v-if="uploadedFiles.length">Archivos cargados</h4>
    <ul class="list-group">
      <li v-for="file in uploadedFiles" :key="file.uuid" class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <i :class="getIconClass(file.mime_type)" class="mr-2" style="color:#6c757d"></i>
          {{ file.name }}
        </div>
        <div>
          <a class="btn btn-info btn-sm" title="Descargar" :href="`/file/download/${file.uuid}`" target="_blank">
            <i class="fas fa-download fa-fw"></i>
          </a>
          <button type="button" class="btn btn-danger btn-sm" title="Eliminar"  @click="deleteById(file.uuid)">
            <i class="fas fa-trash fa-fw" style="color: #f1b0b7"></i>
          </button>
        </div>
      </li>
    </ul>
  </main>
</template>

<script>

import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css';
import "filepond/dist/filepond.min.css";
const FilePond = vueFilePond(FilePondPluginFileValidateSize, FilePondPluginFileValidateType,FilePondPluginImagePreview,FilePondPluginFilePoster);
import Swal from 'sweetalert2'

export default {
  props : {
    fileableType : {
      type : String,
      required : true
    },
    fileableId : {
      type : Number,
      required : true
    },
    maxFileSize: {
      type : String,
      default : '5MB'
    },
    acceptedFileTypes : {
      type : Array,
      default : () => ['image/png', 'image/jpeg', 'image/gif', 'application/pdf']
    }
  },
  data(){
    return {
      files : [],
      uploadedFiles : []
    }
  },
  name: "FileComponent",
  components: {
    FilePond
  },
  methods : {
    getFiles(){
      return this.$refs.pond.getFiles();
    },
    removeFiles(){
      this.$refs.pond.removeFiles();
    },
    getIconClass(mimeType) {
      if (mimeType.includes('image/')) {
        return 'fas fa-file-image';
      } else if (mimeType === 'application/pdf') {
        return 'fas fa-file-pdf';
      } else {
        return 'fas fa-file';
      }
    },
    async uploadFiles() {

      if(!this.files.length) return;

      const formData = new FormData();
      formData.append('fileable_type', this.fileableType);
      formData.append('fileable_id', this.fileableId);

      this.files.forEach(file => {
        formData.append('files[]', file.file);
      });

      const {data} = await axios.post('/file/massStore', formData);

      return data;
    },
    async list(){
      const {data} = await axios.get(`/file/list/${this.fileableType}/${this.fileableId}`);
      this.uploadedFiles = data;
    },
    async deleteById(uuid){
      //sweet alert confirm dialog
      const confirmResult = await Swal.fire({
        title: 'Esta seguro?',
        text: "No podras revertir esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
      });

      if(confirmResult.isConfirmed){
        await axios.post(`/file/delete`, {
          id: uuid
        });
        this.list();
        await Swal.fire('Eliminado con exito', '', 'success');
      }
    }
  }
}
</script>

<style scoped>

</style>