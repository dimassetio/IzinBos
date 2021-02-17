@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
<div class="row">
  <div class="col col-sm-6 mx-auto">
    <div class="card">
      <div class="card-header text-center">
        <h5>Biodata Pegawai</h5>
      </div>   
      <div class="card-body table-striped p-0">
        <table id="example1" class="table  table-striped">
          <tbody>
              <tr>
                <td class="w-25">Nama </td>
                <td> : </td>
                <td><?= $pegawai->nama; ?> </td>
              </tr>
              <tr>
                <td>Email </td>
                <td> : </td>
                <td><?= $pegawai->email; ?> </td>
              </tr>
              <tr>
                <td>Alamat </td>
                <td> : </td>
                <td><?= $pegawai->alamat; ?> </td>
              </tr>
              <tr>
                <td>Tanggal Masuk </td>
                <td> : </td>
                <td><?= $pegawai->tanggal_masuk; ?> </td>
              </tr>
              <tr>
                <td>Rekening </td>
                <td> : </td>
                <td><?= $pegawai->rekening; ?> </td>
              </tr>
              <tr>
                <td>Tipe Pegawai </td>
                <td> : </td>
                <td><?= $pegawai->type_pegawai; ?> </td>
              </tr>
              <tr>
                <td>Bank Id </td>
                <td> : </td>
                <td><?= $pegawai->bank_id; ?> </td>
              </tr>
              <tr>
                <td>Jabatan </td>
                <td> : </td>
                <td><?= $pegawai->getJabatanName($pegawai->jabatan_id); ?></td>
              </tr>
              <tr>
                <td>Bonus Professional </td>
                <td> : </td>
                <td><?= $pegawai->bonus_loyalitas; ?></td>
              </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer text-center">
        <a href=" <?= route('pegawai.index') ?> " class="btn btn-primary btn-sm">Kembali</a>
      </div>
    </div>
  </div>
</div>



@stop