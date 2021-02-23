@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Permission</h1>
@stop

@section('content')

  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::open(array('route' => 'permissions.store','method' => 'POST')) !!}
      <div class="box-body">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Permission Name</label>

          <div class="col-sm-10">
          {!! Form::text('name', null, array('placeholder' => 'Permission Name','class' => 'form-control', 'id' => 'InputName')) !!}
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      <a href="{{route('permissions.index')}}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info pull-right">Submit</button>
      </div>
      <!-- /.box-footer -->
    {!! Form::close() !!}
  </div>
@stop
