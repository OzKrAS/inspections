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
                  <div class="md-layout-item md-size-65">
                    <md-field md-clearable :class="getValidationClass('insNo')">
                        <label for="first-name">Inspección No. (Inspection)</label>
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
                        >Olvidaste ingresar el número de inspección para el arribo
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
                        <label>Fecha de Inspección (Inspection Date)</label>
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
                    <label class="text-muted">Región/Municipio (Region / Municipality)</label>
                        <multiselect v-model="arrayReg" :options="arrayRegion"
                          placeholder="Región/Municipio"
                          :custom-label="nameWithRegion"
                          label="name"
                          track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto/Muelle de Inspección (Port / Dock)</label>
                        <multiselect v-model="arrayPt" :options="arrayPort"
                            placeholder="Puerto/Muelle de Inspección"
                            :custom-label="nameWithPort"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <!-- <div class="md-layout-item">
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
                  </div> &nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Recibió Notificación Previa (Prior Notification)</label>
                          <md-select v-model="notification" name="notification" id="notification" placeholder="Recibió Notificación Previa">
                            <md-option value="si">Si</md-option>
                            <md-option value="no">No</md-option>
                          </md-select>
                        </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                        <md-field>
                          <label class="text-muted">Finalidad Arribo (Arrival's Purpose)</label>
                          <md-select v-model="finalityArrival" name="finalityArrival" id="finalityArrival" placeholder="Finalidad Arribo">
                            <md-option value="pesca">Pesca</md-option>
                            <md-option value="transito">Tránsito</md-option>
                            <md-option value="desembarque">Desembarque</md-option>
                            <md-option value="mantenimiento">Mantenimiento</md-option>
                          </md-select>
                        </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item">
                        <md-field md-clearable :class="getValidationClass('stateRectorPort')">
                            <label for="first-name">Estado Rector de Puerto.</label>
                            <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.stateRectorPort"
                            :disabled="sending"
                            />
                            <span
                                class="md-error"
                                v-if="!$v.form.stateRectorPort.required"
                            >Olvidaste ingresar el estado rector del puerto
                            </span>
                        </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                </div>
                <div class="md-layout">
                  <!-- <div class="md-layout-item">
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
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <!-- <div class="md-layout-item md-size-30">
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
                          >Olvidaste ingresar la fecha de vigencia
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp; -->
                </div>
                 <md-divider style="background-color: #2090E8 " ></md-divider>
                 <br>
                <div>
                    <strong>PUERTO, ESTADO RECTOR DE PUERTO</strong>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                      <md-field>
                        <label class="text-muted">Estado Rector del Puerto (Port / Port State)</label>
                        <md-select v-model="stateRectorPort" name="stateRectorPort" id="stateRectorPort" placeholder="Estado Rector del Puerto">
                          <md-option value="colombia">Colombia</md-option>
                        </md-select>
                      </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label class="text-muted">Puerto de Zarpe (Departure’s Port)</label>
                      <multiselect v-model="arrayPtZarpe" :options="arrayPort"
                          placeholder="Puerto de Zarpe"
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
                        <label>Fecha de Zarpe (Departure’s Date)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateZarpe.required"
                          >Olvidaste ingresar la fecha de zarpe
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-70">
                      <label class="text-muted">Puerto de Ultimo Arribo (Last Arrival’s Port)</label>
                      <multiselect v-model="arrayPtArrival" :options="arrayPort"
                          placeholder="Puerto de Ultimo Arribo"
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
                        <label>Fecha Último Arribo (Last Arrival’s Date)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateLatestArrival.required"
                          >Olvidaste ingresar la fecha de último arribo
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                </div>
                 <md-divider style="background-color: #2090E8 " ></md-divider>
                 <br>
                <div>
                    <strong>SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS</strong>
                </div>
                <div class="md-layout">
                  <!-- <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Sistema de Localización de Buques/VMS</label>
                      <md-select v-model="locationSystem" name="locationSystem" id="locationSystem" placeholder="Sistema de Localización de Buques/VMS">
                        <md-option value="no">No</md-option>
                        <md-option value="si nacional">Si Nacional</md-option>
                        <md-option value="si OROP">Si OROP</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                    <md-field>
                      <label for="locationSystem" class="text-muted">Nacional</label>
                      <md-select v-model="locationSystem" name="locationSystem" id="locationSystem" placeholder="Seleccione un sistema Nacional">
                        <md-option value="no">No</md-option>
                        <md-option value="nacional-AIS">Nacional - AIS</md-option>
                        <md-option value="nacional-VMS">Nacional - VMS</md-option>
                        <md-option value="nacional-AIS/VMS">Nacional - AIS/VMS</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
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
                    <md-field md-clearable :class="getValidationClass('radioCall')">
                      <label for="first-name">Señal Radiollamada Internacional (International Radio Call Signal)</label>
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
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                        <label class="text-muted">OROP</label>
                        <multiselect v-model="arrayOr" :options="arrayOrop"
                            placeholder="Seleccione una opción OROP"
                            :custom-label="nameWithOrop"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('idOmi')">
                      <label for="first-name" class="text-muted">Identificador OMI (IMO Identifier)</label>
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
            <md-divider style="background-color: #2090E8 " ></md-divider>
          <br>
                <div>
                  <strong>PERMISO OTORGADO - ÚLTIMA PRORROGA</strong>
                </div>
                <div class="md-layout">
                <label class="text-muted">Nombre de la embarcación (Ship Name)</label>
                    <multiselect v-model="arrayBt" :options="arrayBoat"
                        @input="setBoats()"
                        placeholder="Seleccione una embarcación"
                        :custom-label="nameWithBoat"
                        label="nameBoat"
                        track-by="nameBoat">
                    </multiselect>
                    </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noResolution')">
                      <label for="first-name">No. Resolución (Resolution No.)</label>
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


                  <div class="md-layout-item">
                      <md-datepicker
                        md-clearable :class="getValidationClass('dateResolution')"
                        v-model="form.dateResolution"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Fecha Resolución (Resolution Date)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateResolution.required"
                          >Olvidaste ingresar la fecha de resolución
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <md-datepicker
                        md-clearable :class="getValidationClass('dateValidity')"
                        v-model="form.dateValidity"
                        @input="toString"
                        md-immediately
                        :md-model-type="String"
                        >
                        <label>Fecha Vigencia (Validity Date)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateValidity.required"
                          >Olvidaste ingresar la fecha de vigencia
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameBoat')">
                        <label for="first-name">Nombre Embarcación (Ship Name)</label>
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
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Bandera (Flag)</label>
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
                        >Olvidaste ingresar una matrícula</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noOmi')">
                        <label for="first-name">No. OMI</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noOmi"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noOmi.required"
                        >Olvidaste ingresar el identificador OMI</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noPatent')">
                        <label for="first-name">No. de Patente (Patent)</label>
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
                        <label>Fecha Vigencia Patente (Validity Name)</label>
                        <span
                          class="md-error"
                          v-if="!$v.form.dateValidityPat.required"
                          >Olvidaste ingresar la fecha de vigencia
                        </span>
                      </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('legalRepre')">
                        <label for="first-name">Representante Legal (Legal Representative)</label>
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
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label class="text-muted">Empresa (Enterprise)</label>
                      <multiselect v-model="arrayComp" :options="arrayCompany"
                          placeholder="Seleccione una Empresa"
                          :custom-label="nameWithCompany"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                 <md-divider style="background-color: #2090E8 " ></md-divider>
                 <br>
                <div>
                  <strong>PESQUERÍA Y ARTES AUTORIZADOS</strong>
                </div>

                <div class="md-layout">
                  <!-- <div class="md-layout-item">
                      <label class="text-muted">Pesquería Autorizada</label>
                      <multiselect v-model="arrayFa" :options="arrayFisheryAuthorized"
                          placeholder="Pesquería Autorizada"
                          :custom-label="nameWithFisheryAuthorized"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                    <label class="text-muted">Pesquería Autorizada (Fishery)</label>
                    <multiselect
                      v-model="arrayFa"
                      :options="arrayFisheryAuthorized"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="false"
                      placeholder="Seleccione Pesquería Autorizada"
                      label="name"
                      track-by="name"
                      :preselect-first="false">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label class="text-muted">Zona de Pesca Autorizada (Fishing Zone)</label>
                      <multiselect v-model="arrayZoneAuto" :options="arrayZoneAutoFish"
                          placeholder="Zona de Pesca Autorizada"
                          :custom-label="nameWithZoneAutoFish"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <md-divider style="background-color: #2090E8 " ></md-divider>
                <br>
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
                          type="number"
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
                       <label class="text-muted">Equipos o Dispositivos Requeridos</label>
                        <multiselect v-model="arrayEquipDevi" :options="arrayValue"
                          placeholder="Equipos o Dispositivo"
                          :custom-label="nameWithName"
                          label="name"
                          track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                      <label for="first-name md-size-20">Otro</label>
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
                        <label for="first-name">Nombre Capitán de Pesca (Captain Name)</label>
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
                      <label class="text-muted">Nacionalidad (Nationality)</label>
                      <multiselect v-model="arrayNation" :options="arrayNationality"
                          placeholder="Seleccione una Nacionalidad"
                          :custom-label="nameWithNationality"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable>
                        <label for="first-name">No. Total de Tripulantes</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="noAllCrew"
                          :disabled="sending"
                          type="number"
                        />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                        <label for="first-name">No. Tripulantes Extranjeros</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="noCrewForeign"
                          :disabled="sending"
                          type="number"
                        />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable>
                        <label for="first-name">No. Tripulantes Nacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="noCrewNational"
                          :disabled="sending"
                          type="number"
                        />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                 <md-divider style="background-color: #2090E8 " ></md-divider>
                 <br>
                <div>
                  <strong>LOS DATOS RELACIONADOS CON LA FAENA Y CAPTURA</strong>
                </div>

                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noDays')">
                        <label for="first-name">No. Días de Pesca</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noDays"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noDays.required"
                        >Olvidaste ingresar el número de días de pesca</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noAllHauls')">
                        <label for="first-name">No. Total de Lances</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noAllHauls"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noAllHauls.required"
                        >Olvidaste ingresar el número total de lances</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noHaulsNacional')">
                        <label for="first-name">No. Lances Nacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noHaulsNacional"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noHaulsNacional.required"
                        >Olvidaste ingresar el número total de lances nacionales</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noHaulsInter')">
                        <label for="first-name">No. Lances Internacionales</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noHaulsInter"
                          :disabled="sending"
                          type="number"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noHaulsInter.required"
                        >Olvidaste ingresar el número de lances internacionales</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('observation')">
                            <label>Observaciones al Cumplimiento de Medidas de Manejo Aplicables a la Pesquería (Nacional-OROP's)(Observations on compliance)</label>
                            <md-textarea v-model="form.observation"></md-textarea>
                            <span
                              class="md-error"
                              v-if="!$v.form.observation.required"
                            >Olvidaste ingresar una observación
                            </span>
                    </md-field>
                  </div>
                </div>
          <md-divider style="background-color: #2090E8 " ></md-divider>
          <br>
                <div style="text-align:center">
                  <strong>CAPTURA OBJETIVO</strong>
                </div>

            <div class="card-body">
                    <div class="md-layout">
                      <div class="md-layout-item">
                        <md-field md-clearable>
                          <label for="first-name">Nombre Común</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="nameCommon1"
                            :disabled="sending"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable>
                          <label for="first-name">Nombre Científico</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="nameScientific1"
                            :disabled="sending"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item md-size-25">
                        <md-field md-clearable>
                          <label for="first-name">Captura - Ton.</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="capture1"
                            :disabled="sending"
                            type="number"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                    </div>
                    <md-button
                      type="button"
                      class="md-dense md-raised md-primary"
                      :disabled="sending"
                      @click="addItemTarget()"
                    >Agregar
                    </md-button>
              <div class="table-responsive">
                <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NOMBRE COMÚN</th>
                      <th>NOMBRE CIENTÍFICO</th>
                      <th>CAPTURA TON.</th>
                      <th style="width: 90px">OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody v-if="arrayTarget.length">
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
                  <tbody v-else>
                    <tr>
                      <td colspan="6" class="text-center">
                        No existen elementos agregados
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>NOMBRE COMÚN</th>
                      <th>NOMBRE CIENTÍFICO</th>
                      <th>CAPTURA TON.</th>
                      <th style="width: 90px">OPCIONES</th>
                    </tr>
                  </tfoot>
                    <tbody>
                    </tbody>
                </table>
              </div>
            </div>
             <md-divider style="background-color: #2090E8 " ></md-divider>
             <br>
            <div style="text-align:center">
              <strong>CAPTURA FAUNA INCIDENTAL</strong>
            </div>

            <div class="card-body">
                    <div class="md-layout">
                      <div class="md-layout-item">
                        <md-field md-clearable>
                          <label for="first-name">Nombre Común</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="nameCommon2"
                            :disabled="sending"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable>
                          <label for="first-name">Nombre Científico</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="nameScientific2"
                            :disabled="sending"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item md-size-25">
                        <md-field md-clearable>
                          <label for="first-name">Captura - Ton.</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="capture2"
                            :disabled="sending"
                            type="number"
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="md-layout">
                      <div class="md-layout-item">
                        <md-button
                          type="button"
                          class="md-dense md-raised md-primary"
                          :disabled="sending"
                          @click="addItemFauna()"
                        >Agregar
                        </md-button>
                      </div>
                    </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NOMBRE COMÚN</th>
                      <th>NOMBRE CIENTÍFICO</th>
                      <th>CAPTURA TON.</th>
                      <th style="width: 90px">OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody v-if="arrayFauna.length">
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
                  <tbody v-else>
                    <tr>
                      <td colspan="6" class="text-center">
                        No existen elementos agregados
                      </td>
                    </tr>
                  </tbody>
                    <tfoot>
                      <tr>
                        <th>NOMBRE COMÚN</th>
                        <th>NOMBRE CIENTÍFICO</th>
                        <th>CAPTURA TON.</th>
                        <th style="width: 90px">OPCIONES</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
              </div>
            </div>
                <div class="md-layout">
                  <div class="md-layout-item md-size-55">
                    <md-field md-clearable :class="getValidationClass('landedWeight')">
                      <label for="first-name">Peso Desembarcado Comprobado (ingreso planta proceso)(Ton)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.landedWeight"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.landedWeight.required"
                      >Olvidaste ingresar el peso desembarcado comprobado</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('inspectorConclusions')">
                            <label>Conclusiones Del Inspector (Inspector’s Conclusions)</label>
                            <md-textarea v-model="form.inspectorConclusions"></md-textarea>
                            <span
                              class="md-error"
                              v-if="!$v.form.inspectorConclusions.required"
                            >Olvidaste ingresar las conclusiones del inspector
                            </span>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('additionalComments')">
                            <label>Comentarios Adicionales (espacio disponible para el capitan)(Additional Comments)</label>
                            <md-textarea v-model="form.additionalComments"></md-textarea>
                            <span
                              class="md-error"
                              v-if="!$v.form.additionalComments.required"
                            >Olvidaste ingresar los comentarios adicionales
                            </span>
                    </md-field>
                  </div>
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('observationGeneral')">
                            <label>Observaciones (General Observations)</label>
                            <md-textarea v-model="form.observationGeneral"></md-textarea>
                            <span
                              class="md-error"
                              v-if="!$v.form.observationGeneral.required"
                            >Olvidaste ingresar las observaciones
                            </span>
                    </md-field>
                  </div>
                </div>
                <!-- SUBIR IMAGEN -->
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
                <!-- FIL SUBIR IMAGEN -->
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

                @click="validateData"
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
        noOmi: "",
        legalRepre: "",
        noDays: "",
        noAllHauls: "",
        noHaulsNacional: "",
        noHaulsInter: "",
        landedWeight: "",
        dateScale: format(now, dateFormat),
        dateZarpe: format(now, dateFormat),
        dateLatestArrival: format(now, dateFormat),
        dateResolution: format(now, dateFormat),
        dateValidityPat: format(now, dateFormat),
        dateValidity: format(now, dateFormat),
        dateIns: format(now, dateFormat),
        observation: "",
        inspectorConclusions: "",
        additionalComments: "",
        observationGeneral: "",
        idOmi: "",
      },
      totalLongline: "",
      stateRectorPort: "",
      other: "",
      eyeMesh: "",
      netWidth: "",
      eyeFlake: "",
      typeHook: "",
      longNet: "",
      materialArt: "",
      equipDevi: "",
      captain: "",
      noAllCrew: "",
      noCrewForeign: "",
      noCrewNational: "",

      nameCommon1: "",
      nameScientific1: "",
      capture1: "",
      nameCommon2: "",
      nameScientific2: "",
      capture2: "",
      notification: "",
      finalityArrival: "",
      workDone: "",
      locationSystem: "",
      // destination: "",

      noApply: "No aplica",


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
      arrayFa: [],
	    arrayFisheryAuthorized: [],
      id_fisheryAuthorized: 0,
      arrayComp: {id:0, name:''},
	    arrayCompany: [],
      arrayBt: {id:0, nameBoat:''},
	    arrayBoat: [],
      id_Company: 0,
      orop: "",
      arrayOr: {id:0, name:''},
	    arrayOrop: [],
      id_orop: 0,
      arrayMaterial: {id:0, name:''},
	    arrayMaterialArt: [],
      id_material: 0,

      arrayTarget: [],
      arrayTa: [],
      arrayFauna: [],

      arrayTargetAct: [],
      arrayTaAct: [],
      arrayFaunaAct: [],
      arrayEquipDevi: [{name:"",id:0}],
      arrayValue:[
        { name: 'Dispositivo Agregado de peces - DAPs (FAD)', id: '1' },
        { name: 'Dispositivo Excluidor de Tortugas - DET', id: '2' },
        { name: 'otro', id: '3' },
      ],

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
      legalRepre: {
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
      idOmi: {
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
      dateValidity: {
        required
      },
      dateValidityPat: {
        required
      },
      dateIns: {
        required
      },
      observation: {
        required
      },
      // totalLongline: {
      //   required
      // },
      inspectorConclusions: {
        required
      },
      additionalComments: {
        required
      },
      observationGeneral: {
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
    setBoats(){
      this.form.noResolution= this.arrayBt.noResolution;
      this.form.enrollment= this.arrayBt.enrollment;
      this.form.dateResolution= this.arrayBt.dateResolution;
      this.form.dateValidityPat= this.arrayBt.dateValidityPat;
      this.form.dateValidity= this.arrayBt.dateValid;
      this.arrayComp.name= this.arrayBt.nameCompany;
      this.form.nameBoat= this.arrayBt.nameBoat;
      this.form.noPatent= this.arrayBt.noPatent;
      this.arrayFg.name= this.arrayBt.nameFlag;
    },
        selectBoats() {
            let me = this;
            var url = "/selectboats";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayBoat = respuesta.boat;
                }).catch(function (error) {
                    console.log(error);
            });
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
    addItemTarget() {
      let me = this;
      var total1 = me.arrayTarget.push({
        nameCommon1:this.nameCommon1,
        nameScientific1:this.nameScientific1,
        capture1:this.capture1
      });
      var total2 = me.arrayTargetAct.push({
        nameCommon1:this.nameCommon1,
        nameScientific1:this.nameScientific1,
        capture1:this.capture1
      });
      console.log("arrayTarget " + total2);
      // this.mensaje("Captura objetivo agregado", "success");
      me.clearTarget();
    },
    addItemFauna() {
      let me = this;
      var total2 = me.arrayFauna.push({
        nameCommon2:this.nameCommon2,
        nameScientific2:this.nameScientific2,
        capture2:this.capture2
      });
      var total = me.arrayFaunaAct.push({
        nameCommon2:this.nameCommon2,
        nameScientific2:this.nameScientific2,
        capture2:this.capture2
      });
      console.log("arrayFauna " + total2);
      // this.mensaje("Captura fauna incidental agregado", "success");
      me.clearFauna();


    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
      //  this.mensaje("Captura fauna incidental agregado", "error");
    },
    deleteFauna(index){
       this.arrayFauna.splice(index,1);
    },
    clearTarget() {
      this.nameCommon1 = null;
      this.nameScientific1 = null;
      this.capture1 = null;
    },
    clearFauna() {
      this.nameCommon2 = null;
      this.nameScientific2 = null;
      this.capture2 = null;
    },
    // mensaje(msj, icono) {
    //     const Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-center',
    //         showConfirmButton: false,
    //         timer: 2000,
    //         timerProgressBar: true,
    //         didOpen: (toast) => {
    //             toast.addEventListener('mouseenter', Swal.stopTimer)
    //             toast.addEventListener('mouseleave', Swal.resumeTimer)
    //         }
    //     })
    //     Toast.fire({
    //         icon: icono,
    //         title: msj
    //     })
    // },
    clearForm() {
      this.$v.$reset();
      this.form.insNo = null;
      this.form.radioCall = null;
      this.form.noResolution = null;
      this.form.nameBoat = null;
      this.form.enrollment = null;
      this.form.noPatent = null;
      this.eyeMesh = null;
      this.netWidth = null;
      this.eyeFlake = null;
      this.typeHook = null;
      this.longNet = null;
      this.materialArt = null;
      this.equipDevi = null;
      this.captain = null;
      this.form.noOmi = null;
      this.form.legalRepre = null;
      this.noAllCrew = null;
      this.noCrewForeign = null;
      this.noCrewNational = null;
      // this.destination = null;
      this.form.noDays = null;
      this.form.noAllHauls = null;
      this.form.noHaulsNacional = null;
      this.form.noHaulsInter = null;
      this.form.landedWeight = null;
      this.stateRectorPort = null;
      this.form.observation = null;
      this.totalLongline = null;
      this.notification = null;
      this.finalityArrival = null;
      this.workDone = null;
      this.other = null;
      this.locationSystem = null;
      this.form.inspectorConclusions = null;
      this.form.additionalComments = null;
      this.form.dateIns = null;
      this.form.dateScale = null;
      this.form.dateZarpe = null;
      this.form.dateLatestArrival = null;
      this.form.dateValidityPat = null;
      this.form.date = null;
      this.form.dateValidity = null;
      this.form.observationGeneral = null;
      this.form.idOmi = null;

      this.arrayReg = {id:0, name:'', nameMuni:''};
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtArrival = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayNation = {id:0, name:''};
      this.arrayZoneAuto = {id:0, name:''};
      this.arrayFa = [];
      this.arrayComp = {id:0, name:''};
      this.arrayTarget = [];
      this.arrayFauna = [];
      this.arrayMaterial = {id:0, name:''};
    },
    nameWithBoat ({ nameBoat  }) {
            return `${nameBoat}`
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
    nameWithOrop ({ name }) {
            return `${name}`
    },
    nameWithMaterialArt ({ name }) {
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
            me.arrayFa=[];
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
    selectMaterial() {
            let me = this;
            var url = "/materials/selectMaterials";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMaterialArt = respuesta.materials;
                    console.log(me.arrayMaterialArt + " arrayMAterial")
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
      this.eyeMesh = data["eyeMesh"];
      this.netWidth = data["netWidth"];
      this.eyeFlake = data["eyeFlake"];
      this.typeHook = data["typeHook"];
      this.longNet = data["longNet"];
      this.materialArt = data["materialArt"];
      this.equipDevi = data["equipDevi"];
      this.captain = data["captain"];
     // this.form.noOmi = data["noOmi"];
      this.form.legalRepre = data["legalRepre"];
      this.noAllCrew = data["noAllCrew"];
      this.noCrewForeign = data["noCrewForeign"];
      this.noCrewNational = data["noCrewNational"];
      this.idOmi = data["idOmi"];
      this.other = data["other"];
      this.form.noDays = data["noDays"];
      this.form.noAllHauls = data["noAllHauls"];
      this.form.noHaulsNacional = data["noHaulsNacional"];
      this.form.noHaulsInter = data["noHaulsInter"];
      this.form.landedWeight = data["landedWeight"];
      this.form.observation = data["observation"];
      this.totalLongline = data["totalLongline"];
      this.notification = data["notification"];
      this.finalityArrival = data["finalityArrival"];
      this.workDone = data["workDone"];
      this.locationSystem = data["locationSystem"];
      this.form.inspectorConclusions = data["inspectorConclusions"];
      this.form.additionalComments = data["additionalComments"];
      this.form.dateIns = data["dateIns"];
      this.form.dateScale = data["dateScale"];
      this.form.dateZarpe = data["dateZarpe"];
      this.form.dateLatestArrival = data["dateLatestArrival"];
      this.form.dateValidityPat = data["dateValidityPat"];
      this.form.date = data["date"];
      this.form.dateValidity = data["dateValidity"];
      this.form.observationGeneral = data["observationGeneral"];
      this.stateRectorPort = data["stateRectorPort"];

      this.arrayReg.id = data["id_region"];
			this.arrayReg.name = data["nameReg"];
      this.arrayPt.id = data["id_port"];
			this.arrayPt.name = data["namePort"];
      this.arrayPtZarpe.id = data["id_portZarpe"];
      this.id_portZarpe = data["id_portZarpe"];
			this.arrayPtZarpe.name = data["namePort"];
      this.arrayPtArrival.id = data["id_portArrival"];
      this.id_portArrival = data["id_portArrival"];
			this.arrayPtArrival.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
			this.arrayFg.name = data["nameFlag"];
      this.arrayNation.id = data["id_nationality"];
			this.arrayNation.name = data["nameNationality"];
      this.arrayZoneAuto.id = data["id_zoneAutoFisher"];
			this.arrayZoneAuto.name = data["nameZoneAutoFisher"];
      this.arrayFa.id = data["arrayFa"];
      this.arrayComp.id = data["id_company"];
			this.arrayComp.name = data["nameCompany"];
      this.arrayOr.id = data["id_orop"];
			this.arrayOr.name = data["nameOrop"];
      this.arrayMaterial.id = data["id_material"];
			this.arrayMaterial.name = data["nameMaterial"];
      this.dataTarget();
      this.dataFauna();
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
      if (this.totalLongline == "") {
        this.totalLongline = this.noApply;
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
      if (this.materialArt == "") {
        this.materialArt = this.noApply;
      }
      if (this.equipDevi == "") {
        this.equipDevi = this.noApply;
      }
      if (this.captain == "") {
        this.captain = this.noApply;
      }
      if (this.noAllCrew == "") {
        this.noAllCrew = this.noApply;
      }
      if (this.noCrewForeign == "") {
        this.noCrewForeign = this.noApply;
      }
      if (this.noCrewNational == "") {
        this.noCrewNational = this.noApply;
      }
      axios
        .post("/arrivals/save", {
          insNo: this.form.insNo.toUpperCase(),
          radioCall: this.form.radioCall.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat: this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent: this.form.noPatent.toUpperCase(),
          eyeMesh: this.eyeMesh.toUpperCase(),
          netWidth: this.netWidth.toUpperCase(),
          eyeFlake: this.eyeFlake.toUpperCase(),
          typeHook: this.typeHook.toUpperCase(),
          longNet: this.longNet.toUpperCase(),
          materialArt: this.materialArt,
          equipDevi: this.arrayEquipDevi.name,
          captain: this.captain.toUpperCase(),
         // noOmi: this.form.noOmi.toUpperCase(),
          legalRepre: this.form.legalRepre.toUpperCase(),
          noAllCrew: this.noAllCrew.toUpperCase(),
          noCrewForeign: this.noCrewForeign.toUpperCase(),
          noCrewNational: this.noCrewNational.toUpperCase(),
          idOmi: this.idOmi,
          other: this.other.toUpperCase(),
          noDays: this.form.noDays.toUpperCase(),
          noAllHauls: this.form.noAllHauls.toUpperCase(),
          noHaulsNacional: this.form.noHaulsNacional.toUpperCase(),
          noHaulsInter: this.form.noHaulsInter.toUpperCase(),
          landedWeight: this.form.landedWeight.toUpperCase(),
          observation: this.form.observation.toUpperCase(),
          totalLongline: this.totalLongline,
          notification: this.notification,
          finalityArrival: this.finalityArrival,
          workDone: this.workDone,
          locationSystem: this.locationSystem,
          inspectorConclusions :this.form.inspectorConclusions.toUpperCase(),
          additionalComments :this.form.additionalComments.toUpperCase(),
          stateRectorPort :this.stateRectorPort,
          dateIns :this.form.dateIns,
          dateScale :this.form.dateScale,
          dateZarpe :this.form.dateZarpe,
          dateLatestArrival: this.form.dateLatestArrival,
          dateValidityPat: this.form.dateValidityPat,
          date: this.form.dateResolution,
          dateValidity: this.form.dateValidity,
          observationGeneral: this.form.observationGeneral,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          'id_fisheryAuthorized': this.arrayFa.id,
          'id_company': this.arrayComp.id,
          'id_orop': this.arrayOr.id,
          'id_material': this.arrayMaterial.id,

          'fishery': this.arrayFa,
          'fauna': this.arrayFauna,
          'target': this.arrayTarget,
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
      if (this.materialArt == "") {
        this.materialArt = this.noApply;
      }
      if (this.equipDevi == "") {
        this.equipDevi = this.noApply;
      }
      if (this.captain == "") {
        this.captain = this.noApply;
      }
      if (this.noAllCrew == "") {
        this.noAllCrew = this.noApply;
      }
      if (this.noCrewForeign == "") {
        this.noCrewForeign = this.noApply;
      }
      if (this.noCrewNational == "") {
        this.noCrewNational = this.noApply;
      }
      axios
        .put("/arrivals/update", {
          id: this.id_arrival,
          insNo: this.form.insNo.toUpperCase(),
          radioCall :this.form.radioCall.toUpperCase(),
          noResolution: this.form.noResolution.toUpperCase(),
          nameBoat :this.form.nameBoat.toUpperCase(),
          enrollment: this.form.enrollment.toUpperCase(),
          noPatent :this.form.noPatent.toUpperCase(),
          eyeMesh :this.eyeMesh.toUpperCase(),
          netWidth :this.netWidth.toUpperCase(),
          eyeFlake :this.eyeFlake.toUpperCase(),
          typeHook :this.typeHook.toUpperCase(),
          longNet :this.longNet.toUpperCase(),
          materialArt :this.materialArt.toUpperCase(),
          equipDevi: this.arrayEquipDevi.name,
          captain :this.captain.toUpperCase(),
          //noOmi :this.form.noOmi.toUpperCase(),
          legalRepre :this.form.legalRepre.toUpperCase(),
          noAllCrew :this.noAllCrew.toUpperCase(),
          noCrewForeign :this.noCrewForeign.toUpperCase(),
          noCrewNational :this.noCrewNational.toUpperCase(),
          idOmi :this.idOmi,
          other :this.other.toUpperCase(),
          noDays :this.form.noDays.toUpperCase(),
          noAllHauls :this.form.noAllHauls.toUpperCase(),
          noHaulsNacional :this.form.noHaulsNacional.toUpperCase(),
          noHaulsInter :this.form.noHaulsInter.toUpperCase(),
          landedWeight :this.form.landedWeight.toUpperCase(),
          observation :this.form.observation.toUpperCase(),
          totalLongline :this.totalLongline,
          notification: this.notification,
          finalityArrival: this.finalityArrival,
          workDone: this.workDone,
          locationSystem: this.locationSystem,
          inspectorConclusions :this.form.inspectorConclusions.toUpperCase(),
          additionalComments :this.form.additionalComments.toUpperCase(),
          stateRectorPort :this.stateRectorPort,
          dateIns :this.form.dateIns,
          dateScale :this.form.dateScale,
          dateZarpe :this.form.dateZarpe,
          dateLatestArrival: this.form.dateLatestArrival,
          dateValidityPat: this.form.dateValidityPat,
          date: this.form.date,
          dateValidity: this.form.dateValidity,
          observationGeneral: this.form.observationGeneral,

          'id_region': this.arrayReg.id,
          'id_port': this.arrayPt.id,
          'id_portZarpe': this.arrayPtZarpe.id,
          'id_portArrival': this.arrayPtArrival.id,
          'id_flag': this.arrayFg.id,
          'id_nationality': this.arrayNation.id,
          'id_zoneAutoFisher': this.arrayZoneAuto.id,
          'id_fisheryAuthorized': this.arrayFa.id,
          'id_company': this.arrayComp.id,
          'id_orop': this.arrayOr.id,
          'id_material': this.arrayMaterial.id,


          'fishery': this.arrayFaAct,
          'fauna': this.arrayFaunaAct,
          'target': this.arrayTargetAct,
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
    dataTarget(){
      let me = this;

      var url = "/arrivals/target?id_Target="+this.id_arrival;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTarget = respuesta.target;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    dataFauna(){
      let me = this;

      var url = "/arrivals/fauna?id_Fauna="+this.id_arrival;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayFauna = respuesta.fauna;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    dataFishery(){
      let me = this;

      var url = "/arrivals/fishery?id_FisheryAut="+this.id_arrival;
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
    this.selectOrop();
    this.selectMaterial();
     this.selectBoats();
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
