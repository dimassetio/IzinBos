@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Pegawai</h1>
@stop

@section('content')

  <div class="box box-info">
    <!-- form start -->
    {!! Form::model($pegawai, ['method' => 'PATCH', 'route' => ['pegawai.update',$pegawai->id]]) !!}
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
          {!! Form::date('tanggal_masuk', $pegawai->tanggal_masuk, array( 'class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Rekening </label>

          <div class="col-sm-10">
          {!! Form::text('rekening', null, array('placeholder' => 'Rekening ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Bank </label>

          <div class="col-sm-10">
          {!! Form::select('bank_id', [
            'BRI' => 'BRI', 
            'BCA' => 'BCA', 
            'BNI' => 'BNI', 
            'BNI Syariah' => 'BNI Syariah', 
            'BTPN' => 'BTPN', 
            'BTPN Wow' => 'BTPN Wow',
            'CIMB Niaga' => 'CIMB Niaga',
            'CIMB Niaga Syariah' => 'CIMB Niaga Syariah',
            'Mandiri' => 'Mandiri',
            'Mandiri Syariah' => 'Mandiri Syariah',
            'Muamalat' => 'Muamalat',
            'OCBC NISP' => 'OCBC NISP',
            ], $pegawai->bank_id, array('placeholder'=>'Bank ID' , 'class' => 'form-control')); !!}
            </div>
        </div>

        @can ('pegawai-edit') 
        <div class="form-group">
          <label for="inputAlamat" class="col-sm-2 control-label">Type Pegawai </label>

          <div class="col-sm-10">
          {!! Form::text('type_pegawai', null, array('placeholder' => 'Type Pegawai ','class' => 'form-control', 'id' => 'InputAlamat')) !!}
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
              <label class="col-sm-2 control-label">Jabatan</label>
              <select name="jabatan_id" class="form-control">
              @if($pegawai->jabatan_id == null)
                  <option selected disabled hidden>Tidak Ada</option>
              @endif
                @foreach ($jabatan as $data)
                 @if($pegawai->jabatan_id == $data->id)
                  <option selected value="{!! $data->id !!}">{!! $data->nama_jabatan !!}</option>
                @else 
                  <option value="{!! $data->id !!}">{!! $data->nama_jabatan !!}</option>
                @endif
                @endforeach
              </select>
          </div>
        </div>
        @endcan

        @can('pegawai-edit')
        <div class="form-group">
        @else
        <div class="form-group d-none">
        @endcan
          <label class="col-sm-2 control-label">Daftar Tunjangan </label>

          <div class="col-sm">
            <!-- <select name="tunjangan_id[]" class="form-control" multiple>
              @foreach($tunjangan as $t)
                <option value="{!! $t->id !!}">{!! $t->nama_tunjangan !!}</option>
              @endforeach
            </select> -->

            @foreach($tunjangan as $value)
                {{ Form::checkbox('tunjangan_id[]', $value->id, in_array($value->id, $tunjangan_pegawai) ? true : false, array('class' => 'name')) }}
                {{ $value->nama_tunjangan }}
                <br>
            @endforeach
          </div>
        </div>
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        @can('pegawai-list')
        <a href="{{route('pegawai.index')}}" class="btn btn-default">Cancel</a>
        @else
        <a href="{{route('pegawai.data')}}" class="btn btn-default">Cancel</a>
        @endcan
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>

@stop