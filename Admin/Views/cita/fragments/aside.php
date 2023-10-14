 <!-- Brand Logo -->
 <a href="index.html" class="brand-link">
     <img src="../dist/img/AdminLTELogo.png" alt="Evolve_Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Evolve</span>
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
     <!-- USUARIO ADMIN O ESTILISTA -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
             <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
             <a href="#" class="d-block">Administrador</a>
         </div>
     </div>

     <!-- SidebarSearch Form -->
     <style>
         /* Cambiar el color del texto de búsqueda en la lista de resultados */
         .sidebar-search-results .list-group-item {
             color: #8B5C4A;
         }

         .sidebar-search-results .list-group-item:hover {
             color: #BC1939;
         }

         strong.text-light {
             color: #202126 !important;

         }
     </style>

     <div class="form-inline">
         <div class="input-group" data-widget="sidebar-search">
             <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
             <div class="input-group-append">
                 <button class="btn btn-sidebar">
                     <i class="fas fa-search fa-fw"></i>
                 </button>
             </div>
         </div>
     </div>

     <!-- Sidebar Menu -->

      <style>
         /* Cambiar el color del icono y lista */
         .nav-pills .nav-link {
             color: #202126;
         }
     </style>
     
     <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

             <li class="nav-item">
                 <a href=".." class="nav-link">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                         Estadisticas
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>General</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../cliente/clientes.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Clientes</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../empleado/empleados.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Empleados</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../producto/producto.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Inventario</p>
                         </a>
                     </li>
                 </ul>

             </li>

             <li class="nav-item">
                 <a href="" class="nav-link">
                     <i class="nav-icon fas fa-copy"></i>
                     <p>
                         Citas
                         <i class="fas fa-angle-left right"></i>
                         <span class="badge badge-info right">6</span>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="historialCitas.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Historial de Citas</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="crearCita.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Crear Cita</p>
                         </a>
                     </li>

                 </ul>

             </li>

             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-tree"></i>
                     <p>
                         Inventario
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="../producto/listaProducto.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista Productos</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../producto/producto.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Agregar Producto</p>
                         </a>
                     </li>

                 </ul>
             </li>

             <li class="nav-item">  
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-edit"></i>
                     <p>
                         Facturas
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="../factura/listaFactura.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista de Facturas</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../factura/facturas.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Crear Factura</p>
                         </a>
                     </li>

                 </ul>
             </li>

             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-table"></i>
                     <p>
                         Gestion de Empleados
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="../empleado/listaEmpleado.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista de Empleados</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../empleado/empleados.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Crear Empleado</p>
                         </a>
                     </li>

                 </ul>
             </li>

             <li class="nav-header">Citas</li>
             <li class="nav-item">
                 <a href="calendar.html" class="nav-link">
                     <i class="nav-icon far fa-calendar-alt"></i>
                     <p>
                         Calendario
                         <span class="badge badge-info right">2</span>
                     </p>
                 </a>
             </li>

         </ul>

     </nav>
     <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->