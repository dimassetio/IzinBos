@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Role</h1>
@stop

@section('content')

  <div class="box box-info">
    <div class="box-header with-border">
      <!-- <h3 class="box-title">Registration Form</h3> -->
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!}
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Role Name</label>

          <div class="col-sm-10">
          {!! Form::text('name', null, array('placeholder' => 'Role Name','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Give Permission To</label>

          <div class="col-sm-10">
            @foreach($permission as $value)
              <label>{{ Form::checkbox('permission[]', $value->id,false, array('class' => 'name')) }}
              {{ $value->name }}</label>
            <br/>
            @endforeach
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route('roles.index')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>
@stop
