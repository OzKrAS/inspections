<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Inspección a Embarcación Pesquera - Zarpe</strong>          
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
                    <th>Inspección No.</th>        
                    <th>Región/Municipio</th>        
                    <th>Finalidad Zarpe</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Puerto de Zarpe</th>
                    <th>Fecha Zarpe</th>  
                    <th>Nombre Embarcación</th>
                    <th>Matricula</th>                                                        
                    <th>Nombre Capitán de Pesca</th>
                    <th>Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                     <tr>
                        <th>Inspección No.</th> 
                        <th>Región/Municipio</th>
                        <th>Finalidad Zarpe</th>
                        <th>Origen</th>
                        <th>Destino</th>    
                        <th>Puerto de Zarpe</th>
                        <th>Fecha Zarpe</th>
                        <th>Nombre Embarcación</th>
                        <th>Matricula</th>                                                                             
                        <th>Nombre Capitán de Pesca</th>
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
                <!-- <div class="md-layout"> -->
                <div class="md-layout"> 
                  <div class="md-layout-item md-size-70"> 
                    <md-field md-clearable :class="getValidationClass('insNo')">
                        <label for="first-name">Inspección No.</label>
                        <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.insNo"
                        :disabled="sending"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.insNo.required"
                        >Olvidaste ingresar el número de inspección para el Zarpe
                        </span>
                    </md-field> 
                  </div>
                    <div class="md-layout-item ">                                        
                          <md-datepicker 
                            v-model="dateIns"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"                          
                          >
                            <label>Fecha de Inspección</label>
                          </md-datepicker>                        
                      </div> &nbsp;&nbsp;&nbsp; 
                </div>
                     <div class="md-layout">  
                        <div class="md-layout-item">  
                        <label for="first-name" class="text-muted">Región/Municipio</label>
                          <multiselect v-model="arrayReg" :options="arrayRegion"
                            placeholder="Seleccione una región/municipio"
                            :custom-label="nameWithRegion"
                            label="nameMuni"
                            track-by="nameMuni">
                          </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="md-layout-item">  
                          <label for="first-name" class="text-muted">Puerto/Muelle de inspección</label>
                          <multiselect v-model="arrayPt" :options="arrayPort"
                              placeholder="Seleccione un puerto/muelle de inspección"
                              :custom-label="nameWithPort"
                              label="name"
                              track-by="name">
                          </multiselect>&nbsp;&nbsp;&nbsp;
                        </div>
                        </div>
                      <div class="md-layout">
                      <div class="md-layout-item">
                        <md-field>
                           <label for="notification" class="text-muted">Recibió Notificación Previa</label> 
                          <md-select v-model="notification" name="notification" id="notification" placeholder="Recibió Notificación Previa">
                            <md-option value="si">Si</md-option>
                            <md-option value="no">No</md-option>
                          </md-select>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp; 
                      <div class="md-layout-item">
                        <md-field>
                          <label for="finalityZarpe" class="text-muted">Finalidad Zarpe</label> 
                          <md-select v-model="finalityZarpe" name="finalityZarpe" id="finalityZarpe" placeholder="Finalidad Zarpe">
                            <md-option value="pesca">Pesca</md-option>
                            <md-option value="transito">Tránsito</md-option>
                          </md-select>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp; 

                         <label>PUERTO, ESTADO RECTOR DE PUERTO</label> 

                        <div class="md-layout-item">
                          <md-field>
                            <label for="origin" class="text-muted">Origen</label> 
                            <md-select v-model="origin" name="origin" id="origin" placeholder="Origen">
                              <md-option value="caribe/Cartagena">Caribe/Cartagena</md-option>
                              <md-option value="caribe/Barranquilla">Caribe/Barranquilla</md-option>
                              <md-option value="pacifico/Bahia Solano">Pacifico/Bahía Solano</md-option>
                              <md-option value="pacifico/Buenaventura">Pacifico/Buenaventura</md-option>
                              <md-option value="pacifico/tumaco">Pacífico/Tumaco</md-option>
                            </md-select>
                          </md-field>
                        </div>&nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                        <md-field>
                          <label for="destination" class="text-muted">Destino</label>
                          <md-select v-model="destination" name="destination" id="destination" placeholder="Destino">
                            <md-option value="caribe/Cartagena">Caribe/Cartagena</md-option>
                            <md-option value="caribe/Barranquilla">Caribe/Barranquilla</md-option>
                            <md-option value="pacifico/Bahia Solano">Pacifico/Bahía Solano</md-option>
                            <md-option value="pacifico/Buenaventura">Pacifico/Buenaventura</md-option>
                            <md-option value="pacifico/tumaco">Pacífico/Tumaco</md-option>
                          </md-select>
                        </md-field>
                      </div>
                      <div class="md-layout-item">                     
                        <div>
                          <md-datepicker 
                            v-model="dateScale"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Última Escala</label>
                          </md-datepicker>
                        </div>
                      </div> &nbsp;&nbsp;&nbsp; 

                      </div> 
                      <div class="md-layout">               
                        <div class="md-layout-item md-size-70">
                            <label class="text-muted">Puerto de Zarpe</label>
                            <multiselect v-model="arrayPtZarpe" :options="arrayPort"
                                placeholder="Seleccione Puerto de Zarpe"
                                :custom-label="nameWithPort"
                                label="name"
                                track-by="name">
                            </multiselect>
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
                      </div>
                  <div class="md-layout">
                  <div class="md-layout-item md-size-70" >
                      <label class="text-muted">Puerto de Ultimo Arribo</label>
                      <multiselect v-model="arrayPtArrival" :options="arrayPort"
                          placeholder="Seleccione Puerto de Ultimo Arribo"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;                 
                  <div class="md-layout-item">
                        <div>
                          <md-datepicker 
                            v-model="dateLatestArrival"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Fecha Ultimo Arribo</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp;
              </div>

                  <label>SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS</label>

                  <div class="md-layout-item">
                    <md-field>
                      <label for="national" class="text-muted">Nacional</label> 
                      <md-select v-model="national" name="national" id="national" placeholder="Seleccione un sistema NAcional">
                        <md-option value="no">No</md-option>
                        <md-option value="nacional-AIS">Nacional - AIS</md-option>
                        <md-option value="nacional-VMS">Nacional - VMS</md-option>
                        <md-option value="nacional-AIS/VMS">Nacional - AIS/VMS</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                  <div class="md-layout-item">
                         <label class="text-muted">OROP</label> 
                        <multiselect v-model="arrayOr" :options="arrayOrop"
                            placeholder="Seleccione una opción OROP"
                            :custom-label="nameWithOrop"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('radioCall')">
                    <label for="first-name">Señal Radiollamada Internacional</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.radioCall"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.radioCall.required"
                    >Olvidaste ingresar la señal radiollamada internacional</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('idOmi')">
                    <label for="first-name" class="text-muted">Identificador OMI</label>
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
                  </md-field>

                   <label>PERMISO OTORGADO - ÚLTIMA PRORROGA</label>

                  <md-field md-clearable :class="getValidationClass('noResolution')">
                    <label for="first-name">No. Resolución</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noResolution"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noResolution.required"
                    >Olvidaste ingresar el número de resolución</span>
                  </md-field>
                  <div class="md-layout-item">
                      <div>
                        <md-datepicker 
                          v-model="dateResolution"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                        >
                          <label>Fecha Resolución</label>
                        </md-datepicker>
                      </div>
                  </div> &nbsp;&nbsp;&nbsp; 
                  <div class="md-layout-item">                 
                        <md-datepicker 
                          v-model="dateValid"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha Vigencia</label>
                        </md-datepicker>                   
                  </div> &nbsp;&nbsp;&nbsp; 
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
                    >Olvidaste ingresar un nombre para la embarcación</span>
                  </md-field>
                  <div class="md-layout-item">
                    <label class="text-muted">Bandera</label>
                        <multiselect v-model="arrayFg" :options="arrayFlag"
                            placeholder="Seleccione una bandera"
                            :custom-label="nameWithFlag"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
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
                    >Olvidaste ingresar la matrícula</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('noPatent')">
                    <label for="first-name">No. de Pantente</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.noPatent"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.noPatent.required"
                    >Olvidaste ingresar el número de patente</span>
                  </md-field>
                  <div class="md-layout-item">
                        <label class="negrita">Vigencia Patente</label>
                        <div>
                          <md-datepicker 
                            v-model="dateValidityPat"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                          >
                            <label>Seleccione Fecha</label>
                          </md-datepicker>
                        </div>
                  </div> &nbsp;&nbsp;&nbsp; 
                  <md-field md-clearable :class="getValidationClass('representative')">
                    <label for="first-name">Representante Legal</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.representative"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.representative.required"
                    >Olvidaste ingresar el nombre del representante legal</span>
                  </md-field>
                  <div class="md-layout-item">
                    <label class="text-muted">Empresa</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany"
                          placeholder="Seleccione una empresa"
                          :custom-label="nameWithCompany"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;

                  <label>PESQUERÍA Y ARTES AUTORIZADOS</label>

                  <!-- <div class="md-layout-item">
                      <label>Pesquería Autorizada</label>
                      <multiselect v-model="arrayFa" :options="arrayFisheryAuthorized"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithFisheryAuthorized"
                          label="name"
                          track-by="name">f
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp; -->

                  <div>
                    <label class="typo__label">Pesquería Autorizada</label>
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
                      :preselect-first="true">
                    </multiselect>
                  </div>




                  <!-- <md-field>
                    <label for="movies">Movies</label>
                    <md-select v-model="arrayFa" name="movies" id="movies" multiple>
                      <md-option value="fight-club">Fight Club</md-option>
                      <md-option value="godfather">Godfather</md-option>
                      <md-option value="godfather-ii">Godfather II</md-option>
                      <md-option value="godfather-iii">Godfather III</md-option>
                      <md-option value="godfellas">Godfellas</md-option>
                      <md-option value="pulp-fiction">Pulp Fiction</md-option>
                      <md-option value="scarface">Scarface</md-option>
                    </md-select>
                  </md-field> -->


                  <div class="md-layout-item">
                      <label>Zona de Pesca Autorizada</label>
                      <multiselect v-model="arrayZoneAuto" :options="arrayZoneAutoFish"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithZoneAutoFish"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;

                  <label>CARACTERÍSTICAS ARTE DE PESCA</label>

                 <md-field md-clearable :class="getValidationClass('eyeMesh')">
                    <label for="first-name">Ojo de Malla (Pulgadas)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.eyeMesh"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.eyeMesh.required"
                    >Olvidaste ingresar una zona de pesca autorizada</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('netWidth')">
                    <label for="first-name">Ancho de Red (Brazas)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.netWidth"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.netWidth.required"
                    >Olvidaste ingresar el ancho de red</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('eyeFlake')">
                    <label for="first-name">Ojo de Malla del Copo (Pulgadas)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.eyeFlake"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.eyeFlake.required"
                    >Olvidaste ingresar el ojo de malla del copo</span>
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('typeHook')">
                    <label for="first-name">Tamaño No. y tipo de Anzuelo</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.typeHook"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.typeHook.required"
                    >Olvidaste ingresar un tamaño No. y tipo de anzuelo</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('longNet')">
                    <label for="first-name">Longitud de la red (Brazas)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.longNet"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.longNet.required"
                    >Olvidaste ingresar la longitud de la red</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('materialArt')">
                    <label for="first-name">Material de Arte de Pesca</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.materialArt"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.materialArt.required"
                    >Olvidaste ingresar el material de arte de pesca</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('equipDevi')">
                    <label for="first-name">Equipos o Dispositivos Requeridos</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.equipDevi"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.equipDevi.required"
                    >Olvidaste ingresar equipos o dispositivos requeridos</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('captain')">
                    <label for="first-name">Nombre Capitán de Pesca</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.captain"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.captain.required"
                    >Olvidaste ingresar un nombre para el capitan de pesca</span>
                  </md-field>
                  <div class="md-layout-item">
                      <label>Nacionalidad</label>
                      <multiselect v-model="arrayNation" :options="arrayNationality"
                          placeholder="Seleccione un pais"
                          :custom-label="nameWithNationality"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;

                  <!-- <label>LOS DATOS RELACIONADOS CON LAS MEDIDAS DE ORDENAMIENTO APLICABLES</label> -->

                   <md-field>
                        <label>Observaciones al Cumplimiento de Medidas de Manejo Aplicables a la Pesquería (Nacional-OROP's)</label>
                        <md-textarea v-model="observation"></md-textarea>
                   </md-field>
                   <md-field>
                        <label>Conclusiones del Inspector</label>
                        <md-textarea v-model="conclusions"></md-textarea>
                   </md-field>
                   <md-field>
                        <label>Comentarios Adicionales (Espacio disponible para el capitan)</label>
                        <md-textarea v-model="comments"></md-textarea>
                   </md-field>

               <!-- </div> -->
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
    
      return {form: {

        insNo: "",
        radioCall: "",
        idOmi: "",
        noResolution: "",
        nameBoat: "",
        enrollment: "",
        noPatent: "",
        representative: "",
        eyeMesh: "",
        netWidth: "",
        eyeFlake: "",
        typeHook: "",
        longNet: "",
        materialArt: "",
        equipDevi: "",
        captain: "",
        
      },

      observation: "",
      conclusions: "",
      comments: "",
      dateIns: format(now, dateFormat),
      dateScale: format(now, dateFormat),
      dateZarpe: format(now, dateFormat),
      dateResolution: format(now, dateFormat),
      dateValid: format(now, dateFormat),
      dateLatestArrival: format(now, dateFormat),
      dateValidityPat: format(now, dateFormat),
      notification: "",
      finalityZarpe: "",
      origin: "",
      destination: "",
      national: "",
      orop: "",
      
      arrayZarpes: [],
      id_zarpes: 0,

      arrayPt: {id:0, namePort:'', name:''},
	    arrayPort: [],
      id_port: 0,
      arrayReg: {id:0, name:'', nameMuni:''},
	    arrayRegion: [],
      id_region: 0,
      arrayPtZarpe: {id:0, namePort:'',name:''},
      id_portZarpe: 0,
      arrayPtArrival: {id:0, namePort:'',name:''},
      id_portArrival: 0,
      arrayPtOrigin: {id:0, name:''},
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      arrayNation: {id:0, name:''},
	    arrayNationality: [],
      id_nationality: 0,
      arrayOr: {id:0, name:''},
	    arrayOrop: [],
      id_orop: 0,
      arrayZoneAuto: {id:0, name:''},
	    arrayZoneAutoFish: [],
      id_zoneAutoFisher: 0,
      arrayFa:{},
	    arrayFisheryAuthorized: [],
      id_fisheryAuthorized: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_Company: 0,
      
      
      edo: 1,

      tipoAccion: 1,
      listado: 1,
      idMcpio: 0,
      sending: false,

      arrayData: [],
      modal: 0,
      tipoAccion: 0
    };
  },
  components: {
		vSelect,
		Multiselect
	},

  validations: {
    form: {

      insNo: {
        required
      },
      radioCall: {
        required
      },
      idOmi: {
        required
      },
      noResolution: {
        required
      },
      nameBoat: {
        required
      },
      enrollment: {
        required
      },
      noPatent: {
        required
      },
      representative: {
        required
      },
      eyeMesh: {
        required
      },
      netWidth: {
        required
      },
      eyeFlake: {
        required
      },
      typeHook: {
        required
      },
      longNet: {
        required
      },
      materialArt: {
        required
      },
      equipDevi: {
        required
      },
      captain: {
        required
      },
    }
  },

  computed: {

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
      this.form.insNo = null;
      this.form.radioCall = null;
      this.form.idOmi = null;
      this.form.noResolution = null;
      this.form.nameBoat = null;
      this.form.enrollment = null;
      this.form.noPatent = null;
      this.form.representative = null;
      this.form.eyeMesh = null;
      this.form.netWidth = null;
      this.form.eyeFlake = null;
      this.form.typeHook = null;
      this.form.longNet = null;
      this.form.materialArt = null;
      this.form.equipDevi = null;
      this.form.captain = null;
      this.observation = null;
      this.conclusions = null;
      this.comments = null;
      this.dateIns = null;
      this.dateScale = null;
      this.dateZarpe = null;
      this.dateResolution = null;
      this.dateValid = null;
      this.dateLatestArrival = null;
      this.dateValidityPat = null;
      this.notification = null;
      this.finalityZarpe = null;
      this.origin = null;
      this.destination = null;
      this.national = null;
  
      this.arrayReg = {id:0, name:'', nameMuni:''};
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtArrival = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayNation = {id:0, name:''};
      this.arrayOr = {id:0, name:''};
      this.arrayZoneAuto = {id:0, name:''};
      this.arrayFa = [];
      this.arrayComp = {id:0, name:''};
    },
    nameWithRegion ({ nameMuni,name  }) {
            return `${nameMuni} / ${name}`
    },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    nameWithNationality ({ name }) {
            return `${name}`
    },
    nameWithOrop ({ name }) {
            return `${name}`
    },
    nameWithZoneAutoFish ({ name }) {
            return `${name}`
    },
    nameWithFisheryAuthorized ({ name }) {
            return `${name}`
    },
    nameWithCompany ({ name }) {
            return `${name}`
    },
    listData() {
      let me = this;
      var url =
        "/zarpes";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayZarpes = respuesta.zarpes.data;
          me.myTable(me.arrayZarpes);
        })
        .catch(function (error) {
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
    selectRegion() {
            let me = this;
            var url = "/municipalities/selectMuni";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegion = respuesta.municipalities;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectNationality() {
            let me = this;
            var url = "nationality/selectNationality";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNationality = respuesta.nationality;
                }).catch(function (error) {
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
    selectOrop() {
            let me = this;
            var url = "orops/selectOrops";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayOrop = respuesta.orops;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectZoneAutoFisher() {
            let me = this;
            var url = "/zarpes/selectZoneAutoFisher";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayZoneAutoFish = respuesta.autoFisher;
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
    selectCompanies() {
            let me = this;
            var url = "/zarpes/selectCompanies";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCompany= respuesta.company;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_zarpes = data["id"]);
      this.form.insNo = data["insNo"];
      this.form.radioCall = data["radioCall"];
      this.form.idOmi = data["idOmi"];
      this.form.noResolution = data["noResolution"];
      this.form.nameBoat = data["nameBoat"];
      this.form.enrollment = data["enrollment"];
      this.form.noPatent = data["noPatent"];
      this.form.representative = data["representative"];
      this.form.eyeMesh = data["eyeMesh"];
      this.form.netWidth = data["netWidth"];
      this.form.eyeFlake = data["eyeFlake"];
      this.form.typeHook = data["typeHook"];
      this.form.longNet = data["longNet"];
      this.form.materialArt = data["materialArt"];
      this.form.equipDevi = data["equipDevi"];
      this.form.captain = data["captain"];
      this.observation = data["observation"];
      this.conclusions = data["conclusions"];
      this.comments = data["comments"];
      this.dateIns = data["dateIns"];
      this.dateScale = data["dateScale"];
      this.dateZarpe = data["dateZarpe"];
      this.dateResolution = data["dateResolution"];
      this.dateValid = data["dateValid"];
      this.dateLatestArrival = data["dateLatestArrival"];
      this.dateValidityPat = data["dateValidityPat"];
      this.notification = data["notification"];
      this.finalityZarpe = data["finalityZarpe"];
      this.origin = data["origin"];
      this.destination = data["destination"];
      this.national = data["national"];
  
      this.arrayReg.id = data["id_region"];
			this.arrayReg.name = data["nameReg"];
      this.arrayPt.id = data["id_port"];
			this.arrayPt.name = data["namePort"];
      this.arrayPtZarpe.id = data["id_portZarpe"];
			this.arrayPtZarpe.name = data["namePort"];
      this.arrayPtArrival.id = data["id_portArrival"];
			this.arrayPtArrival.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
			this.arrayFg.name = data["nameFlag"];
      this.arrayNation.id = data["id_nationality"];
			this.arrayNation.name = data["nameNationality"];
      this.arrayOr.id = data["id_orop"];
			this.arrayOr.name = data["nameOrop"];
      this.arrayZoneAuto.id = data["id_zoneAutoFisher"];
			this.arrayZoneAuto.name = data["nameZoneAutoFisher"];
      this.arrayFa.id = data["id_fisheryAuthorized"];
			this.arrayFa.name = data["nameFishery"];
      this.arrayComp.id = data["id_company"];
			this.arrayComp.name = data["nameCompany"];
 
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
        .post("/zarpes/save", {
          insNo: this.form.insNo.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          idOmi: this.form.idOmi.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          representative: this.form.representative.toUpperCase(),
          eyeMesh: this.form.eyeMesh.toUpperCase(),
          netWidth: this.form.netWidth.toUpperCase(),
          eyeFlake: this.form.eyeFlake.toUpperCase(),
          typeHook: this.form.typeHook.toUpperCase(),
          longNet: this.form.longNet.toUpperCase(),
          materialArt: this.form.materialArt.toUpperCase(),
          equipDevi: this.form.equipDevi.toUpperCase(),
          captain: this.form.captain.toUpperCase(),
          observation: this.observation.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),
          dateIns: this.dateIns,
          dateScale: this.dateScale,
          dateZarpe: this.dateZarpe,
          dateResolution: this.dateResolution,
          dateValid: this.dateValid,
          dateLatestArrival: this.dateLatestArrival,
          dateValidityPat: this.dateValidityPat,
          notification: this.notification,
          finalityZarpe: this.finalityZarpe,
          origin: this.origin,
          destination: this.destination,
          national: this.national,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
          'id_orop': this.arrayOr.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          'id_fisheryAuthorized': this.arrayFa.id,
          'id_company': this.arrayComp.id,

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
        .put("/zarpes/update", {
          id: this.id_zarpes,
          insNo: this.form.insNo.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          idOmi: this.form.idOmi.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          representative: this.form.representative.toUpperCase(),
          eyeMesh: this.form.eyeMesh.toUpperCase(),
          netWidth: this.form.netWidth.toUpperCase(),
          eyeFlake: this.form.eyeFlake.toUpperCase(),
          typeHook: this.form.typeHook.toUpperCase(),
          longNet: this.form.longNet.toUpperCase(),
          materialArt: this.form.materialArt.toUpperCase(),
          equipDevi: this.form.equipDevi.toUpperCase(),
          captain: this.form.captain.toUpperCase(),
          observation: this.observation.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),
          dateIns: this.dateIns,
          dateScale: this.dateScale,
          dateZarpe: this.dateZarpe,
          dateResolution: this.dateResolution,
          dateValid: this.dateValid,
          dateLatestArrival: this.dateLatestArrival,
          dateValidityPat: this.dateValidityPat,
          notification: this.notification,
          finalityZarpe: this.finalityZarpe,
          origin: this.origin,
          destination: this.destination,
          national: this.national,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
          'id_orop': this.arrayOr.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          'id_fisheryAuthorized': this.arrayFa.id,
          'id_company': this.arrayComp.id,
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
            .post("/zarpes/delete", {
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
            { "data": "insNo" },
            { "data": "nameReg" },
            { "data": "finalityZarpe" },
            { "data": "origin" },
            { "data": "destination" },
            { "data": "namePort" },
            { "data": "dateZarpe" },
            { "data": "nameBoat" },
            { "data": "enrollment" },
            { "data": "captain" },
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
    this.selectRegion();   
    this.selectPort();   
    this.selectFlag();   
    this.selectNationality();   
    this.selectOrop();   
    this.selectZoneAutoFisher();   
    this.selectFisheryAuthorized();   
    this.selectCompanies();   
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
