@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Pegawai</h1>    

@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
            <div class="card-body">
            <table id="tablepegawai" class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>Nama Pegawai</th>
                <th>Email</th>
                <!-- <th>Alamat</th> -->
                <!-- <th>Tanggal Masuk</th> -->
                <!-- <th>Rekening</th> -->
                <th>Type Pegawai</th>
                <!-- <th>Bank ID</th> -->
                <th>Jabatan </th>
                <!-- <th>Bonus Loyalitas</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pegawai as $pegawai)
                <tr>
                  <td><?= $pegawai->nama; ?> </td>
                  <td><?= $pegawai->email; ?> </td>
                  <!-- <td><?= $pegawai->alamat; ?> </td> -->
                  <!-- <td><?= $pegawai->tanggal_masuk; ?> </td> -->
                  <!-- <td><?= $pegawai->rekening; ?> </td> -->
                  <td><?= $pegawai->type_pegawai; ?> </td>
                  <!-- <td><?= $pegawai->bank_id; ?> </td> -->
                  <td>
                    @if($pegawai->jabatan_id != null)
                      <?= $pegawai->getJabatanName($pegawai->jabatan_id); ?>
                    @else 
                      <a href="#" class="badge badge-danger">Tidak Ada</a>
                    @endif
                  </td>
                  <!-- <td><?= $pegawai->bonus_loyalitas; ?></td> -->
                  
                  @if(auth()->user()->hasAnyPermission(['pegawai-edit','pegawai-delete']))
                  <td>
                    <div class="row justify-content-center">
                      <div class="mx-2">
                        <a class="btn btn-info btn-sm" href="{{route('pegawai.show', $pegawai->id)}}">show</a>
                      </div>
                      @can('biodata-edit')
                      <div class="mx-2">
                        <a class="btn btn-warning btn-sm" href="{{route('pegawai.edit', $pegawai->id)}}">Edit</a>
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
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    $ ( function () {
        $('#tablepegawai').DataTable();
    })
</script>
@stop