<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card" style="width: 100%">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Acta de Decomiso Preventivo</strong>
          <button
              v-if="edo"
              class="btn btn-success btn-sm"
              type="button"
              @click="showData()"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado==1">
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" cellspacing="0" class="table table-striped table-bordered display" width="100%">
                <thead>
                <tr>
                  <th>No. Acta</th>
                  <th>Regional</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Nombre Funcionario AUNAP</th>
                  <th>Nombre Representante Autoridad Acompañante</th>
                  <th>No. Placa o Cedula</th>
                  <th>Nombre del infractor</th>
                  <th>Dirección de Domicilio</th>
                  <th style="width: 90px">Opciones</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>No. Acta</th>
                  <th>Regional</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Nombre Funcionario AUNAP</th>
                  <th>Nombre Representante Autoridad Acompañante</th>
                  <th>No. Placa o Cedula</th>
                  <th>Nombre del infractor</th>
                  <th>Dirección de Domicilio</th>
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
            <form action class="form-horizontal" enctype="multipart/form-data" method="post">
              <md-card-content>
                <div class="md-layout">
                  <md-input v-model="form.user_id" type="hidden"/>

                  <div class="md-layout-item ">
                    <md-field :class="getValidationClass('noActa')" md-clearable>
                      <label for="first-name">No. Acta</label>
                      <md-input
                          id="first-name"
                          v-model="form.noActa"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="text"
                      />
                      <span
                          v-if="!$v.form.noActa.required"
                          class="md-error"
                      >Olvidaste ingresar el número de acta</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <label class="text-muted">Regional</label>
                    <multiselect v-model="arrayRegl" :custom-label="nameWithRegional"
                                 :options="arrayRegional"
                                 label="name"
                                 placeholder="Selecciona una opción"
                                 track-by="name">
                    </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('departament')" md-clearable>
                      <label for="first-name">Departamento</label>
                      <md-input
                          id="first-name"
                          v-model="form.departament"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.departament.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del departamento</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('municipality')" md-clearable>
                      <label for="first-name">Municipio</label>
                      <md-input
                          id="first-name"
                          v-model="form.municipality"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.municipality.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del municipio</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>

                <div class="card-body">
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <label class="text-muted">Nombre Común (Common Name)</label>
                      <multiselect v-model="arrayCName" :custom-label="nameWithCommonName"
                                   :options="arrayCommonName"
                                   label="commonname"
                                   placeholder="Seleccione una especie"
                                   track-by="commonname"
                                   @input="setCommonName()">
                      </multiselect>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Nombre Científico</label>
                        <md-input
                            id="first-name"
                            v-model="nameScientific"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <!-- <div class="md-layout-item">
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
                    </div>&nbsp;&nbsp;&nbsp; -->
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field>
                        <label class="text-muted">Estado</label>
                        <md-select id="state" v-model="state" name="state" placeholder="Estado">
                          <md-option value="fresco entero">Fresco entero</md-option>
                          <md-option value="fresco eviscerado ">Fresco eviscerado</md-option>
                          <md-option value="congelado entero">Congelado entero</md-option>
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
                    <div class="md-layout-item">
                      <md-field>
                        <label class="text-muted">Presentación</label>
                        <md-select id="presentation" v-model="presentation" name="presentatión"
                                   placeholder="Presentación">
                          <md-option value="unidades">Unidades</md-option>
                          <md-option value="zartas ">Zartas</md-option>
                          <md-option value="bolsas o bultos">Bolsas o Bultos</md-option>
                          <md-option value="canastas">Canastas</md-option>
                          <md-option value="grupos">Grupos</md-option>
                          <md-option value="otros">Otros</md-option>
                        </md-select>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Cantidad (Unidades)</label>
                        <md-input
                            id="first-name"
                            v-model="amount"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Promedio Talla (Cm)</label>
                        <md-input
                            id="first-name"
                            v-model="average"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item ">
                      <md-field md-clearable>
                        <label for="first-name">Peso (Kilogramos)</label>
                        <md-input
                            id="first-name"
                            v-model="weight"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item ">
                      <md-field md-clearable>
                        <label for="first-name">Valor Comercial (Pesos Colombianos)</label>
                        <md-input
                            id="first-name"
                            v-model="commercialValue"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>

                  <p>
                    <file-component
                        ref="fileComponent"
                        :accepted-file-types="['image/png', 'image/jpeg']"
                        max-file-size="3MB"
                    ></file-component>
                  </p>
                  <div id="collapseExample" class="collapse">
                    <div class="card card-body">
                      <div
                          :class="{ dragging: isDragging }"
                          class="uploader"
                          @dragenter="OnDragEnter"
                          @dragleave="OnDragLeave"
                          @drop="onDrop"
                          @dragover.prevent
                      >
                        <div v-show="images.length" class="upload-control">
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
                                id="file"
                                multiple
                                type="file"
                                @change="onInputChange"
                            />
                          </div>
                        </div>

                        <div v-show="images.length" class="images-preview">
                          <div
                              v-for="(image, index) in images"
                              :key="index"
                              class="img-wrapper"
                          >
                            <img :alt="`Image Uplaoder ${index}`" :src="image"/>
                            <button
                                class="btn btn-dark btn-sm"
                                type="button"
                                @click="eliminarImg(index)"
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
                      :disabled="sending"
                      class="md-dense md-raised md-primary"
                      type="button"
                      @click="addItemTarget()"
                  >Agregar
                  </md-button>
                  <div class="table-responsive">
                    <table id="dataTable" cellspacing="0" class="table table-striped table-bordered display"
                           width="50%">
                      <thead>
                      <tr>
                        <th>NOMBRE CIENTÍFICO</th>
                        <th>NOMBRE COMÚN</th>
                        <th>ESTADO</th>
                        <th>PRESENTACIÓN</th>
                        <th>CANTIDAD (UN)</th>
                        <th>PROMEDIO TALLA (Cm)</th>
                        <th>PESO (Kg)</th>
                        <th>VALOR COMERCIAL</th>
                        <th>FOTO</th>
                        <th style="width: 90px">Opciones</th>
                      </tr>
                      </thead>
                      <tbody v-if="arrayTarget.length">
                      <tr v-for="(target,index) in arrayTarget" v-if="!target.deleted" :key="`target-${index}`">
                        <td v-text="target.nameScientific" style="text-transform: capitalize !important;"></td>
                        <td v-text="target.nameCommon" style="text-transform: capitalize !important;"></td>
                        <td v-text="target.state" style="text-transform: capitalize !important;"></td>
                        <td v-text="target.presentation" style="text-transform: capitalize !important;"></td>
                        <td v-text="target.amount"></td>
                        <td v-text="target.average"></td>
                        <td v-text="target.weight"></td>
                        <td v-text="target.commercialValue"></td>
                        <td>
                          <div v-for="(file, index) in target.files" :key="file.uuid">
                                    <span v-if="file.hasOwnProperty('uuid')" @click="stream(file.uuid)">
                                      <md-icon>camera_alt</md-icon>
                                      <span>{{ index + 1 }}</span>
                                    </span>
                            <span v-else-if="typeof file === 'string'" @click="streamBase64(file)">
                                      <md-icon>camera_alt</md-icon>
                                      <span>{{ index + 1 }}</span>
                                    </span>
                          </div>
                        </td>
                        <td>
                          <button
                              class="btn btn-danger btn-sm"
                              data-tooltip
                              title="Eliminar"
                              type="button"
                              @click="deleteTarget(index)"
                          >
                            <i class="icon-trash"></i>
                          </button>
                        </td>
                      </tr>
                      </tbody>
                      <tbody v-else>
                      <tr>
                        <td class="text-center" colspan="10">
                          No existen elementos agregados
                        </td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>NOMBRE CIENTÍFICO</th>
                        <th>NOMBRE COMÚN</th>
                        <th>ESTADO</th>
                        <th>PRESENTACIÓN</th>
                        <th>CANTIDAD (UN)</th>
                        <th>PROMEDIO TALLA (Cm)</th>
                        <th>PESO (Kg)</th>
                        <th>VALOR COMERCIAL</th>
                        <th>FOTO</th>
                        <th style="width: 90px">Opciones</th>
                      </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-body">
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Elemento</label>
                        <md-input
                            id="first-name"
                            v-model="element"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Cantidad (Un)</label>
                        <md-input
                            id="first-name"
                            v-model="amount2"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Características y Estado</label>
                        <md-input
                            id="first-name"
                            v-model="characterState"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable>
                        <label for="first-name">Valor Comercial</label>
                        <md-input
                            id="first-name"
                            v-model="commercialValue2"
                            :disabled="sending"
                            autocomplete="given-name"
                            name="first-name"
                            type="number"
                        />
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <md-button
                      :disabled="sending"
                      class="md-dense md-raised md-primary"
                      type="button"
                      @click="addItemTarget2()"
                  >Agregar
                  </md-button>
                  <div class="table-responsive">
                    <table id="dataTable" cellspacing="0" class="table table-striped table-bordered display"
                           width="50%">
                      <thead>
                      <tr>
                        <th>ELEMENTO</th>
                        <th>CANTIDAD (UN)</th>
                        <th>CARACTERÍSTICAS Y ESTADO</th>
                        <th>VALOR COMERCIAL</th>
                        <!-- <th>FOTO</th>     -->
                        <th style="width: 90px">Opciones</th>
                      </tr>
                      </thead>
                      <tbody v-if="arrayTarget2.length">
                      <tr v-for="(target,index) in arrayTarget2" :key="`target-${index}`">
                        <td v-text="target.element"></td>
                        <td v-text="target.amount2"></td>
                        <td v-text="target.characterState"></td>
                        <td v-text="target.commercialValue2"></td>

                        <td>
                          <button
                              class="btn btn-danger btn-sm"
                              data-tooltip
                              title="Eliminar"
                              type="button"
                              @click="deleteTarget2(index)"
                          >
                            <i class="icon-trash"></i>
                          </button>
                        </td>
                      </tr>
                      </tbody>
                      <tbody v-else>
                      <tr>
                        <td class="text-center" colspan="6">
                          No existen elementos agregados
                        </td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>ELEMENTO</th>
                        <th>CANTIDAD (UN)</th>
                        <th>CARACTERÍSTICAS Y ESTADO</th>
                        <th>VALOR COMERCIAL</th>
                        <!-- <th>FOTO</th>         -->
                        <th style="width: 90px">Opciones</th>
                      </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <label align-center>MOTIVOS DEL DECOMISO PREVENTIVO</label>  -->
                <div>
                  <strong>MOTIVOS DEL DECOMISO PREVENTIVO</strong>
                </div>

                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Motivos del decomiso Preventivo</label>
                    <multiselect
                        v-model="arrayReasons"
                        :clear-on-select="false"
                        :close-on-select="false"
                        :multiple="true"
                        :options="arrayValue"
                        :preselect-first="false"
                        :preserve-search="true"
                        label="name"
                        placeholder="Motivos Del Decomiso Preventivo"
                        track-by="name">
                    </multiselect>
                  </div>
                </div>&nbsp;&nbsp;&nbsp;
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('text4')" md-clearable>
                      <label>Los recursos, productos pesqueros y/o elementos fueron decomisados cuando se encontraban en
                        (describa la situación):</label>
                      <md-textarea v-model="form.text4"></md-textarea>
                      <span
                          v-if="!$v.form.text4.required"
                          class="md-error"
                      >Olvidaste ingresar los recursos, productos y elementos que fueron decomisados
                          </span>
                    </md-field>
                  </div>
                </div>

                <div>
                  <strong>Para constancia se firma la presente acta por cada uno de los que intervienen en el decomiso
                    preventivo.</strong>
                </div>
                <!-- <label>Para constancia se firma la presente acta por cada uno de los que intervienen en el decomiso preventivo.</label> -->

                <div class="md-layout">
                  <div class="md-layout-item ">
                    <md-datepicker
                        v-model="form.date" :class="getValidationClass('date')"
                        :md-model-type="String"
                        md-clearable
                        md-immediately
                        @input="toString"
                    >
                      <label>Seleccione Fecha</label>
                      <span
                          v-if="!$v.form.date.required"
                          class="md-error"
                      >Olvidaste ingresar la fecha
                          </span>
                    </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item ">
                    <md-field :class="getValidationClass('officialName')" md-clearable>
                      <label for="first-name">Nombre Funcionario AUNAP</label>
                      <md-input
                          id="first-name"
                          v-model="form.officialName"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.officialName.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del funcionario de la AUNAP</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('documentIdOfficial')" md-clearable>
                      <label for="first-name">Documento de Identidad</label>
                      <md-input
                          id="first-name"
                          v-model="form.documentIdOfficial"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="number"
                      />
                      <span
                          v-if="!$v.form.documentIdOfficial.required"
                          class="md-error"
                      >Olvidaste ingresar el documento de identidad</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>

                <div class="md-layout">
                  <div class="md-layout-item ">
                    <md-field :class="getValidationClass('representativeName')" md-clearable>
                      <label for="first-name">Nombre Representante Autoridad Acompañante</label>
                      <md-input
                          id="first-name"
                          v-model="form.representativeName"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.representativeName.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre representante autoridad acompañante</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('documentIdRepresentative')" md-clearable>
                      <label for="first-name">Documento de Identidad</label>
                      <md-input
                          id="first-name"
                          v-model="form.documentIdRepresentative"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="number"
                      />
                      <span
                          v-if="!$v.form.documentIdRepresentative.required"
                          class="md-error"
                      >Olvidaste ingresar el documento de identidad</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item ">
                    <md-field :class="getValidationClass('plateCertificate')" md-clearable>
                      <label for="first-name">No. Placa o Cedula</label>
                      <md-input
                          id="first-name"
                          v-model="form.plateCertificate"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.plateCertificate.required"
                          class="md-error"
                      >Olvidaste ingresar la placa o cedula</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>


                <!-- <label>DATOS DEL PRESUNTO INFRACTOR</label> -->
                <div>
                  <strong>DATOS DEL PRESUNTO INFRACTOR</strong>
                </div>

                <div class="md-layout">
                  <div class="md-layout-item ">
                    <md-field :class="getValidationClass('name')" md-clearable>
                      <label for="first-name">Nombre</label>
                      <md-input
                          id="first-name"
                          v-model="form.name"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.name.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del infractor</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('documentIdOffender')" md-clearable>
                      <label for="first-name">Documento de Identidad</label>
                      <md-input
                          id="first-name"
                          v-model="form.documentIdOffender"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="number"
                      />
                      <span
                          v-if="!$v.form.documentIdOffender.required"
                          class="md-error"
                      >Olvidaste ingresar el documento de identidad del infractor</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item ">
                    <md-datepicker
                        v-model="form.dateExpedition" :class="getValidationClass('dateExpedition')"
                        :md-model-type="String"
                        md-clearable
                        md-immediately
                        @input="toString"
                    >
                      <label>Fecha de expediciòn C.C.</label>
                      <span
                          v-if="!$v.form.dateExpedition.required"
                          class="md-error"
                      >Olvidaste ingresar la fecha de expedición del documento
                          </span>
                    </md-datepicker>
                  </div> &nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('expeditionPlace')" md-clearable>
                      <label for="first-name">Lugar de Expedidión C.C.</label>
                      <md-input
                          id="first-name"
                          v-model="form.expeditionPlace"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.expeditionPlace.required"
                          class="md-error"
                      >Olvidaste ingresar el lugar de expedición del documento de identidad</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('homeAddress')" md-clearable>
                      <label for="first-name">Dirección de Domicilio</label>
                      <md-input
                          id="first-name"
                          v-model="form.homeAddress"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.homeAddress.required"
                          class="md-error"
                      >Olvidaste ingresar la dirección de domicilio</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('municipalityOffender')" md-clearable>
                      <label for="first-name">Municipio</label>
                      <md-input
                          id="first-name"
                          v-model="form.municipalityOffender"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.municipalityOffender.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del municipio</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('corregimiento')" md-clearable>
                      <label for="first-name">Corregimiento</label>
                      <md-input
                          id="first-name"
                          v-model="form.corregimiento"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.corregimiento.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre del corregimiento</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('neighborhood')" md-clearable>
                      <label for="first-name">Vereda</label>
                      <md-input
                          id="first-name"
                          v-model="form.neighborhood"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.neighborhood.required"
                          class="md-error"
                      >Olvidaste ingresar el nombre de la vereda</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('telephone')" md-clearable>
                      <label for="first-name">Teléfono</label>
                      <md-input
                          id="first-name"
                          v-model="form.telephone"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="number"
                      />
                      <span
                          v-if="!$v.form.telephone.required"
                          class="md-error"
                      >Olvidaste ingresar el número de teléfono</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('mobile')" md-clearable>
                      <label for="first-name">Celular</label>
                      <md-input
                          id="first-name"
                          v-model="form.mobile"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                          type="number"
                      />
                      <span
                          v-if="!$v.form.mobile.required"
                          class="md-error"
                      >Olvidaste ingresar el número de celular</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field :class="getValidationClass('email')" md-clearable>
                      <label for="first-name">Correo Electrónico</label>
                      <md-input
                          id="first-name"
                          v-model="form.email"
                          :disabled="sending"
                          autocomplete="given-name"
                          name="first-name"
                      />
                      <span
                          v-if="!$v.form.email.required"
                          class="md-error"
                      >Olvidaste ingresar el correo electrónico</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
                <div class="md-layout">
                  <md-field :class="getValidationClass('observation')" md-clearable>
                    <label>Observaciones</label>
                    <md-textarea v-model="form.observation"></md-textarea>
                    <span
                        v-if="!$v.form.observation.required"
                        class="md-error"
                    >Olvidaste ingresar las observaciones
                            </span>
                  </md-field>
                </div>
              </md-card-content>
            </form>
          </div>
          <div class="modal-footer">
            <md-card-actions>
              <md-button class="md-raised" type="button" @click="hideForm()">Cerrar</md-button>
            </md-card-actions>
            <md-card-actions>
              <md-button
                  v-if="tipoAccion==1"
                  :disabled="sending"
                  class="md-dense md-raised md-primary"
                  type="submit"
                  @click="validateData()"
              >Guardar
              </md-button>
              <md-button
                  v-if="tipoAccion==2"
                  :disabled="sending"
                  class="md-dense md-raised md-primary"
                  type="submit"
                  @click="updateData()"
              >Actualizar
              </md-button>
            </md-card-actions>
          </div>
        </template>
      </div>
    </div>
  </main>
</template>

<script>
import format from "date-fns/format";
import {validationMixin} from "vuelidate";
import Multiselect from "vue-multiselect";
import Toasted from 'vue-toasted';
import vSelect from "vue-select";
import jsPDF from 'jspdf'
import 'jspdf-autotable'
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

Vue.use(Toasted, {
  iconPack: 'material' // set your iconPack, defaults to material. material|fontawesome|custom-class
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
import {required, minLength, maxLength, email, sameAs} from "vuelidate/lib/validators";
import FileComponent from "./common/BasicFileComponent.vue";

export default {
  mixins: [validationMixin],
  props: ['ruta'],

  data() {

    Vue.material.locale.shortDays = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    Vue.material.locale.shorterDays = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];
    Vue.material.locale.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    Vue.material.locale.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let dateFormat = this.$material.locale.dateFormat || "yyyy-MM-dd";
    let now = new Date();

    return {
      form: {
        noActa: "",
        departament: "",
        municipality: "",
        officialName: "",
        documentIdOfficial: "",
        representativeName: "",
        documentIdRepresentative: "",
        plateCertificate: "",
        name: "",
        documentIdOffender: "",
        expeditionPlace: "",
        homeAddress: "",
        municipalityOffender: "",
        corregimiento: "",
        neighborhood: "",
        telephone: "",
        mobile: "",
        email: "",
        date: format(now, dateFormat),
        dateExpedition: format(now, dateFormat),
        observation: "",
        text4: "",
      },
      element: "",
      amount2: "",
      characterState: "",
      commercialValue2: "",
      nameScientific: "",
      nameCommon: "",


      state: "",
      presentation: "",
      amount: "",
      average: "",
      weight: "",
      commercialValue: "",


      arrayReasons: [],
      arrayValue: [
        {name: 'Sin Permiso', id: '1'},
        {name: 'Sin patente', id: '2'},
        {name: 'Sin salvoconducto', id: '3'},
        {name: 'Documentos adulterados', id: '4'},
        {name: 'Especie en época de veda', id: '5'},
        {name: 'Especie no autorizada', id: '6'},
        {name: 'Incumplimiento tallas mínimas', id: '7'},
        {name: 'Artes de pesca no autorizados', id: '8'},
        {name: 'Pesca en áreas no autorizadas', id: '9'},
        {name: 'Pesca en áreas protegidas', id: '10'},
        {name: 'Malas prácticas de pesca', id: '11'},
      ],
      arrayTarget: [],
      arrayTarget2: [],
      arrayTargetAct: [],
      arrayTarget2Act: [],
      arrayConfiscationCert: [],

      arrayDataTable1: [],
      arrayDataTable2: [],
      arrayMotivos: [],

      id_confiscationCert: 0,
      arrayCName: {id: 0, commonname: ''},
      arrayCommonName: [],
      arrayRegional: {id: 0, name: ''},
      arrayRegl: {id: 0, name: ''},
      id_regional: 0,
      edo: 1,
      listado: 1,
      sending: false,
      arrayData: [],
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
      departament: {
        required
      },
      municipality: {
        required
      },
      officialName: {
        required
      },
      documentIdOfficial: {
        required
      },
      representativeName: {
        required
      },
      documentIdRepresentative: {
        required
      },
      plateCertificate: {
        required
      },
      name: {
        required
      },
      documentIdOffender: {
        required
      },
      expeditionPlace: {
        required
      },
      homeAddress: {
        required
      },
      municipalityOffender: {
        required
      },
      corregimiento: {
        required
      },
      neighborhood: {
        required
      },
      telephone: {
        required
      },
      mobile: {
        required
      },
      email: {
        required
      },
      date: {
        required
      },
      dateExpedition: {
        required
      },
      observation: {
        required
      },
      text4: {
        required
      },
    }
  },

  computed: {},
  components: {
    FileComponent,
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
    eliminarImg(index) {
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
    setCommonName() {
      this.nameScientific = this.arrayCName.scientificname;
      this.nameCommon = this.arrayCName.commonname;
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
    addItemTarget() {
      // Se va a colocar la funcion de convertir a minusculas
      let me = this;
      me.arrayTarget.push({
        nameScientific: this.nameScientific.toLowerCase(),
        nameCommon: this.nameCommon.toLowerCase(),
        state: this.state.toLowerCase(),
        presentation: this.presentation.toLowerCase(),
        amount: this.amount,
        average: this.average,
        weight: this.weight,
        commercialValue: this.commercialValue,
        files : this.$refs.fileComponent.getImagesAsBase64()
      });
      me.clearTarget();
      this.$refs.fileComponent.removeFiles();
    },
    addItemTarget2() {
      let me = this;
      var total1 = me.arrayTarget2.push({
        element: this.element.toLowerCase(),
        amount2: this.amount2.toLowerCase(),
        characterState: this.characterState.toLowerCase(),
        commercialValue2: this.commercialValue2.toLowerCase(),
      });
      var total2 = me.arrayTarget2Act.push({
        element: this.element.toLowerCase(),
        amount2: this.amount2.toLowerCase(),
        characterState: this.characterState.toLowerCase(),
        commercialValue2: this.commercialValue2.toLowerCase(),

      });
      me.clearTarget2();
    },

    deleteTarget(index) {
      if(this.arrayTarget[index].hasOwnProperty('id')){
        this.arrayTarget[index]['deleted'] = true;
      }else{
        this.arrayTarget.splice(index,1);
      }
    },
    deleteTarget2(index) {
      this.arrayTarget2.splice(index, 1);
    },
    clearTarget() {
      this.nameScientific = null;
      this.nameCommon = null;
      this.state = null;
      this.presentation = null;
      this.amount = null;
      this.average = null;
      this.weight = null;
      this.commercialValue = null;
    },
    clearTarget2() {
      this.element = null;
      this.amount2 = null;
      this.characterState = null;
      this.commercialValue2 = null;
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
      this.form.noActa = null;
      this.form.departament = null;
      this.form.municipality = null;
      this.form.text4 = null;
      this.form.officialName = null;
      this.form.documentIdOfficial = null;
      this.form.representativeName = null;
      this.form.documentIdRepresentative = null;
      this.form.plateCertificate = null;
      this.form.name = null;
      this.form.documentIdOffender = null;
      this.form.expeditionPlace = null;
      this.form.homeAddress = null;
      this.form.municipalityOffender = null;
      this.form.corregimiento = null;
      this.form.neighborhood = null;
      this.form.telephone = null;
      this.form.mobile = null;
      this.form.email = null;
      this.form.date = null;
      this.form.dateExpedition = null;
      this.form.observation = null;
      this.arrayReasons = [];
      this.arrayTarget = [];
      this.arrayTarget2 = [];
      this.arrayTargetAct = [];
      this.arrayTarget2Act = [];

      this.arrayRegl = {id: 0, name: ''};
    },

    getUser() {
      let me = this;
      var url =
          "/user/getuser";
      axios
          .get(url)
          .then(function (response) {
            var respuesta = response.data;
            me.form.user_id = respuesta;
          })
          .catch(function (error) {
            console.log(error);
          });
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_confiscationCert = data["id"]);
      this.form.noActa = data["noActa"];
      this.form.departament = data["departament"];
      this.form.municipality = data["municipality"];
      this.form.text4 = data["text4"];
      this.form.officialName = data["officialName"];
      this.form.documentIdOfficial = data["documentIdOfficial"];
      this.form.representativeName = data["representativeName"];
      this.form.documentIdRepresentative = data["documentIdRepresentative"];
      this.form.plateCertificate = data["plateCertificate"];
      this.form.name = data["name"];
      this.form.documentIdOffender = data["documentIdOffender"];
      this.form.expeditionPlace = data["expeditionPlace"];
      this.form.homeAddress = data["homeAddress"];
      this.form.municipalityOffender = data["municipalityOffender"];
      this.form.corregimiento = data["corregimiento"];
      this.form.neighborhood = data["neighborhood"];
      this.form.telephone = data["telephone"];
      this.form.mobile = data["mobile"];
      this.form.email = data["email"];
      this.form.date = data["date"];
      this.form.dateExpedition = data["dateExpedition"];
      this.form.observation = data["observation"];

      this.arrayRegl.id = data["id_regional"];
      this.arrayRegl.name = data["nameRegional"];
      this.dataTable1();
      this.dataTable2();
      this.dataReasons();
    },
    nameWithRegional({name}) {
      return `${name}`
    },
    nameWithCommonName({commonname}) {
      return `${commonname}`
    },
    showData() {
      this.clearForm();
      let me = this;
      (this.tipoAccion = 1), (me.listado = 0);
      this.edo = 0;
    },
    hideForm() {
      this.edo = 1;
      this.listado = 1;
      this.listData();
    },
    listData() {
      let me = this;
      var url =
          "/confiscationCertificates";
      axios
          .get(url)
          .then(function (response) {
            var respuesta = response.data;
            me.arrayConfiscationCert = respuesta.confiscation.data;
            me.arrayDataTable1 = respuesta.datatable1;
            me.arrayDataTable2 = respuesta.datatable2;
            me.arrayMotivos = respuesta.motivos;
            me.myTable(me.arrayConfiscationCert);

          })
          .catch(function (error) {
            console.log(error);
          });
    },
    selectRegional() {
      let me = this;
      var url = "/confiscationCertificates/selectRegional";
      axios.get(url).then(function (response) {
        var respuesta = response.data;
        me.arrayRegional = respuesta.regional;
      }).catch(function (error) {
        console.log(error);
      });
    },
    saveData() {
      let me = this;

      axios
          .post("/confiscationCertificates/save", {
            'user_id': this.form.user_id,
            noActa: this.form.noActa.toUpperCase(),
            departament: this.form.departament.toUpperCase(),
            municipality: this.form.municipality.toUpperCase(),
            text4: this.form.text4.toUpperCase(),
            officialName: this.form.officialName.toUpperCase(),
            documentIdOfficial: this.form.documentIdOfficial.toUpperCase(),
            representativeName: this.form.representativeName.toUpperCase(),
            documentIdRepresentative: this.form.documentIdRepresentative.toUpperCase(),
            plateCertificate: this.form.plateCertificate.toUpperCase(),
            name: this.form.name.toUpperCase(),
            documentIdOffender: this.form.documentIdOffender.toUpperCase(),
            expeditionPlace: this.form.expeditionPlace.toUpperCase(),
            homeAddress: this.form.homeAddress.toUpperCase(),
            municipalityOffender: this.form.municipalityOffender.toUpperCase(),
            corregimiento: this.form.corregimiento.toUpperCase(),
            neighborhood: this.form.neighborhood.toUpperCase(),
            telephone: this.form.telephone,
            mobile: this.form.mobile,
            email: this.form.email,
            date: this.form.date,
            dateExpedition: this.form.dateExpedition,
            observation: this.form.observation.toUpperCase(),
            data: this.arrayReasons,
            target: this.arrayTarget,
            target2: this.arrayTarget2,

            'id_regional': this.arrayRegl.id,
          })
          .then(function (response) {
            me.arrayTargetAct = [];
            me.hideForm();
            me.id_confiscationCert = response.data.confiscation.id;
            me.message("Guardado", "Guardo ");
            me.listData();
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    updateData() {
      let me = this;

      axios
          .put("/confiscationCertificates/update", {

            id: this.id_confiscationCert,
            noActa: this.form.noActa.toUpperCase(),
            departament: this.form.departament.toUpperCase(),
            municipality: this.form.municipality.toUpperCase(),
            text4: this.form.text4.toUpperCase(),
            officialName: this.form.officialName.toUpperCase(),
            documentIdOfficial: this.form.documentIdOfficial.toUpperCase(),
            representativeName: this.form.representativeName.toUpperCase(),
            documentIdRepresentative: this.form.documentIdRepresentative.toUpperCase(),
            plateCertificate: this.form.plateCertificate.toUpperCase(),
            name: this.form.name.toUpperCase(),
            documentIdOffender: this.form.documentIdOffender.toUpperCase(),
            expeditionPlace: this.form.expeditionPlace.toUpperCase(),
            homeAddress: this.form.homeAddress.toUpperCase(),
            municipalityOffender: this.form.municipalityOffender.toUpperCase(),
            corregimiento: this.form.corregimiento.toUpperCase(),
            neighborhood: this.form.neighborhood.toUpperCase(),
            telephone: this.form.telephone,
            mobile: this.form.mobile,
            email: this.form.email,
            date: this.form.date,
            dateExpedition: this.form.dateExpedition,
            observation: this.form.observation.toUpperCase(),
            'id_regional': this.arrayRegl.id,
            'target': this.arrayTarget,
            'target2': this.arrayTarget2Act,
          })
          .then(function (response) {
            me.arrayTargetAct = [];
            me.listData();
            me.hideForm();
            me.message("Actualizado", "Actualizó ");
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    deleteData(data = []) {
      swal({
        title: "Esta seguro de Eliminar el Acta " + data["name"],
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
              .post("/confiscationCertificates/delete", {
                id: data["id"],
              })
              .then(function (response) {
                me.hideForm();
                me.message("Eliminado", "Eliminó ");
                me.listData();
              })
              .catch(function (error) {
                console.log(error);
              });
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    dataTable1() {
      let me = this;

      var url = "/confiscationCertificates/table1?id_Confiscation=" + this.id_confiscationCert;
      axios
          .get(url)
          .then(function (response) {
            //console.log(response);
            var respuesta = response.data;
            me.arrayTarget = respuesta.confTable1.map(item => {
              return {
                ...item,
                deleted : false,
              }
            });
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    dataTable2() {
      let me = this;

      var url = "/confiscationCertificates/table2?id_Confiscation=" + this.id_confiscationCert;
      axios
          .get(url)
          .then(function (response) {
            //console.log(response);
            var respuesta = response.data;
            me.arrayTarget2 = respuesta.confTable2;
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    dataReasons() {
      let me = this;

      var url = "/confiscationCertificates/dataReasons?id_Confiscation=" + this.id_confiscationCert;
      axios
          .get(url)
          .then(function (response) {
            //console.log(response);
            var respuesta = response.data;
            me.arrayReasons = respuesta.reasons;
          })
          .catch(function (error) {
            console.log(error);
          });
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
    message(tipo, crud) {
      swal(tipo, "El registro se " + crud + " con éxito.", "success");
    },
    createPdf(data = []) {
      let me = this;
      var columns = [];
      var rows = [];
      var columns1 = [];
      var rows1 = [];
      var columns2 = [];
      var rows2 = [];
      let info = [];
      // me.arrayTarget.array.forEach((element) => {
      //   info.push([element.nameScientific, element.nameCommon, element.state])     
      // });
      var doc = new jsPDF('p', 'mm', 'letter');
      this.id_donationCertificate = data["id"]
      console.log("ID " + me.datos.id);
      var logo = new Image();
      logo.src = '/img/logoAUNAP.png';
      doc.addImage(logo, 'png', 20, 10, 33, 15);
      doc.text("FORMATO ACTA DE DECOMISO PREVENTIVO", 55, 20);
      // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
      doc.setFont("arial");
      // doc.setFont("arial", "bold");
      doc.setFontSize(12);
      doc.text("No. Acta: " + me.datos.noActa, 15, 35);
      doc.setFontSize(10);
      doc.text("Regional: " + me.datos.noActa, 15, 45);
      doc.setFontSize(10);
      doc.text("Departamento: " + me.datos.noActa, 75, 45);
      doc.setFontSize(10);
      doc.text("Municipio: " + me.datos.noActa, 140, 45);
      doc.setFontSize(10);
      doc.text(`El suscrito servidor público de la AUNAP ___________________________________________, de la oficina
_____________________________, el día _________, del mes de ______________ de 202 __, procedió a efectuar el decomiso 
preventivo de los siguientes recursos y/o productos pesqueros:
`, 16, 55);
      doc.setDrawColor(0, 0, 0);
      doc.rect(15, 50, 186, 15);

      console.log("ME ", me.datos)

      columns = [
        {title: "Nombre científico", dataKey: "nomCientifico"},
        {title: "Nombre Común", dataKey: "nomComun"},
        {title: "Estado", dataKey: "estado"},
        {title: "Presentación", dataKey: "presentacion"},
        {title: "Cantidad (UN)", dataKey: "cant"},
        {title: "Peso (KG)", dataKey: "peso"},
        {title: "Valor Comercial", dataKey: "valor"},

      ];
      
      // rows = [
      //   {
      //     "nomCientifico": me.datos.nameScientific,
      //     "nomComun": me.datos.nameCommon,
      //     "estado": me.datos.state
      //   },
      //   // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional},
      // ];

      let arrays = {};
      me.arrayDataTable1.forEach(elements => {
        for (let i = 0; i < elements.length; i++) {
          const element = elements[i];
          if( element.id_confiscation == me.datos.id){
            arrays = {
              "nomCientifico": element.nameScientific,
              "nomComun": element.nameCommon,
              "estado": element.state,
              "presentacion": element.presentation,
              "cant": element.amount,
              "peso": element.weight,
              "valor": element.commercialValue
            }
            
            rows.push(arrays);
          }
        }
      });

      rows;
      console.log(rows)

      columns1 = [
        {title: "Elemento", dataKey: "elemento"},
        {title: "Cantidad (UN)", dataKey: "cantidad"},
        {title: "Características y estado", dataKey: "caractEstado"},
        {title: "Valor Comercial", dataKey: "valorC"},
      ];
      rows1 = [
        {
          "elemento": me.datos.nameScientific,
          "cantidad": me.datos.nameCommon,
          "caractEstado": me.datos.state,
          "valorC": me.datos.state,
        },
        // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional},
      ];
      columns2 = [
        {title: "MOTIVOS DEL DECOMISO PREVENTIVO", dataKey: "motivos"},
      ];
      rows2 = [
        {
          "motivos": me.datos.nameScientific,

        },
        // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional},
      ];
      doc.setFontSize(10);
      doc.text(`ESTADO: Fresco entero (FE), Fresco eviscerado (FV), Congelado entero (CE), Congelado eviscerado (CV),
Descabezado (D), Tronco (TR), Aletas (A), Seco (S), Vivos (V), Otros (especificar). 
PRESENTACIÓN: Unidades, zartas, bolsas o bultos, canastas, grupos, otros.
Procedió a efectuar el decomiso preventivo de los siguientes elementos (equipos y/o artes de pesca) asociados a la 
actividad de extracción o comercialización de recursos y/o productos pesqueros:`, 15, 140);
      doc.setFontSize(10);
      doc.text(`ELEMENTO: Embarcación, motor, arte de pesca, otro. En caso de artes, especificar tipo (atarraya, chinchorro,
liso, palangre, otro).`, 15, 165);
      doc.setFontSize(10);
      doc.text(`Los recursos, productos pesqueros y/o elementos fueron decomisados cuando se encontraban en
(describa la situación):` + me.datos.text4, 15, 175);
      doc.setFontSize(10);
      doc.text(`Para constancia se firma la presente acta por cada uno de los que intervienen en el decomiso preventivo.: ${me.datos.date}`, 15, 185);
      doc.setFontSize(10);
      doc.text("NOMBRE FUNCIONARIO AUNAP", 15, 195);
      doc.setFontSize(10);
      doc.text(`${me.datos.officialName}`, 15, 200);
      doc.setFontSize(10);
      doc.text(`Documento de Identidad: ${me.datos.documentIdOfficial}`, 15, 205);
      doc.setFontSize(10);
      doc.text("NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE", 95, 195);
      doc.setFontSize(10);
      doc.text(`${me.datos.representativeName}`, 95, 200);
      doc.setFontSize(10);
      doc.text(`Documento de Identidad: ${me.datos.documentIdRepresentative}`, 95, 205);
      doc.setFontSize(10);
      doc.line(15, 233, 80, 233);
      doc.setFontSize(10);
      doc.text("Firma", 42, 236);
      doc.text(`No. de Placa o cédula militar: ${me.datos.plateCertificate}`, 95, 210);
      doc.setFontSize(10);
      doc.line(95, 233, 160, 233);
      doc.setFontSize(10);
      doc.text("Firma", 122, 236);

      doc.autoTable({
        margin: {top: 72},
        head: [['Nombre científico', 'Nombre Común', 'Estado', 'Presentación', 'Cantidad (UN)', 'Peso (KG)', 'Valor Comercial']],
        body: this.info
      });

      // doc.autoTable(columns, rows, {
      //   // theme: 'grid',
      //         margin: { top: 72 },
      //         didDrawPage: function () {
      //         },
      // });

      doc.autoTable(columns1, rows1, {
        margin: {top: 120},
        didDrawPage: function () {

        },
      });

      doc.autoTable(columns2, rows2, {
        margin: {top: 140},
        didDrawPage: function () {
        },
      });
      doc.addPage();
      doc.setFontSize(10);
      doc.text(`DATOS DEL PRESUNTO INFRACTOR`, 70, 20);
      doc.setFontSize(10);
      doc.text(`Nombre: ${me.datos.name}`, 15, 35);
      doc.setFontSize(10);
      doc.text(`Documento de Identidad: ${me.datos.documentIdOffender}`, 15, 40);
      doc.setFontSize(10);
      doc.text(`Fecha y Lugar de Expedición de C.C.: ${me.datos.dateExpedition}, ${me.datos.expeditionPlace}`, 15, 45);
      doc.text(`Dirección del Domicilio: ${me.datos.homeAddress}`, 15, 50);
      doc.text(`Municipio: ${me.datos.municipalityOffender}`, 15, 55);
      doc.text(`Corregimiento: ${me.datos.corregimiento}`, 82, 55);
      doc.text(`Vereda: ${me.datos.neighborhood}`, 145, 55);
      doc.text(`Teléfonos: ${me.datos.telephone}`, 15, 60);
      doc.text(`Celular: ${me.datos.mobile}`, 82, 60);
      doc.text(`Correo Electrónico: ${me.datos.email}`, 15, 65);
      doc.text(`Observaciones: ${me.datos.observation}`, 15, 70);
      doc.setFontSize(10);
      doc.line(15, 110, 80, 110);
      doc.setFontSize(10);
      doc.text("Firma", 42, 113);
      doc.text("Huella", 120, 113);
      doc.setDrawColor(0, 0, 0);
      doc.rect(105, 75, 40, 35);


      //  doc.save("FORMATO ACTA DE DONACIÓN");
      window.open(doc.output('bloburl'))

    },
    myTable(datas) {
      let me = this;

      $(document).ready(function () {

        var table = $('#dataTable').DataTable({
          destroy: true,
          stateSave: true,
          data: datas,
          "createdRow": function (row, data, dataIndex) {
            if (data[6] == `0`) {
              $(row).addClass('redClass');
            }
          },
          "language": {
            "lengthMenu": "Ver _MENU_ registros por página",
            "zeroRecords": "NO existen Datos",
            "info": "mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "search": "Buscar:",
            "paginate": {
              "first": "Prim",
              "last": "Ant",
              "next": "Sig",
              "previous": "Ant"
            },
            "infoFiltered": "(filtrado de _MAX_ total registros)"
          },
          responsive: "true",
          "columns": [
            {"data": "noActa"},
            {"data": "nameRegional"},
            {"data": "departament"},
            {"data": "municipality"},
            {"data": "officialName"},
            {"data": "representativeName"},
            {"data": "plateCertificate"},
            {"data": "name"},
            {"data": "homeAddress"},
            {"defaultContent": "<button type='button' id='editar' class='editar btn btn-success btn-sm' data-tooltip title='Actualizar' > <i class='fas fa-edit'></i>  </button> <button type='button'id='eliminar' class='eliminar btn btn-danger btn-sm' data-tooltip title='Eliminar' > <i class='fas fa-trash-alt'></i> </button>  <button type='button'id='PDF' class='PDF btn btn-primary btn-sm' data-tooltip title='PDF' > <i class='fas fa-file-pdf'></i> </button>"},

          ]

        });

        $('#dataTable tbody').on('click', '.editar', function () {
          me.datos = table.row($(this).parents('tr')).data();
          me.showUpdate(me.datos);
        });
        $('#dataTable tbody').on('click', '.eliminar', function () {
          me.datos = table.row($(this).parents('tr')).data();
          me.deleteData(me.datos);
        });
        $("#dataTable tbody").on("click", ".PDF", function () {
          me.datos = table.row($(this).parents("tr")).data();
          me.createPdf();
        });
      });
    },
    async stream(uuid){
      const url = `/file/stream/${uuid}`;
      const {data} = await  axios.get(url, {
        responseType: "blob"
      });
      const blobUrl = URL.createObjectURL(data);
      //window open as popup
      window.open(blobUrl, "_blank", "width=800,height=600");
    },
    streamBase64(base64){
      // stream base64string to browser
      // convert base64 to blob
      const byteString = atob(base64);
      const ab = new ArrayBuffer(byteString.length);
      const ia = new Uint8Array(ab);
      for (let i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
      }
      const blob = new Blob([ab], { type: "image/png" });
      const blobUrl = URL.createObjectURL(blob);
      //window open as popup
      window.open(blobUrl, "_blank", "width=800,height=600");
    }
  },

  mounted() {
    this.getUser();
    this.getCommonName();
    this.listData();
    this.selectRegional();
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}

.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}

.div-error {
  display: flex;
  justify-content: center;
}

.text-error {
  color: red !important;
  font-weight: bold;
}

.material-icons.Color1 {
  color: rgb(31, 33, 34);
}

.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}

.material-icons.Color3 {
  color: rgb(12, 170, 91);
}

.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}

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

.material-icons.Color1 {
  color: rgb(31, 33, 34);
}

.material-icons.Color2 {
  color: rgba(167, 142, 5, 0.849);
}

.material-icons.Color3 {
  color: rgb(12, 170, 91);
}

.material-icons.Color4 {
  color: rgba(228, 54, 54, 0.863);
}
</style>
