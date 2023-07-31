@extends('auth.contenido')

@section('login')
  <div class="row justify-content-center">
      <div class="col-md-8" id="loginForm">
        <div class="card-group  mb-0" >
            <div class="card p-4" >
                <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card-body ">
                        <h2 style="color:#f2f2f2">
                          <img src="{{ asset('assets/img/logoaunap.png') }}" class="img-fluid d-lg-none d-md-none" id="logosm"><br>
                          Ingresar
                        </h2>
                        <br>

                        <p style="color:#f2f2f2">Control de acceso al sistema</p>
                        <div class="form-group mb-3{{ $errors->has('usuario' ? 'is-invalid' : '') }}">
                            <span class="input-group-addon"><i class="icon-user"></i></span>
                            <input type="text" value="{{ old('usuario') }}" name="usuario" id="usuario"
                                class="form-control" placeholder="Usuario">
                            {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>') !!}
                        </div>
                        <div class="form-group mb-4{{ $errors->has('password' ? 'is-invalid' : '') }}">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Contraseña">
                            {!! $errors->first('password', '<span class="invalid-feedback">:message</span>') !!}
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4 w-100">Iniciar Sesión</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <small style="color:#222">Todos los derechos reservados<br>
                        &copy; 2023 |
                        <a href="https://altosentido.net">altosentido.net</a>
                    </small>
                </form>
            </div>
            <div class="card p-3 d-md-down-none" style="width:44%">
                <div class="card-body text-center">
                    <h5 class="text-white" id="contramsg">Sistema de Inspección a Embarcaciones</h5><br>
                    <img src="{{ asset('img/aunap2.png') }}" class="card-img-center" id="logo">
                </div>
            </div>

        </div>
      </div>
  </div>
@endsection
