@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Tunjangan</h1>    
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
            <table id="tableTunjangan" class="table table-bordered table-hover text-center">
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
                  <td class="text-right">Rp. <?= number_format($tunjangan->besar_tunjangan,0,",","."); ?> </td>
                  @if(auth()->user()->hasAnyPermission(['tunjangan-edit','tunjangan-delete']))
                  <td>
                    <div class="row justify-content-center">
                    @can('tunjangan-edit')
                      <div class="mx-2">
                        <a class="btn btn-primary btn-sm" href="{{route('tunjangan.edit', $tunjangan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('tunjangan-delete')
                      <div class="mx-2">
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
    <div class="col-xs">
    @can('tunjangan-create')        
        <a href="<?= route('tunjangan.create') ?>" class="btn btn-app float-right">
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
  <script> 
    $ ( function () {
        $('#tableTunjangan').DataTable();
    })
  </script>
@stop