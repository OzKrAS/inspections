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
                    <th>Inspeccion No.</th>
                    <th>Región/Municipio</th>
                    <th>Puerto/Muelle de Inspección</th>
                    <th>Fecha Inspección</th>      
                    <!-- <th>Origen</th> -->
                    <!-- <th>Destino</th>               -->
                    <th>Puerto de Zarpe</th>
                    <th>Fecha Zarpe</th>    
                    <th>Nombre Embarcación</th>                                        
                    <th>Nombre Capitán de Pesca</th>
                    <th>Nacionalidad</th>
                    <th>Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                     <tr>
                        <th>Inspeccion No.</th>
                        <th>Región/Municipio</th>
                        <th>Puerto/Muelle de Inspección</th>
                        <th>Fecha Inspección</th>               
                        <!-- <th>Origen</th> -->
                        <!-- <th>Destino</th>                  -->
                        <th>Puerto de Zarpe</th>
                        <th>Fecha Zarpe</th>        
                        <th>Nombre Embarcación</th>                            
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
                        >Olvidaste ingresar el número de inspección para el arribo
                        </span>
                    </md-field> 
				              	<label class="text-muted">Región/Municipio</label>
                        <multiselect v-model="arrayReg" :options="arrayRegion"
                          placeholder="Región/Municipio"
                          :custom-label="nameWithRegion"
                          label="name"
                          track-by="name">
                        </multiselect>&nbsp;&nbsp;&nbsp;
                        <label class="text-muted">Puerto/Muelle de Inspección</label>
                        <multiselect v-model="arrayPt" :options="arrayPort"
                            placeholder="Puerto/Muelle de Inspección"
                            :custom-label="nameWithPort"
                            label="name"
                            track-by="name">
                        </multiselect>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <!-- <label class="negrita">Fecha de Inspección</label> -->
                        <div>
                          <md-datepicker 
                            v-model="dateIns"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                            >
                            <label>Fecha de Inspección</label>
                          </md-datepicker>
                        </div>
                      </div> &nbsp;&nbsp;&nbsp; 
                      <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Recibió Notificación Previa</label>
                          <md-select v-model="notification" name="notification" id="notification" placeholder="Recibió Notificación Previa">
                            <md-option value="si">Si</md-option>
                            <md-option value="no">No</md-option>
                          </md-select>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;  
                      <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Finalidad Arribo</label>
                          <md-select v-model="finalityArrival" name="finalityArrival" id="finalityArrival" placeholder="Finalidad Arribo">
                            <md-option value="pesca">Pesca</md-option>
                            <md-option value="transito">Tránsito</md-option>
                          </md-select>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp; 

                         <label>PUERTO, ESTADO RECTOR DE PUERTO</label> 

                          <div class="md-layout-item">
                            <md-field>
                              <label class="text-muted">Origen</label>
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
                            <label class="text-muted">Destino</label>
                            <md-select v-model="destination" name="destination" id="destination" placeholder="Destino">
                              <md-option value="caribe/Cartagena">Caribe/Cartagena</md-option>
                              <md-option value="caribe/Barranquilla">Caribe/Barranquilla</md-option>
                              <md-option value="pacifico/Bahia Solano">Pacifico/Bahía Solano</md-option>
                              <md-option value="pacifico/Buenaventura">Pacifico/Buenaventura</md-option>
                              <md-option value="pacifico/tumaco">Pacífico/Tumaco</md-option>
                            </md-select>
                          </md-field>
                        </div>&nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                          <!-- <label class="negrita">Fecha Última Escala</label> -->
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
                        <div class="md-layout-item">
                            <label class="text-muted">Puerto de Zarpe</label>
                            <multiselect v-model="arrayPtZarpe" :options="arrayPort"
                                placeholder="Puerto de Zarpe"
                                :custom-label="nameWithPort"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="md-layout-item">
                          <!-- <label class="negrita">Fecha de Zarpe</label> -->
                          <div>
                            <md-datepicker 
                              v-model="dateZarpe"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                              >
                              <label>Fecha de Zarpe</label>
                            </md-datepicker>
                          </div>
                        </div> &nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">
                            <label class="text-muted">Puerto de Ultimo Arribo</label>
                            <multiselect v-model="arrayPtArrival" :options="arrayPort"
                                placeholder="Puerto de Ultimo Arribo"
                                :custom-label="nameWithPort"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="md-layout-item">
                          <!-- <label class="negrita">Fecha Último Arribo</label> -->
                          <div>
                            <md-datepicker 
                              v-model="dateLatestArrival"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                              >
                              <label>Fecha Último Arribo</label>
                            </md-datepicker>
                          </div>
                        </div> &nbsp;&nbsp;&nbsp; 
                      <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Faena Realizada En</label>
                          <md-select v-model="workDone" name="workDone" id="workDone" placeholder="Faena Realizada En">
                            <md-option value="pesca">Pacífico</md-option>
                            <md-option value="transito">Caribe</md-option>
                            <md-option value="transito">San Andres</md-option>
                          </md-select>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp; 
                      <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Sistema de Localización de Buques/VMS</label>
                          <md-select v-model="locationSystem" name="locationSystem" id="locationSystem" placeholder="Sistema de Localización de Buques/VMS">
                            <md-option value="no">No</md-option>
                            <md-option value="si nacional">Si Nacional</md-option>
                            <md-option value="si OROP">Si OROP</md-option>
                          </md-select>
                        </md-field>
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

                     <label>PERMISO OTORGADO - ÚLTIMA PRORROGA</label>

                      <md-field md-clearable :class="getValidationClass('noResolution')">
                        <label for="first-name">No. de Resolición</label>
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
                        <!-- <label class="negrita">Fecha</label> -->
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
                      <div class="md-layout-item">
                        <!-- <label class="negrita">Vigencia</label> -->
                        <div>
                          <md-datepicker 
                            v-model="dateValidity"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                            >
                            <label>Seleccione Fecha Vigencia</label>
                          </md-datepicker>
                        </div>
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
                        >Olvidaste ingresar una matrícula</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noOmi')">
                        <label for="first-name">No. OMI</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noOmi"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noOmi.required"
                        >Olvidaste ingresar el identificador OMI</span>
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
                        <!-- <label class="negrita">Vigencia Patente</label> -->
                        <div>
                          <md-datepicker 
                            v-model="dateValidityPat"
                            @input="toString"
                            md-immediately
                            :md-model-type="String"
                            >
                            <label>Fecha Vigencia Patente</label>
                          </md-datepicker>
                        </div>
                      </div> &nbsp;&nbsp;&nbsp; 
                      <md-field md-clearable :class="getValidationClass('legalRepre')">
                        <label for="first-name">Representante Legal</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.legalRepre"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.legalRepre.required"
                        >Olvidaste ingresar un nombre para el representante legal</span>
                      </md-field>
                      <div class="md-layout-item">
                      <label class="text-muted">Empresa</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany"
                          placeholder="Seleccione una Empresa"
                          :custom-label="nameWithCompany"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;

                  <label>PESQUERÍA Y ARTES AUTORIZADOS</label>

                      <div class="md-layout-item">
                          <label class="text-muted">Pesquería Autorizada</label>
                          <multiselect v-model="arrayFa" :options="arrayFisheryAuthorized"
                              placeholder="Pesquería Autorizada"
                              :custom-label="nameWithFisheryAuthorized"
                              label="name"
                              track-by="name">
                          </multiselect>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                          <label class="text-muted">Zona de Pesca Autorizada</label>
                          <multiselect v-model="arrayZoneAuto" :options="arrayZoneAutoFish"
                              placeholder="Zona de Pesca Autorizada"
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
                        >Olvidaste ingresar las pulgadas del ojo de malla</span>
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
                      <div class="md-layout-item">
                          <label class="text-muted">Nacionalidad</label>
                          <multiselect v-model="arrayNation" :options="arrayNationality"
                              placeholder="Seleccione una Nacionalidad"
                              :custom-label="nameWithNationality"
                              label="name"
                              track-by="name">
                          </multiselect>
                      </div>&nbsp;&nbsp;&nbsp;
                      <md-field md-clearable :class="getValidationClass('noAllCrew')">
                        <label for="first-name">No. Total de Tripulantes</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noAllCrew"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noAllCrew.required"
                        >Olvidaste ingresar el número total de tripulantes</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noCrewForeign')">
                        <label for="first-name">No. Tripulantes Extranjeros</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noCrewForeign"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noCrewForeign.required"
                        >Olvidaste ingresar el número de tripulantes extrangeros</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noCrewNational')">
                        <label for="first-name">No. Tripulantes Nacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noCrewNational"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noCrewNational.required"
                        >Olvidaste ingresar el número de tripulantes nacionales</span>
                      </md-field>

                  <label>LOS DATOS RELACIONADOS CON LA FAENA Y CAPTURA</label>

                      <md-field md-clearable :class="getValidationClass('noDays')">
                        <label for="first-name">No. Días de Pesca</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noDays"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noDays.required"
                        >Olvidaste ingresar el número de días de pesca</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noAllHauls')">
                        <label for="first-name">No. Total de Lances</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noAllHauls"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noAllHauls.required"
                        >Olvidaste ingresar el número total de lances</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noHaulsNacional')">
                        <label for="first-name">No. Lances Nacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noHaulsNacional"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noHaulsNacional.required"
                        >Olvidaste ingresar el número total de lances nacionales</span>
                      </md-field>
                      <md-field md-clearable :class="getValidationClass('noHaulsInter')">
                        <label for="first-name">No. Lances Internacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noHaulsInter"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noHaulsInter.required"
                        >Olvidaste ingresar el número de lances internacionales</span>
                      </md-field>
                      <md-field>
                            <label>Observaciones al Cumplimiento de Medidas de Manejo Aplicables a la Pesquería (Nacional-OROP's)</label>
                            <md-textarea v-model="observation"></md-textarea>
                      </md-field>

                      <label><b>CAPTURA OJETIVO</b></label>
                      <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                        <thead>
                            <md-field md-clearable :class="getValidationClass('nameCommon1')">
                              <label for="first-name">Nombre Común</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.nameCommon1"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.nameCommon1.required"
                              >Olvidaste ingresar el nombre común</span>
                            </md-field>
                            <md-field md-clearable :class="getValidationClass('nameScientific1')">
                              <label for="first-name">Nombre Científico</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.nameScientific1"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.nameScientific1.required"
                              >Olvidaste ingresar el nombre científico</span>
                            </md-field>
                            <md-field md-clearable :class="getValidationClass('capture1')">
                              <label for="first-name">Captura - Ton.</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.capture1"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.capture1.required"
                              >Olvidaste ingresar la captura el toneladas</span>
                            </md-field>
                            <md-button
                              type="button"
                              class="md-dense md-raised md-primary"
                              :disabled="sending"
                              @click="addItemTarget()"
                            >Agregar
                            </md-button>
                          <tr>
                            <th>NOMBRE COMÙN</th>              
                            <th>NOMBRE CIENTÌFICO</th>    
                            <th>CAPTURA TON.</th>    
                            <th style="width: 90px">Opciones</th>
                          </tr>
                        </thead>
                       <tbody>
                          <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                            <td v-text="target.nameCommon1"></td>
                            <td v-text="target.nameScientific1"></td>
                            <td v-text="target.capture1"></td>
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
                          <tfoot>
                            <tr>
                              <th>NOMBRE COMÙN</th>              
                              <th>NOMBRE CIENTÌFICO</th>    
                              <th>CAPTURA TON.</th>    
                              <th style="width: 90px">Opciones</th>
                            </tr>
                          </tfoot>
                          <tbody>
                          </tbody>
                      </table>
                      <label><b>CAPTURA FAUNA INCIDENTAL</b></label>
                      <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                        <thead>
                           <md-field md-clearable :class="getValidationClass('nameCommon2')">
                              <label for="first-name">Nombre Común</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.nameCommon2"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.nameCommon2.required"
                              >Olvidaste ingresar el nombre común</span>
                            </md-field>
                            <md-field md-clearable :class="getValidationClass('nameScientific2')">
                              <label for="first-name">Nombre Científico</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.nameScientific2"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.nameScientific2.required"
                              >Olvidaste ingresar el nombre científico</span>
                            </md-field>
                            <md-field md-clearable :class="getValidationClass('capture2')">
                              <label for="first-name">Captura - Ton.</label>
                              <md-input
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                v-model="form.capture2"
                                :disabled="sending"
                              />
                              <span
                                class="md-error"
                                v-if="!$v.form.capture2.required"
                              >Olvidaste ingresar la captura en toneladas</span>
                            </md-field>
                            <md-button
                              type="button"
                              v-if="tipoAccion==1"
                              class="md-dense md-raised md-primary"
                              :disabled="sending"
                              @click="addItemFauna()"
                            >Agregar
                            </md-button>
                          <tr>
                            <th>NOMBRE COMÙN</th>              
                            <th>NOMBRE CIENTÌFICO</th>    
                            <th>CAPTURA TON.</th>    
                            <th style="width: 90px">Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(fauna,index) in arrayFauna" :key="`fauna-${index}`">
                            <td v-text="fauna.nameCommon2"></td>
                            <td v-text="fauna.nameScientific2"></td>
                            <td v-text="fauna.capture2"></td>
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
                              <th>NOMBRE COMÙN</th>              
                              <th>NOMBRE CIENTÌFICO</th>    
                              <th>CAPTURA TON.</th>  
                              <th style="width: 90px">Opciones</th>
                            </tr>
                          </tfoot>
                          <tbody>
                          </tbody>
                      </table>

                      <md-field md-clearable :class="getValidationClass('landedWeight')">
                        <label for="first-name">Peso Desembarcado Comprobado (ingreso planta proceso)(Ton)</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.landedWeight"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.landedWeight.required"
                        >Olvidaste ingresar el peso desembarcado comprobado</span>
                      </md-field>
                      <md-field>
                            <label>Conclusiones Del Inspector</label>
                            <md-textarea v-model="inspectorConclusions"></md-textarea>
                      </md-field>
                      <md-field>
                            <label>Comentarios Adicionales (espacio disponible para el capitan)</label>
                            <md-textarea v-model="additionalComments"></md-textarea>
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
        noResolution: "",
        nameBoat: "",
        enrollment: "",
        noPatent: "",
        eyeMesh: "",
        netWidth: "",
        eyeFlake: "",
        typeHook: "",
        longNet: "",
        materialArt: "",
        equipDevi: "",
        captain: "",
        noOmi: "",
        legalRepre: "",
        noAllCrew: "",
        noCrewForeign: "",
        noCrewNational: "",
        noDays: "",
        noAllHauls: "",
        noHaulsNacional: "",
        noHaulsInter: "",
        landedWeight: "",
        nameCommon1: "",
        nameScientific1: "",
        capture1: "",
        nameCommon2: "",
        nameScientific2: "",
        capture2: "",
      },

      observation: "",
      notification: "",
      finalityArrival: "",
      origin: "",
      destination: "",
      workDone: "",
      locationSystem: "",
      inspectorConclusions: "",
      additionalComments: "",

      dateIns: format(now, dateFormat),
      dateScale: format(now, dateFormat),
      dateZarpe: format(now, dateFormat),
      dateLatestArrival: format(now, dateFormat),
      dateValidityPat: format(now, dateFormat),
      date: format(now, dateFormat),
      dateValidity: format(now, dateFormat),

      arrayArrival: [],
      id_arrival: 0,

      arrayReg: {id:0, name:'', nameMuni:''},
	    arrayRegion: [],
      id_region: 0,
      arrayPt: {id:0, namePort:'', name:''},
	    arrayPort: [],
      id_port: 0,
      arrayPtZarpe: {id:0, namePort:'',name:''},
      id_portZarpe: 0,
      arrayPtArrival: {id:0, namePort:'',name:''},
      id_portArrival: 0,
      arrayFg: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      arrayNation: {id:0, name:''},
	    arrayNationality: [],
      id_nationality: 0,
      arrayZoneAuto: {id:0, name:''},
	    arrayZoneAutoFish: [],
      id_zoneAutoFisher: 0,
      arrayFa: {id:0, name:''},
	    arrayFisheryAuthorized: [],
      id_fisheryAuthorized: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_Company: 0,

      arrayTarget: [],
      arrayFauna: [],
          
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
      noOmi: {
        required
      },
      legalRepre: {
        required
      },
      noAllCrew: {
        required
      },
      noCrewForeign: {
        required
      },
      noCrewNational: {
        required
      },
      noDays: {
        required
      },
      noAllHauls: {
        required
      },
      noHaulsNacional: {
        required
      },
      noHaulsInter: {
        required
      },
      landedWeight: {
        required
      },
      nameCommon1: {
        required
      },
      nameScientific1: {
        required
      },
      capture1: {
        required
      },
      nameCommon2: {
        required
      },
      nameScientific2: {
        required
      },
      capture2: {
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
    addItemTarget() {
      let me = this;
      var total1 = me.arrayTarget.push({
        nameCommon1:this.form.nameCommon1,
        nameScientific1:this.form.nameScientific1,
        capture1:this.form.capture1
      });
      console.log("arrayTarget " + total1);
      me.clearTarget();
    
    },
    addItemFauna() {
      let me = this;
      var total2 = me.arrayFauna.push({
        nameCommon2:this.form.nameCommon2,
        nameScientific2:this.form.nameScientific2,
        capture2:this.form.capture2
      });
      console.log("arrayFauna " + total2);
      me.clearFauna();
       
      
    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
    },
    deleteFauna(index){
       this.arrayFauna.splice(index,1);
    },
    clearTarget() {
      this.form.nameCommon1 = null;
      this.form.nameScientific1 = null;
      this.form.capture1 = null;
    },
    clearFauna() {
      this.form.nameCommon2 = null;
      this.form.nameScientific2 = null;
      this.form.capture2 = null;
    },
    clearForm() {
      this.$v.$reset();
      this.form.insNo = null;
      this.form.radioCall = null;
      this.form.noResolution = null;
      this.form.nameBoat = null;
      this.form.enrollment = null;
      this.form.noPatent = null;
      this.form.eyeMesh = null;
      this.form.netWidth = null;
      this.form.eyeFlake = null;
      this.form.typeHook = null;
      this.form.longNet = null;
      this.form.materialArt = null;
      this.form.equipDevi = null;
      this.form.captain = null;
      this.form.noOmi = null;
      this.form.legalRepre = null;
      this.form.noAllCrew = null;
      this.form.noCrewForeign = null;
      this.form.noCrewNational = null;
      this.form.noDays = null;
      this.form.noAllHauls = null;
      this.form.noHaulsNacional = null;
      this.form.noHaulsInter = null;
      this.form.landedWeight = null;
      this.observation = null;
      this.notification = null;
      this.finalityArrival = null;
      this.origin = null;
      this.destination = null;
      this.workDone = null;
      this.locationSystem = null;
      this.inspectorConclusions = null;
      this.additionalComments = null;
      this.dateIns = null;
      this.dateScale = null;
      this.dateZarpe = null;
      this.dateLatestArrival = null;
      this.dateValidityPat = null;
      this.date = null;
      this.dateValidity = null;

      this.arrayReg = {id:0, name:'', nameMuni:''};
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtArrival = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayNation = {id:0, name:''};
      this.arrayZoneAuto = {id:0, name:''};
      this.arrayFa = {id:0, name:''};
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
        "/arrivals";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayArrival = respuesta.arrivals.data;
          me.myTable(me.arrayArrival);
    

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
            var url = "arrivals/selectNationality";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNationality = respuesta.nationality;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectFlag() {
            let me = this;
            var url = "arrivals/selectFlags";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFlag = respuesta.flag;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectZoneAutoFisher() {
            let me = this;
            var url = "/arrivals/selectZoneAutoFisher";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayZoneAutoFish = respuesta.autoFisher;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectFisheryAuthorized() {
            let me = this;
            var url = "/arrivals/selectFisheryAuthorized";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFisheryAuthorized= respuesta.fishery;
                }).catch(function (error) {
                    console.log(error);
            });
    },
    selectCompanies() {
            let me = this;
            var url = "/arrivals/selectCompanies";
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
      (this.id_arrival = data["id"]);
      this.form.insNo = data["insNo"];
      this.form.radioCall = data["radioCall"];
      this.form.noResolution = data["noResolution"];
      this.form.nameBoat = data["nameBoat"];
      this.form.enrollment = data["enrollment"];
      this.form.noPatent = data["noPatent"];
      this.form.eyeMesh = data["eyeMesh"];
      this.form.netWidth = data["netWidth"];
      this.form.eyeFlake = data["eyeFlake"];
      this.form.typeHook = data["typeHook"];
      this.form.longNet = data["longNet"];
      this.form.materialArt = data["materialArt"];
      this.form.equipDevi = data["equipDevi"];
      this.form.captain = data["captain"];
      this.form.noOmi = data["noOmi"];
      this.form.legalRepre = data["legalRepre"];
      this.form.noAllCrew = data["noAllCrew"];
      this.form.noCrewForeign = data["noCrewForeign"];
      this.form.noCrewNational = data["noCrewNational"];
      this.form.noDays = data["noDays"];
      this.form.noAllHauls = data["noAllHauls"];
      this.form.noHaulsNacional = data["noHaulsNacional"];
      this.form.noHaulsInter = data["noHaulsInter"];
      this.form.landedWeight = data["landedWeight"];
      this.observation = data["observation"];
      this.notification = data["notification"];
      this.finalityArrival = data["finalityArrival"];
      this.origin = data["origin"];
      this.destination = data["destination"];
      this.workDone = data["workDone"];
      this.locationSystem = data["locationSystem"];
      this.inspectorConclusions = data["inspectorConclusions"];
      this.additionalComments = data["additionalComments"];
      this.dateIns = data["dateIns"];
      this.dateScale = data["dateScale"];
      this.dateZarpe = data["dateZarpe"];
      this.dateLatestArrival = data["dateLatestArrival"];
      this.dateValidityPat = data["dateValidityPat"];
      this.date = data["date"];
      this.dateValidity = data["dateValidity"];

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
        .post("/arrivals/save", {
          insNo: this.form.insNo.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          eyeMesh: this.form.eyeMesh.toUpperCase(),
          netWidth: this.form.netWidth.toUpperCase(),
          eyeFlake: this.form.eyeFlake.toUpperCase(),
          typeHook: this.form.typeHook.toUpperCase(),
          longNet: this.form.longNet.toUpperCase(),
          materialArt: this.form.materialArt.toUpperCase(),
          equipDevi: this.form.equipDevi.toUpperCase(),
          captain: this.form.captain.toUpperCase(),
          noOmi: this.form.noOmi.toUpperCase(),
          legalRepre: this.form.legalRepre.toUpperCase(),
          noAllCrew: this.form.noAllCrew.toUpperCase(),
          noCrewForeign: this.form.noCrewForeign.toUpperCase(),
          noCrewNational: this.form.noCrewNational.toUpperCase(),
          noDays: this.form.noDays.toUpperCase(),
          noAllHauls: this.form.noAllHauls.toUpperCase(),
          noHaulsNacional: this.form.noHaulsNacional.toUpperCase(),
          noHaulsInter: this.form.noHaulsInter.toUpperCase(),
          landedWeight: this.form.landedWeight.toUpperCase(),
          observation: this.observation.toUpperCase(),
          notification: this.notification,
          finalityArrival: this.finalityArrival,
          origin: this.origin,
          destination: this.destination,
          workDone: this.workDone,
          locationSystem: this.locationSystem,
          inspectorConclusions :this.inspectorConclusions.toUpperCase(),
          additionalComments :this.additionalComments.toUpperCase(),
          dateIns :this.dateIns,
          dateScale :this.dateScale,
          dateZarpe :this.dateZarpe,
          dateLatestArrival: this.dateLatestArrival,
          dateValidityPat: this.dateValidityPat,
          date: this.date,
          dateValidity: this.dateValidity,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
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
        .put("/arrivals/update", {
          id: this.id_arrival,
          insNo: this.form.insNo.toUpperCase(),
          radioCall :this.form.radioCall.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat :this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent :this.form.noPatent.toUpperCase(),
          eyeMesh :this.form.eyeMesh.toUpperCase(),
          netWidth :this.form.netWidth.toUpperCase(),
          eyeFlake :this.form.eyeFlake.toUpperCase(),
          typeHook :this.form.typeHook.toUpperCase(),
          longNet :this.form.longNet.toUpperCase(),
          materialArt :this.form.materialArt.toUpperCase(),
          equipDevi :this.form.equipDevi.toUpperCase(),
          captain :this.form.captain.toUpperCase(),
          noOmi :this.form.noOmi.toUpperCase(),
          legalRepre :this.form.legalRepre.toUpperCase(),
          noAllCrew :this.form.noAllCrew.toUpperCase(),
          noCrewForeign :this.form.noCrewForeign.toUpperCase(),
          noCrewNational :this.form.noCrewNational.toUpperCase(),
          noDays :this.form.noDays.toUpperCase(),
          noAllHauls :this.form.noAllHauls.toUpperCase(),
          noHaulsNacional :this.form.noHaulsNacional.toUpperCase(),
          noHaulsInter :this.form.noHaulsInter.toUpperCase(),
          landedWeight :this.form.landedWeight.toUpperCase(),
          observation :this.observation.toUpperCase(),
          notification: this.notification,
          finalityArrival: this.finalityArrival,
          origin: this.origin,
          destination: this.destination,
          workDone: this.workDone,
          locationSystem: this.locationSystem,
          inspectorConclusions :this.inspectorConclusions.toUpperCase(),
          additionalComments :this.additionalComments.toUpperCase(),
          dateIns :this.dateIns,
          dateScale :this.dateScale,
          dateZarpe :this.dateZarpe,
          dateLatestArrival: this.dateLatestArrival,
          dateValidityPat: this.dateValidityPat,
          date: this.date,
          dateValidity: this.dateValidity,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
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
        title: "Esta seguro de Eliminar este arribo " + data["name"],
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
            .post("/arrivals/delete", {
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
            { "data": "namePort" },
            { "data": "dateIns" },
            // { "data": "origin" },
            // { "data": "destination" },
            { "data": "namePort" },
            { "data": "dateZarpe" },
            { "data": "nameBoat" },
            // { "data": "nameFlag" },
            // { "data": "enrollment" },
            { "data": "captain" },
            { "data": "nameNationality" },
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
