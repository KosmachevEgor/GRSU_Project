<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'public/css/sidebar.css',
        'public/js/sidebar.js',
        'public/css/admin/style.css'
        ])
    <title>Laravel_Project</title>
</head>
<body>
    <!--SideBar-->
    @include('admin.includes.sidebar')
    <div class='section'>
        @yield('content')
    </div>
</body>
</html>
