@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users Data</h1>

@stop

@section('content')
  <div class="row">
    <div class="col">
      <div class="card ">
        <div class="card-body table-responsive ">
          <table id="tableUsers" class="table table-bordered table-hover text-center">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Roles</th>
              <th>Action</th> 
            </tr>
          </thead>
          <tbody>
            @foreach($data as $user)
              <tr>
                <td><?= $user->name; ?> </td>
                <td><?= $user->email; ?> </td>
                <td> 
                  @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                      <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                  @endif</td>
                @if(auth()->user()->hasAnyPermission(['user-edit','user-delete']))
                <td>
                  <div class="row justify-content-center">
                    <div class="mx-2">
                      <a class="btn btn-info btn-sm" href="{{route('users.show', $user->id)}}">show</a>
                    </div>
                    @can('user-edit')
                    <div class="mx-2">
                      <a class="btn btn-primary btn-sm" href="{{route('users.edit', $user->id)}}">edit</a>
                    </div>
                    @endcan
                    @can('user-delete')
                    <div class="mx-2">
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endcan
                  </div>
                </td>
                @endif
              </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>   
    <div class="col-xs">
      @can('user-create')        
        <a href="<?= route('users.create') ?>" class="btn btn-app float-right">
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
    $('#tableUsers').DataTable();
  })
</script>
@stop
