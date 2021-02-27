@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Izin Pegawai</h1>

@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <div class="card-body table-responsive ">
            <table id="tableIzin" class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tipe Izin</th>
                <!-- <th>Keterangan</th> -->
                <th>Status Diterima</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach($izin as $izin)
                <tr>
                  <td> <?= $no; ?></td>
                  <?php $no++; ?>
                  <td>
                    @if($izin->nama != null)
                      <?= $izin->nama; ?>
                    @else 
                      <a href="#" class="badge badge-danger">Tidak Ada</a>
                    @endif
                  </td>
                  <td><?= $izin->tanggal_mulai; ?> </td>
                  <td><?= $izin->tanggal_selesai; ?> </td>
                  <td><?= $izin->type_izin; ?> </td>
                  <!-- <td><?= $izin->keterangan; ?> </td> -->
                  <td>
                    @if($izin->status_diterima == 'menunggu')
                      <a class="badge badge-warning p-2 ">                    
                    @elseif($izin->status_diterima == 'diterima')
                      <a class="badge badge-success p-2 text-white">
                    @elseif($izin->status_diterima == 'ditolak')
                      <a class="badge badge-danger p-2 text-white">
                    @endif
                      <?= $izin->status_diterima; ?> 
                    </a>
                  </td> 
                  @if(auth()->user()->hasAnyPermission(['izin-edit','izin-delete']))
                  <td>
                    <div class="row justify-content-center">
                    <div class="m-2">
                      <a href=" {!! route('izin.show', $izin->id) !!} " class="btn btn-info btn-sm">Show</a>
                    </div>
                    @if ($izin->status_diterima != 'ditolak')
                      @can('izin-edit')
                      <div class="m-2">
                        <a class="btn btn-primary btn-sm" href="{{route('izin.edit', $izin->id)}}">edit</a>
                      </div>
                      @endcan
                    @endif
                      @can('izin-delete')
                      <div class="m-2">
                        {!! Form::open(['method' => 'DELETE','route' => ['izin.destroy', $izin->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-secondary btn-sm']) !!}
                        {!! Form::close() !!}
                      </div>
                      @endcan
                      @if($izin->status_diterima == 'menunggu')
                      @can('izin-confirmation')
                      <div class="m-2">
                        {!! Form::open(['method' => 'patch','route' => ['izin.confirm', $izin->id],'style'=>'display:inline']) !!}
                          <button type="submit" name="status_diterima" value="diterima" class="btn btn-success btn-sm">Terima</button>
                        {!! Form::close() !!}
                      </div>
                      <div class="m-2">
                        {!! Form::open(['method' => 'patch','route' => ['izin.confirm', $izin->id],'style'=>'display:inline']) !!}
                          <button type="submit" name="status_diterima" value="ditolak" class="btn btn-danger btn-sm">Tolak</button>                          
                        {!! Form::close() !!}
                      </div>
                      @endcan
                      @endif
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
    @can('izin-create')        
    <div class="m-1">
        <a href="<?= route('izin.create') ?>" class="btn btn-app float-right">
            <i class="fas fa-edit"></i> Tambah
        </a>
    </div>
    @endcan
    @can('izin-confirmation')
    <div class="m-1">
        <a href="<?= route('izin.laporan') ?>" class="btn btn-app float-right">
            <i class="fas fa-save"></i> Laporan
        </a>
    </div>
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
        $('#tableIzin').DataTable();
    })
    </script>
@stop                                                                                                                                                                                                                           