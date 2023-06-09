<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    @include('templates.link')
</head>

<body>
    <div class="wrapper">

        @include('templates.navbar')

        <div class="main">
            @include('templates.topbar')


            @yield('content')

            @include('templates.footer')
        </div>
    </div>

    @include('templates.script')

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
