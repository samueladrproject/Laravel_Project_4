<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="{{ URL::to('vendor/bootstrap5/css/bootstrap.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
        integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Custom Style --}}
    <link rel=" stylesheet" href="{{ URL::to('bin/css/style.css') }}">

    <title>SP DempsterShafer{{ isset($titlePage) ? ' || ' . $titlePage : '' }}</title>
</head>

<body>
    <div class="card kartu-100">
        <div class="card-header p-0">
            @include('Frontend.partials.navbar')
        </div>
        <div class="card-body p-0">
            <div class="container">
                @yield('content-wrapper')
            </div>
        </div>
        <div class="card-footer">
            @include('Frontend.partials.footer')
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::to('vendor/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 5 JS --}}
    <script src="{{ URL::to('vendor/bootstrap5/js/bootstrap.min.js') }}"></script>
</body>

</html>
