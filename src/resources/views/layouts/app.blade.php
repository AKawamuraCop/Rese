<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href= "{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/common.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">Rese</h1>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>