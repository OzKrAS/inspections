<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Verificación DET Doble Solapa</strong>          
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
                    <!-- <th>Pesquería Autorizada</th> -->
                    <th>Empresa</th>
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
                      <!-- <th>Pesquería Autorizada</th> -->
                      <th>Empresa</th>
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
               

                  <!-- ESPACIO PARA LA HORA       -->
                </div>  
                <div class="md-layout">
        
                  <div class="md-layout-item">
                      <label class="text-muted">Regional (Regional)</label>
                      <multiselect v-model="arrayRegl" :options="arrayRegional"
                          placeholder="Seleccione una opción"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label for="office" class="text-muted">Oficina (Office)</label>
                      <md-select v-model="office" name="office" id="office" placeholder="Seleccione una oficina (Office)">
                        <md-option value="BARRANQUILLA">BARRANQUILLA</md-option>
                        <md-option value="CARTAGENA">CARTAGENA</md-option>
                        <md-option value="TOLÚ">TOLÚ</md-option>
                        <md-option value="BAHÍA SOLANO">BAHÍA SOLANO</md-option>
                        <md-option value="BUENAVENTURA">BUENAVENTURA</md-option>
                        <md-option value="TUMACO">TUMACO</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item">
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
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('official')">
                      <label for="first-name">Funcionario (Official)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">                 
                      <md-datepicker 
                        md-clearable :class="getValidationClass('date')"
                        v-model="form.date"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Seleccione Fecha (Date)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.date.required"
                          >Olvidaste ingresar la fecha
                        </span>
                      </md-datepicker>                   
                  </div> &nbsp;&nbsp;&nbsp;
                </div> 
                <md-divider style="background-color: #2090E8 " ></md-divider>
                <div>
                  <br>
                    <strong class="text-muted">DATOS DE LA EMBARCACIÓN</strong>
                </div> 
                <div class="md-layout">
                <div class="md-layout-item">
                <label class="text-muted">Nombre de la embarcación (Ship Name)</label>
                    <multiselect v-model="arrayBt" :options="arrayBoat"
                        @input="setBoats()"
                        placeholder="Seleccione una embarcación"
                        :custom-label="nameWithBoat"
                        label="nameBoat"
                        track-by="nameBoat">
                    </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('boat')">
                      <label for="first-name">Embarcación (Ship Name)</label>
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
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('enrollment')">
                      <label for="first-name">Matrícula (Vessel Registration)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('fishLicense')">
                      <label for="first-name">Pantente de Pesca (Patent)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;      
                </div>
                <div class="md-layout">  
                  <div class="md-layout-item">
                      <label class="text-muted">Empresa (Company/Permit Holder)</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany"
                          placeholder="Seleccione una Empresa"
                          :custom-label="nameWithCompany"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;                             
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('owner')">
                      <label for="first-name">Armador (Shipowner)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('fishCaptain')">
                      <label for="first-name">Capitán de Pesca (Fishing Captain)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;              
                </div>   
                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Pesquería Autorizada (Fishery)</label>
                    <multiselect
                      v-model="arrayFa"
                      :options="arrayFisheryAuthorized"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="true"
                      placeholder="Seleccione Pesquería Autorizada"
                      label="name"
                      track-by="name"
                      :preselect-first="false">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('location')">
                      <label for="first-name">Localización (Location)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;
                </div> 

                <md-divider style="background-color: #2090E8 " ></md-divider>
                <div>
                  <br>
                    <strong class="text-muted">Nota: Para completar los datos de la tabla debe hacer click en cada uno de los puntos de la imagen (A, B, C, D, E, F, G, H, I).</strong>
                </div>    
                <br> 
                  
                <div class="md-layout"> 
                   <img src="/img/img5.png" alt="Workplace" usemap="#workmap" width="263" height="278">
                  <map name="workmap">
                    <area @click="title('B')" shape="rect" coords="0,188,35,228" alt="">
                    <area @click="title('A')" class="puntoa" id="puntoa" shape="rect" coords="114,132,153,178" alt="">
                  </map>
                  <img src="/img/img6.png" alt="Workplace" usemap="#workmap2" width="263" height="278">
                  <map name="workmap2">
                    <area @click="title('D')" shape="rect" coords="65,190,105,230" alt="">
                    <area @click="title('C')" shape="rect" coords="105,105,141,148" alt="">
                    <area @click="title('E')" shape="rect" coords="228,296,262,333" alt="">
                  </map>
                  <img src="/img/img3.png" alt="Workplace" usemap="#workmap3" width="273" height="295">
                  <map name="workmap3">
                     <area @click="title('I')" shape="rect" coords="23,178,59,214" alt="" >
                     <area @click="title('F')" shape="rect" coords="71,124,104,160" alt="" >
                     <area @click="title('G')" shape="rect" coords="112,33,144,70" alt="" >
                     <area @click="title('H')" shape="rect" coords="188,75,222,110" alt="" >
                  </map>
                  <img alt="Graficos" width="263" height="278" src="/img/img4.png">
                </div>
                  <br>
                  <table class="table table-striped table-bordered display" id="dataTable2" width="50%" cellspacing="0">
                      <thead>         
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
                      <tbody v-if="arrayDets2.length">
                        <tr v-for="(dets,index) in arrayDets2" :key="`dets-${index}`">
                          <td v-text="dets.punto2"></td>
                          <td v-text="dets.tituloModal"></td>
                          <td v-text="dets.babor3"></td>
                          <td v-text="dets.babor4"></td>
                          <td v-text="dets.estribor3"></td>
                          <td v-text="dets.estribor4"></td>      
                          <td>  
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              data-tooltip
                              title="Eliminar"
                              @click="deleteDets2(index)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="8" class="text-center">
                            No existen elementos agregados 
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
                  <md-divider style="background-color: #2090E8 " ></md-divider>
                <div class="md-layout">  
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('flapMeshSize')">
                      <label for="first-name">Tamaño de malla en la solapa (Mesh Size on Flap)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.flapMeshSize"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.flapMeshSize.required"
                      >Olvidaste ingresar el tamaño de malla en la solapa</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; 
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('angleDet')">
                      <label for="first-name">Ángulo del DET (DET Angle)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.angleDet"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.angleDet.required"
                      >Olvidaste ingresar el ángulo del DET </span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('typeDet')">
                      <label for="first-name">Tipo de DET (DET Type)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.typeDet"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.typeDet.required"
                      >Olvidaste ingresar el tipo de DET</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;         
                </div>  
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('materialDet')">
                      <label for="first-name">Material del DET (DET Material)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.materialDet"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.materialDet.required"
                      >Olvidaste ingresar el material del DET</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('exit')">
                      <label for="first-name">Salida (superior ó inferior)(Outlet)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.exit"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.exit.required"
                      >Olvidaste ingresar la salida (superior ó inferior)</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('float')">
                      <label for="first-name">Flotadores (cantidad)(Number of Floats)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.float"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.float.required"
                      >Olvidaste ingresar la cantidad de flotadores</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>  
                <label>DETs con salida inferior: si la circunferencia del DET es ≥ a 120 ", se requieren 2 boyas, si es menor solo se requiere una boya</label>
                <label>Exención: red de prueba (chango)  La longitud de la relinga superior debe ser de 12 pies o menos, y la longitud de la relinga inferior debe ser de 15 pies o menos</label>
                <div class="md-layout"> 
                  <div class="md-layout-item">
                    <md-field>
                            <label>Observaciones (Observations)</label>
                            <md-textarea v-model="observation"></md-textarea>
                    </md-field>
                  </div>    
                </div>
                <p>
                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Subir imagen
                  </button>
                </p>                                 
                <div class="collapse" id="collapseExample">
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
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal2}"
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
                        v-model="babor3"
                        :disabled="sending"
                        type="number"
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
                        v-model="babor4"
                        :disabled="sending"
                        type="number"
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
                        v-model="estribor3"
                        :disabled="sending"
                        type="number"
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
                        v-model="estribor4"
                        :disabled="sending"
                        type="number"
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
                class="md-dense md-raised md-primary"
                :disabled="sending"
                @click="addDets2()"
              >registrar</md-button>
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
    import jsPDF from 'jspdf'
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
        official: "",
        boat: "",
        enrollment: "",
        // outhFhisher: "",
        fishLicense: "",
        owner: "",
        fishCaptain: "",
        location: "",
        flapMeshSize: "",
        angleDet: "",
        typeDet: "",
        materialDet: "",
        exit: "",
        float: "",
        date: format(now, dateFormat),
      },
        office: "",

      arrayCheckDet: [],
      id_CheckDet: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_Company: 0,
      arrayRegional: {id:0, name:''},
      id_regional: 0,
      tituloModal: "",
      punto: "",
      modal2: 0,
      punto2: "",
      arrayDets2: [],
      arrayDetsAct: [],
      babor3:0,
      babor4:0,
      estribor3:0,
      estribor4:0,
      observation: "",

      arrayRegl: {id:0, name:''},
      arrayBt: {id:0, nameBoat:''},
      arrayFa: {id:0, nameBoat:''},
      arrayFaAct:[],
	    arrayFisheryAuthorized: [],
      id_fisheryAuthorized: 0,


      // meshSize: "",
      // angleDet: "",
      // typeDet: "",
      // materialDet: "",
      // exit: "",
      // float: "",

      idCheckFlap: 0,

      edo:1,
      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0,

      //variables imagen
      selectedFile: null,
      isDragging: false,
      dragCount: 0,
      files: [],     
      images: [],
    };
  },

  validations: {
    form: {
      // office: {
      //   required
      // },
      official:  {
        required
      },
      boat:  {
        required
      },
      enrollment:  {
        required
      },
      // outhFhisher:  {
      //   required
      // },
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
      flapMeshSize:  {
        required
      },
      angleDet:  {
        required
      },
      typeDet:  {
        required
      },
      materialDet:  {
        required
      },
      exit:  {
        required
      },
      float:  {
        required
      },
      date:  {
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
    // addTag (newTag) {
    //   const tag = {
    //     name: newTag,
    //     id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
    //   }
    //   this.arrayRegional.push(tag)
    //   this.arrayReasons.push(tag)
    // },
    alerta() {
       alert('test');
    }, 
    abrirModal2(dets,punto2){
      this.tituloModal=dets;
        this.punto2=punto2;
        this.modal2=1;
    },
     cerrarModal() {
  
      this.modal2 = 0;
      // this.tituloModal = "";
     // this.clearForm();
    },
    clearDets() {
       this.punto = "";
       this.punto2 = "";
       this.tituloModal = "";
       this.babor1 = 0;
       this.babor2 = 0;
       this.estribor1 = 0;
       this.estribor2 = 0;
       this.babor3 = 0;
       this.babor4 = 0;
       this.estribor3 = 0;
       this.estribor4 = 0;
    },
    title(punto2){
      var dets="";
      if(punto2=='A'){ 
        dets='Ancho solpa (>= 56 "  cuando está estirada)'    ;   
       
      }else if(punto2 =='B'){
        dets='Medir el corte delantero de ambos lados de la solapa, desde el marco del DET hacia adelante (<=20 " cuando está estirada)' ; 
      }
      if(punto2=='C'){ 
        dets='Traslape no debe ser mayor a 15 " cuando está estirada';   
       
      }else if(punto2 =='D'){
        dets='Dimencsión de las tapas no debe ser mayor a 58 " cuando están estirada' ; 
      }
      if(punto2=='E'){ 
        dets='Longitud de la solapa no debe ser mayor a 24 " mas allá del borde posterior de la parrilla'    ;   
       
      }else if(punto2 =='F'){
        dets='Ancho del DET' ; 
      }
      if(punto2=='G'){ 
        dets='Alto del DET'    ;   
       
      }else if(punto2 =='H'){
        dets='Distancia entre varillas' ; 
      }
      if (punto2 =='I'){
         dets='Distancia entre marco y varilla' ; 
      }
      // if (punto2 =='J'){
      //    dets='Tamaño de malla en la solapa' ; 
      // }
      // if (punto2 =='K'){
      //    dets='Ángulo del DET' ; 
      // }
      // if (punto2 =='L'){
      //    dets='Tipo de DET' ; 
      // }
      // if (punto2 =='M'){
      //    dets='material del DET' ; 
      // }
      // if (punto2 =='N'){
      //    dets='Salida (supeior o inferior)' ; 
      // }
      // if (punto2 =='O'){
      //    dets='Flotadores (cantidad)' ; 
      // }
      this.abrirModal2(dets,punto2) 
    },
    addDets2(){
      let me = this;
      me.arrayDets2.push({
        punto2:this.punto2,
        tituloModal:this.tituloModal,
        babor3:this.babor3,
        babor4:this.babor4,
        estribor3:this.estribor3,
        estribor4:this.estribor4,
      });
      me.arrayDetsAct.push({
        punto2:this.punto2,
        tituloModal:this.tituloModal,
        babor3:this.babor3,
        babor4:this.babor4,
        estribor3:this.estribor3,
        estribor4:this.estribor4,
      });
      this.clearDets();
      this.cerrarModal();
    },
    deleteDets2(index){
       this.arrayDets2.splice(index,1);
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
  
      this.office = null;
      this.form.official = null;
      this.form.boat = null;
      this.form.enrollment = null;
      // this.form.outhFhisher = null;
      this.form.fishLicense = null;
      this.form.owner = null;
      this.form.fishCaptain = null;
      this.form.location = null;
      this.observation = null;
      this.form.date = null;

      this.form.flapMeshSize = null;
      this.form.angleDet = null;
      this.form.typeDet = null;
      this.form.materialDet = null;
      this.form.exit = null;
      this.form.float = null;

      this.arrayCheckDet = [];
      this.arrayFa = [];

      this.arrayComp = {id:0, name:''};
      this.arrayRegl = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_CheckDet = data["id"]);
      this.office = data["office"];
      this.form.official = data["official"];
      this.form.boat = data["boat"];
      this.arrayBt.nameBoat=data["boat"];
      this.form.enrollment = data["enrollment"];
      // this.form.outhFhisher = data["outhFhisher"];
      this.form.fishLicense = data["fishLicense"];
      this.form.owner = data["owner"];
      this.form.fishCaptain = data["fishCaptain"];
      this.form.location = data["location"];
      this.observation = data["observation"];
      this.form.date = data["date"];

      this.form.flapMeshSize = data["flapMeshSize"];
      this.form.angleDet = data["angleDet"];
      this.form.typeDet = data["typeDet"];
      this.form.materialDet = data["materialDet"];
      this.form.exit = data["exit"];
      this.form.float = data["float"];

      this.arrayComp.id = data["id_company"];
			this.arrayComp.name = data["nameCompany"];
      this.arrayRegl.id = data["id_regional"];
			this.arrayRegl.name = data["nameRegional"];
      this.arrayFa.id = data["arrayFa"];
      this.dataTable();
      this.dataFishery();
    },
    nameWithCompany ({ name }) {
            return `${name}`
    },
    nameWithRegional ({ name }) {
            return `${name}`
    },
    nameWithFisheryAuthorized ({ name }) {
            return `${name}`
    },
    nameWithBoat ({ nameBoat  }) {
            return `${nameBoat}`
    },
    setBoats(){
      this.form.enrollment= this.arrayBt.enrollment;
      this.form.fishLicense= this.arrayBt.noPatent;
      this.form.boat= this.arrayBt.nameBoat;

    },
    selectCompanies() {
            let me = this;
            var url = "/checkDetFlaps/selectCompanies";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCompany= respuesta.company;
                }).catch(function (error) {
                    console.log(error);
            });
    }, 
    selectRegional() {
            let me = this;
            var url = "/checkDetFlaps/selectRegional";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegional= respuesta.regional;
                }).catch(function (error) {
                    console.log(error);
            });
    }, 
    selectFisheryAuthorized() {
            let me = this;
            me.arrayFa=[];
            var url = "/zarpes/selectFisheryAuthorized";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFisheryAuthorized= respuesta.fishery;
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
        "/checkDetFlaps";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayCheckDet = respuesta.checkDetFlaps.data;
          me.myTable(me.arrayCheckDet);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    selectBoats() {
      let me = this;
      var url = "/selectboats?type=1";
      axios.get(url).then(function (response) {
              var respuesta = response.data;
              me.arrayBoat = respuesta.boat;
          }).catch(function (error) {
              console.log(error);
      });
    },
    saveData() {
      let me = this;

      axios
        .post("/checkDetFlaps/save", {
    
        office: this.office.toUpperCase(),
        official: this.form.official.toUpperCase(),
        boat: this.form.boat.toUpperCase(),
        enrollment: this.form.enrollment.toUpperCase(),
        // outhFhisher: this.form.outhFhisher.toUpperCase(),
        fishLicense: this.form.fishLicense.toUpperCase(),
        owner: this.form.owner.toUpperCase(),
        fishCaptain: this.form.fishCaptain.toUpperCase(),
        location: this.form.location.toUpperCase(),
        observation: this.observation.toUpperCase(),
        date: this.form.date,

        flapMeshSize: this.form.flapMeshSize.toUpperCase(),
        angleDet: this.form.angleDet.toUpperCase(),
        typeDet: this.form.typeDet.toUpperCase(),
        materialDet: this.form.materialDet.toUpperCase(),
        exit: this.form.exit.toUpperCase(),
        float: this.form.float,

        'id_company': this.arrayComp.id,
        'id_regional': this.arrayRegl.id,
        'detflap': this.arrayDets2,
        'data': this.arrayFa,
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
        .put("/checkDetFlaps/update", {
      
          id: this.id_CheckDet,
          office: this.office.toUpperCase(),
          official: this.form.official.toUpperCase(),
          boat: this.form.boat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          // outhFhisher: this.form.outhFhisher.toUpperCase(),
          fishLicense: this.form.fishLicense.toUpperCase(),
          owner: this.form.owner.toUpperCase(),
          fishCaptain: this.form.fishCaptain.toUpperCase(),
          location: this.form.location.toUpperCase(),
          observation: this.observation.toUpperCase(),
          date: this.form.date,

          flapMeshSize: this.form.flapMeshSize.toUpperCase(),
          angleDet: this.form.angleDet.toUpperCase(),
          typeDet: this.form.typeDet.toUpperCase(),
          materialDet: this.form.materialDet.toUpperCase(),
          exit: this.form.exit.toUpperCase(),
          float: this.form.float,

          'id_company': this.arrayComp.id,
          'id_regional': this.arrayRegl.id,

          'detflap': this.arrayDetsAct,
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
            .post("/checkDetFlaps/delete", {
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
    dataFishery(){
      let me = this;

      var url = "/checkDetFlaps/fishery?id_FisheryAut="+this.id_CheckDet;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayFa = respuesta.fisheryAut;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    dataTable(){
      let me = this;

      var url = "/checkDetFlaps/dataTable?id_Detflap="+this.id_CheckDet;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDets2 = respuesta.detflap;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    message(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    },
    createPdf (data = []) {
      let me = this;
      var columns = []; var rows = [];
      var columns1 = []; var rows1 = [];
      var doc = new jsPDF('p','mm','letter');
      this.id_CheckDet = data["id"]
        var logo = new Image();
        var img1 = new Image();
        var img2 = new Image();
        var img3 = new Image();
        var img4 = new Image();
        logo.src = '/img/logoAUNAP.png';
        doc.addImage(logo, 'png', 20, 10, 33, 15);
        img1.src = '/img/img5.png';
        doc.addImage(img1, 'png', 15, 70, 40, 45);
        img2.src = '/img/img6.png';
        doc.addImage(img2, 'png', 60, 70, 40, 45);
        img3.src = '/img/img3.png';
        doc.addImage(img3, 'png', 100, 70, 40, 45);
        img4.src = '/img/img4.png';
        doc.addImage(img4, 'png', 140, 70, 40, 45);
        doc.text("FORMATO VERIFICACIÓN DETs DOBLE SOLAPA", 65, 20);
        // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
        doc.setFont("arial");
        // doc.setFont("arial", "bold");
        doc.setFontSize(11);
        doc.text("Oficina: " + me.datos.office, 15, 35 );
        doc.setFontSize(10);
        doc.text("Fecha: " + me.datos.date, 110, 35,);
        doc.setFontSize(10);
        doc.text("Regional: " + me.datos['nameRegional'], 15, 40,);
        doc.setFontSize(10);
        doc.text("Funcionario: " + me.datos.official, 110, 40,);
        doc.setFontSize(10);
        doc.text("Embarcación: " + me.datos.boat, 15, 45,);
        doc.setFontSize(10);
        doc.text("Empresa: " + me.datos['nameCompany'], 110, 45,);
        doc.setFontSize(10);
        doc.text("Matrícula: " + me.datos.enrollment, 15, 50,);
        doc.setFontSize(10);
        doc.text("Capitán: " + me.datos.fishCaptain, 110, 50,);
        doc.setFontSize(10);
        doc.text("Patente: " + me.datos.fishLicense, 15, 55,);
        doc.setFontSize(10);
        doc.text("Armador: " + me.datos.owner, 110, 55,);
        doc.setFontSize(10);
        doc.text("Localización: " + me.datos.location, 15, 60,);
        doc.setFontSize(10);
        // doc.text("Pesquería: " + me.datos.outhFhisher, 110, 60,);

            columns = [    
              { title: "Punto", dataKey: "nomCientifico" },
              { title: "DET's", dataKey: "nomComun" },
              { title: "Babor 1", dataKey: "estado" },
              { title: "Babor 2", dataKey: "presentacion" },
              { title: "Estribor 1", dataKey: "cant" },
              { title: "Estribor 2", dataKey: "peso" }             
            ];
            rows = [
              {"nomCientifico": this.pruebaData,
               "nomComun": this.pruebaData},
              // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional}, 
            ]; 

            columns1 = [    
              { title: "Tamaño de malla en la solapa", dataKey: "nomCientifico" },
              { title: "Ángulo del DET ", dataKey: "nomComun" },
              { title: "Tipo de DET", dataKey: "estado" },
              { title: "Material del DET", dataKey: "presentacion" },
              { title: "Salida (superior ó inferior)", dataKey: "cant" },
              { title: "Flotadores (cantidad)", dataKey: "peso" }             
            ];
            rows1 = [
              {"nomCientifico": this.pruebaData,
               "nomComun": this.pruebaData},
              // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional}, 
            ]; 
        doc.setFontSize(10);    
        doc.text(`DETs con salida inferior: si la circunferencia del DET es ≥ a 120", se requieren 2 boyas, si es menor solo se requiere una boya.`, 15, 145,  {align: 'justify',lineHeightFactor: 1,maxWidth:110} );    
        doc.setFontSize(10);    
        doc.text(`Exención: red de prueba (chango)  La longitud de la relinga superior debe ser de 12 pies o menos, y la longitud de la relinga inferior debe ser de 15 pies o menos`, 15, 153,  {align: 'justify',lineHeightFactor: 1,maxWidth:160} );  
        doc.setFontSize(10);
        doc.setFontSize(10);
        doc.text("Observaciones: " + me.datos.observation, 15, 165,);
        doc.setFontSize(10);
        doc.line(15, 255, 90, 255);
        doc.setFontSize(10);
        doc.text("Firma encargado de motonave", 30, 260 );
        doc.setFontSize(10);
        doc.line(185, 255, 110, 255);
        doc.setFontSize(10);
        doc.text("Firma funcionario", 135, 260 );

        doc.autoTable(columns, rows, {
          // theme: 'grid',
                margin: { top: 120 },
                didDrawPage: function () {
                  // doc.text("INFORMACIÓN DEL PROYECTO", 50, 60);
                },
        });     
        doc.autoTable(columns1, rows1, {
                margin: { top: 140 },
                didDrawPage: function () {
                },
        });     
      //  doc.save("FORMATO ACTA DE DONACIÓN");
      window.open(doc.output('bloburl'))
      // me.pdf = 0;
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
            // { "data": "outhFhisher" },
            { "data": "nameCompany" },
            { "data": "fishCaptain" },
            { "data": "location" },
             {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>  <button type='button'id='pdf' class='pdf btn btn-primary btn-sm' data-tooltip title='pdf' > <i class='fas fa-file-pdf'></i> </button>"},

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
          $('#dataTable tbody').on( 'click', '.pdf', function () {
                me.datos= table.row( $(this).parents('tr') ).data();
                me.createPdf(me.datos);
            } );
    });
    }
  },
  mounted() {
    this.selectBoats();
    this.listData();
    this.selectCompanies();
    this.selectRegional();
    this.selectFisheryAuthorized();
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
