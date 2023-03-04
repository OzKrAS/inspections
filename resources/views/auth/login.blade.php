@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
      <div class="col-md-8">
        
        <div class="card-group  mb-0">
          <div class="card p-4 bg-dark">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
          {{ csrf_field() }}
              <div class="card-body ">
              <h2 style="color:#fcfafb">Ingresar</h2>
              <br>
              
              <p style="color:#fcfafb" class="text-muted">Control de acceso al sistema</p>
              <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary px-4 w-100">Acceder</button>
                </div>
              </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            
            <h6 style="color:#ecf0f5">Todos los derechos reservados &copy;AltoSentido</h6>
          </form>
          </div>
          <div class="card py-1 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <br>
              <br>
              <br>
       
               <h3 class="text-muted">Sistema de Inspecciones </h3> 
                <img src="img\aunap.png" class="card-img-center" alt="Cinque Terre" width="100%" height="100%"> 
             
               
                               
     
                <p>  Sistema de Inspección a embarcaciones </p>  
            
            </div>
          </div>

        </div>
      </div>
    </div>
@endsection
