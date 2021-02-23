@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Potongan</h1>

@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <div class="card-body table-responsive">
            <table id="tablePotongan" class="table table-bordered table-hover text-center">
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
                  <td class="text-right">Rp. <?= number_format($potongan->besar_potongan,0,",","."); ?> </td>
                  @if(auth()->user()->hasAnyPermission(['potongan-edit','potongan-delete']))
                  <td>
                    <div class="row justify-content-center">
                    @can('potongan-edit')
                      <div class="mx-2">
                        <a class="btn btn-primary btn-sm" href="{{route('potongan.edit', $potongan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('potongan-delete')
                      <div class="mx-2">
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
    <div class="col-xs">
    @can('potongan-create')        
        <a href="<?= route('potongan.create') ?>" class="btn btn-app float-right">
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
    $('#tablePotongan').DataTable();
  })

    $('#besarPotongan').priceFormat({
      prefix: 'Rp. ',
      centsLimit: 0,
      thousandsSeparator: '.'
    });
  </script>
@stop