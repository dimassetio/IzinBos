@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Pegawai</h1>    
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
                <th>Nama Pegawai</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Rekening</th>
                <th>Type Pegawai</th>
                <th>Bank ID</th>
                <th>Jabatan </th>
                <th>Bonus Loyalitas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pegawai as $pegawai)
                <tr>
                  <td><?= $pegawai->nama; ?> </td>
                  <td><?= $pegawai->email; ?> </td>
                  <td><?= $pegawai->alamat; ?> </td>
                  <td><?= $pegawai->tanggal_masuk; ?> </td>
                  <td><?= $pegawai->rekening; ?> </td>
                  <td><?= $pegawai->type_pegawai; ?> </td>
                  <td><?= $pegawai->bank_id; ?> </td>
                  <td><?= $pegawai->getJabatanName($pegawai->jabatan_id); ?></td>
                  <td><?= $pegawai->getBonus($pegawai->jabatan_id); ?></td>
                  
                  @if(auth()->user()->hasAnyPermission(['pegawai-edit','pegawai-delete']))
                  <td>
                    <div class="row justify-content-center">
                      <div class="mx-2">
                        <a class="btn btn-info btn-sm" href="{{route('pegawai.show', $pegawai->id)}}">show</a>
                      </div>
                    @can('pegawai-edit')
                      <div class="mx-2">
                        <a class="btn btn-primary btn-sm" href="{{route('pegawai.edit', $pegawai->id)}}">edit</a>
                      </div>
                      @endcan
                      @can('pegawai-delete')
                      <div class="mx-2">
                        {!! Form::open(['method' => 'DELETE','route' => ['pegawai.destroy', $pegawai->id],'style'=>'display:inline']) !!}
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
    @can('pegawai-create')        
        <a href="<?= route('pegawai.create') ?>" class="btn btn-app float-right">
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