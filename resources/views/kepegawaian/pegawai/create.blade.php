@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Registrasi Pegawai</h1>
@stop

@section('content')

  <div class="box box-info">
    <!-- form start -->
    {!! Form::open(array('route' => 'pegawai.store','method' => 'POST')) !!}
    <!-- {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!} -->
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Nama </label>

          <div class="col-sm-10">
          {!! Form::text('nama', null, array('placeholder' => 'Nama ','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Email </label>

          <div class="col-sm-10">
          {!! Form::email('email', null, array('placeholder' => 'Email ','class' => 'form-control', 'id' => 'InputEmail')) !!}
          </div>
        </div>       
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Alamat </label>

          <div class="col-sm-10">
          {!! Form::text('alamat', null, array('placeholder' => 'Alamat ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Tanggal Masuk </label>

          <div class="col-sm-10">
          {!! Form::date('tanggal_masuk', \Carbon\Carbon::now(), array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Rekening </label>

          <div class="col-sm-10">
          {!! Form::text('rekening', null, array('placeholder' => 'Rekening ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Type Pegawai </label>

          <div class="col-sm-10">
          {!! Form::text('type_pegawai', null, array('placeholder' => 'Type Pegawai ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Bank </label>

          <div class="col-sm-10">
          {!! Form::number('bank_id', null, array('placeholder' => 'Bank ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <label> Jabatan</label>
            @foreach ($jabatan as $data)
            <div class="checkbox">
                <label class="col-sm-2 control-label">
                  {!! Form::radio('jabatan_id', $data->id, array('class' => 'form-control name')); !!}
                  {!! $data->nama_jabatan !!}
                </label>
            @endforeach
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