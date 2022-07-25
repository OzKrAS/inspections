<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Acta de Donación</strong>          
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
                    <th>Acta No.</th>
                    <th>Regional</th>
                    <th>Nombre Funcionario AUNAP</th>
                    <th>Nombre Representante Autoridad Acompañante</th>
                    <!-- <th>Estado</th> -->
                    <th>No. de Placa o Cédula Militar</th>
                    <th>Nombre de la institución que recibe donación</th>
                    <th>Personería Jurídica</th>
                    <th>Dirección</th>
                    <!-- <th>Foto</th> -->
                    <th style="width: 90px">Opciones</th>    
                  </tr>
                </thead>
                <tbody>
                </tbody>
                  <tfoot>
                    <tr>
                      <th>Acta No.</th>
                      <th>Regional</th>
                      <th>Nombre Funcionario AUNAP</th>
                      <th>Nombre Representante Autoridad Acompañante</th>
                      <!-- <th>Estado</th> -->
                      <th>No. de Placa o Cédula Militar</th>
                      <th>Nombre de la institución que recibe donación</th>
                      <th>Personería Jurídica</th>
                      <th>Dirección</th>
                      <!-- <th>Foto</th> -->
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
                  <label>En operativo de control desarrollado, el suscrito servidor público de la AUNAP, procedió a efectuar el decomiso preventivo de los recursos y/o productos pesqueros que a continuación se relacionan, por no cumplir con las disposiciones establecidas por la Autoridad Nacional de Pesca y Acuicultura - AUNAP.

Por tratarse de productos altamente perecederos y que no pueden ser comercializados, se procede a la donación de los mismos, en presencia de la autoridad competente.
</label>
                  <div class="md-layout-item md-size-50">
                    <md-field md-clearable :class="getValidationClass('noActa')">
                      <label for="first-name">No. Acta</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.noActa"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.noActa.required"
                      >Olvidaste ingresar el número de acta</span>
                      <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                      <label class="text-muted">Regional</label>
                      <multiselect v-model="arrayRegl" :options="arrayRegional"
                          placeholder="Seleccione una opción"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>





                <div class="card-body">             
                  <div class="md-layout"> 
                    <div class="md-layout-item">                 
                      <md-field md-clearable>
                        <label for="first-name">Nombre Científico</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="nameScientific"
                          :disabled="sending"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item">     
                      <md-field md-clearable>
                        <label for="first-name">Nombre Común</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="nameCommon"
                          :disabled="sending"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp; 
                    <div class="md-layout-item"> 
                      <md-field>
                        <label class="text-muted">Estado</label>
                        <md-select v-model="state" name="state" id="state" placeholder="Estado">
                          <md-option value="fresco entero">Fresco entero</md-option>
                          <md-option value="fresco eviscerado ">Fresco eviscerado </md-option>
                          <md-option value="congelado entero">Congelado entero </md-option>
                          <md-option value="congelado eviscerado">Congelado eviscerado</md-option>
                          <md-option value="descabezado">Descabezado</md-option>
                          <md-option value="tronco">Tronco</md-option>
                          <md-option value="aletas">Aletas</md-option>
                          <md-option value="seco">Seco</md-option>
                          <md-option value="vivos">Vivos</md-option>
                          <md-option value="otros">Otros</md-option>
                        </md-select>
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div> 
                  <div class="md-layout"> 
                    <div class="md-layout-item">
                      <md-field>
                          <label class="text-muted">Presentación</label>
                          <md-select v-model="presentation" name="presentation" id="presentation" placeholder="presentación">
                            <md-option value="unidades">Unidades</md-option>
                            <md-option value="zartas ">Zartas </md-option>
                            <md-option value="bolsas o bultos">Bolsas o Bultos </md-option>
                            <md-option value="canastas">Canastas</md-option>
                            <md-option value="grupos">Grupos</md-option>
                            <md-option value="otros">Otros</md-option>
                          </md-select>
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;  
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Cantidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="amount"
                          :disabled="sending"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;  
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Peso</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="weight"
                          :disabled="sending"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;  
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Valor Comercial</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="commercialValue"
                          :disabled="sending"
                        />
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;  
                    
                      
                  

                    
                    
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
                                <th>NOMBRE CIENTÌFICO</th>    
                                <th>NOMBRE COMÙN</th>              
                                <th>ESTADO</th>    
                                <th>PRESENTACIÓN</th>    
                                <th>CANTIDAD (UN)</th>    
                                <th>PESO (Kg)</th>    
                                <th>VALOR COMERCIAL</th>    
                                <th>FOTOS</th>    
                                <th style="width: 80px">Opciones</th>
                              </tr>
                            </thead>
                            <tbody v-if="arrayTarget.length">
                              <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                                <td v-text="target.nameScientific"></td>
                                <td v-text="target.nameCommon"></td>
                                <td v-text="target.state"></td>
                                <td v-text="target.presentation"></td>
                                <td v-text="target.amount"></td>
                                <td v-text="target.weight"></td>
                                <td v-text="target.commercialValue"></td>
                                <td>
                                  <div v-for="(target,index) in images" :key="`target-${index}`">
                                  </div>
                                </td>
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
                                <td colspan="9" class="text-center">
                                  No existen elementos agregados 
                                </td>
                              </tr>
                            </tbody>
                              <tfoot>
                                <tr>
                                  <th>NOMBRE CIENTÌFICO</th>    
                                  <th>NOMBRE COMÙN</th>              
                                  <th>ESTADO</th>    
                                  <th>PRESENTACIÓN</th>    
                                  <th>CANTIDAD (UN)</th>    
                                  <th>PESO (Kg)</th>    
                                  <th>VALOR COMERCIAL</th>    
                                  <th>FOTOS</th>    
                                  <th style="width: 80px">Opciones</th>
                                </tr>
                              </tfoot>
                              <tbody>
                              </tbody>
                    </table>   
                  </div>                
                </div>    






                  <!-- <md-field md-clearable :class="getValidationClass('nameScientific')">
                    <label for="first-name">Nombre Científico</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameScientific"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameScientific.required"
                    >Olvidaste ingresar el nombre nombre común</span>
                  </md-field> -->
                  <!-- <md-field md-clearable :class="getValidationClass('nameCommon')">
                    <label for="first-name">Nombre Común</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.nameCommon"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.nameCommon.required"
                    >Olvidaste ingresar el nombre nombre común</span>
                  </md-field> -->
                  <!-- <md-field md-clearable :class="getValidationClass('presentation')">
                    <label for="first-name">Presentación</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.presentation"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.presentation.required"
                    >Olvidaste ingresar la presentación</span>
                  </md-field> -->
                  <!-- <md-field md-clearable :class="getValidationClass('amount')">
                    <label for="first-name">Cantidad</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.amount"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.amount.required"
                    >Olvidaste ingresar la cantidad</span>
                  </md-field> -->
                  <!-- <md-field md-clearable :class="getValidationClass('weight')">
                    <label for="first-name">Peso</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.weight"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.weight.required"
                    >Olvidaste ingresar el peso</span>
                  </md-field> -->
                  <!-- <md-field md-clearable :class="getValidationClass('commercialValue')">
                    <label for="first-name">Valor Comercial</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.commercialValue"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.commercialValue.required"
                    >Olvidaste ingresar el valor comercial</span>
                  </md-field> -->
                  <div class="md-layout">
                    <div class="md-layout-item md-size-50">
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
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="md-layout">                  
                    <div class="md-layout-item md-size-70"> 
                      <md-field md-clearable :class="getValidationClass('nameOfficial')">
                        <label for="first-name">Nombre Funcionario AUNAP</label>
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
                      <md-field md-clearable :class="getValidationClass('noDocumentId1')">
                        <label for="first-name">Documento de Identidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noDocumentId1"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noDocumentId1.required"
                        >Olvidaste ingresar el número de indentidad</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>    
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item md-size-70">
                      <md-field md-clearable :class="getValidationClass('nameRepresentative')">
                        <label for="first-name">Nombre Representante Autoridad Acompañante</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.nameRepresentative"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.nameRepresentative.required"
                        >Olvidaste ingresar el nombre del representante</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>        
                    </div>&nbsp;&nbsp;&nbsp;  
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('noDocumentId2')">
                        <label for="first-name">Documento de identidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noDocumentId2"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noDocumentId2.required"
                        >Olvidaste ingresar el número de identidad</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>      
                    </div>&nbsp;&nbsp;&nbsp;  
                  </div>
                  <div class="md-layout">                  
                    <div class="md-layout-item md-size-50">
                      <md-field md-clearable :class="getValidationClass('noPlateCertificate')">
                        <label for="first-name">No. de Placa o Cédula Militar</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.noPlateCertificate"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.noPlateCertificate.required"
                        >Olvidaste ingresar el número de placa o cédula militar</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                    
                  <div style="text-align:center">
                    <strong>DATOS DE LA INSTITUCIÓN QUE RECIBE LA DONACIÓN</strong>    
                  </div>  
                  <!-- <label>DATOS DE LA INSTITUCIÓN QUE RECIBE LA DONACIÓN</label> -->

                  <div class="md-layout">                  
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('name')">
                        <label for="first-name">Nombre</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.name"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.name.required"
                        >Olvidaste ingresar el nombre</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('legalStatus')">
                        <label for="first-name">Personería Jurídica</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.legalStatus"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.legalStatus.required"
                        >Olvidaste ingresar el nombre de la personería jurídica</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;  
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('address')">
                        <label for="first-name">Dirección</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.address"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.address.required"
                        >Olvidaste ingresar la dirección</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;  
                  </div>
                  <div class="md-layout">                  
                    <div class="md-layout-item md-size-70">
                      <md-field md-clearable :class="getValidationClass('representativeDonation')">
                        <label for="first-name">Representante Legal</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.representativeDonation"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.representativeDonation.required"
                        >Olvidaste ingresar la dirección</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('identification')">
                        <label for="first-name">C.C.</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.identification"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.identification.required"
                        >Olvidaste ingresar la cedula de ciudadania</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>    
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div>
                  <div class="md-layout">                  
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('municipality')">
                        <label for="first-name">Municipio</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.municipality"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.municipality.required"
                        >Olvidaste ingresar el nombre del municipio</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;     
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('corregimiento')">
                        <label for="first-name">Corregimiento</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.corregimiento"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.corregimiento.required"
                        >Olvidaste ingresar el nombre del corregimiento</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;     
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('place')">
                        <label for="first-name">Vereda</label>
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
                        >Olvidaste ingresar el nombre de la vereda</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;     
                    <div class="md-layout-item">    
                      <md-field md-clearable :class="getValidationClass('telephone')">
                        <label for="first-name">Teléfono</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.telephone"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.telephone.required"
                        >Olvidaste ingresar el numero de télefono</span>
                        <!-- <span class="md-error" v-else-if="!$v.form.firstName.minlength">Invalid first name</span> -->
                      </md-field>   
                    </div>&nbsp;&nbsp;&nbsp;      
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
    import jsPDF from 'jspdf';
    import 'jspdf-autotable';
    import 'bootstrap-fileinput';
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
        noActa: "",
        
        
        
        nameOfficial: "",
        noDocumentId1: "",
        nameRepresentative: "",
        noDocumentId2: "",
        noPlateCertificate: "",
        name: "",
        legalStatus: "",
        address: "",
        representativeDonation: "",
        identification: "",
        municipality: "",
        corregimiento: "",
        place: "",
        telephone: "",

        nameScientific1: "",
        nameCommon1: "",
        state1: "",
        presentation1: "",
        amount1: "",
        weight1: "",
        commercialValue1: "",          
      },

      nameScientific: "",
      nameCommon: "",
      amount: "",
      state: "",
      presentation: "",
      weight: "",
      commercialValue: "",
      
      arrayDonationCertificate: [],
      id_donationCertificate: 0,

      arrayRegional: {id:0, name:''},
	    arrayRegl: [],
      id_regional: 0,
	    arrayTarget: [],
    
      date: format(now, dateFormat),

      img1: null,

      // pdf: 0,

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
      noActa: {
        required
      },
      commercialValue: {
        required
      },
      nameOfficial: {
        required
      },
      noDocumentId1: {
        required
      },
      noDocumentId2: {
        required
      },
      nameRepresentative: {
        required
      },
      noPlateCertificate: {
        required
      },
      name: {
        required
      },
      legalStatus: {
        required
      },
      address: {
        required
      },
      representativeDonation: {
        required
      },
      identification: {
        required
      },
      municipality: {
        required
      },
      corregimiento: {
        required
      },
      place: {
        required
      },
      telephone: {
        required
      },


      nameScientific1: {
        required
      },
        nameCommon1: {
        required
      },
        state1: {
        required
      },
        presentation1: {
        required
      },
        amount1: {
        required
      },
        weight1: {
        required
      },
        commercialValue1: {
        required
      },
      
    }
  },

  computed: {
    file() {
       $(document).ready(function() {
        $("#input-res-2").fileinput({
            uploadUrl: "/site/test-upload",
            enableResumableUpload: true,
            initialPreviewAsData: true,
            allowedFileTypes: ['image'],
            showCancel: true,
            resumableUploadOptions: {
                testUrl: "/site/test-file-chunks",
                chunkSize: 1024, // 1 MB chunk size
            },
            maxFileCount: 5,
            theme: 'fas',
            deleteUrl: '/site/file-delete',
            fileActionSettings: {
                showZoom: function(config) {
                    if (config.type === 'pdf' || config.type === 'image') {
                        return true;
                    }
                    return false;
                }
            }
        });
      });
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


    clickImg1(e) {
        this.img1 = e.target.files[0];
        console.log(this.img1);
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
      this.saveData();
      this.$v.$touch();

      if (!this.$v.$invalid) {
        console.log(" validateSave");
        this.clearForm();
      console.log(" validateSaveSale");
      }
    },
    addItemTarget() {
      let me = this;
      var total1 = me.arrayTarget.push({
        nameScientific:this.nameScientific.toUpperCase(),
        nameCommon:this.nameCommon.toUpperCase(),
        state:this.state.toUpperCase(),
        presentation:this.presentation.toUpperCase(),
        amount:this.amount,
        weight:this.weight,
        commercialValue:this.commercialValue,
      });
      console.log("arrayTarget " + total1);
      me.clearTarget();  
    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
    },
    clearTarget() {
      this.nameScientific = null;
      this.nameCommon = null;
      this.state = null;
      this.presentation = null;
      this.amount = null;
      this.weight = null;
      this.commercialValue = null;
      this.images = [];
    },
    clearForm() {
      this.$v.$reset();
      this.form.noActa = null;
      this.nameScientific = null;
      this.nameCommon = null;
      this.form.presentation = null;
      this.form.amount = null;
      this.form.weight = null;
      this.form.commercialValue = null;
      this.date = null;
      this.form.nameOfficial = null;
      this.form.noDocumentId1 = null;
      this.form.nameRepresentative = null;
      this.form.noDocumentId2 = null;
      this.form.noPlateCertificate = null;
      this.form.name = null;
      this.form.legalStatus = null;
      this.form.address = null;
      this.form.representativeDonation = null;
      this.form.identification = null;
      this.form.municipality = null;
      this.form.corregimiento = null;
      this.form.place = null;
      this.form.telephone = null;
      this.arrayTarget = [];
      
      this.arrayRegl = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2),(me.listado = 0);
      (this.id_donationCertificate = data["id"]);
      this.form.noActa = data["noActa"];
      this.date = data["date"];
      this.form.nameOfficial = data["nameOfficial"];
      this.form.noDocumentId1 = data["noDocumentId1"];
      this.form.nameRepresentative = data["nameRepresentative"];
      this.form.noDocumentId2 = data["noDocumentId2"];
      this.form.noPlateCertificate = data["noPlateCertificate"];
      this.form.name = data["name"];
      this.form.legalStatus = data["legalStatus"];
      this.form.address = data["address"];
      this.form.representativeDonation = data["representativeDonation"];
      this.form.identification = data["identification"];
      this.form.municipality = data["municipality"];
      this.form.corregimiento = data["corregimiento"];
      this.form.place = data["place"];
      this.form.telephone = data["telephone"];
    
      this.arrayRegl.id = data["id_regional"];
	    this.arrayRegl.name = data["nameRegional"];
      this.dataTable();
    },
    nameWithRegional ({ name }) {
            return `${name}`
    },
    selectRegional() {
            let me = this;
            var url = "/donationCertificates/selectRegional";
            axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRegional= respuesta.regional;
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
        "/donationCertificates";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayDonationCertificate = respuesta.donations.data;
          me.myTable(me.arrayDonationCertificate);

        })
        .catch(function (error) {
          console.log(error);
        });
    }, 
    saveData() {
      console.log(" metodo guardar");
      let me = this;

      axios
        .post("/donationCertificates/save", {
    
        noActa: this.form.noActa.toUpperCase(),
        date: this.date,
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        noDocumentId1: this.form.noDocumentId1,
        nameRepresentative: this.form.nameRepresentative.toUpperCase(),
        noDocumentId2: this.form.noDocumentId2,
        noPlateCertificate: this.form.noPlateCertificate.toUpperCase(),
        name: this.form.name.toUpperCase(),
        legalStatus: this.form.legalStatus.toUpperCase(),
        address: this.form.address.toUpperCase(),
        representativeDonation: this.form.representativeDonation.toUpperCase(),
        identification: this.form.identification,
        municipality: this.form.municipality.toUpperCase(),
        corregimiento: this.form.corregimiento.toUpperCase(),
        place: this.form.place.toUpperCase(),
        telephone: this.form.telephone,

        target: this.arrayTarget,
       
        'id_regional': this.arrayRegl.id,
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
        .put("/donationCertificates/update", {
        id: this.id_donationCertificate,
        noActa: this.form.noActa.toUpperCase(),
        date: this.date,
        nameOfficial: this.form.nameOfficial.toUpperCase(),
        noDocumentId1: this.form.noDocumentId1,
        nameRepresentative: this.form.nameRepresentative.toUpperCase(),
        noDocumentId2: this.form.noDocumentId2,
        noPlateCertificate: this.form.noPlateCertificate.toUpperCase(),
        name: this.form.name.toUpperCase(),
        legalStatus: this.form.legalStatus.toUpperCase(),
        address: this.form.address.toUpperCase(),
        representativeDonation: this.form.representativeDonation.toUpperCase(),
        identification: this.form.identification,
        municipality: this.form.municipality.toUpperCase(),
        corregimiento: this.form.corregimiento.toUpperCase(),
        place: this.form.place.toUpperCase(),
        telephone: this.form.telephone,
       
        'id_regional': this.arrayRegl.id,
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
        title: "Esta seguro de Eliminar la Donación " + data["name"],
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
            .post("/donationCertificates/delete", {
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
    dataTable(){
      let me = this;

      var url = "/donationCertificates/dataTable?id_Donation="+this.id_donationCertificate;
      axios
        .get(url)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayTarget = respuesta.donation;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    createPdf (data = []) {
      let me = this;
      var columns = []; var rows = [];
      var doc = new jsPDF('p','mm','letter');
      this.id_donationCertificate = data["id"]
        var logo = new Image();
        logo.src = '/img/logoAUNAP.png';
        doc.addImage(logo, 'png', 20, 10, 33, 15);
        doc.text("FORMATO ACTA DE DONACIÓN", 65, 20);
        // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
        doc.setFont("arial");
        // doc.setFont("arial", "bold");
        doc.setFontSize(11);
        doc.text("No. Acta: " + me.datos.noActa, 15, 35 );
        doc.setFontSize(10);
        doc.text("Regional: " + me.datos['nameRegional'], 110, 35,);
        doc.setFontSize(10);
        doc.text(`En operativo de control desarrollado en _______________________________________________, el suscrito servidor público 
de la AUNAP ___________________________, de la oficina _________________________, el día ___, del mes de 202___, 
procedió a efectuar el decomiso preventivo de los recursos y/o productos pesqueros que a continuación se relacionan, por no 
cumplir con las disposiciones establecidas por la Autoridad Nacional de Pesca y Acuicultura - AUNAP.

Por tratarse de productos altamente perecederos y que no pueden ser comercializados, se procede a la donación de los mismos,
en presencia de la autoridad competente.
`, 16, 45);
        doc.setDrawColor(0,0,0);
        doc.rect(15, 41, 186, 30);
        doc.setDrawColor(0,0,0);
        doc.rect(15, 262, 186, 10);
            columns = [    
              { title: "Nombre científico", dataKey: "nomCientifico" },
              { title: "Nombre Común", dataKey: "nomComun" },
              { title: "Estado", dataKey: "estado" },
              { title: "Presentación", dataKey: "presentacion" },
              { title: "Cantidad (UN)", dataKey: "cant" },
              { title: "Peso (KG)", dataKey: "peso" },
              { title: "Valor Comercial", dataKey: "valor" },
                
            ];
            rows = [
              {"nomCientifico": this.pruebaData,
               "nomComun": this.pruebaData},
              // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional}, 
            ]; 
        doc.setFontSize(10);    
        doc.text(`Para constancia se firma la presente acta por cada uno de los que intervienen en la donación. Fecha: ${me.datos.date}`, 15, 145,  {align: 'justify',lineHeightFactor: 1,maxWidth:180} );    
        doc.setFontSize(10);
        doc.text("NOMBRE FUNCIONARIO AUNAP", 15, 155 );  
        doc.setFontSize(10);
        doc.text(`${me.datos.nameOfficial}`, 15, 160 );  
        doc.setFontSize(10);
        doc.text(`Documento de Identidad: ${me.datos.noDocumentId1}`, 15, 165 );  
        doc.setFontSize(10);
        doc.text("NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE", 95, 155 );  
        doc.setFontSize(10);
        doc.text(`${me.datos.nameRepresentative}`, 95, 160 ); 
        doc.setFontSize(10);
        doc.text(`Documento de Identidad: ${me.datos.noDocumentId2}`, 95, 165 );  
        doc.setFontSize(10);
        doc.line(15, 190, 80, 190);
        doc.setFontSize(10);
        doc.text("Firma", 42, 195 );
        doc.text(`No. de Placa o cédula militar: ${me.datos.noPlateCertificate}`, 95, 170 );  
        doc.setFontSize(10);
        doc.line(95, 190, 160, 190);
        doc.setFontSize(10);
        doc.text("Firma", 122, 195 );
        doc.setFontSize(10);
        doc.text("DATOS DE LA INSTITUCIÓN QUE RECIBE LA DONACIÓN", 55, 205 );
        doc.setFontSize(10);
        doc.text(`Nombre: ${me.datos.name}`, 15, 215 ); 
        doc.setFontSize(10);
        doc.text(`Personería Jurídica: ${me.datos.legalStatus}`, 15, 220 ); 
        doc.setFontSize(10);
        doc.text(`Dirección: ${me.datos.address}`, 95, 220 ); 
        doc.setFontSize(10);
        doc.text(`Representante Legal: ${me.datos.representativeDonation}`, 15, 225 ); 
        doc.setFontSize(10);
        doc.text(`C.C.: ${me.datos.identification}`, 95, 225 ); 
        doc.setFontSize(10);
        doc.text(`Municipio: ${me.datos.municipality}`, 15, 230 ); 
        doc.setFontSize(10);
        doc.text(`Corregimiento: ${me.datos.corregimiento}`, 95, 230 ); 
        doc.setFontSize(10);
        doc.text(`Vereda: ${me.datos.place}`, 15, 235 ); 
        doc.setFontSize(10);
        doc.text(`Teléfonos ${me.datos.telephone}`, 95, 235 );
        doc.setFontSize(10);
        doc.line(15, 255, 80, 255);
        doc.setFontSize(10);
        doc.text("Firma", 15, 260 );
        doc.setFontSize(10);
        doc.text(`Nota: Con la firma de la presente acta, los intervinientes del acto de Donación dan fe de las buenas
condiciones organolépticas del producto pesquero donado.`, 16, 266,{align: 'justify',lineHeightFactor: 1,maxWidth:180} );
        

        doc.autoTable(columns, rows, {
          // theme: 'grid',
                margin: { top: 80 },
                didDrawPage: function () {
                  // doc.text("INFORMACIÓN DEL PROYECTO", 50, 60);
                },
        });     
      //  doc.save("FORMATO ACTA DE DONACIÓN");
      window.open(doc.output('bloburl'))
      // me.pdf = 0;
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

            { "data": "noActa" },
            { "data": "nameRegional" },
            { "data": "nameOfficial" },
            { "data": "nameRepresentative" },
            { "data": "noPlateCertificate" },
            { "data": "name" },
            { "data": "legalStatus" },
            { "data": "address" },
             {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>  <button type='button'id='PDF' class='PDF btn btn-primary btn-sm' data-tooltip title='PDF' > <i class='fas fa-file-pdf'></i> </button>"},

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
          $("#dataTable tbody").on("click", ".PDF", function () {
                me.datos = table.row($(this).parents("tr")).data();
                // me.pdf = 1;
                // me.showUpdate(me.datos);
                me.createPdf();
          //  console.log(me.datos['id'] + " prueba de datos ID");       
            } );
    });
    }
  },

  mounted() {
    this.listData();
    this.selectRegional();
  }
};
</script>
<style>
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
