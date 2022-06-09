<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="m-0 font-weight-bold text-primary fas fa-car"></i>
          <strong class="lead">Acta de Decomiso Preventivo</strong>          
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
                    <th>No. Acta</th>
                    <th>Regional</th>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Nombre Científico</th>
                    <th>Nombre Comun</th>
                    <th>Cantidad (Un)</th>
                    <th>Promedio Talla (Cm)</th>
                    <th>Peso (Kg)</th>
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
                      <th>Nombre Científico</th>
                      <th>Nombre Comun</th>
                      <th>Cantidad (Un)</th>
                      <th>Promedio Talla (Cm)</th>
                      <th>Peso (Kg)</th>
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
                  <div class="md-layout-item md-size-70">
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
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;  
                </div>
                <div class="md-layout">
                  <div class="md-layout-item">
                    <label class="text-muted">Regional</label>
                      <multiselect v-model="arrayRegl" :options="arrayRegional"
                          placeholder="Selecciona una opción"
                          :custom-label="nameWithRegional"
                          label="name"
                          track-by="name">
                      </multiselect>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout-item">
                    <md-field md-clearable :class="getValidationClass('departament')">
                      <label for="first-name">Departamento</label>
                      <md-input
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
                        v-model="form.departament"
                        :disabled="sending"
                      />
                      <span
                        class="md-error"
                        v-if="!$v.form.departament.required"
                      >Olvidaste ingresar el nombre del departamento</span>
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;      
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
                    </md-field>
                  </div>&nbsp;&nbsp;&nbsp;      
                </div>
                <div class="card-body">
                    <div class="md-layout">
                      <div class="md-layout-item">
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
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
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
                      </div>&nbsp;&nbsp;&nbsp;
                    </div>  
                    <div class="md-layout">
                      <div class="md-layout-item">
                        <md-field md-clearable :class="getValidationClass('state1')">
                          <label for="first-name">Estado</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.state1"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.state1.required"
                          >Olvidaste ingresar el estado</span>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable :class="getValidationClass('presentation1')">
                          <label for="first-name">Presentación</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.presentation1"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.presentation1.required"
                          >Olvidaste ingresar la presentación</span>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable :class="getValidationClass('amount1')">
                          <label for="first-name">Cantidad (UN)</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.amount1"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.amount1.required"
                          >Olvidaste ingresar la cantidad unitaria</span>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item">
                        <md-field md-clearable :class="getValidationClass('AverageSize')">
                          <label for="first-name">Promedio Talla (Cm)</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.AverageSize"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.AverageSize.required"
                          >Olvidaste ingresar el promedio talla en centimetros</span>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;          
                    </div>
                    <div class="md-layout">
                      <div class="md-layout-item md-size-20">
                        <md-field md-clearable :class="getValidationClass('weight1')">
                          <label for="first-name">Peso (Kg)</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.weight1"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.weight1.required"
                          >Olvidaste ingresar el peso en kilogramosa</span>
                        </md-field>
                      </div>&nbsp;&nbsp;&nbsp;
                      <div class="md-layout-item md-size-20">
                        <md-field md-clearable :class="getValidationClass('commercialValue1')">
                          <label for="first-name">Valor Comercial</label>
                          <md-input
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            v-model="form.commercialValue1"
                            :disabled="sending"
                          />
                          <span
                            class="md-error"
                            v-if="!$v.form.commercialValue1.required"
                          >Olvidaste ingresar valor comercial</span>
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
                          <th>NOMBRE CIENTÌFICO</th>    
                          <th>NOMBRE COMÙN</th>              
                          <th>ESTADO</th>    
                          <th>PRESENTACIÓN</th>    
                          <th>CANTIDAD (UN)</th>    
                          <th>PROMEDIO TALLA (Cm)</th>    
                          <th>PESO (Kg)</th>    
                          <th>VALOR COMERCIAL</th>    
                          <!-- <th>FOTO</th>     -->
                          <th style="width: 90px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(target,index) in arrayTarget" :key="`target-${index}`">
                          <td v-text="target.nameScientific1"></td>
                          <td v-text="target.nameCommon1"></td>
                          <td v-text="target.state1"></td>
                          <td v-text="target.presentation1"></td>
                          <td v-text="target.amount1"></td>
                          <td v-text="target.AverageSize"></td>
                          <td v-text="target.weight1"></td>
                          <td v-text="target.commercialValue1"></td>
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
                            <th>NOMBRE CIENTÌFICO</th>    
                            <th>NOMBRE COMÙN</th>              
                            <th>ESTADO</th>    
                            <th>PRESENTACIÓN</th>    
                            <th>CANTIDAD (UN)</th>   
                            <th>PROMEDIO TALLA (Cm)</th>  
                            <th>PESO (Kg)</th>    
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
                <div class="card-body">
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('element')">
                        <label for="first-name">Elemento</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.element"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.element.required"
                        >Olvidaste ingresar el nombre del elemento</span>
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;                       
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('amount2')">
                        <label for="first-name">Cantidad (UN)</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.amount2"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.amount2.required"
                        >Olvidaste ingresar la cantidad unitaria</span>
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;                       
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('characterState')">
                        <label for="first-name">Características y Estado</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.characterState"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.characterState.required"
                        >Olvidaste ingresar las características y estado</span>
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;                       
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('commercialValue2')">
                        <label for="first-name">Valor Comercial</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.commercialValue2"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.commercialValue2.required"
                        >Olvidaste ingresar valor comercial</span>
                      </md-field> 
                    </div>&nbsp;&nbsp;&nbsp;                                                         
                  </div>                       
                  <md-button
                    type="button"
                    class="md-dense md-raised md-primary"
                    :disabled="sending"
                    @click="addItemTarget2()"
                  >Agregar
                  </md-button>
                  <div class="table-responsive">  
                    <table class="table table-striped table-bordered display" id="dataTable" width="50%" cellspacing="0">
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
                      <tbody>
                        <tr v-for="(target,index) in arrayTarget2" :key="`target-${index}`">
                          <td v-text="target.element"></td>
                          <td v-text="target.amount2"></td>
                          <td v-text="target.characterState"></td>
                          <td v-text="target.commercialValue2"></td>
                          
                          <td>                      
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              data-tooltip
                              title="Eliminar"
                              @click="deleteTarget2(index)"
                            >
                              <i class="icon-trash"></i>
                            </button>
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
                  <md-field md-clearable :class="getValidationClass('nameScientific')">
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
                    >Olvidaste ingresar el nombre científico</span>
                  </md-field>
                   <md-field md-clearable :class="getValidationClass('nameCommon')">
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
                  </md-field>
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
                  <md-field md-clearable :class="getValidationClass('amount')">
                    <label for="first-name">Cantidad (Un)</label>
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
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('average')">
                    <label for="first-name">Promedio Talla (Cm)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.average"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.average.required"
                    >Olvidaste ingresar el promedio talla</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('weight')">
                    <label for="first-name">Peso (Kg)</label>
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
                  </md-field> 
                  <md-field md-clearable :class="getValidationClass('commercialValue')">
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
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('element')">
                    <label for="first-name">Elemento</label>
                    <md-input
                       name="first-name"
                       id="first-name"
                       autocomplete="given-name"
                       v-model="form.element"
                       :disabled="sending"
                     />
                     <span
                       class="md-error"
                       v-if="!$v.form.element.required"
                     >Olvidaste ingresar el nombre del elemento</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('amount2')">
                    <label for="first-name">Cantidad (Un)</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.amount2"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.amount2.required"
                    >Olvidaste ingresar la cantidad</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('featuresState')">
                    <label for="first-name">Características y Estado</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.featuresState"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.featuresState.required"
                    >Olvidaste ingresar las características y estado</span>
                  </md-field>
                  <md-field md-clearable :class="getValidationClass('commercialValue2')">
                    <label for="first-name">Valor Comercial</label>
                    <md-input
                      name="first-name"
                      id="first-name"
                      autocomplete="given-name"
                      v-model="form.commercialValue2"
                      :disabled="sending"
                    />
                    <span
                      class="md-error"
                      v-if="!$v.form.commercialValue2.required"
                    >Olvidaste ingresar el valor comercial</span>
                  </md-field>

                  <label>MOTIVOS DEL DECOMISO PREVENTIVO</label> 

                  <div class="md-layout">
                    <div class="md-layout-item md-size-50">
                      <label class="text-muted">Motivos del decomiso Preventivo</label>
                      <multiselect 
                        v-model="arrayReasons" 
                        :options="arrayValue" 
                        :multiple="true" 
                        :close-on-select="false" 
                        :clear-on-select="false" 
                        :preserve-search="true" 
                        placeholder="Motivos Del Decomiso Preventivo" 
                        label="name" 
                        track-by="name" 
                        :preselect-first="true">
                      </multiselect>
                    </div>
                  </div>&nbsp;&nbsp;&nbsp;
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field>
                            <label>Los recursos, productos pesqueros y/o elementos fueron decomisados cuando se encontraban en (describa la situación):</label>
                            <md-textarea v-model="text4"></md-textarea>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div> 

                  <label>Para constancia se firma la presente acta por cada uno de los que intervienen en el decomiso preventivo.</label>

                  <div class="md-layout">
                    <div class="md-layout-item md-size-40">
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
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item md-size-70">
                      <md-field md-clearable :class="getValidationClass('officialName')">
                        <label for="first-name">Nombre Funcionario AUNAP</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.officialName"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.officialName.required"
                        >Olvidaste ingresar el nombre del funcionario de la AUNAP</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('documentIdOfficial')">
                        <label for="first-name">Documento de Identidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.documentIdOfficial"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.documentIdOfficial.required"
                        >Olvidaste ingresar el documento de identidad</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item md-size-70">
                      <md-field md-clearable :class="getValidationClass('representativeName')">
                        <label for="first-name">Nombre Representante Autoridad Acompañante</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.representativeName"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.representativeName.required"
                        >Olvidaste ingresar el nombre representante autoridad acompañante</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('documentIdRepresentative')">
                        <label for="first-name">Documento de Identidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.documentIdRepresentative"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.documentIdRepresentative.required"
                        >Olvidaste ingresar el documento de identidad</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="md-layout">
                    <div class="md-layout-item md-size-40">
                      <md-field md-clearable :class="getValidationClass('plateCertificate')">
                        <label for="first-name">No. Placa o Cedula</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.plateCertificate"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.plateCertificate.required"
                        >Olvidaste ingresar la placa o cedula</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;
                  </div>
                  
                  <label>DATOS DEL PRESUNTO INFRACTOR</label>

                  <div class="md-layout">
                    <div class="md-layout-item md-size-70">
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
                        >Olvidaste ingresar el nombre del infractor</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('documentIdOffender')">
                        <label for="first-name">Documento de Identidad</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.documentIdOffender"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.documentIdOffender.required"
                        >Olvidaste ingresar el documento de identidad del infractor</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div>   
                  <div class="md-layout">
                    <div class="md-layout-item md-size-30"> 
                      <div>
                          <md-datepicker 
                          v-model="dateExpedition"
                          @input="toString"
                          md-immediately
                          :md-model-type="String"
                          >
                          <label>Fecha de expediciòn C.C.</label>
                          </md-datepicker>
                      </div>
                    </div>&nbsp;&nbsp;&nbsp;     
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('expeditionPlace')">
                        <label for="first-name">Lugar de Expedidión C.C.</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.expeditionPlace"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.expeditionPlace.required"
                        >Olvidaste ingresar el lugar de expedición del documento de identidad</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('homeAddress')">
                        <label for="first-name">Dirección de Domicilio</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.homeAddress"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.homeAddress.required"
                        >Olvidaste ingresar la dirección de domicilio</span>
                      </md-field>
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div>  
                  <div class="md-layout">
                    <div class="md-layout-item"> 
                      <md-field md-clearable :class="getValidationClass('municipalityOffender')">
                        <label for="first-name">Municipio</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.municipalityOffender"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.municipalityOffender.required"
                        >Olvidaste ingresar el nombre del municipio</span>
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
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;     
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('neighborhood')">
                        <label for="first-name">Vereda</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.neighborhood"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.neighborhood.required"
                        >Olvidaste ingresar el nombre de la vereda</span>
                      </md-field>   
                    </div>&nbsp;&nbsp;&nbsp;     
                  </div>   
                  <div class="md-layout">
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
                        >Olvidaste ingresar el número de teléfono</span>
                      </md-field>   
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('mobile')">
                        <label for="first-name">Celular</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.mobile"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.mobile.required"
                        >Olvidaste ingresar el número de celular</span>
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;    
                    <div class="md-layout-item">
                      <md-field md-clearable :class="getValidationClass('email')">
                        <label for="first-name">Correo Electrónico</label>
                        <md-input
                          name="first-name"
                          id="first-name"
                          autocomplete="given-name"
                          v-model="form.email"
                          :disabled="sending"
                        />
                        <span
                          class="md-error"
                          v-if="!$v.form.email.required"
                        >Olvidaste ingresar el correo electrónico</span>
                      </md-field>  
                    </div>&nbsp;&nbsp;&nbsp;    
                  </div> 
                  <div class="md-layout">
                    <div class="md-layout-item">
                      <md-field>
                            <label>Observaciones</label>
                            <md-textarea v-model="observation"></md-textarea>
                      </md-field>   
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
        departament: "",
        municipality: "",
        nameScientific: "",
        nameCommon: "",
        amount: "",
        average: "",
        weight: "",
        commercialValue: "",     
        element: "",
        amount2: "",
        featuresState: "",
        commercialValue2: "",   
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

        nameScientific1: "",
        nameCommon1: "",
        state1: "",
        presentation1: "",
        amount1: "",
        AverageSize: "",
        weight1: "",
        commercialValue1: "",

        element: "",
        amount2: "",
        characterState: "",
        commercialValue2: "",
      },

      text4: "",

      state: "",
      presentation: "",
      date: format(now, dateFormat),
      dateExpedition: format(now, dateFormat),
      observation: "",

      arrayReasons:[],
      arrayValue:[
                   { name: 'Sin Permiso', id: '1' },
                   { name: 'Sin patente', id: '2' },
                   { name: 'Sin salvoconducto', id: '3' },
                   { name: 'Documentos adulterados', id: '4' },
                   { name: 'Especie en época de veda', id: '5' },
                   { name: 'Especie no autorizada', id: '6' },
                   { name: 'Incumplimiento tallas mínimas', id: '7' },
                   { name: 'Artes de pesca no autorizados', id: '8' },
                   { name: 'Pesca en áreas no autorizadas', id: '9' },
                   { name: 'Pesca en áreas protegidas', id: '10' },
                   { name: 'Malas prácticas de pesca', id: '11' },
                 ],

      arrayTarget: [],
      arrayTarget2: [],
      
      arrayConfiscationCert: [],
      id_confiscationCert: 0,

      arrayRegional: {id:0, name:''},
	    arrayRegl: [],
      id_regional: 0,

      edo:1,
      tipoAccion: 1,
      listado: 1,
      sending: false,

      arrayData: [],
      tipoAccion: 0
    };
  },

  validations: {
    form: {
      
      noActa:  {
        required
      },
      departament:  {
        required
      },
      municipality:  {
        required
      },
      nameScientific:  {
        required
      },
      nameCommon:  {
        required
      },
      amount:  {
        required
      },
      average:  {
        required
      },
      weight:  {
        required
      },
      commercialValue:  {
        required
      },
      element:  {
        required
      },
      amount2:  {
        required
      },
      featuresState:  {
        required
      },
      commercialValue2:  {
        required
      },
      officialName:  {
        required
      },
      documentIdOfficial:  {
        required
      },
      representativeName:  {
        required
      },
      documentIdRepresentative:  {
        required
      },
      plateCertificate:  {
        required
      },
      name:  {
        required
      },
      documentIdOffender:  {
        required
      },
      expeditionPlace:  {
        required
      },
      homeAddress:  {
        required
      },
      municipalityOffender:  {
        required
      },
      corregimiento:  {
        required
      },
      neighborhood:  {
        required
      },
      telephone:  {
        required
      },
      mobile:  {
        required
      },
      email:  {
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
        AverageSize: {
        required
      },
        weight1: {
        required
      },
        commercialValue1: {
        required
      },

        element: {
        required
      },
        amount2: {
        required
      },
        characterState: {
        required
      },
        commercialValue2: {
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
      let me = this;
      var total1 = me.arrayTarget.push({
        nameScientific1:this.form.nameScientific1.toUpperCase(),
        nameCommon1:this.form.nameCommon1.toUpperCase(),
        state1:this.form.state1.toUpperCase(),
        presentation1:this.form.presentation1.toUpperCase(),
        amount1:this.form.amount1,
        AverageSize:this.form.AverageSize,
        weight1:this.form.weight1,
        commercialValue1:this.form.commercialValue1,
      });
      console.log("arrayTarget " + total1);
      me.clearTarget();  
    },
    addItemTarget2() {
      let me = this;
      var total1 = me.arrayTarget2.push({
        element:this.form.element.toUpperCase(),
        amount2:this.form.amount2.toUpperCase(),
        characterState: this.form.characterState.toUpperCase(),
        commercialValue2: this.form.commercialValue2.toUpperCase(),
        
      });
      console.log("arrayTarget " + total1);
      me.clearTarget();  
    },
    deleteTarget(index){
       this.arrayTarget.splice(index,1);
    },
    deleteTarget2(index){
       this.arrayTarget2.splice(index,1);
    },
    clearTarget() {
      this.form.nameScientific1 = null;
      this.form.nameCommon1 = null;
      this.form.state1 = null;
      this.form.presentation1 = null;
      this.form.amount1 = null;
      this.form.AverageSize = null;
      this.form.weight1 = null;
      this.form.commercialValue1 = null;
    },
    clearTarget2() {
      this.form.element = null;
      this.form.amount2 = null;
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
      this.form.nameScientific = null;
      this.form.nameCommon = null;
      this.form.amount = null;
      this.form.average = null;
      this.form.weight = null;
      this.form.commercialValue = null;
      this.form.element = null;
      this.form.amount2 = null;
      this.form.featuresState = null;
      this.form.commercialValue2 = null;
      this.text4 = null;
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
      this.state = null;
      this.presentation = null;
      this.date = null;
      this.dateExpedition = null;
      this.observation = null;
      
      this.arrayRegl = {id:0, name:''};
    },

    showUpdate(data = []) {
      let me = this;
      (this.tipoAccion = 2), (me.listado = 0);
      (this.id_confiscationCert = data["id"]);
      this.form.noActa = data["noActa"];
      this.form.departament = data["departament"];
      this.form.municipality = data["municipality"];
      this.form.nameScientific = data["nameScientific"];
      this.form.nameCommon = data["nameCommon"];
      this.form.amount = data["amount"];
      this.form.average = data["average"];
      this.form.weight = data["weight"];
      this.form.commercialValue = data["commercialValue"];
      this.form.element = data["element"];
      this.form.amount2 = data["amount2"];
      this.form.featuresState = data["featuresState"];
      this.form.commercialValue2 = data["commercialValue2"];
      this.text4 = data["text4"];
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
      this.state = data["state"];
      this.presentation = data["presentation"];
      this.date = data["date"];
      this.dateExpedition = data["dateExpedition"];
      this.observation = data["observation"];
      
      this.arrayRegl.id = data["id_regional"];
			this.arrayRegl.name = data["nameRegional"];
    },
    nameWithRegional ({ name }) {
            return `${name}`
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
        "/confiscationCertificates";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayConfiscationCert = respuesta.confiscation.data;
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
                    me.arrayRegional= respuesta.regional;
                }).catch(function (error) {
                    console.log(error);
            });
    }, 
    saveData() {
      let me = this;

      axios
        .post("/confiscationCertificates/save", {
    
      noActa : this.form.noActa.toUpperCase(),
      departament : this.form.departament.toUpperCase(),
      municipality : this.form.municipality.toUpperCase(),
      nameScientific : this.form.nameScientific.toUpperCase(),
      nameCommon : this.form.nameCommon.toUpperCase(),
      amount : this.form.amount.toUpperCase(),
      average : this.form.average.toUpperCase(),
      weight : this.form.weight.toUpperCase(),
      commercialValue : this.form.commercialValue.toUpperCase(),
      element : this.form.element.toUpperCase(),
      amount2 : this.form.amount2.toUpperCase(),
      featuresState : this.form.featuresState.toUpperCase(),
      commercialValue2 : this.form.commercialValue2.toUpperCase(),
      text4 : this.text4.toUpperCase(),
      officialName : this.form.officialName.toUpperCase(),
      documentIdOfficial : this.form.documentIdOfficial.toUpperCase(),
      representativeName : this.form.representativeName.toUpperCase(),
      documentIdRepresentative : this.form.documentIdRepresentative.toUpperCase(),
      plateCertificate : this.form.plateCertificate.toUpperCase(),
      name : this.form.name.toUpperCase(),
      documentIdOffender : this.form.documentIdOffender.toUpperCase(),
      expeditionPlace : this.form.expeditionPlace.toUpperCase(),
      homeAddress : this.form.homeAddress.toUpperCase(),
      municipalityOffender : this.form.municipalityOffender.toUpperCase(),
      corregimiento : this.form.corregimiento.toUpperCase(),
      neighborhood : this.form.neighborhood.toUpperCase(),
      telephone : this.form.telephone,
      mobile : this.form.mobile,
      email : this.form.email,
      state : this.state.toUpperCase(),
      presentation : this.presentation.toUpperCase(),
      date : this.date,
      dateExpedition : this.dateExpedition,
      observation : this.observation.toUpperCase(),

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
        .put("/confiscationCertificates/update", {
          
      id: this.id_confiscationCert,
      noActa : this.form.noActa.toUpperCase(),
      departament : this.form.departament.toUpperCase(),
      municipality : this.form.municipality.toUpperCase(),
      nameScientific : this.form.nameScientific.toUpperCase(),
      nameCommon : this.form.nameCommon.toUpperCase(),
      amount : this.form.amount.toUpperCase(),
      average : this.form.average.toUpperCase(),
      weight : this.form.weight.toUpperCase(),
      commercialValue : this.form.commercialValue.toUpperCase(),
      element : this.form.element.toUpperCase(),
      amount2 : this.form.amount2.toUpperCase(),
      featuresState : this.form.featuresState.toUpperCase(),
      commercialValue2 : this.form.commercialValue2.toUpperCase(),
      text4 : this.text4.toUpperCase(),
      officialName : this.form.officialName.toUpperCase(),
      documentIdOfficial : this.form.documentIdOfficial.toUpperCase(),
      representativeName : this.form.representativeName.toUpperCase(),
      documentIdRepresentative : this.form.documentIdRepresentative.toUpperCase(),
      plateCertificate : this.form.plateCertificate.toUpperCase(),
      name : this.form.name.toUpperCase(),
      documentIdOffender : this.form.documentIdOffender.toUpperCase(),
      expeditionPlace : this.form.expeditionPlace.toUpperCase(),
      homeAddress : this.form.homeAddress.toUpperCase(),
      municipalityOffender : this.form.municipalityOffender.toUpperCase(),
      corregimiento : this.form.corregimiento.toUpperCase(),
      neighborhood : this.form.neighborhood.toUpperCase(),
      telephone : this.form.telephone,
      mobile : this.form.mobile,
      email : this.form.email,
      state : this.state.toUpperCase(),
      presentation : this.presentation.toUpperCase(),
      date : this.date,
      dateExpedition : this.dateExpedition,
      observation : this.observation.toUpperCase(),

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
    createPdf (data = []) {
      let me = this;
      var columns = []; var rows = [];
      var columns1 = []; var rows1 = [];
      var columns2 = []; var rows2 = [];
      let info = [];
      me.arrayTarget.array.forEach((element) => {
        info.push([element.nameScientific, element.nameCommon, element.state])     
      });
      var doc = new jsPDF('p','mm','letter');
        (this.id_donationCertificate = data["id"]);
        console.log("ID " + me.datos.id);
        var logo = new Image();
        logo.src = '/img/logoAUNAP.png';
        doc.addImage(logo, 'png', 20, 10, 33, 15);
          doc.text("FORMATO ACTA DE DECOMISO PREVENTIVO", 55, 20);
          // doc.text(`FORMATO ACTA DE DONACIÓN ${variable} , otro texto si necesita mas variables ${otra}`, 65, 60);
          doc.setFont("arial");
          // doc.setFont("arial", "bold");
          doc.setFontSize(12);
          doc.text("No. Acta: " + me.datos.noActa, 15, 35 );
          doc.setFontSize(10);
          doc.text("Regional: " + me.datos.noActa, 15, 45 );
          doc.setFontSize(10);
          doc.text("Departamento: " + me.datos.noActa, 75, 45 );
          doc.setFontSize(10);
          doc.text("Municipio: " + me.datos.noActa, 140, 45 );
          doc.setFontSize(10);
          doc.text(`El suscrito servidor público de la AUNAP ___________________________________________, de la oficina
_____________________________, el día _________, del mes de ______________ de 202 __, procedió a efectuar el decomiso 
preventivo de los siguientes recursos y/o productos pesqueros:
`, 16, 55 );
          doc.setDrawColor(0,0,0);
          doc.rect(15, 50, 186, 15);
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
                {"nomCientifico": me.datos.nameScientific,
                 "nomComun": me.datos.nameCommon,
                 "estado": me.datos.state
                },
                // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional}, 
              ]; 
              columns1 = [    
                { title: "Elemento", dataKey: "elemento" },
                { title: "Cantidad (UN)", dataKey: "cantidad" },
                { title: "Características y estado", dataKey: "caractEstado" },
                { title: "Valor Comercial", dataKey: "valorC" },                
              ];
              rows1 = [
                {"elemento": me.datos.nameScientific,
                 "cantidad": me.datos.nameCommon,
                 "caractEstado": me.datos.state,
                 "valorC": me.datos.state,
                },
                // {"nombre": "Nombre del proyecto", "descripcion": element.nameRegional}, 
              ]; 
              columns2 = [    
                { title: "MOTIVOS DEL DECOMISO PREVENTIVO", dataKey: "motivos" },              
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
actividad de extracción o comercialización de recursos y/o productos pesqueros:`, 15, 155 );
          doc.setFontSize(10);
          doc.text(`ELEMENTO: Embarcación, motor, arte de pesca, otro. En caso de artes, especificar tipo (atarraya, chinchorro,
liso, palangre, otro).`, 15, 180 );

          doc.autoTable({
            margin: { top: 72 },
            head:[['Nombre científico','Nombre Común','Estado','Presentación','Cantidad (UN)','Peso (KG)','Valor Comercial']],
            body:this.info
          });
 
          // doc.autoTable(columns, rows, {
          //   // theme: 'grid',
          //         margin: { top: 72 },
          //         didDrawPage: function () {
          //         },
          // });     
          
          // doc.autoTable(columns1, rows1, {
          //         margin: { top: 120 },
          //         didDrawPage: function () {
                    
          //         },
          // });     

          // doc.autoTable(columns2, rows2, {
          //         margin: { top: 140 },
          //         didDrawPage: function () {          
          //         },
          // });     
        doc.addPage(); 
            
      //  doc.save("FORMATO ACTA DE DONACIÓN");
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
            { "data": "noActa" },
            { "data": "nameRegional" },
            { "data": "departament" },
            { "data": "municipality" },
            { "data": "nameScientific" },
            { "data": "nameCommon" },
            { "data": "amount" },
            { "data": "average" },
            { "data": "weight" },
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
                me.createPdf();    
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
.material-icons.Color1 { color: rgb(31, 33, 34); }
.material-icons.Color2 { color: rgba(167, 142, 5, 0.849); }
.material-icons.Color3 { color: rgb(12, 170, 91); }
.material-icons.Color4 { color: rgba(228, 54, 54, 0.863); }
</style>
