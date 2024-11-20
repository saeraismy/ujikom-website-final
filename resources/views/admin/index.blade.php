<!DOCTYPE html>
<html>

<head>
    @include('admin.partials.css')

    <link rel="shortcut icon" href="{{ asset('images/logoSMKN4.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    @include('admin.partials.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.partials.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.partials.javascript')
</body>

</html>
