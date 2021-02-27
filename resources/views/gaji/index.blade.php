@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
<div class="row">
  <div class="col col-sm-6 mx-auto">
    <div class="card w-75 mx-auto">
      <div class="card-header text-center">
        @if(empty($data))
          <h5>Belum Ada Data Tersedia!</h5>
        @else
          <h5>Detail Gaji Pegawai</h5>
      </div>   
      <div class="card-body table-striped p-0">
        <table id="example1" class="table  table-striped">
          <tbody>
            <tr>
              <td class="w-25">Nama </td>
              <td> : </td>
              <td><?= $data->nama; ?> </td>
            </tr>
            <tr>
              <td class="w-25">Tanggal </td>
              <td> : </td>
              <td><?= $data->tanggal; ?> </td>
            </tr>
            <tr>
              <td>Total Gaji </td>
              <td> : </td>
              <td><?= $data->total_gaji; ?> </td>
            </tr>
            <tr>
              <td>Bonus Loyalitas </td>
              <td> : </td>
              <td><?= $data->bonus_loyalitas; ?> </td>
            </tr>
            <tr>
              <td>Total Tunjangan </td>
              <td> : </td>                            
              <td><?= $data->total_tunjangan; ?></td>
            </tr>
            @if($data->total_tunjangan > 0)
            <tr>
              <td>Rincian Tunjangan </td>
              <td colspan="2"> 
              @foreach($tunjangan as  $tunjangan)
                <li>
                  <?= $tunjangan->nama_tunjangan; ?> 
                  :
                  <?= $tunjangan->nominal_tunjangan; ?>
                </li>
                @endforeach
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      @endif
      </div>
      <div class="card-footer text-center">
        <a href=" <?= route('users.index') ?> " class="btn btn-primary btn-sm">Back</a>
      </div>
    </div>
  </div>
</div>
@stop