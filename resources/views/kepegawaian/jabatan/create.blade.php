@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Jabatan</h1>
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
    {!! Form::open(array('route' => 'jabatan.store','method' => 'POST')) !!}
    <!-- {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!} -->
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Nama Jabatan</label>

          <div class="col-sm-10">
          {!! Form::text('nama_jabatan', null, array('placeholder' => 'Nama Jabatan','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputGaji" class="col-sm-2 control-label">Gaji Pokok</label>

          <div class="col-sm-10">
          {!! Form::text('gaji_pokok', null, array('placeholder' => 'Gaji Pokok','class' => 'form-control', 'id' => 'inputGaji')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputBonus" class="col-sm-2 control-label">Bonus Professional</label>

          <div class="col-sm-10">
          {!! Form::text('bonus_professional', null, array('placeholder' => 'Bonus Professional','class' => 'form-control', 'id' => 'inputBonus')) !!}
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