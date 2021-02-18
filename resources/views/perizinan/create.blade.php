@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pengajuan Izin</h1>
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
          <label for="inputType" class="col-sm-2 control-label">Type Izin </label>

          <div class="col-sm-10">
            <select name="type_izin" id="inputType" class="form-control">
              <option disabled selected hidden value="">Type Izin</option>
              <option value="Sakit">Sakit</option>
              <option value="Hal Penting">Hal Penting</option>
              <option value="Cuti Hamil">Cuti Hamil</option>
              <option value="Cuti Tahunan">Cuti Tahunan</option>
              <option value="Cuti Hari Besar">Cuti Hari Besar</option>
            </select>
            <!-- {!! Form::select('type_izin', ['Sakit' => 'Sakit', 
                                          'Hal Penting' => 'Hal Penting', 
                                          'Cuti Tahunan' => 'Cuti Tahunan', 
                                          'Cuti Besar' => 'Cuti Tahunan'],
              null, array('placeholder' => ' ', 'class' => 'form-control', 'id' => 'InputType')); !!} -->
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