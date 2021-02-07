<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  

  <a class="navbar-brand text-warning" href="#">
    <img src="assets/img/EggL.png" class="img-fluid" style="width: 1.4em">
    Las Tunas</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= ($nombre == 'Recogida') ? 'active' : '' ?>">
        <a href="?c=recogida" class="nav-link">Recogida</a>
      </li>
      <li class="nav-item <?= ($nombre == 'Galpon') ? 'active' : '' ?>">
        <a href="?c=Galpon" class="nav-link">Galpón</a>
      </li>
      <li class="nav-item <?= ($nombre == 'ControlAves') ? 'active' : '' ?>">
        <a href="?c=ControlAves" class="nav-link">Control de Aves</a>
      </li>
      <?php if ($_SESSION['nombreUsuario'] == 'Admin'): ?>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#Responsables">Responsables</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#Usuario">Usuarios</a>
        </li>
      <?php endif ?>

      <li class="nav-item dropdown <?= ($nombre == 'Reportes') ? 'active' : '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- <a class="dropdown-item" href="?c=Reportes&p=CierreMes">Cierre de Mes</a> -->
          <a class="dropdown-item" href="?c=Reportes&p=ProduccionDiaria">Producción Diaria</a>
          <a class="dropdown-item" href="?c=Reportes&p=ProduccionEntreFechas">Producción Entre Fechas</a>
          <a class="dropdown-item" href="?c=Reportes&p=FormatoDistribucion">Formato de Distribución</a>
        </div>
      </li>
    </ul>
    <a data-toggle="modal" data-target="#Salir" class="btn btn-danger py-0 m-0"><i class="fas fa-sign-out-alt"></i></a>
  </div>
</nav>
