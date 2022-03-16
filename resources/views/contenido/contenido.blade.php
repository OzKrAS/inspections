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

           
   
            @else

            @endif

    @endif
       
        
    @endsection