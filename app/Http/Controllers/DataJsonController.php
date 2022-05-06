<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AutoFisher;
use App\Arrival;
use App\CertificationDisembTuna;
use App\CheckDetFlap;
use App\CheckDetInch;
use App\Company;
use App\ConfiscationCertificate;
use App\DonationCertificate;
use App\FisheryAuthorized;
use App\Flag;
use App\Nationality;
use App\Orop;
use App\Ports;
use App\PresenVerific;
use App\Region;
use App\Regional;
use App\Zarpe;

class DataJsonController extends Controller
{
    public function jsonZarpe(){
        $flags = Flag::all();
        $ports = Ports::all();
        $regions = Region::all();
        $orops = Orop::all();
        $company = Company::all();
        $fishery = FisheryAuthorized::all();
        $autoFisher = AutoFisher::all();
        $nationality = Nationality::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>2,
                        "title"=>"INSPECCIÓN No",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"insNo",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateIns",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGION/MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReg",
                        "data"=>$regions
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO/MUELLE DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "data"=>$ports
                    ],
                    [
                        "type"=> 3,
                        "title"=> "SE RECIBIÓ NOTIFICACIÓN PREVIA",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "data"=>null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "FINALIDAD ZARPE",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"finalityZarpe",
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "PUERTO, ESTADO RECTOR DE PUERTO",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=> null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "ORIGEN",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"origin",
                        "data"=>null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "DESTINO",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"destination",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMA ESCALA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateScale",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtArrival",
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateLatestArrival",
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=> null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "SISTEMA NACIONAL",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"national",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"OROP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayOr",
                        "data"=>$orops
                    ],
                    [
                        "type"=>1,
                        "title"=>"SEÑAL RADIOLLAMADA INTERNACIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"radioCall",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"IDENTIFICADOR OMI",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"idOmi",
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "PERMISO OTORGADO - ÚLTIMA PRORROGA",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=> null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noResolution",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateResolution",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValid",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "data"=>$flags
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPatent",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FECHA VIGENCIA PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidityPat",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representative",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$company
                    ],
                    [
                        "type"=>8,
                        "title"=>"PESQUERÍA Y ARTES AUTORIZADOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"PESQUERÍA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFa",
                        "data"=>$fishery
                    ],
                    [
                        "type"=>3,
                        "title"=>"ZONA DE PESCA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayZoneAuto",
                        "data"=>$autoFisher
                    ],
                    [
                        "type"=>8,
                        "title"=>"CARACTERISTICAS ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeMesh",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ANCHO DE RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"netWidth",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA DEL COPO (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeFlake",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"TAMAÑO No. Y TIPO DE ANZUELO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"typeHook",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LONGITUD DE LA RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"longNet",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATERIAL DE ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"materialArt",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EQUIPOS O DISPOSITIVOS REQUERIDOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"equipDevi",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"captain",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NACIONALIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayNation",
                        "data"=>$nationality
                    ],
                    [
                        "type"=>8,
                        "title"=>"LOS DATOS RELACIONADOS CON LAS MEDIDAS DE ORDENAMIENTO APLICABLES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES AL CUMPLIMIENTO DE MEDIDAS DE MANEJO APLICABLES A LA PESQUERIA (NACIONAL-OROP's)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"CONCLUSIONES DEL INSPECTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"conclusions",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"COMENTARIOS ADICIONALES (ESPACIO DISPONIBLE PARA EL CAPITAN)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"comments",
                        "data"=>null
                    ],

                )
                ]
            ),200
        );
    }
    public function jsonArrival(){
        $flags = Flag::all();
        $ports = Ports::all();
        $regions = Region::all();
        $company = Company::all();
        $fishery = FisheryAuthorized::all();
        $autoFisher = AutoFisher::all();
        $nationality = Nationality::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>2,
                        "title"=>"INSPECCIÓN No",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"insNo",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGION/MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReg",
                        "data"=>$regions
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO/MUELLE DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateIns",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"RECIBIÓ NOTIFICACIÓN PREVIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"FINALIDAD DE ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"finalityArrival",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ESTADO RECTOR DE PUERTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"stateRectorPort",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"ORIGEN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"origin",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"DESTINO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"destination",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMA ESCALA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateScale",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtArrival",
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ULTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateLatestArrival",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"FAENA REALIZADA EN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"workDone",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"locationSystem",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"SEÑAL RADIOLLAMADA INTERNACIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"radioCall",
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"PERMISO OTORGADO - ÚLTIMAPRORROGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],       
                    [
                        "type"=>2,
                        "title"=>"No. DE RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noResolution",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidity",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "data"=>$flags
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No.  OMI",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noOmi",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. DE PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPatent",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidityPat",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"legalRepre",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$company
                    ],
                    [
                        "type"=>8,
                        "title"=>"PESQUERÍA Y ARTES AUTORIZADOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],  
                    [
                        "type"=>10,
                        "title"=>"PESQUERÍA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFa",
                        "data"=>$fishery
                    ],
                    [
                        "type"=>3,
                        "title"=>"ZONA DE PESCA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayZoneAuto",
                        "data"=>$autoFisher
                    ],
                    [
                        "type"=>8,
                        "title"=>"",
                        "value"=>"CARACTERÍSTICAS ARTE DE PESCA",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeMesh",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ANCHO DE RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"netWidth",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA DEL COPO (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeFlake",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"TAMAÑO No. Y TIPO DE ANZUELO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"typeHook",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LONGITUD DE LA RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"longNet",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATERIAL DE ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"materialArt",
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"EQUIPOS O DISPOSITIVOS REQUERIDOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"equipDevi",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"captain",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NACIONALIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayNation",
                        "data"=>$nationality
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noAllCrew",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES EXTRANJEROS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noCrewForeign",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES NACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noCrewNational",
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"LOS DATOS RELACIONADOS CON LA FAENA Y CAPTURA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. DÍAS DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDays",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE LANCES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noAllHauls",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. LANCES NACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noHaulsNacional",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. LANCES INTERNACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noHaulsInter",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES AL CUMPLIMIENTO DE MEDIDAS DE MANEJO APLICABLES A LA PESQUERÍA (NACIONAL-OROP's)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"PESO DESEMBARCADO COMPROBADO (INGRESO PLANTA PROCESO)(TON)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"landedWeight",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"CONCLUSIONES DEL INSPECTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"inspectorConclusions",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"COMENTARIOS ADICIONALES (ESPACIO DISPONIBLE PARA EL CAPITAN)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"additionalComments",
                        "data"=>null
                    ],
                    
                )
                ]
            ),200
        );
    }
    public function jsonDetFlap(){
        $regional = Regional::all();
        $company = Company::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"OFICINA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"office",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"official",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"boat",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PESQUERÍA AUTORIADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"outhFhisher",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PATENTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishLicense",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$company
                    ],
                    [
                        "type"=>1,
                        "title"=>"ARMADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"owner",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CAPITÁN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishCaptain",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LOCALIZACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"location",
                        "data"=>null
                    ],

                )
                ]
            ),200
        );
     
    }
    public function jsonDetInch(){
        $regional = Regional::all();
        $company = Company::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"OFICINA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"office",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"official",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"boat",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PESQUERÍA AUTORIADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"outhFhisher",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PATENTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishLicense",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$company
                    ],
                    [
                        "type"=>1,
                        "title"=>"ARMADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"owner",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CAPITÁN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishCaptain",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LOCALIZACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"location",
                        "data"=>null
                    ],

                )
                ]
            ),200
        );
     
    }
    public function jsonTableDetFlap(){
        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>1,
                        "title"=>"BABOR 1",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"BABOR 2",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ESTRIBOR 1",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ESTRIBOR 2",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "data"=>null
                    ],
                )
                ]
            ),200
        );
    }
    public function jsonPresenVerific(){
        $flags = Flag::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE DEL BARCO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameShip",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "data"=>$flags
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. CRUCERO/RSA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"cruise",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE PESCADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameFish",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateDesemb",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameCaptain",
                        "data"=>null
                    ],
                   
                )
                ]
            ),200
        );
    }
    public function jsonConfiscation(){
        $regional = Regional::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>2,
                        "title"=>"No. ACTA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noActa",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"DEPARTAMENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"departament",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipality",
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"MOTIVOS DEL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"MOTIVOS DEL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReasons",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"LOS RECURSOS, PRODUCTOS PESQUEROS Y/O ELEMENTOS FUERON DECOMISADOS CUANDO SE ENCONTRABAN EN (DESCRIBA LA SITUACIÓN):",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"text4",
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"PARA CONSTANCIA SE FIRMA LA PRESENTE ACTA POR CADA UNO DE LOS QUE INTERVIENEN EN EL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO AUNAP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"officialName",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdOfficial",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representativeName",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdRepresentative",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PLACA O CEDULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"plateCertificate",
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"DATOS DEL PRESUNTO INFRACTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"name",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdOffender",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE EXPEDICIÓN DE LA C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateExpedition",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LUGAR DE EXPEDICIÓN DE LA C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"expeditionPlace",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"DIRECCIÓN DE DOMICILIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"homeAddress",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipalityOffender",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREGIMIENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"corregimiento",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"VEREDA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"neighborhood",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TELÉFONO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"telephone",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"CELULAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"mobile",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREO ELECTRONICO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"email",
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "data"=>null
                    ],
                )
                ]
            ),200
        );
    }
    public function jsonDonation(){
        $regional = Regional::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>2,
                        "title"=>"No. ACTA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noActa",
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "data"=>$regional
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO AUNAP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDocumentId1",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameRepresentative",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDocumentId2",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PLACA O CÉDULA MILITAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPlateCertificate",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"name",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PERSONERÍA JURÍDICA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"legalStatus",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"DIRECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"address",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representativeDonation",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"identification",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipality",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREGIMIENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"corregimiento",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"VEREDA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"place",
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TELEFONO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"telephone",
                        "data"=>null
                    ],
                )
                ]
            ),200
        );
    }
    public function jsonInspectionBoatCargo(){
        
        $ports = Ports::all();
        $flags = Flag::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>2,
                        "title"=>"No. FORMULARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noForm",
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LUGAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"place",
                        "data"=>null
                    ],      
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"EMPRESA COLOMBIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"businessColombia",
                        "data"=>null
                    ],      
                    [
                        "type"=>2,
                        "title"=>"TOTAL CARGA (TON.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fullCargo",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN DE CRAGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoatCargo",
                        "data"=>null
                    ],      
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE TRANSBORDO DE LA CARGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "data"=>$ports
                    ],      
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "data"=>$flags
                    ],      
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "data"=>$ports
                    ],      
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtDisemb",
                        "data"=>$ports
                    ],      
                    [
                        "type"=>3,
                        "title"=>"ÁREA DE OPERACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"areaOperation",
                        "data"=>null
                    ],      
                    [
                        "type"=>3,
                        "title"=>"NOTIFICACIÓN PREVIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "data"=>null
                    ],      
                    [
                        "type"=>8,
                        "title"=>"INFORMACIÓN DE TRANSBORDO SOBRE EMBARCACIONES DONANTES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "data"=>null
                    ],      
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "data"=>$flags
                    ],      
                    [
                        "type"=>2,
                        "title"=>"No. IDENTIFICADOR (OMI)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noIdOmi",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"LUGAR DE TRANSBORDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"placeTransfer",
                        "data"=>null
                    ],      
                    [
                        "type"=>4,
                        "title"=>"FECHA DE TRANSBORDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateTransfer",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"ÁREAS DE CAPTURA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"areasCapture",
                        "data"=>null
                    ],      
                    [
                        "type"=>8,
                        "title"=>"PRODUCTO POR ESPECIE (TON.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"ESPECIE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"species",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"FORMATO DEL PODUCTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"shapeProduct",
                        "data"=>null
                    ],      
                    [
                        "type"=>2,
                        "title"=>"CANTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"amount",
                        "data"=>null
                    ],      
                    [
                        "type"=>2,
                        "title"=>"TOTAL PRODUCTO DESEMBARCADO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"productLanded",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITÁN BARCO CARGUERO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameCaptain",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMPRESA RESPONSABLE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBusiness",
                        "data"=>null
                    ],      
                    [
                        "type"=>11,
                        "title"=>"observaciones",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "data"=>null
                    ],      
                )
                ]
            ),200
        );
    }
    public function jsonCertificationDisembTuna(){
        $flags = Flag::all();
        $company = Company::all();
        $ports = Ports::all();

        return response() -> json(
            array(
                ["idForm"=>1,
            "questions"=>
                array(                                      
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "data"=>null
                    ],         
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$company
                    ],         
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "data"=>null
                    ],   
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "data"=>$flags
                    ],  
                    [
                        "type"=>8,
                        "title"=>"CERTIFICA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA INICIO DE FAENA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateBeginningFaena",
                        "data"=>null
                    ],      
                    [
                        "type"=>4,
                        "title"=>"FECHA FIN DE FAENA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateEndFaena",
                        "data"=>null
                    ],      
                    [
                        "type"=>1,
                        "title"=>"ZONA DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"ZoneFisher",
                        "data"=>null
                    ],      
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "data"=>$ports
                    ],      
                    [
                        "type"=>2,
                        "title"=>"ALETA AMARILLA - YFT (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"yellowFin",
                        "data"=>null
                    ],      
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS ALETA AMARILLA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating1",
                        "data"=>null
                    ],      
                    [
                        "type"=>2,
                        "title"=>"BARRILETE -SKJ (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"barrilete",
                        "data"=>null
                    ], 
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS BARRILETE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating2",
                        "data"=>null
                    ],     
                    [
                        "type"=>2,
                        "title"=>"PATUDO -BET (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"patudo",
                        "data"=>null
                    ],     
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS PATUDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating3",
                        "data"=>null
                    ],     
                    [
                        "type"=>1,
                        "title"=>"OTRO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"other",
                        "data"=>null
                    ],     
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS OTRO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating4",
                        "data"=>null
                    ],     
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "data"=>null
                    ],     
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "data"=>null
                    ],     
                )
                ]
            ),200
        );
    }
    
}
