@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan</h1>
@stop

@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      @can('jabatan-create')
        <div class="box-header">
         <a href="jabatan/create" class="btn btn-primary btn-sm my-3"> Tambah Jabatan </a>
        </div>
      @endcan
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Bonus Professional</th>
                @if(auth()->user()->hasAnyPermission(['jabatan-edit','jabatan-delete']))
                    <th>Action</th> 
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($data as $jabatan)
                <tr>
                  <td><?= $jabatan->nama_jabatan; ?> </td>
                  <td><?= $jabatan->gaji_pokok; ?> </td>
                  <td><?= $jabatan->bonus_professional; ?> </td>
                  @if(auth()->user()->hasAnyPermission(['jabatan-edit','jabatan-delete']))
                  <td>
                    <div class="row">
                    @can('jabatan-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('jabatan.edit', $jabatan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('jabatan-delete')
                      <div class="col">
                        {!! Form::open(['method' => 'DELETE','route' => ['jabatan.destroy', $jabatan->id],'style'=>'display:inline']) !!}
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
        </div>
      </div>
    </div>
  </div>
</section>
@stop