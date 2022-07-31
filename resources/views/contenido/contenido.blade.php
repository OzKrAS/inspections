@extends('principal')
@section('contenido')

    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <h1>Escritorio</h1>
            </template>
            <template v-if="menu==1">
                <region></region>
            </template>
            <template v-if="menu==2">
                <municipalities></municipalities>
            </template>
            <template v-if="menu==3">
                <ports></ports>
            </template>
            <template v-if="menu==4">
                <autofisher></autofisher>
            </template>
            <template v-if="menu==5">
                <flags></flags>
            </template>
            <template v-if="menu==6">
                <docks></docks>
            </template>
            <template v-if="menu==7">
                <zarpe></zarpe>
            </template>
            <template v-if="menu==8">
                <arrival></arrival>
            </template>
            <template v-if="menu==9">
                <checkdetinch></checkdetinch>
            </template>
            <template v-if="menu==10">
                <checkdetflap></checkdetflap>
            </template>
            <template v-if="menu==11">
                <presenVerific></presenVerific>
            </template>
            <template v-if="menu==12">
                <nationality></nationality>
            </template>
            <template v-if="menu==13">
                <companies></companies>
            </template>
            <template v-if="menu==14">
                <donations></donations>
            </template>
            <template v-if="menu==15">
                <confiscations></confiscations>
            </template>
            <template v-if="menu==16">
                <inspectioncargos></inspectioncargos>
            </template>
            <template v-if="menu==17">
                <certificationtuna></certificationtuna>
            </template>
            <template v-if="menu==18">
                <materials></materials>
            </template>
            <template v-if="menu==19">
                <profiles></profiles>
            </template>
            <template v-if="menu==20">
                <boats></boats>
            </template>
            <!-- <template v-if="menu==18">
                <noticepreviouszarpe></noticepreviouszarpe>
            </template>
            <template v-if="menu==19">
                <processingplant></processingplant>
            </template> -->

           
   
            @else

            @endif

    @endif
       
        
    @endsection