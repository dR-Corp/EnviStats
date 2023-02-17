<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-white">
        <img src="<?= ASSETS ?>dist/img/log2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-1"
            style="opacity: 1">
        <span class="brand-text font-weight-bold">EnviStats</span>
    </a>

    <?php $page_active = isset($_GET["page"]) ? $_GET["page"] : "dashboard";  ?>

    <!-- Sidebar -->
    <div class="sidebar">
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="./dashboard" class="nav-link <?= $page_active == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fas fa-chart-pie"></i>
                        <p class="font-weight-bold">
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./categorie" class="nav-link <?= $page_active == 'categorie' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p class="font-weight-bold">
                            Catégories
                            <span class="badge badge-success right"><?= count(all("categorie")) ?></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./scategorie" class="nav-link <?= $page_active == 'scategorie' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-code-branch"></i>
                        <p class="font-weight-bold">
                            Sous catégories
                            <span class="badge badge-success right"><?= count(all("scategorie")) ?></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./indicateur" class="nav-link <?= $page_active == 'indicateur' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p class="font-weight-bold">
                            Indicateurs
                            <span class="badge badge-success right"><?= count(all("indicateur")) ?></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./collecte" class="nav-link <?= $page_active == 'collecte' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p class="font-weight-bold">
                            Collectes
                            <span class="badge badge-success right"><?= count(all("collecte")) ?></span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>