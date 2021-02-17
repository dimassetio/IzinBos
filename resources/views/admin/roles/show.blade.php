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
        <h5>Detail Data Pegawai</h5>
      </div>   
      <div class="card-body table-striped p-0">
        <table id="example1" class="table  table-striped">
          <tbody>
              <tr>
                <td class="w-25">Name </td>
                <td> : </td>
                <td><?= $role->name; ?> </td>
              </tr>
              @foreach($rolePermissions as $data)
              <tr>
                <td>Permission </td>
                <td> : </td>                            
                <td><?= $data->name; ?></td>
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