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
          <button
            type="button"
            @click="carta()"
            class="btn btn-primary btn-sm"
          >
            <i class="icon-plus"></i>&nbsp;Autorización
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
                        type="number"
                        />
                        <span
                            class="md-error"
                            v-if="!$v.form.insNo.required"
                        >Olvidaste ingresar el número de inspección para el Zarpe
                        </span>
                    </md-field> 
                  </div>
                  <div class="md-layout-item">                 
                      <md-datepicker 
                        md-clearable :class="getValidationClass('dateIns')"
                        v-model="form.dateIns"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Fecha de Inspección</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateIns.required"
                          >Olvidaste ingresar la fecha de inspección
                        </span>
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
                              <!-- <md-option value="desembarque">Desembarque</md-option> -->
                            </md-select>
                          </md-field>
                        </div>&nbsp;&nbsp;&nbsp;
                      </div>
                        <!-- <div class="md-layout-item"> 
                          <label>PUERTO, ESTADO RECTOR DE PUERTO</label>           
                        </div> -->
                      <div>
                          <strong>PUERTO, ESTADO RECTOR DE PUERTO</strong>    
                      </div>

                      <div class="md-layout">
                        <div class="md-layout-item md-size-40">                 
                            <md-datepicker 
                              md-clearable :class="getValidationClass('dateScale')"
                              v-model="form.dateScale"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                              >
                              <label>Fecha Última Escala</label>
                              <span
                                class="md-error"
                                v-if="!$v.form.dateScale.required"
                                >Olvidaste ingresar la fecha de última escala
                              </span>
                            </md-datepicker>                   
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
                            <md-datepicker 
                              md-clearable :class="getValidationClass('dateZarpe')"
                              v-model="form.dateZarpe"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                              >
                              <label>Fecha de Zarpe</label>
                              <span
                                class="md-error"
                                v-if="!$v.form.dateZarpe.required"
                                >Olvidaste ingresar la fecha de zarpe
                              </span>
                            </md-datepicker>                   
                        </div> &nbsp;&nbsp;&nbsp;
                      </div>
                      <div class="md-layout">
                        <div class="md-layout-item md-size-70" >
                            <label class="text-muted">Puerto de Último Arribo</label>
                            <multiselect v-model="arrayPtArrival" :options="arrayPort"
                                placeholder="Seleccione Puerto de Último Arribo"
                                :custom-label="nameWithPort"
                                label="name"
                                track-by="name">
                            </multiselect>
                        </div>&nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">                 
                            <md-datepicker 
                              md-clearable :class="getValidationClass('dateLatestArrival')"
                              v-model="form.dateLatestArrival"
                              @input="toString"
                              md-immediately
                              :md-model-type="String"
                              >
                              <label>Fecha Último Arribo</label>
                              <span
                                class="md-error"
                                v-if="!$v.form.dateLatestArrival.required"
                                >Olvidaste ingresar la fecha de último arribo
                              </span>
                            </md-datepicker>                   
                        </div> &nbsp;&nbsp;&nbsp;                
                      </div>                 
                        <!-- <div class="md-layout-item">          
                          <label>SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS</label>
                        </div> -->
                        <div>
                            <strong>SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS</strong>    
                        </div>
                        
                      <div class="md-layout">
                        <div class="md-layout-item">
                          <md-field>
                            <label for="national" class="text-muted">Nacional</label> 
                            <md-select v-model="national" name="national" id="national" placeholder="Seleccione un sistema Nacional">
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
                      </div>
                      <div class="md-layout">
                        <div class="md-layout-item">  
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
                        </div>&nbsp;&nbsp;&nbsp; 
                        <div class="md-layout-item">  
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
                        </div>&nbsp;&nbsp;&nbsp; 
                      </div>  

                      <!-- <label>PERMISO OTORGADO - ÚLTIMA PRORROGA</label> -->
                      <div>
                            <strong>PERMISO OTORGADO - ÚLTIMA PRORROGA</strong>    
                      </div>
                  
                  <div class="md-layout">
                    <div class="md-layout-item md-size-50"> 
                      <md-field md-clearable :class="getValidationClass('noResolution')">
                        <label for="first-name">No. Resolución</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noResolution"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noResolution.required"
                        >Olvidaste ingresar el número de resolución</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="md-layout"> 
                    <div class="md-layout-item">                 
                        <md-datepicker 
                          md-clearable :class="getValidationClass('dateResolution')"
                          v-model="form.dateResolution"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha Resolución</label>
                          <span
                            class="md-error"
                            v-if="!$v.form.dateResolution.required"
                            >Olvidaste ingresar la fecha de resolución
                          </span>
                        </md-datepicker>                   
                    </div> &nbsp;&nbsp;&nbsp; 
                    <div class="md-layout-item">                 
                        <md-datepicker 
                          md-clearable :class="getValidationClass('dateValid')"
                          v-model="form.dateValid"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha Vigencia</label>
                          <span
                            class="md-error"
                            v-if="!$v.form.dateValid.required"
                            >Olvidaste ingresar la fecha de vigencia
                          </span>
                        </md-datepicker>                   
                    </div> &nbsp;&nbsp;&nbsp; 
                  </div>                    
                  <div class="md-layout">
                    <div class="md-layout-item">
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
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout">
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
                    </div>  &nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('noPatent')">
                        <label for="first-name">No. de Patente</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noPatent"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noPatent.required"
                        >Olvidaste ingresar el número de patente</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp; 
                    <div class="md-layout-item">                 
                        <md-datepicker 
                          md-clearable :class="getValidationClass('dateValidityPat')"
                          v-model="form.dateValidityPat"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha Vigencia Patente</label>
                          <span
                            class="md-error"
                            v-if="!$v.form.dateValidityPat.required"
                            >Olvidaste ingresar la fecha de vigencia patente
                          </span>
                        </md-datepicker>                   
                    </div> &nbsp;&nbsp;&nbsp;
                  </div> 
                  <div class="md-layout">
                    <div class="md-layout-item">
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
                    </div>&nbsp;&nbsp;&nbsp; 
                    <div class="md-layout-item">
                      <label class="text-muted">Empresa</label>
                        <multiselect v-model="arrayComp" :options="arrayCompany"
                            placeholder="Seleccione una empresa"
                            :custom-label="nameWithCompany"
                            label="name"
                            track-by="name">
                        </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div> 
 
                  <!-- <label>PESQUERÍA Y ARTES AUTORIZADOS</label> -->
                  <div>
                        <strong>PESQUERÍA Y ARTES AUTORIZADOS</strong>    
                  </div>

                  <!-- <div class="md-layout-item">
                      <label>Pesquería Autorizada</label>
                      <multiselect v-model="arrayFa" :options="arrayFisheryAuthorized"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithFisheryAuthorized"
                          label="name"
                          track-by="name">f
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp; -->
        
                  <div class="md-layout"> 
                    <div class="md-layout-item">
                      <label class="text-muted">Pesquería Autorizada</label>
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
                      <label>Zona de Pesca Autorizada</label>
                      <multiselect v-model="arrayZoneAuto" :options="arrayZoneAutoFish"
                          placeholder="Seleccione una zona"
                          :custom-label="nameWithZoneAutoFish"
                          label="name"
                          track-by="name">
                      </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
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


                  

                  <!-- <label>CARACTERÍSTICAS ARTE DE PESCA</label> -->
                  <div>
                        <strong>CARACTERÍSTICAS ARTE DE PESCA</strong>    
                  </div>
                 
                 <div class="md-layout">
                  <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Ancho de Red (Brazas)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="netWidth"
                        :disabled="sending"
                        type="number"
                      />
                    </md-field>
                   </div>&nbsp;&nbsp;&nbsp;
                   <div class="md-layout-item"> 
                    <md-field md-clearable>
                        <label for="first-name">Ojo de Malla (Pulgadas)</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="eyeMesh"
                          :disabled="sending"
                          type="number"
                        />
                      </md-field>
                   </div>&nbsp;&nbsp;&nbsp;              
                   <div class="md-layout-item"> 
                    <md-field md-clearable>
                        <label for="first-name">Cantidad total de anzuelos del palangre</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="totalLongline"
                          :disabled="sending"
                          type="number"
                        />
                      </md-field>
                   </div>&nbsp;&nbsp;&nbsp;              
                 </div>
                 <div class="md-layout">
                  <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Longitud de la red (Brazas)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="longNet"
                        :disabled="sending"
                        type="number"
                      />
                    </md-field>
                   </div>&nbsp;&nbsp;&nbsp;
                   <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Ojo de Malla del Copo (Pulgadas)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="eyeFlake"
                        :disabled="sending"
                        type="number"
                      />
                    </md-field> 
                   </div>&nbsp;&nbsp;&nbsp;
                   <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Tamaño No. y tipo de Anzuelo</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="typeHook"
                        :disabled="sending"
                      />
                    </md-field>
                   </div>&nbsp;&nbsp;&nbsp;           
                 </div>
                 <div class="md-layout">
                   <div class="md-layout-item">
                      <label>Material de Arte de Pesca</label>
                      <multiselect v-model="arrayMaterial" :options="arrayMaterialArt"
                          placeholder="Seleccione el material de arte de pesca"
                          :custom-label="nameWithMaterialArt"
                          label="name"
                          track-by="name">
                      </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field>
                        <label for="equipDevi" class="text-muted">Equipos o Dispositivos Requeridos</label> 
                        <md-select v-model="equipDevi" name="equipDevi" id="equipDevi" placeholder="Seleccione un equipo o dispositivo">
                          <md-option value="Dispositivo Agregado de preces - DAPs (FADs)">Dispositivo Agregado de preces - DAPs (FADs)</md-option>
                          <md-option value="Dispositivo Excluidor de Tortugas - DETs">Dispositivo Excluidor de Tortugas - DETs</md-option>
                          <md-option value="Otro">Otro</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                   <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Otro</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="other"
                        :disabled="sending"
                      />
                    </md-field>
                   </div>&nbsp;&nbsp;&nbsp;
                 </div>
                 <div class="md-layout">
                  <div class="md-layout-item"> 
                    <md-field md-clearable>
                      <label for="first-name">Nombre Capitán de Pesca</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="captain"
                        :disabled="sending"
                      />
                    </md-field>
                   </div>&nbsp;&nbsp;&nbsp;
                   <div class="md-layout-item">
                      <label>Nacionalidad</label>
                      <multiselect v-model="arrayNation" :options="arrayNationality"
                          placeholder="Seleccione un pais"
                          :custom-label="nameWithNationality"
                          label="name"
                          track-by="name">
                      </multiselect>
                   </div>&nbsp;&nbsp;&nbsp;
                 </div>

                  <!-- <label>LOS DATOS RELACIONADOS CON LAS MEDIDAS DE ORDENAMIENTO APLICABLES</label> -->
                  <div>
                        <strong>LOS DATOS RELACIONADOS CON LAS MEDIDAS DE ORDENAMIENTO APLICABLES</strong>    
                  </div>

                   <div class="md-layout-item">
                      <md-field>
                            <label>Observaciones al Cumplimiento de Medidas de Manejo Aplicables a la Pesquería (Nacional-OROP's)</label>
                            <md-textarea v-model="observation"></md-textarea>
                      </md-field>
                   </div>
                   <div class="md-layout-item">
                      <md-field>
                            <label>Conclusiones del Inspector</label>
                            <md-textarea v-model="conclusions"></md-textarea>
                      </md-field>
                   </div>
                   <div class="md-layout-item">
                      <md-field>
                            <label>Comentarios Adicionales (Espacio disponible para el capitan)</label>
                            <md-textarea v-model="comments"></md-textarea>
                      </md-field>
                   </div>
                   <div class="md-layout-item">
                      <md-field>
                            <label>Observaciones</label>
                            <md-textarea v-model="observationGeneral"></md-textarea>
                      </md-field>
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
                     <!-- SUBIR PDF -->
                 <p>
                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                    Subir PDF
                  </button>
                </p>                                
                <div class="collapse" id="collapseExample1">
                  <div class="card card-body">
                    <div
                      class="uploader1"
                      @dragenter="OnDragEnter"
                      @dragleave="OnDragLeave"
                      @dragover.prevent
                      @drop="onDrop"
                      :class="{ dragging: isDragging }"
                    >
                      <div class="upload-control" v-show="pdf.length">
                        <!-- <label for="file">Anexar otra Imágen</label> -->
                        <!-- <button @click="upload">Guardar Imágenes</button>
                        <button @click="abrirList">Cancelar</button> -->
                      </div>

                      <div v-show="!pdf.length">
                        <i class="fa fa-cloud-upload"></i>
                        <p>Arrastra tus PDF's aquí</p>
                        <div>O</div>
                        <div class="file-input">
                          <label for="file">Selecciona un PDF</label>
                          <input
                            type="file"
                            id="file"
                            accept="application/pdf"
                            @change="onInputChange"
                            multiple
                          />
                        </div>
                      </div>
                      <div class="images-preview" v-show="pdf.length">
                        <div
                          class="img-wrapper"
                          v-for="(image, index) in pdf" :key="index"
                        >
                          <img :src="pdf" :alt="`Image Uplaoder ${index}`" />
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
                <!-- FIN SUBIR PDF -->

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
    import jsPDF from 'jspdf';
    import 'jspdf-autotable';
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
        dateIns: format(now, dateFormat),
        dateScale: format(now, dateFormat),
        dateZarpe: format(now, dateFormat),
        dateResolution: format(now, dateFormat),
        dateValid: format(now, dateFormat),
        dateLatestArrival: format(now, dateFormat),
        dateValidityPat: format(now, dateFormat),
        
      },
      eyeMesh: "",
      netWidth: "",
      eyeFlake: "",
      longNet: "",
      // materialArt: "",
      equipDevi: "",
      captain: "",
      typeHook: "",
      totalLongline: "",
      other: "",

      observation: "",
      observationGeneral: "",
      conclusions: "",
      comments: "",
      notification: "",
      finalityZarpe: "",
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
      arrayFa:[],
      arrayFaAct:[],
	    arrayFisheryAuthorized: [],
      id_fisheryAuthorized: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      id_Company: 0,
      arrayMaterial: {id:0, name:''},
	    arrayMaterialArt: [],
      id_material: 0,
      
      noApply: "No aplica",
      
      edo: 1,

      tipoAccion: 1,
      listado: 1,
      idMcpio: 0,
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
      //variables pdf
      selectedFilePDF: null,
      isDraggingPDF: false,
      dragCountPDF: 0,
      filesPDF: [],     
      pdf: []
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
      dateIns: {
        required
      },
      dateScale: {
        required
      },
      dateZarpe: {
        required
      },
      dateLatestArrival: {
        required
      },
      dateResolution: {
        required
      },
      dateValid: {
        required
      },
      dateValidityPat: {
        required
      },
      
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
      this.eyeMesh = null;
      this.netWidth = null;
      this.eyeFlake = null;
      this.typeHook = null;
      this.longNet = null;
      this.totalLongline = null;
      this.other = null;
      // this.materialArt = null;
      this.equipDevi = null;
      this.captain = null;
      this.observation = null;
      this.observationGeneral = null;
      this.conclusions = null;
      this.comments = null;
      this.form.dateIns = null;
      this.form.dateScale = null;
      this.form.dateZarpe = null;
      this.form.dateResolution = null;
      this.form.dateValid = null;
      this.form.dateLatestArrival = null;
      this.form.dateValidityPat = null;
      this.notification = null;
      this.finalityZarpe = null;
      this.national = null;
  
      this.arrayReg = {id:0, name:'', nameMuni:''};
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtArrival = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayMaterial = {id:0, name:''};
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
    nameWithMaterialArt ({ name }) {
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
    selectMaterial() {
            let me = this;
            var url = "/materials/selectMaterials";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMaterialArt = respuesta.materials;
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
      this.eyeMesh = data["eyeMesh"];
      this.netWidth = data["netWidth"];
      this.eyeFlake = data["eyeFlake"];
      this.typeHook = data["typeHook"];
      this.longNet = data["longNet"];
      this.totalLongline = data["totalLongline"];
      this.other = data["other"];
      // this.materialArt = data["materialArt"];
      this.equipDevi = data["equipDevi"];
      this.captain = data["captain"];
      this.observation = data["observation"];
      this.observationGeneral = data["observationGeneral"];
      this.conclusions = data["conclusions"];
      this.comments = data["comments"];
      this.form.dateIns = data["dateIns"];
      this.form.dateScale = data["dateScale"];
      this.form.dateZarpe = data["dateZarpe"];
      this.form.dateResolution = data["dateResolution"];
      this.form.dateValid = data["dateValid"];
      this.form.dateLatestArrival = data["dateLatestArrival"];
      this.form.dateValidityPat = data["dateValidityPat"];
      this.notification = data["notification"];
      this.finalityZarpe = data["finalityZarpe"];
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
      this.arrayMaterial.id = data["id_material"];
			this.arrayMaterial.name = data["nameMaterial"];
      this.arrayNation.id = data["id_nationality"];
			this.arrayNation.name = data["nameNationality"];
      this.arrayOr.id = data["id_orop"];
			this.arrayOr.name = data["nameOrop"];
      this.arrayZoneAuto.id = data["id_zoneAutoFisher"];
			this.arrayZoneAuto.name = data["nameZoneAutoFisher"];
      this.arrayFa.id = data["arrayFa"];
			// this.arrayFa.name = data["nameFishery"];
      this.arrayComp.id = data["id_company"];
			this.arrayComp.name = data["nameCompany"];
      this.dataFishery();
 
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
      if (this.eyeMesh == "") {
        this.eyeMesh = this.noApply;
      }
      if (this.other == "") {
        this.other = this.noApply;
      }
      if (this.totalLongline == "") {
        this.totalLongline = this.noApply;
      }
      if (this.netWidth == "") {
        this.netWidth = this.noApply;
      }
      if (this.eyeFlake == "") {
        this.eyeFlake = this.noApply;
      }
      if (this.longNet == "") {
        this.longNet = this.noApply;
      }
      if (this.typeHook == "") {
        this.typeHook = this.noApply;
      }
      // if (this.materialArt == "") {
      //   this.materialArt = this.noApply;
      // }
      if (this.equipDevi == "") {
        this.equipDevi = this.noApply;
      }
      if (this.captain == "") {
        this.captain = this.noApply;
      }
      axios
        .post("/zarpes/save", {
          insNo: this.form.insNo.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          idOmi: this.form.idOmi.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent,
          representative: this.form.representative.toUpperCase(),
          eyeMesh: this.eyeMesh.toUpperCase(),
          netWidth: this.netWidth.toUpperCase(),
          eyeFlake: this.eyeFlake.toUpperCase(),
          typeHook: this.typeHook.toUpperCase(),
          longNet: this.longNet.toUpperCase(),
          totalLongline: this.totalLongline,
          other: this.other.toUpperCase(),
          // materialArt: this.materialArt.toUpperCase(),
          equipDevi: this.equipDevi.toUpperCase(),
          captain: this.captain.toUpperCase(),
          observation: this.observation.toUpperCase(),
          observationGeneral: this.observationGeneral.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),
          dateIns: this.form.dateIns,
          dateScale: this.form.dateScale,
          dateZarpe: this.form.dateZarpe,
          dateResolution: this.form.dateResolution,
          dateValid: this.form.dateValid,
          dateLatestArrival: this.form.dateLatestArrival,
          dateValidityPat: this.form.dateValidityPat,
          notification: this.notification,
          finalityZarpe: this.finalityZarpe,
          national: this.national,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_material': this.arrayMaterial.id,
          'id_nationality': this.arrayNation.id,
          'id_orop': this.arrayOr.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          'id_company': this.arrayComp.id,
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
      if (this.eyeMesh == "") {
        this.eyeMesh = this.noApply;
      }
      if (this.totalLongline == "") {
        this.totalLongline = this.noApply;
      }
      if (this.other == "") {
        this.other = this.noApply;
      }
      if (this.netWidth == "") {
        this.netWidth = this.noApply;
      }
      if (this.eyeFlake == "") {
        this.eyeFlake = this.noApply;
      }
      if (this.typeHook == "") {
        this.typeHook = this.noApply;
      }
      if (this.longNet == "") {
        this.longNet = this.noApply;
      }
      // if (this.materialArt == "") {
      //   this.materialArt = this.noApply;
      // }
      if (this.equipDevi == "") {
        this.equipDevi = this.noApply;
      }
      if (this.captain == "") {
        this.captain = this.noApply;
      }
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
          eyeMesh: this.eyeMesh.toUpperCase(),
          netWidth: this.netWidth.toUpperCase(),
          eyeFlake: this.eyeFlake.toUpperCase(),
          typeHook: this.typeHook.toUpperCase(),
          longNet: this.longNet.toUpperCase(),
          totalLongline: this.totalLongline,
          other: this.other.toUpperCase(),
          // materialArt: this.materialArt.toUpperCase(),
          equipDevi: this.equipDevi.toUpperCase(),
          captain: this.captain.toUpperCase(),
          observation: this.observation.toUpperCase(),
          observationGeneral: this.observationGeneral.toUpperCase(),
          conclusions: this.conclusions.toUpperCase(),
          comments: this.comments.toUpperCase(),
          dateIns: this.form.dateIns,
          dateScale: this.form.dateScale,
          dateZarpe: this.form.dateZarpe,
          dateResolution: this.form.dateResolution,
          dateValid: this.form.dateValid,
          dateLatestArrival: this.form.dateLatestArrival,
          dateValidityPat: this.form.dateValidityPat,
          notification: this.notification,
          finalityZarpe: this.finalityZarpe,
          national: this.national,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_material': this.arrayMaterial.id,
          'id_nationality': this.arrayNation.id,
          'id_orop': this.arrayOr.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          // 'id_fisheryAuthorized': this.arrayFa.id,
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
    // dataFishery(){
    //   let me = this;

    //   var url = "/zarpes/fishery?id_FisheryAut="+this.id_zarpes;
    //   axios
    //     .get(url)
    //     .then(function(response) {
    //       console.log(response);
    //       var respuesta = response.data;
    //       me.arrayFa = respuesta.data;
    //     })
    //     .catch(function(error) {
    //       console.log(error);
    //     });
    // },
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
    dataFishery(){
      let me = this;

      var url = "/zarpes/fishery?id_FisheryAut="+this.id_zarpes;
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
    message(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    },
    carta(data = []) {
      let me = this;
      var doc = new jsPDF('p','mm','letter');
      // (this.id_flag = data["id"]);
      // console.log("ID " + me.datos.id);
        var logo = new Image();
        logo.src = '/img/logoAUNAP.png';
        doc.addImage(logo, 'png', 20, 10, 33, 15);
        doc.text("FORMATO DE AUTORIZACIÓN DE ZARPE", 60, 20);
        // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
        doc.setFont("arial");
        doc.setFontSize(11);
        doc.text(`_____________, ____ de ________ de 201_



Señor(a) (res)

_________________________________
__________________________________
Ciudad: ___________________________



Respetado(s) señor(a) (res):



Asunto: Autorización para Zarpe.


Para su información y fines pertinentes le comunico que una vez realizada la inspección a la 
Motonave _________________________________________ con matrícula ________________ 
vinculada al permiso de pesca comercial industrial según Resolución # ___________ otorgado al 
señor ___________________________________ identificado con la cedula de ciudadanía número 
______________________________, se constató que cumple con los requisitos mínimos 
establecidos en la Resolución 1026 del 2014, para realizar faenas de pesca dirigida a la captura de 
___________________ 


Por la AUNAP						

 

Nombre: ____________________________	
Cargo: ______________________________		
Dirección oficina: _____________________                     
Teléfono oficina: ______________________                    
Correo Electrónico: ___________________                     
`, 30, 45);
        doc.setFontSize(8);
        doc.setTextColor(100);
        doc.text(`Nota: Si este documento se encuentra impreso se considera Copia no Controlada. La versión vigente está publicada en la 
ntranet de la Autoridad Nacional de Acuicultura y Pesca.`, 30, 260);
             
           
      window.open(doc.output('bloburl'))
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
            { "data": "namePort" },
            { "data": "dateZarpe" },
            { "data": "nameBoat" },
            { "data": "enrollment" },
            { "data": "captain" },
             {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>"},

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
    this.selectMaterial();   
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
