@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Data User List</h1>
@stop

@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        @can('role-create')
          <div class="box-header">
            <a href="roles/create" class="btn btn-primary btn-sm my-3">Create Role</a>
          </div>
        @endcan
        <div class="box-body">
        
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Guard Name</th>
                @if(auth()->user()->hasAnyPermission(['role-edit','role-delete']))
                    <th>Action</th> 
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($roles as $data)
                <tr>
                  <td><?= $data->id; ?> </td>
                  <td><?= $data->name; ?> </td>
                  <td><?= $data->guard_name; ?> </td>
                  @if(auth()->user()->hasAnyPermission(['role-edit','role-delete']))
                  <td>
                    <div class="row">
                    @can('role-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $data->id) }}">edit</a>
                      </div>
                      @endcan
                      @can('role-delete')
                      <div class="col">
                        <!-- <button class="btn btn-warning btn-sm">delete</button> -->
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $data->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-warning btn-sm']) !!}
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
  </div>
</section>
@stop