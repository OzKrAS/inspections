<style>
    .text-capitalize {
        text-transform: capitalize !important;
    }
</style>

<div class="sidebar">
    <div class="page-wrapper legacy-theme toggled">

        <!-- <a id="toggle-sidebar" class="btn btn-sm btn-dark " href="#">
    <i class="icon-menu"></i>
</a> -->
        <nav id="sidebar" class="sidebar-wrapper sidebar-nav">
            <div class="sidebar-content ">
                <div class="sidebar-brand">
                    <span>Software Inspecciones</span>
                </div>
                <div class="sidebar-header text-center">
                    <img class="img-avatar img-responsive img-rounded" style="width: 100px;" src="img/avatars/6.png" alt="User picture">
                    {{-- <img class="img-avatar img-responsive img-rounded" style="width: 100px;" src="img/avatars/6.png" alt="User picture"> --}}
                    <div class="user-info">
                        <span class="user-name">
                            <strong>{{ Auth::user()->usuario }}</strong>
                        </span>
                        <span class="user-role">Usuario</span>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="sidebar-dropdown ">
                            <ul>
                                <li class="header-menu">
                                    <span>TABLAS MAESTRAS</span>
                                </li>
                                <li>
                                    <a href="#" @click="menu=0">
                                        <i class="fas fa-th"></i>
                                        <span class="menu-text">Escritorio</span>
                                    </a>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fas fa-cog"></i>
                                        <span class="menu-text">General</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li @click="menu=7">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-024 V3 INSPECCIÓN A
                                                    EMBARCACIÓN PESQUERA - ZARPE</a>
                                            </li>
                                            <li @click="menu=8">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-018 V3-INSPECCIÓN A
                                                    EMBARCACIÓN PESQUERA - ARRIBO</a>
                                            </li>
                                            <li @click="menu=9">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-014-FORMATO VERIFICACIÓN
                                                    DETs 71 PULGADAS</a>
                                            </li>
                                            <li @click="menu=10">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-015 V2-FORMATO
                                                    VERIFICACIÓN DETs DOBLE SOLAPA.</a>
                                            </li>
                                            <li @click="menu=11">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-019-VERIFICACIÓN
                                                    PRESENCIA DEL EQUIPO DE RESCATE DE DELFINES A BORDO DE BARCOS
                                                    ATUNEROS DE CERCO</a>
                                            </li>
                                            <li @click="menu=14">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-002 V3-FORMATO ACTA DE
                                                    DONACIÓN</a>
                                            </li>
                                            <li @click="menu=15">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-004 V3-FORMATO ACTA DE
                                                    DECOMISO PREVENTIVO</a>
                                            </li>
                                            <li @click="menu=16">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-023-FORMATO INSPECCIÓN
                                                    EMBARCACIÓN DE CARGA</a>
                                            </li>
                                            <li @click="menu=17">
                                                <a href="#"><i class="icon-bag"></i>FT-IV-020-FORMATO
                                                    CERTIFICACIÓN DESEMBARQUE DE ATÚN PARA EXPORTACIÓN - ANEXO IV</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                        </li>
                    </ul>
                    <br><br><br>
                </div>
        <br><br><br>

            </div>

        </nav>

        <button class="sidebar-minimizer brand-minimizer" type="button"></button>

    </div>
</div>
