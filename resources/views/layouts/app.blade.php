<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Phénix ERP')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(session('token'))
    <meta name="bearer-token" content="{{ session('token') }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/dist/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/atlantis.css"> -->
    <link rel="stylesheet" href="../assets/css/demo.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @if (Auth::check())
            <header class="header fixed d-flex justify-content-start">
                <div class="sidebar-header ">
                    <a href="/dashboard">
                        <img src="/assets/img/PHENIX_LOGO.png" width="100px" height="auto" alt="Phenix ERP Logo">
                    </a>
                </div>
                <div class="d-flex w-100 justify-content-between align-items-center">

                    <div class="header-content">
                        <h1><strong>Bienvenu, {{ Auth::user()->name }}</strong></h1>
                        <div class="user-info">
                            <p><small><strong>Vendredi 10 Janvier 2025</strong></small></p>
                        </div>
                    </div>
                    <div class="data">
                        <ul class="menu d-none d-md-flex">
                            <li class="dropdown">
                                <a href="#menu" class="dropdown-toggle menu-link" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    <div class="menu-avatar">
                                        <img src="../../assets/img/profile.jpg" alt="User Avatar" class="avatar">
                                        <div style="display: flex; flex-direction:column">
                                            <span class="auth-user-name">{{ Auth::user()->name }}</span>
                                            <span class="auth-user-role">{{ Auth::user()->role }}</span>
                                        </div>
                                    </div>
                                </a>

                                <ul class="dropdown-menu">
                                    @auth
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Se déconnecter</button>
                                        </form>
                                    </li>
                                    @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Se connecter</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}">S'inscrire</a></li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main>
                @yield('content')
            </main>
            @else
            <script>
                // alert('Please');
                window.location.href = "{{ route('login') }}";
            </script>
            @endif

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <script src="../assets/js/atlantis.min.js"></script>

    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
    <!-- @vite(['resources/js/app.js']) -->

    @stack('scripts')
    <!-- Include your JS -->
</body>

</html>
