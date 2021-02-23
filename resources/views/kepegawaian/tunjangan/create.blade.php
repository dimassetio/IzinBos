@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Tunjangan</h1>
@stop

@section('content')

  <div class="box box-info">
    <!-- form start -->
    {!! Form::open(array('route' => 'tunjangan.store','method' => 'POST')) !!}
    <!-- {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!} -->
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Nama Tunjangan</label>

          <div class="col-sm-5">
          {!! Form::text('nama_tunjangan', null, array('placeholder' => 'Nama Tunjangan','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputTunjangan" class="col-sm-2 control-label">Besar Tunjangan</label>

          <div class="col-sm-3">
          {!! Form::text('besar_tunjangan', null, array('placeholder' => 'Rp. ','class' => 'form-control text-right', 'id' => 'inputTunjangan')) !!}
          </div>
        </div>        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route('tunjangan.index')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop

@section('js')
  <script>
    $('#inputTunjangan').priceFormat({
      prefix: 'Rp. ',
      centsLimit: 0,
      thousandsSeparator: '.'
    });
  </script>
@stop