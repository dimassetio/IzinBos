@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Data Tunjangan</h1>
@stop

@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      @can('tunjangan-create')
        <div class="box-header">
         <a href="tunjangan/create" class="btn btn-primary btn-sm my-3"> Tambah Tunjangan </a>
        </div>
      @endcan
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nama Tunjangan</th>
                <th>Besar Tunjangan</th>
                @if(auth()->user()->hasAnyPermission(['tunjangan-edit','tunjangan-delete']))
                    <th>Action</th> 
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($data as $tunjangan)
                <tr>
                  <td><?= $tunjangan->nama_tunjangan; ?> </td>
                  <td><?= $tunjangan->besar_tunjangan; ?> </td>
                  @if(auth()->user()->hasAnyPermission(['tunjangan-edit','tunjangan-delete']))
                  <td>
                    <div class="row">
                    @can('tunjangan-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('tunjangan.edit', $tunjangan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('tunjangan-delete')
                      <div class="col">
                        {!! Form::open(['method' => 'DELETE','route' => ['tunjangan.destroy', $tunjangan->id],'style'=>'display:inline']) !!}
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