<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="{{ asset('ranz2.png') }}" type="image/x-icon">

    {{--
    <link rel="stylesheet" href="{{ asset('summernote\summernote-lite.min.css') }}"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ranz/css/ranz.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <style>
        .ranz-border {
            border-top: 5px solid rgb(44, 109, 183);
            border-radius: 10px;
        }

        /* Tombol di pojok kanan bawah */
        .back-to-top {
            position: fixed;
            bottom: 60px;
            right: 20px;
            background-color: #0d5db1;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 50px;
            cursor: pointer;
            display: none;
            z-index: 1000;
        }

        .back-to-top:hover {
            background-color: #032244;
        }

        .active {
            background-color: rgba(169, 169, 169, 0.2);
            border-radius: 50px;
        }
    </style>

    @yield('head')

    <title>Ranz</title>

</head>

<body class="bg-light">
    <!-- Tombol Back to Top -->
    <button class="back-to-top" id="backToTop" type="button"><i class="fa-solid fa-chevron-up"></i></button>

    @if (!request()->routeIs('login') && !request()->routeIs('user.register.form') &&
    !request()->routeIs('password.reset'))
    @include('layouts.partials.top-nav')
    @endif

    <div class="container" style="margin-bottom: 80px">

        @if (session('error'))
        <x-forms.error-alert :message="session('error')" />
        @endif

        @if (session('success'))
        <x-forms.success-alert :message="session('success')" />
        @endif

        @yield('content')
    </div>

    @if (!request()->routeIs('login') && !request()->routeIs('user.register.form') &&
    !request()->routeIs('password.reset'))
    @include('layouts.partials.footer')
    @include('admin.auth.partials.change-passsword')
    @endif


    <script src="{{ asset('ranz/js/ranz.js') }}"></script>

    <script>
        const backToTopBtn = document.getElementById("backToTop");

        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        backToTopBtn.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
    @stack('scripts')
</body>

</html>