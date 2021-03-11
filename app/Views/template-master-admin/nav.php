<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#!" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <form id="search-form" action="<?= base_url('/admin/student/search'); ?>" method="GET">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" name="name-student" type="search" placeholder="Search Student" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit" id="search-student" style="padding: 0.30rem 0.5rem !important;">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">   
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#!" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>

</nav>