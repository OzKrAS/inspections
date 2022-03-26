<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Inspección a Embarcación Pesquera - Arribo</strong>          
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
                    <th>Región/Municipio</th>
                    <th>Puerto/Muelle de Inspección</th>
                    <th>Fecha Inspección</th>
                    <th>Notificación Previa</th>
                    <th>Finalidad Zarpe</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha Última Escala</th>
                    <th>Puerto de Zarpe</th>
                    <th>Fecha Zarpe</th>
                    <th>Puerto de Ultimo Arribo</th>
                    <th>Nacional</th>
                    <th>OROP</th>
                    <th>Señal Radiollamada Internacional</th>
                    <th>Identificador OMI</th>
                    <th>Permiso Otorgado - Última Prorroga</th>
                    <th>Fecha</th>
                    <th>Vigencia</th>
                    <th>Nombre Embarcación</th>
                    <th>Bandera</th>
                    <th>Matricula</th>
                    <th>No. Patente</th>
                    <th>Vigencia Patente</th>
                    <th>Representante Legal</th>
                    <th>Empresa</th>
                    <th>Pesqueria Autorizada</th>
                    <th>Zona de Pesca Autorizada</th>
                    <th>Características Arte De Pesca (Ojo de malla-pulgadas)</th>
                    <th>Ancho de la Red (Brazas)</th>
                    <th>Ojo de malla del Copo (pulgadas)</th>
                    <th>Tamaño No. y Tipo de Anzuelo</th>
                    <th>Longitud de la Red (Brazas)</th>
                    <th>Material de Arte de Pesca</th>
                    <th>Equipos o Dispositivos Requeridos</th>
                    <th>Nombre Capitán de Pesca</th>
                    <th>Nacionalidad</th>
                    <th>Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                     <tr>
                        <th>Región/Municipio</th>
                        <th>Puerto/Muelle de Inspección</th>
                        <th>Fecha Inspección</th>
                        <th>Notificación Previa</th>
                        <th>Finalidad Zarpe</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Fecha Última Escala</th>
                        <th>Puerto de Zarpe</th>
                        <th>Fecha Zarpe</th>
                        <th>Puerto de Ultimo Arribo</th>
                        <th>Nacional</th>
                        <th>OROP</th>
                        <th>Señal Radiollamada Internacional</th>
                        <th>Identificador OMI</th>
                        <th>Permiso Otorgado - Última Prorroga</th>
                        <th>Fecha</th>
                        <th>Vigencia</th>
                        <th>Nombre Embarcación</th>
                        <th>Bandera</th>
                        <th>Matricula</th>
                        <th>No. Patente</th>
                        <th>Vigencia Patente</th>
                        <th>Representante Legal</th>
                        <th>Empresa</th>
                        <th>Pesqueria Autorizada</th>
                        <th>Zona de Pesca Autorizada</th>
                        <th>Características Arte De Pesca (Ojo de malla-pulgadas)</th>
                        <th>Ancho de la Red (Brazas)</th>
                        <th>Ojo de malla del Copo (pulgadas)</th>
                        <th>Tamaño No. y Tipo de Anzuelo</th>
                        <th>Longitud de la Red (Brazas)</th>
                        <th>Material de Arte de Pesca</th>
                        <th>Equipos o Dispositivos Requeridos</th>
                        <th>Nombre Capitán de Pesca</th>
                        <th>Nacionalidad</th>
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
				              	<label>Región/Municipio</label>
                        <multiselect v-model="arrayReg" :options="arrayRegion"
                          placeholder="Seleccione una región"
                          :custom-label="nameWithRegion"
                          label="name"
                          track-by="name">
                        </multiselect>&nbsp;&nbsp;&nbsp;
                        <label>Puerto/Muelle de Inspección</label>
                        <multiselect v-model="arrayPt" :options="arrayPort"
                            placeholder="Seleccione un puerto/muelle"
                            :custom-label="nameWithPort"
                            label="name"
                            track-by="name">
                        </multiselect>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <label class="negrita">Fecha de Inspección</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateIns"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
                      </div> &nbsp;&nbsp;&nbsp; 
                      <div class="md-layout-item">
                        <label>Recibió Notificación Previa</label>
                        <multiselect v-model="arrayReg" :options="arrayNotification"
                            placeholder="Seleccione una opción"
                            :custom-label="nameWithRegion"
                            label="name"
                            track-by="name">
                        </multiselect>
                      </div> &nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                            <label>Finalidad Zarpe</label>
                            <multiselect v-model="arrayReg" :options="arrayFinalityZarpe"
                                placeholder="Seleccione una opción"
                                :custom-label="nameWithRegion"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;

                         <!-- <label>PUERTO, ESTADO RECTOR DE PUERTO</label>  -->

                        <div class="md-layout-item">
                          <label>Origen</label>
                          <multiselect v-model="arrayReg" :options="arrayOrigin"
                              placeholder="Seleccione una origen"
                              :custom-label="nameWithRegion"
                              label="name"
                              track-by="name">
                          </multiselect>
                        </div>&nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                            <label>Destino</label>
                            <multiselect v-model="arrayReg" :options="arrayDestination"
                                placeholder="Seleccione una región"
                                :custom-label="nameWithRegion"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <label class="negrita">Fecha Última Escala</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateScale"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
                      </div> &nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                            <label>Puerto de Zarpe</label>
                            <multiselect v-model="arrayPt" :options="arrayPort"
                                placeholder="Seleccione una región"
                                :custom-label="nameWithPort"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <label class="negrita">Fecha Zarpe</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateZarpe"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
                      </div> &nbsp;&nbsp;&nbsp;  
                  <md-field md-clearable :class="getValidationClass('portArrival')">
                    <label for="first-name">Puerto de Ultimo Arribo</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.portArrival"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.portArrival.required"
                    >Olvidaste ingresar el puerto para el ultimo arribo</span>
                  </md-field>
                  <div class="md-layout-item">
                        <label class="negrita">Fecha Ultimo Arribo</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateLatestArrival"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
                  </div> &nbsp;&nbsp;&nbsp;

                  <!-- <label>SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS</label> -->

                  <div class="md-layout-item">
                            <label>Nacional</label>
                            <multiselect v-model="arrayReg" :options="arrayNational"
                                placeholder="Seleccione una región"
                                :custom-label="nameWithRegion"
                                label="name"
                                track-by="name">
                            </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                            <label>OROP</label>
                            <multiselect v-model="arrayReg" :options="arrayOrop"
                                placeholder="Seleccione una región"
                                :custom-label="nameWithRegion"
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
                    <label for="first-name">Identificador OMI</label>
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

                   <!-- <label>PERMISO OTORGADO - ÚLTIMA PRORROGA</label> -->

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
                        <label class="negrita">Fecha</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateResolution"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
                  </div> &nbsp;&nbsp;&nbsp; 
                  <div class="md-layout-item">
                        <label class="negrita">Vigencia</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateValid"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
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
                        <label>Bandera</label>
                        <multiselect v-model="arrayFg" :options="arrayFlag"
                            placeholder="Seleccione una región"
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
                    >Olvidaste ingresar el numero de patente</span>
                  </md-field>
                  <div class="md-layout-item">
                        <label class="negrita">Vigencia Patente</label>
                        <v-flex xs12 sm6>
                          <input
                            type="date"
                            class="form-control"
                            v-model="dateValidityPat"
                            pattern="\d{4}-\d{2}-\d{2}"
                          />
                        </v-flex>
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
                  <md-field md-clearable :class="getValidationClass('business')">
                    <label for="first-name">Empresa</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.business"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.business.required"
                    >Olvidaste ingresar el nombre de la empresa</span>
                  </md-field>

                  <!-- <label>PESQUERÍA Y ARTES AUTORIZADOS</label> -->

                  <div class="md-layout-item">
                            <label>Pesquería Autorizada</label>
                            <multiselect v-model="arrayReg" :options="arrayFishAut"
                                placeholder="Seleccione una pesquería autorizada"
                                :custom-label="nameWithRegion"
                                label="name"
                                track-by="name">
                            </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <md-field md-clearable :class="getValidationClass('zoneAutFish')">
                    <label for="first-name">Zona de Pesca Autorizada</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.zoneAutFish"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.zoneAutFish.required"
                    >Olvidaste ingresar una zona de pesca autorizada</span>
                  </md-field>

                  <!-- <label>CARACTERÍSTICAS ARTE DE PESCA</label> -->

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
                    >Olvidaste ingresar un nombre para el capitan</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('nacionality')">
                    <label for="first-name">Nacionalidad</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nacionality"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nacionality.required"
                    >Olvidaste ingresar una nacionalidad</span>
                  </md-field>

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
        portArrival: "",
        radioCall: "",
        idOmi: "",
        noResolution: "",
        nameBoat: "",
        enrollment: "",
        noPatent: "",
        representative: "",
        business: "",
        zoneAutFish: "",
        eyeMesh: "",
        netWidth: "",
        eyeFlake: "",
        typeHook: "",
        longNet: "",
        materialArt: "",
        equipDevi: "",
        captain: "",
        nacionality: "",
        
      },

      observation: "",
      conclusions: "",
      comments: "",

      arrayZarpes: [],
      id_zarpes: 0,
      arrayReg: {id:0, name:''},
	    arrayRegion: [],
      id_region: 0,
      arrayPt: {id:0, name:''},
	    arrayPort: [],
      id_port: 0,
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      arrayNotification: [],
      arrayFinalityZarpe: [],
      arrayOrigin: [],
      arrayDestination: [],
      arrayNational: [],
      arrayOrop: [],
      arrayFlag: [],
      arrayFishAut: [],
      dateIns: 0,
      dateScale: 0,
      dateZarpe: 0,
      dateResolution: 0,
      dateValid: 0,
      dateLatestArrival: 0,
      dateValidityPat: 0,
      
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
      portArrival: {
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
      business: {
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
      nacionality: {
        required
      },
      zoneAutFish: {
        required
      }
    }
  },

  computed: {

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
    validateData() {
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.saveData();
        this.clearForm();
      }
    },
    clearForm() {
      this.$v.$reset();
      this.form.name = null;
      this.form.insNo = null;
      this.form.portArrival = null;
      this.form.radioCall = null;
      this.form.idOmi = null;
      this.form.noResolution = null;
      this.form.nameBoat = null;
      this.form.enrollment = null;
      this.form.noPatent = null;
      this.form.representative = null;
      this.form.business = null;
      this.form.zoneAutFish = null;
      this.form.eyeMesh = null;
      this.form.netWidth = null;
      this.form.eyeFlake = null;
      this.form.typeHook = null;
      this.form.longNet = null;
      this.form.materialArt = null;
      this.form.equipDevi = null;
      this.form.captain = null;
      this.form.nacionality = null;
      this.observation = null;
      this.conclusions = null;
      this.comments = null;
      this.arrayReg = {id:0, name:''};
      this.arrayPt = {id:0, name:''};
      this.arrayFg = {id:0, name:''};
    },
    nameWithRegion ({ name }) {
            return `${name}`
    },
    nameWithPort ({ name }) {
            return `${name}`
    },
    nameWithFlag ({ name }) {
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
            var url = "ports/selectPorts";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPort = respuesta.port;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectRegion() {
            let me = this;
            var url = "region/selectRegion";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegion = respuesta.region;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectFlag() {
            let me = this;
            var url = "flags/selectFlag";
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
      (this.id_zarpes = data["id"]);
      this.form.insNo = data["insNo "];
      this.form.portArrival = data["portArrival"];
      this.form.radioCall = data["radioCall"];
      this.form.idOmi = data["idOmi"];
      this.form.noResolution = data["noResolution"];
      this.form.nameBoat = data["nameBoat"];
      this.form.enrollment = data["enrollment"];
      this.form.noPatent = data["noPatent"];
      this.form.representative = data["representative"];
      this.form.business = data["business"];
      this.form.zoneAutFish = data["zoneAutFish"];
      this.form.eyeMesh = data["eyeMesh"];
      this.form.netWidth = data["netWidth"];
      this.form.eyeFlake = data["eyeFlake"];
      this.form.typeHook = data["typeHook"];
      this.form.longNet = data["longNet"];
      this.form.materialArt = data["materialArt"];
      this.form.equipDevi = data["equipDevi"];
      this.form.captain = data["captain"];
      this.form.nacionality = data["nacionality"];
      this.observation = data["observation"];
      this.conclusions = data["conclusions"];
      this.comments = data["comments"];

      this.arrayReg.id = data["id_region"];
			this.arrayReg.name = data["nameReg"];
      this.arrayPt.id = data["id_port"];
			this.arrayPt.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
			this.arrayFg.name = data["nameFlag"];
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
          portArrival: this.form.portArrival.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          idOmi: this.form.idOmi.toUpperCase(),
          noResolution: this.noResolution.name.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          representative: this.form.representative.toUpperCase(),
          business: this.form.business.toUpperCase(),
          zoneAutFish: this.form.zoneAutFish.toUpperCase(),
          eyeMesh: this.form.eyeMesh.toUpperCase(),
          netWidth: this.form.netWidth.toUpperCase(),
          eyeFlake: this.form.eyeFlake.toUpperCase(),
          typeHook: this.form.typeHook.toUpperCase(),
          longNet: this.form.longNet.toUpperCase(),
          materialArt: this.form.materialArt.toUpperCase(),
          equipDevi: this.form.equipDevi.toUpperCase(),
          captain: this.form.captain.toUpperCase(),
          nacionality: this.form.nacionality.toUpperCase(),
          observation: this.observation.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_flag': this.arrayFg.id,
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
          name: this.form.name.toUpperCase(),
          insNo: this.form.insNo.toUpperCase(),
          portArrival: this.form.portArrival.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          idOmi: this.form.idOmi.toUpperCase(),
          noResolution: this.noResolution.name.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          representative: this.form.representative.toUpperCase(),
          business: this.form.business.toUpperCase(),
          zoneAutFish: this.form.zoneAutFish.toUpperCase(),
          eyeMesh: this.form.eyeMesh.toUpperCase(),
          netWidth: this.form.netWidth.toUpperCase(),
          eyeFlake: this.form.eyeFlake.toUpperCase(),
          typeHook: this.form.typeHook.toUpperCase(),
          longNet: this.form.longNet.toUpperCase(),
          materialArt: this.form.materialArt.toUpperCase(),
          equipDevi: this.form.equipDevi.toUpperCase(),
          captain: this.form.captain.toUpperCase(),
          nacionality: this.form.nacionality.toUpperCase(),
          observation: this.observation.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_flag': this.arrayFg.id,
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
              id: this.id_zarpes
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

            { "data": "name" },
            { "data": "nameReg" },
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
