<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <?php
      if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
        if ($_SESSION["perfil"] == "Administrador") {
          
                    // Mostrar el menú completo para otros tipos de usuarios
                    echo '
                    <li class="active">
                    <a href="home">
                      <i class="fa fa-home"></i>
                      <span>Inicio</span>
                    </a>
                  </li>
                    <li class="active">
                      <a href="usuarios">
                        <i class="fa fa-user"></i>
                        <span>Usuarios</span>
                      </a>
                    </li>
                    <li>
                      <a href="clientes">
                        <i class="fa fa-users"></i>
                        <span>Clientes</span>
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-list-ul"></i>
                        <span>Pagos</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li>
                          <a href="pagos">
                            <i class="fa fa-circle-o"></i>
                            <span>Administrar Pagos</span>
                          </a>
                        </li>
                        <li>
                          <a href="crear-pago">
                            <i class="fa fa-circle-o"></i>
                            <span>Crear Pago</span>
                          </a>
                        </li>
                        <li>
                          <a href="reportes">
                            <i class="fa fa-circle-o"></i>
                            <span>NO Pagagados</span>
                          </a>
                        </li>
                        <li>
                        <a href="reportes">
                          <i class="fa fa-circle-o"></i>
                          <span>SI Pagados</span>
                        </a>
                      </li>
                        <li>
                    </li>';
        } else {
                    // Mostrar solo el enlace "Crear Pago" para usuarios de tipo "vendedor"
                    echo '
                    <li class="active">
                    <a href="home">
                      <i class="fa fa-home"></i>
                      <span>home</span>
                    </a>
                  </li>
                    <li class="treeview">
                    <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Pagos</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                    <li>
                      <a href="pagos">
                      <i class="fa fa-circle-o"></i>
                      <span>Administrar Pagos</span>
                      </a>
                    </li>
                    <li>
                      <a href="crear-pago">
                      <i class="fa fa-circle-o"></i>
                      <span>Crear Pago</span>
                      </a>
                    </li>
                    </ul>
                  </li>';
        }
      }
      ?>
    </ul>
  </section>
</aside>