@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Potongan</h1>
@stop

@section('content')

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
          <label for="inputJenis" class="col-sm-2 control-label">Jenis Potongan</label>

          <div class="col-sm-10">
            <input type="radio" id="presentase" name="jenis_potongan" value="presentase">
            <label for="presentase">Presentase</label><br>
            <input type="radio" id="nominal" name="jenis_potongan" value="nominal">
            <label for="nominal">Nominal</label><br>
          </div>
          <script>
            if(document.getElementById('presentase').checked) {

            }else if(document.getElementById('nominal').checked) {
              
            }
          </script>
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
        <a href="{{route('potongan.index')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop
@section('js')
  <script>
    $('#inputPotongan').priceFormat({
      prefix: 'Rp. ',
      centsLimit: 0,
      thousandsSeparator: '.'
    });
  </script>
@stop