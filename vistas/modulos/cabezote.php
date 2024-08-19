<header class="main-header">
    <!-- LOGOTIPO -->
    <a href="home" class="logo">
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="vistas/img/plantilla/torre.png" class="img-responsive" style="padding:10px">
        </span>
		<!-- logo normal -->
		<span class="logo-lg">
			<img src="vistas/img/plantilla/pc-lab-blanco.png" class="img-responsive hidden-xs" alt="Logo PC-LAB Blanco">
			<!-- Logotipo más pequeño para dispositivos móviles (oculto en dispositivos extra-pequeños) -->
		</span>

    </a>

    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Botón de navegación -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- perfil de usuario -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="vistas/img/usuarios/torre.png" class="user-image">
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                        <!-- Para poder identificar qué usuario entró al sistema -->
                    </a>
                    <!-- Dropdown-toggle -->
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
