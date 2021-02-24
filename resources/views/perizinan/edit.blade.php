@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Izin</h1>
@stop

@section('content')

  <div class="box box-info">
    <!-- form start -->
    {!! Form::model($izin, ['method' => 'PATCH', 'route' => ['izin.update',$izin->id]]) !!}
      <div class="box-body">
      <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Tanggal Mulai </label>

          <div class="col-sm-10">
          {!! Form::date('tanggal_mulai', null, array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Tanggal Selesai </label>

          <div class="col-sm-10">
          {!! Form::date('tanggal_selesai', null, array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
       
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Type Izin </label>

          <div class="col-sm-10">
          {!! Form::select('type_izin', ['Sakit'=>'Sakit','Hal Penting' => 'Hal Penting', 'Terlambat' => 'Terlambat'], $izin->type_izin, array('class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Keterangan </label>
          <div class="col-sm-10">
          {!! Form::textarea('keterangan', null, array('placeholder' => 'Keterangan ','class' => 'form-control', 'id' => 'InputName', 'rows' => '3')) !!}
          </div>
        </div>
    @if($izin->status_diterima == 'diterima')
      @can('izin-confirmation')
        <div class="form-group">
          <div class="col-sm-10">
          {!! Form::checkbox('status_diterima', 'menunggu', array('class' => 'form-control d-none', 'id' => 'InputAlamat')) !!}
          Batalkan Status Diterima
          </div>
        </div>
      @endcan
    @elseif($izin->status_diterima == 'ditolak')
      @can('izin-confirmation')
        <div class="form-group">
          <div class="col-sm-10">
          {!! Form::checkbox('status_diterima', 'menunggu', array('class' => 'form-control d-none', 'id' => 'InputAlamat')) !!}
          Batalkan Status Ditolak
          </div>
        </div>
      @endcan
    @endif
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route('izin.index')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop