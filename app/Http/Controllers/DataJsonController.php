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

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>2,
                        "title"=>"INSPECCIÓN No",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"insNo",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateIns",
                        "cons"=>2,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGION/MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReg",
                        "cons"=>3,
                        "data"=>$regions
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO/MUELLE DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "cons"=>4,
                        "data"=>$ports
                    ],
                    [
                        "type"=> 3,
                        "title"=> "SE RECIBIÓ NOTIFICACIÓN PREVIA",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "FINALIDAD ZARPE",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"finalityZarpe",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "PUERTO, ESTADO RECTOR DE PUERTO",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"text1",
                        "cons"=>7,
                        "data"=> null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "ORIGEN",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"origin",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "DESTINO",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"destination",
                        "cons"=>9,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMA ESCALA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateScale",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "cons"=>11,
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtArrival",
                        "cons"=>13,
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateLatestArrival",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"text2",
                        "cons"=>15,
                        "data"=> null
                    ],
                    [
                        "type"=> 3,
                        "title"=> "SISTEMA NACIONAL",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"national",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"OROP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayOr",
                        "cons"=>17,
                        "data"=>$orops
                    ],
                    [
                        "type"=>1,
                        "title"=>"SEÑAL RADIOLLAMADA INTERNACIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"radioCall",
                        "cons"=>18,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"IDENTIFICADOR OMI",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"idOmi",
                        "cons"=>19,
                        "data"=>null
                    ],
                    [
                        "type"=> 8,
                        "title"=> "PERMISO OTORGADO - ÚLTIMA PRORROGA",
                        "value"=> "VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=> "PLACE HOLDER INPUT",
                        "id"=>"text3",
                        "cons"=>20,
                        "data"=> null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noResolution",
                        "cons"=>21,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateResolution",
                        "cons"=>22,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValid",
                        "cons"=>23,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "cons"=>24,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "cons"=>25,
                        "data"=>$flags
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "cons"=>26,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPatent",
                        "cons"=>27,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FECHA VIGENCIA PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidityPat",
                        "cons"=>28,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representative",
                        "cons"=>29,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observationGeneral",
                        "cons"=>13,
                        "data"=>null
                    ],

                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>30,
                        "data"=>$company
                    ],
                    [
                        "type"=>8,
                        "title"=>"PESQUERÍA Y ARTES AUTORIZADOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"text4",
                        "cons"=>31,
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"PESQUERÍA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFa",
                        "cons"=>32,
                        "data"=>$detailsfisheryzarpe
                    ],
                    [
                        "type"=>3,
                        "title"=>"ZONA DE PESCA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayZoneAuto",
                        "cons"=>33,
                        "data"=>$autoFisher
                    ],
                    [
                        "type"=>8,
                        "title"=>"CARACTERISTICAS ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"text5",
                        "cons"=>34,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeMesh",
                        "cons"=>35,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ANCHO DE RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"netWidth",
                        "cons"=>36,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA DEL COPO (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeFlake",
                        "cons"=>37,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"TAMAÑO No. Y TIPO DE ANZUELO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"typeHook",
                        "cons"=>38,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LONGITUD DE LA RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"longNet",
                        "cons"=>39,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATERIAL DE ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"materialArt",
                        "cons"=>40,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EQUIPOS O DISPOSITIVOS REQUERIDOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"equipDevi",
                        "cons"=>41,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"captain",
                        "cons"=>42,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NACIONALIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayNation",
                        "cons"=>43,
                        "data"=>$nationality
                    ],
                    [
                        "type"=>8,
                        "title"=>"LOS DATOS RELACIONADOS CON LAS MEDIDAS DE ORDENAMIENTO APLICABLES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"text6",
                        "cons"=>44,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES AL CUMPLIMIENTO DE MEDIDAS DE MANEJO APLICABLES A LA PESQUERIA (NACIONAL-OROP's)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>45,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"CONCLUSIONES DEL INSPECTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"conclusions",
                        "cons"=>46,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"COMENTARIOS ADICIONALES (ESPACIO DISPONIBLE PARA EL CAPITAN)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"comments",
                        "cons"=>47,
                        "data"=>null
                    ],
                )
                ]
            ,200
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

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>2,
                        "title"=>"INSPECCIÓN No",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"insNo",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGION/MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReg",
                        "cons"=>2,
                        "data"=>$regions
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO/MUELLE DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "cons"=>3,
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE INSPECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateIns",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"RECIBIÓ NOTIFICACIÓN PREVIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"FINALIDAD DE ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"finalityArrival",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ESTADO RECTOR DE PUERTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"stateRectorPort",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"ORIGEN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"origin",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"DESTINO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"destination",
                        "cons"=>9,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ÚLTIMA ESCALA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateScale",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "cons"=>11,
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO ÚLTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtArrival",
                        "cons"=>13,
                        "data"=>$ports
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ULTIMO ARRIBO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateLatestArrival",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"FAENA REALIZADA EN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"workDone",
                        "cons"=>15,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"SISTEMA DE LOCALIZACIÓN DE BUQUES/VMS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"locationSystem",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"SEÑAL RADIOLLAMADA INTERNACIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"radioCall",
                        "cons"=>17,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"PERMISO OTORGADO - ÚLTIMAPRORROGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>18,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. DE RESOLUCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noResolution",
                        "cons"=>19,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>20,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidity",
                        "cons"=>21,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "cons"=>22,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "cons"=>23,
                        "data"=>$flags
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "cons"=>24,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No.  OMI",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noOmi",
                        "cons"=>25,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. DE PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPatent",
                        "cons"=>26,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA VIGENCIA PATENTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateValidityPat",
                        "cons"=>27,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"legalRepre",
                        "cons"=>28,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>29,
                        "data"=>$company
                    ],
                    [
                        "type"=>8,
                        "title"=>"PESQUERÍA Y ARTES AUTORIZADOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>30,
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"PESQUERÍA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFa",
                        "cons"=>31,
                        "data"=>$fishery
                    ],
                    [
                        "type"=>3,
                        "title"=>"ZONA DE PESCA AUTORIZADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayZoneAuto",
                        "cons"=>32,
                        "data"=>$autoFisher
                    ],
                    [
                        "type"=>8,
                        "title"=>"",
                        "value"=>"CARACTERÍSTICAS ARTE DE PESCA",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>33,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeMesh",
                        "cons"=>34,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ANCHO DE RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"netWidth",
                        "cons"=>35,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OJO DE MALLA DEL COPO (PULGADAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"eyeFlake",
                        "cons"=>36,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"TAMAÑO No. Y TIPO DE ANZUELO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"typeHook",
                        "cons"=>37,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LONGITUD DE LA RED (BRAZAS)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"longNet",
                        "cons"=>38,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATERIAL DE ARTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"materialArt",
                        "cons"=>39,
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"EQUIPOS O DISPOSITIVOS REQUERIDOS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"equipDevi",
                        "cons"=>40,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"captain",
                        "cons"=>41,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NACIONALIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayNation",
                        "cons"=>42,
                        "data"=>$nationality
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noAllCrew",
                        "cons"=>43,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES EXTRANJEROS",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noCrewForeign",
                        "cons"=>44,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE TRIPULANTES NACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noCrewNational",
                        "cons"=>45,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"LOS DATOS RELACIONADOS CON LA FAENA Y CAPTURA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>46,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. DÍAS DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDays",
                        "cons"=>47,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. TOTAL DE LANCES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noAllHauls",
                        "cons"=>48,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. LANCES NACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noHaulsNacional",
                        "cons"=>49,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. LANCES INTERNACIONALES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noHaulsInter",
                        "cons"=>50,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES AL CUMPLIMIENTO DE MEDIDAS DE MANEJO APLICABLES A LA PESQUERÍA (NACIONAL-OROP's)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>51,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"PESO DESEMBARCADO COMPROBADO (INGRESO PLANTA PROCESO)(TON)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"landedWeight",
                        "cons"=>52,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"CONCLUSIONES DEL INSPECTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"inspectorConclusions",
                        "cons"=>53,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"COMENTARIOS ADICIONALES (ESPACIO DISPONIBLE PARA EL CAPITAN)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"additionalComments",
                        "cons"=>54,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observationGeneral",
                        "cons"=>13,
                        "data"=>null
                    ],

                )
                ]
            ,200
        );
    }
    public function jsonDetFlap(){
        $regional = Regional::all();
        $company = Company::all();

        return response() -> json(

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "cons"=>2,
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"OFICINA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"office",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"official",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"boat",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PESQUERÍA AUTORIADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"outhFhisher",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PATENTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishLicense",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>9,
                        "data"=>$company
                    ],
                    [
                        "type"=>1,
                        "title"=>"ARMADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"owner",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CAPITÁN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishCaptain",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LOCALIZACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"location",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>13,
                        "data"=>null
                    ],

                )
                ]
            ,200
        );

    }
    public function jsonDetInch(){
        $regional = Regional::all();
        $company = Company::all();

        return response() -> json(

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "cons"=>2,
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"OFICINA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"office",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"official",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"boat",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MATRÍCULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"enrollment",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PESQUERÍA AUTORIADA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"outhFhisher",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PATENTE DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishLicense",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>9,
                        "data"=>$company
                    ],
                    [
                        "type"=>1,
                        "title"=>"ARMADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"owner",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CAPITÁN DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fishCaptain",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LOCALIZACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"location",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>13,
                        "data"=>null
                    ],

                )
                ]
            ,200
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

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>1,
                        "title"=>"NOMBRE DEL BARCO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameShip",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "cons"=>2,
                        "data"=>$flags
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. CRUCERO/RSA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"cruise",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE PESCADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameFish",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateZarpe",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateDesemb",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITAN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameCaptain",
                        "cons"=>7,
                        "data"=>null
                    ],

                )
                ]
            ,200
        );
    }
    public function jsonConfiscation(){
        $regional = Regional::all();

        return response() -> json(
                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>2,
                        "title"=>"No. ACTA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noActa",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "cons"=>2,
                        "data"=>$regional
                    ],
                    [
                        "type"=>1,
                        "title"=>"DEPARTAMENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"departament",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipality",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"MOTIVOS DEL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>10,
                        "title"=>"MOTIVOS DEL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayReasons",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"LOS RECURSOS, PRODUCTOS PESQUEROS Y/O ELEMENTOS FUERON DECOMISADOS CUANDO SE ENCONTRABAN EN (DESCRIBA LA SITUACIÓN):",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"text4",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"PARA CONSTANCIA SE FIRMA LA PRESENTE ACTA POR CADA UNO DE LOS QUE INTERVIENEN EN EL DECOMISO PREVENTIVO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>9,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO AUNAP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"officialName",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdOfficial",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representativeName",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdRepresentative",
                        "cons"=>13,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PLACA O CEDULA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"plateCertificate",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"DATOS DEL PRESUNTO INFRACTOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>15,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"name",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"documentIdOffender",
                        "cons"=>17,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE EXPEDICIÓN DE LA C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateExpedition",
                        "cons"=>18,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LUGAR DE EXPEDICIÓN DE LA C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"expeditionPlace",
                        "cons"=>19,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"DIRECCIÓN DE DOMICILIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"homeAddress",
                        "cons"=>20,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipalityOffender",
                        "cons"=>21,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREGIMIENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"corregimiento",
                        "cons"=>22,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"VEREDA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"neighborhood",
                        "cons"=>23,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TELÉFONO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"telephone",
                        "cons"=>24,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"CELULAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"mobile",
                        "cons"=>25,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREO ELECTRONICO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"email",
                        "cons"=>26,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"OBSERVACIONES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>27,
                        "data"=>null
                    ],
                )
                ]
            ,200
        );
    }
    public function jsonDonation(){
        $regional = Regional::all();

        return response() -> json(
                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>2,
                        "title"=>"No. ACTA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noActa",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"REGIONAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayRegl",
                        "cons"=>2,
                        "data"=>$regional
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO AUNAP",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDocumentId1",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE REPRESENTANTE AUTORIDAD ACOMPAÑANTE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameRepresentative",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"DOCUMENTO DE IDENTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noDocumentId2",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"No. PLACA O CÉDULA MILITAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noPlateCertificate",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"name",
                        "cons"=>9,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"PERSONERÍA JURÍDICA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"legalStatus",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"DIRECCIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"address",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"REPRESENTANTE LEGAL",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"representativeDonation",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"C.C.",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"identification",
                        "cons"=>13,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"MUNICIPIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"municipality",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"CORREGIMIENTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"corregimiento",
                        "cons"=>15,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"VEREDA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"place",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TELEFONO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"telephone",
                        "cons"=>17,
                        "data"=>null
                    ],
                )
                ]
            ,200
        );
    }
    public function jsonInspectionBoatCargo(){

        $ports = Ports::all();
        $flags = Flag::all();

        return response() -> json(

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>2,
                        "title"=>"No. FORMULARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noForm",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LUGAR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"place",
                        "cons"=>2,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"EMPRESA COLOMBIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"businessColombia",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TOTAL CARGA (TON.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"fullCargo",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN DE CRAGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoatCargo",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE TRANSBORDO DE LA CARGA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "cons"=>7,
                        "data"=>$ports
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "cons"=>8,
                        "data"=>$flags
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE ZARPE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtZarpe",
                        "cons"=>9,
                        "data"=>$ports
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPtDisemb",
                        "cons"=>10,
                        "data"=>$ports
                    ],
                    [
                        "type"=>3,
                        "title"=>"ÁREA DE OPERACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"areaOperation",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NOTIFICACIÓN PREVIA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"notification",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"INFORMACIÓN DE TRANSBORDO SOBRE EMBARCACIONES DONANTES",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>13,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayFg",
                        "cons"=>15,
                        "data"=>$flags
                    ],
                    [
                        "type"=>2,
                        "title"=>"No. IDENTIFICADOR (OMI)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"noIdOmi",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"LUGAR DE TRANSBORDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"placeTransfer",
                        "cons"=>17,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA DE TRANSBORDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateTransfer",
                        "cons"=>18,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ÁREAS DE CAPTURA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"areasCapture",
                        "cons"=>19,
                        "data"=>null
                    ],
                    [
                        "type"=>8,
                        "title"=>"PRODUCTO POR ESPECIE (TON.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>20,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ESPECIE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"species",
                        "cons"=>21,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"FORMATO DEL PODUCTO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"shapeProduct",
                        "cons"=>22,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"CANTIDAD",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"amount",
                        "cons"=>23,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"TOTAL PRODUCTO DESEMBARCADO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"productLanded",
                        "cons"=>24,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "cons"=>25,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE CAPITÁN BARCO CARGUERO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameCaptain",
                        "cons"=>26,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMPRESA RESPONSABLE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBusiness",
                        "cons"=>27,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"observaciones",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>28,
                        "data"=>null
                    ],
                )
                ]
            ,200
        );
    }
    public function jsonCertificationDisembTuna(){
        $flags = Flag::all();
        $company = Company::all();
        $ports = Ports::all();

        return response() -> json(

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>4,
                        "title"=>"FECHA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"EMPRESA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>2,
                        "data"=>$company
                    ],
                    [
                        "type"=>1,
                        "title"=>"NOMBRE EMBARCACIÓN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>4,
                        "data"=>$flags
                    ],
                    [
                        "type"=>8,
                        "title"=>"CERTIFICA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>5,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA INICIO DE FAENA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateBeginningFaena",
                        "cons"=>6,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"FECHA FIN DE FAENA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"dateEndFaena",
                        "cons"=>7,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"ZONA DE PESCA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"ZoneFisher",
                        "cons"=>8,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"PUERTO DE DESEMBARQUE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayPt",
                        "cons"=>9,
                        "data"=>$ports
                    ],
                    [
                        "type"=>2,
                        "title"=>"ALETA AMARILLA - YFT (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"yellowFin",
                        "cons"=>10,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS ALETA AMARILLA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating1",
                        "cons"=>11,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"BARRILETE -SKJ (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"barrilete",
                        "cons"=>12,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS BARRILETE",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating2",
                        "cons"=>13,
                        "data"=>null
                    ],
                    [
                        "type"=>2,
                        "title"=>"PATUDO -BET (Kg.)",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"patudo",
                        "cons"=>14,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS PATUDO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating3",
                        "cons"=>15,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"OTRO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"other",
                        "cons"=>16,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"CLASIFICACIÓN EN LIBRAS OTRO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"poundRating4",
                        "cons"=>17,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"observaciones",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"observation",
                        "cons"=>18,
                        "data"=>null
                    ],
                    [
                        "type"=>11,
                        "title"=>"NOMBRE FUNCIONARIO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "cons"=>19,
                        "data"=>null
                    ],
                )
                ]
            ,200
        );
    }
    public function jsonEquipmentDolphin(){
        $flags = Flag::all();


        return response() -> json(

                ["idForm"=>1,
            "questions"=>
                array(
                    [
                        "type"=>4,
                        "title"=>"Fecha Zarpe",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>1,
                        "data"=>null
                    ],
                    [
                        "type"=>4,
                        "title"=>"Fecha Desembarque",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"date",
                        "cons"=>2,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"NOMBRE DEL BARCO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>3,
                        "data"=>null
                    ],
                    [
                        "type"=>1,
                        "title"=>"NUM CRUCERO",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameBoat",
                        "cons"=>4,
                        "data"=>null
                    ],
                    [
                        "type"=>3,
                        "title"=>"BANDERA",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"arrayComp",
                        "cons"=>5,
                        "data"=>$flags
                    ],
                    [
                        "type"=>6,
                        "title"=>"NOMBRE OBSERVADOR",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"",
                        "cons"=>5,
                        "data"=>null
                    ],
                [
                        "type"=>11,
                        "title"=>"NOMBRE CAPITAN",
                        "value"=>"VALOR_ASIGNADO_POR_USUARIO",
                        "placeHolder"=>"PLACE HOLDER INPUT",
                        "id"=>"nameOfficial",
                        "cons"=>19,
                        "data"=>null
                    ],

                )
                ]
            ,200
        );
    }

}
