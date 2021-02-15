@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users Data</h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
  <div class="row">
    <div class="col">
      <div class="card ">
        <div class="card-header">
            
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                  </button>
                  </div>
              </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table id="example1" class="table table-bordered table-hover text-center">
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
    <script> console.log('Hi!'); </script>
@stop
