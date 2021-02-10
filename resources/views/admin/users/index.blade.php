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
                  <td>
                    <div class="row">
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('users.edit', $user->id)}}">edit</a>
                      </div>
                      <div class="col">
                        <!-- <button class="btn btn-warning btn-sm">delete</button> -->
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
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