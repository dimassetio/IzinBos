@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Permission List</h1>
@stop

@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      @can('permission-create')
        <div class="box-header my-3">
            <a href="permissions/create" class="btn btn-primary btn-sm">Create Permission</a>
        </div>
      @endcan 
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Guard Name</th>
                @if(auth()->user()->hasAnyPermission(['permission-edit','permission-delete']))
                    <th>Action</th> 
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($permissions as $data)
                <tr>
                  <td><?= $data->id; ?> </td>
                  <td><?= $data->name; ?> </td>
                  <td><?= $data->guard_name; ?> </td>
                  @if(auth()->user()->hasAnyPermission(['permission-edit','permission-delete']))
                  <td>
                    <div class="row">
                    @can('permission-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('permissions.edit',$data->id)}}">edit</a>
                      </div>
                    @endcan
                    @can('permission-delete')
                      <div class="col">
                           {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $data->id],'style'=>'display:inline']) !!}
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