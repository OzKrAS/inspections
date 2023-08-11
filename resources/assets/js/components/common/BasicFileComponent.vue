<template>
  <main>
    <file-pond
        ref="pond"
        allow-image-preview="false"
        v-model="files"
        name="files"
        :max-file-size="maxFileSize"
        allow-multiple="true"
        :accepted-file-types="acceptedFileTypes"
        label-idle="Arrastra aquí tus archivos o <span class='filepond--label-action'> Buscar </span>"
    ></file-pond>
  </main>
</template>

<script>

import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
const FilePond = vueFilePond(FilePondPluginFileEncode,FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

export default {
  props : {
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
    getImagesAsBase64(){
      return this.getFiles().map(file => file.getFileEncodeBase64String());
    }
  }
}
</script>

<style scoped>

</style>