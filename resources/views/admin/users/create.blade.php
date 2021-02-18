@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create User Account</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'users.store','method' => 'POST')) !!}
            <!-- {!! Form::open(array('route' => 'roles.store','method' => 'POST')) !!} -->
              <div class="box-body">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                  {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'InputName')) !!}
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'id' => 'InputEmail')) !!}
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                  {!! Form::Password('password', array('placeholder' => 'Password','class' => 'form-control', 'id' => 'InputPassword')) !!}
                  </div>
                </div>
                <div class="form-group">
                  <label for="ConfirmPassword" class="col-sm-2 control-label">Confirm Password</label>

                  <div class="col-sm-10">
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'ConfirmPassword')) !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <label> Role</label>
                    @foreach ($roles as $data)
                    <div class="checkbox">
                        <label class="col-sm-2 control-label">
                          {!! Form::checkbox('roles[]', $data, array('class' => 'form-control name')); !!}
                          {!! $data !!}
                        </label>
                    @endforeach
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            {!! Form::close() !!}
          </div>
@stop
