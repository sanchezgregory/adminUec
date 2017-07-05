<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('storage/'.auth()->user()->img)  }}" class="img-circle" alt="User Image" height="15  0" width="100">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->person->FullName}} </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="{{ route('indexPerson') }}" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            @if (Auth()->user()->role == 'admin')
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Personal</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('createPerson') }}"><i class="fa fa-circle-o"></i>Registrar Personal</a></li>
                        <li class="active"><a href="{{ route('indexPerson') }}"><i class="fa fa-circle-o"></i>Listar Representantes</a></li>
                        <li class="active"><a href="{{ route('indexStudent') }}"><i class="fa fa-circle-o"></i>Estudiantes por seccion</a></li>
                        <li class="active"><a href="{{ route('defaulter') }}"><i class="fa fa-circle-o"></i>Estudiantes morosos</a></li>
                    </ul>
                </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Reporte de Pagos</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="{{ route('indexpayment') }}"><i class="fa fa-circle-o"></i> Listar pagos</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Configuracion de Pagos</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="{{ route('indexSetting') }}"><i class="fa fa-circle-o"></i> Configuracion</a></li>
                </ul>
            </li>
            @endif
            @if(Auth()->user()->role == 'user')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Ver cuenta personal</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('indexUser') }}"><i class="fa fa-circle-o"></i> Ver cuenta</a></li>
                </ul>
            </li>
                @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

