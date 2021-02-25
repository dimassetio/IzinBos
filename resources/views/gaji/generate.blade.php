@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Tunjangan</h1>
@stop

@section('content')
  {!! Form::open(array('route' => 'gaji.store','method' => 'POST')) !!}
  <input type="date" name="tanggal" class="form-control-sm-2"> <br>
    <button type="submit" class="btn btn-info pull-right mt-2">Submit</button>
  {!! Form::close() !!}
@stop

@section('js')

@stop