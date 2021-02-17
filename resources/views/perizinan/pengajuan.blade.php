@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pengajuan Izin</h1>
@stop

@section('content')

  <div class="box box-info">
    <!-- form start -->
    {!! Form::open(array('route' => 'izin.store','method' => 'POST')) !!}
      <div class="box-body">
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Tanggal Mulai </label>

          <div class="col-sm-10">
          {!! Form::date('tanggal_mulai', \Carbon\Carbon::now(), array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Tanggal Selesai </label>

          <div class="col-sm-10">
          {!! Form::date('tanggal_selesai', \Carbon\Carbon::now(), array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
       
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Type Izin </label>

          <div class="col-sm-10">
          {!! Form::select('type_izin', ['cuti sakit'=>'cuti sakit','cuti hamil' => 'cuti hamil'], array('placeholder' => 'Type Izin ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Keterangan </label>
          <div class="col-sm-10">
          {!! Form::textarea('keterangan', null, array('placeholder' => 'Keterangan ','class' => 'form-control', 'id' => 'InputName', 'rows' => '3')) !!}
          </div>
        </div>


        <div class="form-group d-none">
          <div class="col-sm-10">
          {!! Form::text('status_diterima', 'menunggu', array('placeholder' => 'status diterima ','class' => 'form-control d-none', 'id' => 'InputAlamat', 'value' => 'menunggu')) !!}
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