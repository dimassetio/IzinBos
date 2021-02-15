@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Data User List</h1>
@stop


@section('content')

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= $user->name; ?></h3>
              <h5 class="widget-user-desc"><?= $user->email; ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Role 
                  @foreach($userRole as $dataRole)
                  <span class="pull-right badge bg-blue"><?= $dataRole; ?></span>
                  @endforeach
                </a></li>
                <li><a href="#">Permission 
                  @foreach($userPermission as $dataPermission)
                  <span class="pull-right badge bg-blue"><?= $dataPermission; ?></span>
                  @endforeach
                </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop