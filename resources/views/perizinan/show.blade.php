@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
   

@stop

@section('content')
<div class="row">
  <div class="col col-sm-6 mx-auto">
    <div class="card">
      <div class="card-header text-center">
        <h5>Detail Data Izin</h5>
      </div>   
      <div class="card-body table-striped p-0">
        <table id="example1" class="table  table-striped">
          <tbody>
              <tr>
                <td class="w-25">Nama </td>
                <td> : </td>
                <td><?= $izin->getNamaPegawai($izin->pegawai_id  ); ?> </td>
              </tr>
              <tr>
                <td>Tanggal Mulai </td>
                <td> : </td>
                <td><?= $izin->tanggal_mulai; ?> </td>
              </tr>
              <tr>
                <td>Tanggal Selesai </td>
                <td> : </td>
                <td><?= $izin->tanggal_selesai; ?> </td>
              </tr>
              <tr>
                <td>Type Izin </td>
                <td> : </td>
                <td><?= $izin->type_izin; ?> </td>
              </tr>
              <tr>
                <td>Keterangan </td>
                <td> : </td>
                <td><?= $izin->keterangan; ?> </td>
              </tr>
              <tr>
                <td>Status Diterima </td>
                <td> : </td>
                <td><?= $izin->status_diterima; ?> </td>
              </tr>
          </tbody>
        </table>
      </div>
      <div class="row mx-auto p-3">
      
      @can('izin-list')
      <div class="col  text-center">
        <a href=" <?= route('izin.index',$izin->id) ?> " class="btn btn-primary btn-sm">Kembali</a>
      </div>
      @endcan
      @can('izin-edit')
        <div class="col  text-center">
          <a href=" <?= route('izin.edit', $izin->id) ?> " class="btn btn-warning btn-sm">Edit</a>
        </div>
      @endcan
      </div>
    </div>
  </div>
</div>



@stop