
<div class="sidebar">
<div class="page-wrapper legacy-theme toggled">

<!-- <a id="toggle-sidebar" class="btn btn-sm btn-dark " href="#">
    <i class="icon-menu"></i>
</a> -->
<nav id="sidebar" class="sidebar-wrapper sidebar-nav">

    <div class="sidebar-content ">
        <div class="sidebar-brand">


            <h5>Software Inspecciones</h5>
          <!-- <span class="navbar-toggler-icon"></span> -->
        </button>
        </div>
    <div class="sidebar-header">
        <div class="user-pic">
            <img class="img-avatar img-responsive img-rounded" src="img/avatars/6.png"
            alt="User picture">
        </div>
        <div class="user-info">
            <span class="user-name">
            <strong>{{Auth::user()->usuario}}</strong>
            </span>
            <span class="user-role">Administrator</span>
            <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
            </span>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-dropdown ">
                <ul>
                    <li class="header-menu">
                        <span>TABLAS MAESTRAS</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span class="menu-text">General</span>                         
                        </a>
                        <div class="sidebar-submenu">
                        <ul>      
                                                      
                            <li @click="menu=1"  >
                                <a href="#"><i class="icon-bag"></i>Región</a>                                                                               
                            </li>
                            <li @click="menu=2">
                                <a href="#"><i class="icon-bag"></i>Municipio</a>                                                                               
                            </li>                                
                            <li @click="menu=3">
                                <a href="#"><i class="icon-bag"></i>Puertos</a>                                                                               
                            </li>                                
                            <li @click="menu=4">
                                <a href="#"><i class="icon-bag"></i>Zonas Autorizadas</a>                                                                               
                            </li>                                
                            <li @click="menu=5">
                                <a href="#"><i class="icon-bag"></i>Banderas</a>                                                                               
                            </li>                                
                            <li @click="menu=6">
                                <a href="#"><i class="icon-bag"></i>Muelles</a>                                                                               
                            </li>                                
                            <li @click="menu=7">
                                <a href="#"><i class="icon-bag"></i>Inspección a Embarcación Pesquera - Zarpe</a>                                                                               
                            </li>                                
                            <li @click="menu=8">
                                <a href="#"><i class="icon-bag"></i>Inspección a Embarcación Pesquera - Arribo</a>                                                                               
                            </li>                                
                            <li @click="menu=9">
                                <a href="#"><i class="icon-bag"></i>Verificación DETs 71 Pulgadas</a>                                                                               
                            </li>                                
                            <li @click="menu=10">
                                <a href="#"><i class="icon-bag"></i>Verificación DET Doble Solapa</a>                                                                               
                            </li>                                
                            <li @click="menu=11">
                                <a href="#"><i class="icon-bag"></i>Verificación Presencia del Equipo de Rescate de Delfines Abordo de BarcosAtuneros de Cerco</a>                                                                               
                            </li>                                
                            <li @click="menu=12">
                                <a href="#"><i class="icon-bag"></i>Países</a>                                                                               
                            </li>                                
                            <li @click="menu=13">
                                <a href="#"><i class="icon-bag"></i>Empresas</a>                                                                               
                            </li>                                
                            <li @click="menu=14">
                                <a href="#"><i class="icon-bag"></i>Acta de Donación</a>                                                                               
                            </li>                                
                            <li @click="menu=15">
                                <a href="#"><i class="icon-bag"></i>Acta de Decomiso Preventivo</a>                                                                               
                            </li>                                
                            <li @click="menu=16">
                                <a href="#"><i class="icon-bag"></i>Formato Inspección Embarcación de Carga</a>                                                                               
                            </li>                                
                        </ul>                            
                        </div>                        
                    </li>
                    <!-- <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-clipboard"></i>
                            <span class="menu-text">Otro Menu</span>                         
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                          
    
                       
                            <li @click="menu=0" >
                                <a  href="#"><i class="icon-bag"></i>Opcion1</a>
                            </li>
                       
                            </ul>                            
                        </div>                        
                    </li> -->
                    <!-- <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="menu-text">Otro Menu</span>                         
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                               
                                <li @click="menu=0" >
                                    <a  href="#"><i class="icon-user-following"></i>Opcion1 </a>
                                </li> 
                            </ul>                            
                        </div>                        
                    </li>
                    <li class="header-menu">
                        <span>OTRO GRUPO</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="far fa-newspaper"></i>
                            <span class="menu-text">Otro Menu</span>
                        </a>                                        
                        <div class="sidebar-submenu">
                            <ul>

                                <li @click="menu=0" >
                                    <a  href="#"><i class="fas fa-laptop"></i>Opcion1</a>
                                </li>
            
                            </ul>
                        </div>
                    </li>
    -->
       
                    </li>
               
                
                </ul>
            </div>
    </div>

</nav>

 <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
</div>

