@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Generate Gaji</h1>
@stop

@section('content')
  <div class="row">
    <div class="col">
      <div class="card ">
        <div class="card-body table-responsive">
          <table id="tableGaji" class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>Nama Pegawai</th>
                <th>Gaji Pokok</th>
                <th>Bonus Loyalitas</th>
                <th>Total Tunjangan</th>
                <th>Total Gaji</th>
                <th>Tanggal</th>
                @can('gaji-list')
                <th>Action</th> 
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($data as $gaji)
                <tr>
                  <td><?= $gaji->nama; ?> </td>
                  <td class="text-right">Rp. <?= number_format($gaji->gaji_pokok,0,",","."); ?> </td>
                  <td class="text-right">Rp. <?= number_format($gaji->bonus_loyalitas,0,",","."); ?> </td>
                  <td class="text-right">Rp. <?= number_format($gaji->total_tunjangan,0,",","."); ?> </td>
                  <td class="text-right">Rp. <?= number_format($gaji->total_gaji,0,",","."); ?> </td>
                  <td> {!! $gaji->tanggal !!} </td>
                  @can('gaji-list')
                  <td>
                      <div class="mx-2">
                        <a class="btn btn-info btn-sm" href="{{route('gaji.index', $gaji->id)}}">Show</a>
                      </div>
                  </td>
                  @endcan
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xs">
      @can('gaji-create')        
        {!! Form::open(array('route' => 'gaji.store','method' => 'POST')) !!}
          {!! Form::date('tanggal', \Carbon\Carbon::now(), array( 'class' => 'form-control')) !!}
          <button type="submit"  class="btn btn-app">
            <i class="fas fa-money-bill"></i> Generate Gaji
          </button>
        {!! Form::close() !!}
      @endcan
    </div> 
</div>

@stop

@section('js')
  <script> 
    $ ( function () {
        $('#tableGaji').DataTable();
    })
  </script>
@stop