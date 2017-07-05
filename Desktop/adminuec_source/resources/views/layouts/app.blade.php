<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
  <!-- Font Awesome -->
  <link rel='stylesheet' href="{{ asset('css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.easy-autocomplete.css') }}">
  <link rel="stylesheet" href="{{ asset('css/multi-select.css') }}">
  <link rel="stylesheet" href="{{ asset('datatables/css/dataTables.bootstrap.css') }}">
  @yield('styles')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <title>{{ config('app.name', 'Laravel') }}</title>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('../partials.topbar')
  @include('../partials.sidebar')
  <br>
  @if(Auth()->user()->role == "admin")
  <!-- Content Wrapper. Contains page content -->
    <form  action="{{ route('createPayment',1) }}"  method="get"  class="form-inline pull-right">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <div class="col-md-4">
          <input type="text" id="person" required="required" name="person" class="easy-auto-complete" placeholder="Representante">

        </div>
      </div>
      <div class="form-group">
        <div class="col-md-4">
          <input type="text" required="required" name="hijo" class="form-control" id="hijo" placeholder="Estudiante">
          <input type="hidden" name="idhijo" id="idhijo">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
    @endif
  <br>
    <div class="content-wrapper">
  <!-- /////////////////////////////////////////////////////////  Avisos del sistema  /////////////////////  -->

    @include('partials.errors')
    @include('partials.success')

    <!--  ////////////////////////////////////////////////////// Fin aviso del sistema /////////////// -->
    <!-- Content Header (Page header) -->

      <h1>
        U.E.C Arquidiocesano
        <small>Version 1.0</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

     @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    @include('../partials.footer')

    @include('../partials.rightbar')

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"> </script>
<script src="{{ asset('js/validacampo.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easy-autocomplete.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"> </script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"> </script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"> </script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- DataTables -->
<script src="{{ asset('datatables/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('datatables/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
  {!! Html::script('assets/js/jquery.easy-autocomplete.js') !!}
  <script>
    $(document).ready(function () {
      $("#person").easyAutocomplete({
        url: "/users/users",
        getValue: function(element) {
          return element.papaname+' '+element.papaape;
        },
        template: {
          type: "description",
          fields: {
            description: function(element) {
              return element.hijoname+' '+element.hijoape;
            }
          }
        },
        list: {
          match: {
            enabled: true
          },
          onSelectItemEvent: function() {
            var person = $("#person").getSelectedItemData();
            $('#hijo').val(person.id);
          },
          onClickEvent: function () {
            var person = $("#person").getSelectedItemData();
            console.log(person);
            $('#hijo').val(person.hijoname.concat(' ').concat(person.hijoape));
            $('#idhijo').val(person.student);
          },
          showAnimation: {
            type: "fade", //normal|slide|fade
            time: 400,
            callback: function() {}
          },

          hideAnimation: {
            type: "slide", //normal|slide|fade
            time: 400,
            callback: function() {}
          }
        },
        theme: "dark-light",
        ajaxSettings: {
          dataType: "json",
          method: "GET",
          data: {
          }
        },
        preparePostData: function(data) {
          data.term = $("#person").val();
          return data;
        },
        requestDelay: 500
      }).change(function () {
        $('#person_id').val('');
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#meses').select2({
        tags: true,
        tokenSeparators: [',']
      });
    });
  </script>
  <script type="text/javascript">
        $(function(){
            //Para escribir solo letras
            $('#nombre').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
            $('#apellido').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
            $('#nombreest').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
            $('#apellidoest').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
            $('#cedula').validCampoFranz('0123456789');
            $('#cedulaest').validCampoFranz('0123456789');
            $('#phone').validCampoFranz('0123456789-');
            $('#phone2').validCampoFranz('0123456789-');
            $('#phoneest').validCampoFranz('0123456789-');
            $('#phoneest2').validCampoFranz('0123456789-');
            $('#mensualidad').validCampoFranz('0123456789');
            $('#inscripcion').validCampoFranz('0123456789');
            $('#inscripcionpagada').validCampoFranz('0123456789');
        });
    </script>
@yield('scripts')

</body>
</html>
