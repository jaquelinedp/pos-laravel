@extends ('welcome')

@section ('contenido')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Gestor de su perfil personal</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form method="post" action="{{ url('Mis-Datos') }}" enctype="multipart/form-data"> 
                    @csrf

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-user"> </i></span>
                            <input type="text" class="form-control input-lg" name="name" required value="{{ auth()->user()->name }}"> 
                        </div> 
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="email" class="form-control input-lg" name="email" value="{{ auth()->user()->email }}">
                        </div> 
                        @error('email')
                            <p class="alert alert-danger">El email ya se encuentra registrado</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-lock"> </i></span>
                            <input type="password" class="form-control input-lg" name="password" placeholder="Opcional, deja en blanco para no cambiar">
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="fotoPerfil">Actualizar foto de perfil:</label>
                        <input type="file" name="fotoPerfil" accept="image/*">

                        <br>

                        @if(auth()->user()->foto)
                            <img src="{{ url('storage/' . auth()->user()->foto) }}" width="150px" height="150px">
                        @else
                        <img src="{{ asset('storage/users/anonymous.jpg') }}" width="150px" height="150px">


                        @endif
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success pull-right">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

</div>

@endsection
