<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('ranz2.png') }}" type="image/x-icon">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

    <title>Ranz</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home.index') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('ranz2.png') }}" alt="RANZ Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">RANZ</span>
            </a>

            @include('layouts.partials.side-menu')
        </aside>

        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content mt-2">
                <div class="container-fluid">
                    @if (session('error'))
                    <x-forms.alert color="danger" :message="session('error')" />
                    @endif

                    @if (session('success'))
                    <x-forms.alert color="success" :message="session('success')" />
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <img src="{{ asset('ranz2.png') }}" alt="RANZ logo" height="24">
                RANZ.</strong> All rights
            reserved.
        </footer>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>

        <script src="{{ asset('plugins/adminlte/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('ranz/js/ranz.js') }}"></script>

        @stack('scripts')
    </div>
</body>

</html>