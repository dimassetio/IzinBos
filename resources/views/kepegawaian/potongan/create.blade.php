@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Potongan</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="box box-info">
    <!-- form start -->
    {!! Form::open(array('route' => 'potongan.store','method' => 'POST')) !!}
    <!-- {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!} -->
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Nama Potongan</label>

          <div class="col-sm-10">
          {!! Form::text('nama_potongan', null, array('placeholder' => 'Nama Potongan','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputPotongan" class="col-sm-2 control-label">Besar Potongan</label>

          <div class="col-sm-10">
          {!! Form::text('besar_potongan', null, array('placeholder' => 'Besar Potongan','class' => 'form-control', 'id' => 'inputPotongan')) !!}
          </div>
        </div>        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop