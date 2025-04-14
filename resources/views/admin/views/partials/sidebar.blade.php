<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/html/ltr/vertical-menu-template/index.html">

                    <img id="logo-img" width="90px" height="auto" src="/images/phenix_logo.png" alt="Logo" />

                    <h2 class="d-none brand-text">Phenix</h2>
                </a></li>
            <li hidden class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/dashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Tableau de bord</span></a>

            </li>
            <li class=" navigation-header"><span data-i18n="Gestion &amp; ERP">Gestion &amp; ERP</span><i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item {{ request()->is('admin/employes*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/employes">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Gestion des employés</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/paiements*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/paiements">
                    <i data-feather="dollar-sign"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Gestion des paiements</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/etats_paiements*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/etats_paiements">
                    <i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Etats des paiements</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/taxes_cotisations*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/taxes_cotisations">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Taxes et cotisations</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/gestion_conges*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/gestion_conges">
                    <i data-feather="calendar"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Gestion des congés</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/notifications*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/notifications">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Notifications</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/parametres*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/parametres">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Paramètres</span>
                </a>
            </li>

            <li class=" nav-item {{ request()->is('admin/supports*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/admin/supports">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Sujets">Support</span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
