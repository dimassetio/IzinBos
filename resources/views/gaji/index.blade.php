@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
<div class="row">
  <div class="col col-sm-6 mx-auto">
    <div class="card">
      <div class="card-header text-center">
        <h5>Detail Gaji Pegawai</h5>
      </div>   
      <div class="card-body table-striped p-0">
        <table id="example1" class="table  table-striped">
          <tbody>
              <tr>
                <td class="w-25">Nama </td>
                <td> : </td>
                <td><?= $data->nama; ?> </td>
              </tr>
              <tr>
                <td>Total Gaji </td>
                <td> : </td>
                <td><?= $user->email; ?> </td>
              </tr>
              @foreach($userRole as $dataRole)
              <tr>
                <td>Role </td>
                <td> : </td>                            
                <td><?= $dataRole; ?></td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer text-center">
        <a href=" <?= route('users.index') ?> " class="btn btn-primary btn-sm">Back</a>
      </div>
    </div>
  </div>
</div>
@stop