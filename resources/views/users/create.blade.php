@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item">Configuraciones</li>
    <li class="breadcrumb-item"><a href="">Usuarios</a></li>
	<li class="breadcrumb-item active">Nuevo</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="icon-grid"></i>
                    <strong>Usuarios</strong>
                    <small>Nuevo</small>
                </div>
				{!! Form::open(['route' => ['users.store'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
							@include('users.partials.fields')
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        Guardar
                    </button>
                    <a href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                </div>
				{!! Form::close() !!}
            </div>

        </div>
	</div>
@stop


