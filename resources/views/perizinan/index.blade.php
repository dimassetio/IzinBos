@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Izin Pegawai</h1>    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card ">
            <div class="card-header">
                <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table id="example1" class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tipe Izin</th>
                <th>Keterangan</th>
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
                    @if($izin->pegawai_id != null)
                      <?= $izin->getNamaPegawai($izin->pegawai_id); ?>
                    @else 
                      <a href="#" class="badge badge-danger">Tidak Ada</a>
                    @endif
                  </td>
                  <td><?= $izin->tanggal_mulai; ?> </td>
                  <td><?= $izin->tanggal_selesai; ?> </td>
                  <td><?= $izin->type_izin; ?> </td>
                  <td><?= $izin->keterangan; ?> </td>
                  <td>
                    @if($izin->status_diterima == 'menunggu')
                      <a class="badge badge-warning p-2">                    
                    @elseif($izin->status_diterima == 'diterima')
                      <a class="badge badge-success p-2">
                    @elseif($izin->status_diterima == 'ditolak')
                      <a class="badge badge-danger p-2">
                    @endif
                      <?= $izin->status_diterima; ?> 
                    </a>
                  </td> 
                  @if(auth()->user()->hasAnyPermission(['izin-edit','izin-delete']))
                  <td>
                    <div class="row justify-content-center">
                    <div class="mx-2">
                      <a href=" <?= route('izin.show',$izin->id) ?> " class="btn btn-info btn-sm">Show</a>
                    </div>
                    @can('izin-edit')
                      <div class="mx-2">
                        <a class="btn btn-primary btn-sm" href="{{route('izin.edit', $izin->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('izin-delete')
                      <div class="mx-2">
                        {!! Form::open(['method' => 'DELETE','route' => ['izin.destroy', $izin->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                      </div>
                      @endcan
                      @if($izin->status_diterima == 'menunggu')
                      @can('izin-confirmation')
                      <div class="mx-2">
                        {!! Form::open(['method' => 'patch','route' => ['izin.confirm', $izin->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Terima', ['class' => 'btn btn-success btn-sm']) !!}
                        {!! Form::close() !!}<!-- <a class="btn btn-success btn-sm" href="{{route('izin.confirm', $izin)}}">terima</a> -->
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
        <a href="<?= route('izin.create') ?>" class="btn btn-app float-right">
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
    <script> console.log('Hi!'); </script>
@stop