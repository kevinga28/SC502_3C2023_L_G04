 <!-- Brand Logo -->
 <a href="../index.php" class="brand-link">
     <img src="../dist/img/logo.png" alt="Evolve_Logo" class="brand-image img-circle ">
     <span class="brand-text font-weight-light">Evolve</span>
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
     <!-- USUARIO ADMIN O ESTILISTA -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="info">
             <a id="nombreCompleto" href="../user.php">
                 <?php echo isset($_SESSION['datosEmpleado']['nombre']) ? $_SESSION['datosEmpleado']['nombre'] : ''; ?>
                 <?php echo isset($_SESSION['datosEmpleado']['apellido']) ? $_SESSION['datosEmpleado']['apellido'] : ''; ?>
             </a>
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
                 <a href="../index.php" class="nav-link">
                     <i class="nav-icon fas fa-home"></i>
                     <p>
                         Inicio
                     </p>
                 </a>
             </li>

             <li class="nav-item ">
                 <a href="#" class="nav-link ">
                     <i class="nav-icon fas fa-user"></i>
                     <p>
                         Clientes
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="../cliente/listaClientes.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista de Clientes</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../cliente/clientes.php" class="nav-link ">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Crear Clientes</p>
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
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="../cita/historialCitas.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Historial de Citas</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../cita/crearCita.php" class="nav-link">
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
                         <a href="../producto/productos.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista Productos</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="../producto/crearProducto.php" class="nav-link">
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

             <li class="nav-item menu-open">
                 <a href="#" class="nav-link active">
                     <i class="nav-icon fas fa-cut"></i>
                     <p>
                         Tratamientos
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="listaTratamiento.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Lista de Tratamiento</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="tratamiento.php" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Crear Tratamiento</p>
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="nav-header">Citas</li>
             <li class="nav-item">
                 <a href="../calendario/calendario.php" class="nav-link">
                     <i class="nav-icon far fa-calendar-alt"></i>
                     <p>
                         Calendario
                     </p>
                 </a>
             </li>

         </ul>

     </nav>
     <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->