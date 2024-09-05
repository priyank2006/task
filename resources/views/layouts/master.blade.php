<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>

    {{-- Include CSS File --}}

    @include('includes.css')



</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('includes.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- /Sidebar -->



        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">
                @if (Session::has('success'))
                    <div class="alert alert-success text-success">{{ Session::get('success') }}</div>
                @endif

                @yield('main')

            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->




    {{-- Include JS File --}}
    @include('includes.js')

</body>

</html>
