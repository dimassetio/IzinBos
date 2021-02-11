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
        @can('user-create')
        <div class="box-header">
          <a href="users.create" class="btn btn-primary btn-sm my-3">Create User</a>
        </div>
        @endcan
        <div class="box-body">
        @section('plugins.Datatables', true)
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                @if(auth()->user()->hasAnyPermission(['user-edit','user-delete']))
                    <th>Action</th> 
                @endif
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
                    <div class="row">
                    @can('user-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('users.edit', $user->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('user-delete')
                      <div class="col">
                        <!-- <button class="btn btn-warning btn-sm">delete</button> -->
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
          <div class="row mx-auto">
            <a href="users/create" class="btn btn-primary btn-sm"> Create User </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop