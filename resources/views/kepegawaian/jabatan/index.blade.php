@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Jabatan</h1>    

@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <div class="card-body table-responsive">
            <table id="tableJabatan" class="table table-bordered table-hover text-center justify-content-center">
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
                  <td id="besarGaji" class="text-right">Rp. <?= number_format($jabatan->gaji_pokok,0,",","."); ?> </td>
                  <td id="besarBonus" class="text-right">Rp. <?= number_format($jabatan->bonus_professional,0,",","."); ?> </td>
                  @if(auth()->user()->hasAnyPermission(['jabatan-edit','jabatan-delete']))
                  <td>
                    <div class="row justify-content-center">
                    @can('jabatan-edit')
                      <div class="mx-2">
                        <a class="btn btn-primary btn-sm" href="{{route('jabatan.edit', $jabatan->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('jabatan-delete')
                      <div class="mx-2">
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
    <div class="col-xs">
    @can('jabatan-create')        
        <a href="<?= route('jabatan.create') ?>" class="btn btn-app float-right">
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
      $('#tableJabatan').DataTable();
    })
    $('.price').priceFormat({
      prefix: 'Rp. ',
      centsLimit: 0,
      thousandsSeparator: '.'
    });
  </script>
@stop