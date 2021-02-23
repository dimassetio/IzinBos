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
          <div class="col-sm">
          {!! Form::text('nama', null, array('placeholder' => 'Nama ','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
        <div class="form-group">

          <label for="inputEmail" class="col-sm-2 control-label">Email </label>
          <div class="col-sm">
          {!! Form::email('email', null, array('placeholder' => 'Email ','class' => 'form-control', 'id' => 'InputEmail')) !!}
          </div>
        </div>       
        <div class="form-group row">

          <div class="col-sm">
          <label for="inputAlamat" class="col-sm-2 control-label">Rekening </label>
          {!! Form::text('rekening', null, array('placeholder' => 'Rekening ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>

          <div class="col-sm">
          <label for="inputbank" class="col-sm-2 control-label">Bank ID</label>
            <select name="bank_id" class="form-control">
              <option disabled selected hidden value="">Bank ID</option>
                <option value="BRI">BRI</option>
                <option value="BCA">BCA</option>
                <option value="BNI">BNI</option>
                <option value="BNI Syariah">BNI Syariah</option>
                <option value="BTPN">BTPN</option>
                <option value="BTPN Wow">BTPN Wow</option>
                <option value="CIMB Niaga">CIMB Niaga</option>
                <option value="CIMB Niaga Syariah">CIMB Niaga Syariah</option>
                <option value="Mandiri">Mandiri</option>
                <option value="Mandiri Syariah">Mandiri Syariah</option>
                <option value="Muamalat">Muamalat</option>
                <option value="OCBC NISP">OCBC NISP</option>
            </select>
            <!-- {!! Form::number('bank_id', null, array('placeholder' => 'Bank ID ','class' => 'form-control', 'id' => 'Inputbank')) !!} -->
          </div>
        </div>
        <div class="form-group">

          <label for="inputAlamat" class="col-sm-2 control-label">Alamat </label>
          <div class="col-sm">
          {!! Form::textarea('alamat', null, array('placeholder' => 'Alamat ','class' => 'form-control', 'id' => 'InputAlamat', 'rows       ' => 2)) !!}
          </div>
        </div>
        @can('pegawai-edit')
        <div class="form-group">

          <label for="inputAlamat" class="col-sm-2 control-label">Type Pegawai </label>
          <div class="col-sm">
          {!! Form::text('type_pegawai', null, array('placeholder' => 'Type Pegawai ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm">
            <label for="jabatans" class="col-sm-2 control-label">Jabatan</label>
            <select name="jabatan_id" id="jabatans" class="form-control">
              <option disabled selected hidden value="">Jabatan</option>
              @foreach ($jabatan as $data)
              
                <option value={!! $data->id; !!}>{!!  $data->nama_jabatan !!}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endcan
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route('pegawai.data')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop