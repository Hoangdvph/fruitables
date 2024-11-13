<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('client.layouts.partials.head')
</head>

<body>

    <!-- Spinner Start -->
    @include('client.layouts.partials.spinner')
    <!-- Spinner End -->

    <!-- Navbar start -->
    @include('client.layouts.partials.navbar')
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('client.layouts.partials.modal-search')
    <!-- Modal Search End -->

    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer Start -->
    @include('client.layouts.partials.footer')
    <!-- Footer End -->

    <!-- Copyright Start -->
    @include('client.layouts.partials.copyright')
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
        class="fa fa-arrow-up"></i></a>

    @include('client.layouts.partials.js')
</body>

</html>
