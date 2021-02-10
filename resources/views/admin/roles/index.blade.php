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
        <!-- <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div> -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Guard Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($roles as $data)
                <tr>
                  <td><?= $data->id; ?> </td>
                  <td><?= $data->name; ?> </td>
                  <td><?= $data->guard_name; ?> </td>
                  <td>
                    <div class="row">
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $data->id) }}">edit</a>
                      </div>
                      <div class="col">
                        <!-- <button class="btn btn-warning btn-sm">delete</button> -->
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $data->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-warning btn-sm']) !!}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </td>
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