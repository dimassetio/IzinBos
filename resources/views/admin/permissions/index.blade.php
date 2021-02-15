@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Permissions Data</h1>    

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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table id="example1" class="table table-bordered table-hover text-center">
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
                      <div class="row justify-content-center">
                      @can('permission-edit')
                        <div class="mx-2">
                          <a class="btn btn-primary btn-sm" href="{{route('permissions.edit',$data->id)}}">edit</a>
                        </div>
                      @endcan
                      @can('permission-delete')
                        <div class="mx-2">
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
      <div class="col-xs">
        @can('permission-create')        
          <a href="<?= route('permissions.create') ?>" class="btn btn-app float-right">
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
