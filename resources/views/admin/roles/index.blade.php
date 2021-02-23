@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Roles Data</h1>    


@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <div class="card-body table-responsive">
            <table id="tableRoles" class="table table-bordered table-hover text-center">
                <!-- <table class="table table-hover text-nowrap"> -->
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                        <div class="row justify-content-center">
                            <div class="mx-2">
                            </div>
                                <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                            @can('role-edit')
                            <div class="mx-2">
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                            </div>
                            @endcan
                            @can('role-delete')
                            <div class="mx-2">
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </div>
                            @endcan
                        </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xs">
            @can('role-create')        
                <a href="<?= route('roles.create') ?>" class="btn btn-app float-right">
                    <i class="fas fa-edit"></i> Tambah
                </a>
            @endcan
        </div>
    </div>
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> 
  $ ( function () {
    $('#tableRoles').DataTable();
  })
</script>
@stop
