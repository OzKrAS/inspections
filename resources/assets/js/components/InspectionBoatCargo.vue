<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Formato Inspección Embarcación de Carga</strong>          
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
                    <th>No. Formulario</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Total Carga (Ton.)</th>
                    <th>Nombre Embarcación de Carga</th>
                    <th>Nombre Representante</th>
                    <th>Notificación Previa</th>
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Formulario</th>
                      <th>Lugar</th>
                      <th>Fecha</th>
                      <th>Total Carga (Ton.)</th>
                      <th>Nombre Embarcación de Carga</th>
                      <th>Nombre Representante</th>
                      <th>Notificación Previa</th>
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
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noForm')">
                      <label for="first-name" class="">No. Formulario (Form Number)</label>
                      <md-input
                      class="mt-3"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.noForm"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.noForm.required"
                      >Olvidaste ingresar el número de formulario</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Lugar de Inspección (Inspection Place)</label>
                        <multiselect v-model="arrayReg" :options="arrayRegion" class="multi"
                          placeholder="Región/Municipio"
                          :custom-label="nameWithRegion"
                          label="namePlace"
                          track-by="namePlace">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <!-- <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('place')">
                      <label for="first-name">Lugar de Inspección (Inspection Place)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.place"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.place.required"
                      >Olvidaste ingresar el lugar</span>
                     <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> 
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item mt-3">                 
                        <md-datepicker 
                      
                          md-clearable :class="getValidationClass('date')"
                          v-model="form.date"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label   >Seleccione Fecha (Date)</label>
                          <span
                            class="md-error"
                            v-if="!$v.form.date.required"
                            >Olvidaste ingresar la fecha
                          </span>
                        </md-datepicker>                   
                  </div> &nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('businessColombia')">
                      <label for="first-name">Empresa Colombia (Colombian Company)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.businessColombia"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.businessColombia.required"
                      >Olvidaste ingresar nombre de la empresa</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('fullCargo')">
                      <label for="first-name">Total Carga (Ton.)(Total Cargo)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.fullCargo"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.fullCargo.required"
                      >Olvidaste ingresar nombre de la empresa</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
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
                    <md-field md-clearable :class="getValidationClass('nameBoatCargo')">
                      <label for="first-name">Nombre Embarcación de Carga (Cargo Ship Name)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameBoatCargo"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nameBoatCargo.required"
                      >Olvidaste ingresar el nombre de la embarcación</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
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
                    <label class="text-muted">Puerto de Zarpe (Departure Port)</label>
                      <multiselect v-model="arrayPtZarpe" :options="arrayPort"
                          placeholder="Seleccione puerto de zarpe"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Transbordo (Transshipment Port)</label>
                      <multiselect v-model="arrayPt" :options="arrayPort"
                          placeholder="Seleccione puerto de transbordo de la carga"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Puerto de Desembarque (Landing Port)</label>
                      <multiselect v-model="arrayPtDisemb" :options="arrayPort"
                          placeholder="Seleccione puerto de desembarque"
                          :custom-label="nameWithPort"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;   
                </div>
                <div class="md-layout">
                    <div class="md-layout-item">
                      <label class="text-muted">Área de operación (Operations Area)</label>
                      <multiselect v-model="arrayZoneAuto" :options="arrayZoneAutoFish"
                          placeholder="Área de operación"
                          :custom-label="nameWithZoneAutoFish"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item" v-if="arrayZoneAuto.name=='Otro'">
                    <md-field md-clearable >
                      <label for="first-name">Otra (Another)</label>
                      <md-input                    
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="another"
                        :disabled="sending"
                      />
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field>
                      <label class="text-muted">Notificación Previa (Prior Notification)</label>
                      <md-select v-model="notification" name="notification" id="notification" placeholder="Notificación Previa (Prior Notification)">
                        <md-option value="SI">SI</md-option>
                        <md-option value="NO">NO</md-option>
                      </md-select>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>  

                <md-divider style="background-color: #2090E8 " ></md-divider>
                <br>
                
                <div>
                  <strong>INFORMACIÓN DE TRANSBORDO SOBRE EMBARCACIONES DONANTES</strong>    
                </div>
                <!-- <label>INFORMACIÓN DE TRANSBORDO SOBRE EMBARCACIONES DONANTES</label> -->

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
                      >Olvidaste ingresar el nombre de la embarcación</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Bandera</label>
                        <multiselect v-model="arrayFgDonor" :options="arrayFlag"
                            placeholder="Seleccione una bandera"
                            :custom-label="nameWithFlag"
                            label="name"
                            track-by="name">
                        </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('noIdOmi')">
                      <label for="first-name">No. Identificador (OMI)</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.noIdOmi"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.noIdOmi.required"
                      >Olvidaste ingresar el identificador (OMI)</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('placeTransfer')">
                      <label for="first-name">Puerto o muelle de transbordo</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.placeTransfer"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.placeTransfer.required"
                      >Olvidaste ingresar el lugar de transbordo</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">                 
                        <md-datepicker 
                          md-clearable :class="getValidationClass('dateTransfer')"
                          v-model="form.dateTransfer"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha de Transbordo</label>
                          <span
                            class="md-error"
                            v-if="!$v.form.dateTransfer.required"
                            >Olvidaste ingresar la fecha de transbordo
                          </span>
                        </md-datepicker>                   
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('areasCapture')">
                      <label for="first-name">Áreas de Captura</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.areasCapture"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.areasCapture.required"
                      >Olvidaste ingresar el nombre de las áreas de captura</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                
                <!-- <label>PRODUCTO POR ESPECIE (TON.)</label> -->
                <div>
                  <strong>PRODUCTO POR ESPECIE (TON.)</strong>    
                </div>
                               <div class="md-layout">
                  <div class="md-layout-item">
                      <label class="text-muted">Nombre Común (Common Name)</label>
                      <multiselect v-model="arrayCName" :options="arrayCommonName"
                          @input="setCommonName()"
                          placeholder="Seleccione una especie"
                          :custom-label="nameWithCommonName"
                          label="commonname"
                          track-by="commonname">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable>
                          <label for="first-name">Nombre Científico (Scientific Name)</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="nameScientific1"                          
                            disabled
                          />
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
            <!-- <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('shapeProduct')">
                      <label for="first-name">Presentación del Producto</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.shapeProduct"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.shapeProduct.required"
                      >Olvidaste ingresar el número de indentidad</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp; -->
                  <div class="md-layout-item">
                      <md-field>
                          <label class="text-muted">Presentación del Producto</label>
                          <md-select v-model="form.shapeProduct" name="presentation" id="presentation" placeholder="presentación">
                            <md-option value="Unidades">Unidades</md-option>
                            <md-option value="Zartas ">Zartas</md-option>
                            <md-option value="Bolsas o Bultos">Bolsas o Bultos </md-option>
                            <md-option value="Canastas">Canastas</md-option>
                            <md-option value="Grupos">Grupos</md-option>
                            <md-option value="Otros">Otros</md-option>
                          </md-select>
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;  
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('amount')">
                      <label for="first-name">Cantidad</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.amount"
                        :disabled="sending"
                        type="number"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.amount.required"
                      >Olvidaste ingresar la cantidad</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field> 
                  </div>
                  <md-button
                  type="button"
                      class="md-dense md-raised md-primary"
                      :disabled="sending"
                      @click="addItemTarget()"
                    >Agregar
                  </md-button>
                </div>
                <br>
                <br>
      
                <div class="table-responsive">        
                    <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
                      <thead>    
                        <tr>
                          <th>NOMBRE EMBARCACIÓN</th>    
                          <th>BANDERA</th>              
                          <th>IDENTIFICADOR OMI</th>    
                          <th>PUERTO O MUELLE DE TRANSBORDO</th>    
                          <th>FECHA DE TRANSBORDO</th>    
                          <th>ÁREA DE CAPTURA FAO</th>    
                          <th>NOMBRE COMÚN</th>    
                          <th>NOMBRE CIENTÍFICO</th>    
                          <th>PRESENTACIÓN DEL PRODUCTO</th>    
                          <th>CANTIDAD</th>    
                          <th style="width: 90px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody v-if="arrayTarget.length">
                        <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                          <td v-text="target.nameBoat"></td>
                          <td v-text="target.flag"></td>
                          <td v-text="target.noIdOmi"></td>
                          <td v-text="target.placeTransfer"></td>
                          <td v-text="target.dateTransfer"></td>
                          <td align="right" v-text="target.areasCapture"></td>
                          <td v-text="target.nameCommon1"></td>
                          <td v-text="target.nameScientific1"></td>
                          <td v-text="target.shapeProduct"></td>
                          <td align="right" v-text="target.amount"></td>
  
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
                          <tr style="background-color: darkgray;">
                              <td colspan="9" align="right"><strong>TOTAL PRODUCTO DESEMBARCADO Kg.</strong></td>
                              <td align="right"><strong>{{totalOther.toLocaleString('de-DE')}}</strong></td>
                          </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td colspan="11" class="text-center">
                            No existen elementos agregados 
                          </td>
                        </tr>
                      </tbody>
          
                    </table>
                  </div> 
                  <!-- <div class="md-layout-item md-size-21">
                    <md-field md-clearable :class="getValidationClass('productLanded')">
                      <label for="first-name">Total Producto Desembarcado</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.productLanded"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.productLanded.required"
                      >Olvidaste ingresar el número de identidad</span>
                      <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> 
                    </md-field> 
                  </div>&nbsp;&nbsp;&nbsp; -->
            
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameOfficial')">
                      <label for="first-name">Nombre Funcionario</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameOfficial"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nameOfficial.required"
                      >Olvidaste ingresar el nombre del funcionario</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameCaptain')">
                      <label for="first-name">Nombre Capitán Barco Carguero</label>
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
                      >Olvidaste ingresar el nombre del capitán del barco</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field> 
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('nameBusiness')">
                      <label for="first-name">Nombre Empresa Responsable</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.nameBusiness"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.nameBusiness.required"
                      >Olvidaste ingresar el nombre de la empresa responsable</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout"> 
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('observation')">
                            <label>Observaciones</label>
                            <md-textarea v-model="form.observation"></md-textarea>
                            <span
                              class="md-error"
                              v-if="!$v.form.observation.required"
                            >Olvidaste ingresar las observaciones
                            </span>
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
    return {
      form: {
        noForm: "",
        businessColombia: "",
        fullCargo: "",
        nameBoat: "",
        noIdOmi: "",
        placeTransfer: "",
        areasCapture: "",
        shapeProduct: "",
        amount: "",
        nameOfficial: "",
        nameCaptain: "",
        nameBusiness: "",
        date: format(now, dateFormat),
        dateTransfer: format(now, dateFormat),
        observation: "",
      
      },
      another:"",
      notification: "",
      areaOperation: "",
      nameScientific1: "",

      arrayInspectionBoatCargo: [],
      id_inspectionBoatCargo: 0,
      
      arrayBt: {id:0, nameBoat:''},
	    arrayBoat: [],
      arrayReg: {namePlace:''},
	    arrayRegion: [],
      arrayCName: {id:0, commonname:''},
      arrayCommonName:[],
      arrayZoneAuto: {id:0, name:''},
	    arrayZoneAutoFish: [],
      id_zoneAutoFisher: 0,
      arrayPt: {id:0, namePort:'',name:''},
	    arrayPort: [],
      id_port: 0,
      arrayPtZarpe: {id:0, namePort:'',name:''},
      id_portZarpe: 0,
      arrayPtDisemb: {id:0, namePort:'',name:''},
      id_disemb: 0,
      arrayFg: {id:0, name:''},
      arrayFgDonor: {id:0, name:''},
	    arrayFlag: [],
      id_flag: 0,
      id_flagDonor: 0,

      edo:1,
      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayData: [],
      arrayTarget: [],
      arrayTargetAct: [],
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

  validations: {
    form: {

      noForm: {
        required
      },
      businessColombia: {
        required
      },
      fullCargo: {
        required
      },

      nameBoat: {
        required
      },
      noIdOmi: {
        required
      },
      placeTransfer: {
        required
      },
      areasCapture: {
        required
      },
      shapeProduct: {
        required
      },
      amount: {
        required
      },  
      nameOfficial: {
        required
      },
      nameCaptain: {
        required
      },
      nameBusiness: {
        required
      },
      date: {
        required
      },
      dateTransfer: {
        required
      },
      observation: {
        required
      },
      
    }
  },

  computed: {
    totalOther: function(){
      return this.arrayTarget.reduce((total, item) => total + parseInt(item.amount), 0);
    }
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
      nameWithCommonName ({ commonname }) {
            return `${commonname}`
    },
    nameWithBoat ({ nameBoat  }) {
            return `${nameBoat}`
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
      this.arrayFg.id= this.arrayBt.id_flag;
      this.arrayFg.name= this.arrayBt.nameFlag;
    },
    selectBoats() {
            let me = this;
            var url = "/selectboats?type=0";
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
    setCommonName(){
      this.nameScientific1= this.arrayCName.scientificname;
      this.nameCommon1= this.arrayCName.commonname;
    },
    addItemTarget() {
      let me = this;
      var total1 = me.arrayTarget.push({
        nameCommon1:this.nameCommon1,
        nameBoat:this.form.nameBoat,
        flag:this.arrayFgDonor.name,
        id_flag:this.arrayFgDonor.id,
        noIdOmi:this.form.noIdOmi,
        placeTransfer:this.form.placeTransfer,
        dateTransfer:this.form.dateTransfer,
        areasCapture:this.form.areasCapture,
        shapeProduct:this.form.shapeProduct,
        amount:this.form.amount,
        nameScientific1:this.nameScientific1
      });
      var total2 = me.arrayTargetAct.push({
      nameCommon1:this.nameCommon1,
        nameBoat:this.form.nameBoat,
        flag:this.arrayFgDonor.name,
        id_flag:this.arrayFgDonor.id,
        noIdOmi:this.form.noIdOmi,
        placeTransfer:this.form.placeTransfer,
        dateTransfer:this.form.dateTransfer,
        areasCapture:this.form.areasCapture,
        shapeProduct:this.form.shapeProduct,
        amount:this.form.amount,
        nameScientific1:this.nameScientific1
      });
      console.log("arrayTarget " + total2);
      // this.mensaje("Captura objetivo agregado", "success");
      //me.clearTarget();
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
       
      }
    },
    clearForm() {
      this.$v.$reset();
      //this.arrayReg.name = "";
      this.form.date = null;
      this.form.noForm = null;
      this.form.businessColombia = null;
      this.form.fullCargo = null;
      this.form.nameBoatCargo = null;
      this.areaOperation = null;
      this.notification = null;
      this.form.nameBoat = null;
      this.form.noIdOmi = null;
      this.form.placeTransfer = null;
      this.form.dateTransfer = null;
      this.form.areasCapture = null;
      this.form.species = null;
      this.form.shapeProduct = null;
      this.form.amount = null;
      this.form.nameOfficial = null;
      this.form.nameCaptain = null;
      this.form.nameBusiness = null;
      this.form.observation = null;
      this.another = null;
      this.arrayZoneAuto = {id:0, name:''};
      
      this.arrayPt = {id:0, namePort:'',name:''};
      this.arrayPtZarpe = {id:0, namePort:'',name:''};
      this.arrayPtDisemb = {id:0, namePort:'',name:''};
      this.arrayFg = {id:0, name:''};
      this.arrayFgDonor = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_inspectionBoatCargo = data["id"]);
      this.arrayReg.namePlace = data["place"];
      // this.arrayReg.nameMuni = data["place"];
      this.form.date = data["date"];
      this.form.noForm = data["noForm"];
      this.form.businessColombia = data["businessColombia"];
      this.form.fullCargo = data["fullCargo"];
      this.arrayBt.nameBoat = data["nameBoatCargo"];
      this.arrayZoneAuto.name = data["areaOperation"];
      this.notification = data["notification"];
      this.form.nameBoat = data["nameBoat"];
      this.form.noIdOmi = data["noIdOmi"];
      this.form.placeTransfer = data["placeTransfer"];
      this.form.dateTransfer = data["dateTransfer"];
      this.form.areasCapture = data["areasCapture"];
      this.form.shapeProduct = data["shapeProduct"];
      this.form.amount = data["amount"];
      this.form.nameOfficial = data["nameOfficial"];
      this.form.nameCaptain = data["nameCaptain"];
      this.form.nameBusiness = data["nameBusiness"];
      this.form.observation = data["observation"];

      this.arrayPt.id = data["id_port"];
      this.arrayPt.name = data["namePort"];
      this.arrayPtZarpe.id = data["id_portZarpe"];
			this.arrayPtZarpe.name = data["namePort"];
      this.arrayPtDisemb.id = data["id_portDisemb"];
			this.arrayPtDisemb.name = data["namePort"];
      this.arrayFg.id = data["id_flag"];
	    this.arrayFg.name = data["nameFlag"];
      this.arrayFgDonor.id = data["id_flagDonor"];
	    this.arrayFgDonor.name = data["nameFlag"];

    },
       nameWithRegion ({ namePlace  }) {
            return `${namePlace}`
    },
    nameWithPort ({ namePort,name }) {
            return `${namePort} / ${name}  `
    },
    nameWithFlag ({ name }) {
            return `${name}`
    },
    nameWithZoneAutoFish ({ name }) {
        return `${name}`
    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
    },
    selectFlag() {
            let me = this;
            var url = "inspectionBoatCargo/selectFlags";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFlag = respuesta.flag;
                }).catch(function (error) {
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
    showData() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      this.edo=0;
    },
        getCommonName() {
      let me = this;
      var url =
        "/species";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayCommonName = respuesta.species;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    hideForm() {
      this.edo = 1;
      this.listado = 1;
      this.listData();
    },   
    listData() {
      let me = this;
      var url =
        "/inspectionBoatCargo";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayInspectionBoatCargo = respuesta.inspections.data;
          me.myTable(me.arrayInspectionBoatCargo);

        })
        .catch(function (error) {
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
   async saveData() {
      let me = this;

      if (this.arrayZoneAuto.name!="Otro"){
          this.another="";
        }
      
      await axios
        .post("/inspectionBoatCargo/save", {
    
        place: this.arrayReg.namePlace,
        date: this.form.date,
        noForm: this.form.noForm.toUpperCase(),
        businessColombia: this.form.businessColombia.toUpperCase(),
        fullCargo: this.form.fullCargo,
        nameBoatCargo: this.arrayBt.nameBoat,
        areaOperation: this.arrayZoneAuto.name,
        notification: this.notification.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        noIdOmi: this.form.noIdOmi.toUpperCase(),
        placeTransfer: this.form.placeTransfer.toUpperCase(),
        dateTransfer: this.form.dateTransfer.toUpperCase(),
        areasCapture: this.form.areasCapture.toUpperCase(),
        shapeProduct: this.form.shapeProduct,
        amount: this.form.amount.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        nameBusiness: this.form.nameBusiness.toUpperCase(),
        observation: this.form.observation.toUpperCase(),
        another: this.another,
        data:this.arrayTarget,
       
        'id_port': this.arrayPt.id,
        'id_portZarpe': this.arrayPtZarpe.id,
        'id_portDisemb': this.arrayPtDisemb.id,
        'id_flag': this.arrayFg.id,
        'id_flagDonor': this.arrayFgDonor.id,
        })
        .then(function(response) {
          me.clearForm();
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
        .put("/inspectionBoatCargo/update", {
        id: this.id_inspectionBoatCargo,
        place: this.arrayReg.namePlace,
        date: this.form.date,
        noForm: this.form.noForm.toUpperCase(),
        businessColombia: this.form.businessColombia.toUpperCase(),
        fullCargo: this.form.fullCargo,
        nameBoatCargo: this.arrayBt.nameBoat,
        areaOperation: this.arrayZoneAuto.name,
        notification: this.notification.toUpperCase(),
        nameBoat: this.form.nameBoat.toUpperCase(),
        noIdOmi: this.form.noIdOmi.toUpperCase(),
        placeTransfer: this.form.placeTransfer.toUpperCase(),
        dateTransfer: this.form.dateTransfer.toUpperCase(),
        areasCapture: this.form.areasCapture.toUpperCase(),
        shapeProduct: this.form.shapeProduct,
        amount: this.form.amount.toUpperCase(),
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        nameCaptain: this.form.nameCaptain.toUpperCase(),
        nameBusiness: this.form.nameBusiness.toUpperCase(),
        observation: this.form.observation.toUpperCase(),
        another: this.another,
       
        'id_port': this.arrayPt.id,
        'id_portZarpe': this.arrayPtZarpe.id,
        'id_portDisemb': this.arrayPtDisemb.id,
        'id_flag': this.arrayFg.id,
        'id_flagDonor': this.arrayFgDonor.id,
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
        title: "Esta seguro de Eliminar esta Inspección " + data["name"],
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
            .post("/inspectionBoatCargo/delete", {
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

            { "data": "noForm" },
            { "data": "place" },
            { "data": "date" },
            { "data": "fullCargo" },
            { "data": "nameBoatCargo" },
            { "data": "nameOfficial" },
            { "data": "notification" },
            
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
    this.selectBoats();
    this.listData();
    this.selectRegion();
    this.selectZoneAutoFisher();
    this.selectPort();
    this.selectFlag();
    this.getCommonName();
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
/* .multi{
    min-height: 12px;
    display: block;
    border-radius: 5px;
    border: 1px solid #e8e8e8;
    background: #fff;
    font-size: 12px;
} */
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(167, 142, 5, 0.849); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
