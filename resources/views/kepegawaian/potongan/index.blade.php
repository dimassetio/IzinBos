@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Data Potongan</h1>
@stop

@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      @can('potongan-create')
        <div class="box-header">
         <a href="potongan/create" class="btn btn-primary btn-sm my-3"> Tambah Potongan </a>
        </div>
      @endcan
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nama Potongan</th>
                <th>Besar Potongan</th>
                @if(auth()->user()->hasAnyPermission(['potongan-edit','potongan-delete']))
                    <th>Action</th> 
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($data as $potongan)
                <tr>
                  <td><?= $potongan->nama_potongan; ?> </td>
                  <td><?= $potongan->besar_potongan; ?> </td>
                  @if(auth()->user()->hasAnyPermission(['potongan-edit','potongan-delete']))
                  <td>
                    <div class="row">
                    @can('potongan-edit')
                      <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{route('potongan.edit', $potongan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('potongan-delete')
                      <div class="col">
                        {!! Form::open(['method' => 'DELETE','route' => ['potongan.destroy', $potongan->id],'style'=>'display:inline']) !!}
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