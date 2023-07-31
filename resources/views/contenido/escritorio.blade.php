<div class="container-fluid" id="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h3>Formularios de Inspecciones a Embarcaciones</h3><br><br>
                <p> De acuerdo al Artículo 16, del Decreto 4181 de 2011,
                    es función de la Dirección Técnica de Inspección y Vigilancia, ejercer el control y
                    la vigilancia de la actividad pesquera y acuicola, en coordinación con las demas autoridades
                    públicas.
                </p>
            </div>
        </div>
        <!-- Slider -->
        <div class="top-content">
            <div class="container-fluid">
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center active">
                            <img src="{{ asset('assets/img/iconos/zarpe.png') }}" class="img-fluid mx-auto d-block"
                                style="width: 100px;" alt="img1"><br>
                            <h6>Inspección Embarcación Pesquera Zarpe</h6>
                            <hr>
                            <small>FT-IV-024 | V3 | 1-5-2019</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=7">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/arribo.png') }}" class="img-fluid mx-auto d-block"
                                style="width: 100px;" alt="img2"><br>
                            <h6>Inspección Embarcación Pesquera Arribo</h6>
                            <hr>
                            <small>FT-IV-018 | V3 | 1-5-2019</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=8">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/verificacion.png') }}"
                                class="img-fluid mx-auto d-block" style="width: 100px;" alt="img3"><br>
                            <h6>Verificación Dets 71 Pulgadas</h6>
                            <hr>
                            <small>FT-IV-014 | V1 | 1-5-2019</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=9">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/doble-solapa.png') }}"
                                class="img-fluid mx-auto d-block" style="width: 100px;" alt="img4"><br>
                            <h6>Verificación Dets Doble Solapa</h6>
                            <hr>
                            <small>FT-IV-015 | V2 | 1-5-2019</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=10">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/equipo-pesca.png') }}"
                                class="img-fluid mx-auto d-block" style="width: 100px;" alt="img5"><br>
                            <h6>Verificación Equipo Rescate</h6>
                            <hr>
                            <small>FT-IV-019 | V1 | 26-2-2019</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=11">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/donacion.png') }}" class="img-fluid mx-auto d-block"
                                style="width: 100px;" alt="img6"><br>
                            <h6>Formato Acta de Donación</h6>
                            <hr>
                            <small>FT-IV-002 | V3 | 8-7-2022</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=14">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/preventivo.png') }}" class="img-fluid mx-auto d-block"
                                style="width: 100px;" alt="img7"><br>
                            <h6>Acta de Decomiso Preventivo</h6>
                            <hr>
                            <small>FT-IV-004 | V3 | 8-7-2022</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=15">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/carga.png') }}" class="img-fluid mx-auto d-block"
                                style="width: 100px;" alt="img8"><br>
                            <h6>Formato Embarcación Carga</h6>
                            <hr>
                            <small>FT-IV-004 | V3 | 8-7-2022</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=16">Generar</button>
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                            <img src="{{ asset('assets/img/iconos/certificacion-atun.png') }}"
                                class="img-fluid mx-auto d-block" style="width: 100px;" alt="img9"><br>
                            <h6>Certificación Desembarque Atún</h6>
                            <hr>
                            <small>FT-IV-023 | V4 | 9-7-2022</small><br><br>
                            <button type="button" class="btn btn-sm btn-white" @click="menu=17">Generar</button>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev"
                        style="margin-left: -45px">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="color: #333"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next"
                        style="margin-left: -68px">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="color: #333"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>


<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#1a74bc" fill-opacity="1"
        d="M0,256L40,250.7C80,245,160,235,240,197.3C320,160,400,96,480,96C560,96,640,160,720,197.3C800,235,880,245,960,213.3C1040,181,1120,107,1200,69.3C1280,32,1360,32,1400,32L1440,32L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z">
    </path>
</svg>


@if (auth()->user()->idrol == 1)
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <hr>
            <span style="color: #ddd; display:inline-block">-----------</span>
            <h5 style="display:inline-block">O también puedes llevar a cabo el proceso de administración en el sistema
            </h5>
            <span style="color: #ddd; display:inline-block">-----------</span>
        </div>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-md-3">
            <div class="card text-center" @click="menu=21">
                <img src="{{ asset('assets/img/iconos/usuarios.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Usuarios</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=12">
                <img src="{{ asset('assets/img/iconos/nacionalidades.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Nacionalidades</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=3">
                <img src="{{ asset('assets/img/iconos/puertos.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Puertos</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=6">
                <img src="{{ asset('assets/img/iconos/muelles.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Muelles</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=13">
                <img src="{{ asset('assets/img/iconos/empresas.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Empresas</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=5">
                <img src="{{ asset('assets/img/iconos/banderas.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Banderas</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=1">
                <img src="{{ asset('assets/img/iconos/regiones.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Regiones</b>
            </div>
        </div>

        <div class="col-md-3" @click="menu=2">
            <div class="card text-center">
                <img src="{{ asset('assets/img/iconos/municipios.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Municipios</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=4">
                <img src="{{ asset('assets/img/iconos/zonas-autorizadas.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Zonas Autorizadas</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=18">
                <img src="{{ asset('assets/img/iconos/material-pesca.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Material de Pesca</b>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center" @click="menu=20">
                <img src="{{ asset('assets/img/iconos/embarcaciones.png') }}" class="img fluid circle rounded"
                    style="width: 50px; height: auto; margin: 0 auto"><br>
                <b>Embarcaciones</b>
            </div>
        </div>
    </div>
@endif
