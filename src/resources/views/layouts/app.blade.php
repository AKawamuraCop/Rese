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
            <h1 class="header__heading"><a class="logo modal-open-btn" data-toggle="modal" data-target="#MenuModal" data-title="" data-url=""><i class="fa-solid fa-bars-staggered"></i></a>Rese</h1>


            <div class="modal" id="MenuModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-overlay"></div>
            <div class="modal__inner">
                    <div class="modal__content" >
                        <a href="#" class="modal__close-btn">×
                        </a>
                        @if(Auth::check() && Auth::user()->hasVerifiedEmail())
                        <ul>
                            <li><a class="modal-link" href="/list">Home</a></li>
                            <li><a class="modal-link" href="/logout">Logout</a></li>
                            <li><a class="modal-link" href="/mypage">Mypage</a></li>
                            @if(Auth::user()->auth == 1)
                                <li><a class="modal-link" href="/managerRegistration">Manager Registration</a></li>
                            @elseif(Auth::user()->auth == 2)
                                <li><a class="modal-link" href="/restaurantRegistration">Restaurant Registration</a></li>
                                <li><a class="modal-link" href="/reservationList">Reservation List</a></li>
                            @endif
                        </ul>
                        @else
                        <ul>
                            <li><a class="modal-link" href="/login">Home</a></li>
                            <li><a class="modal-link" href="/register">Registration</a></li>
                            <li><a class="modal-link" href="/login">Login</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
<script>
// モーダルを開くボタンのイベントリスナーを設定
document.querySelector('.modal-open-btn').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('#MenuModal').classList.add('is-visible');
});

// モーダルのオーバーレイをクリックしてモーダルを閉じるイベントリスナーを設定
document.querySelector('.modal-overlay').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('#MenuModal').classList.remove('is-visible');
});


// モーダルクローズボタンとオーバーレイにクリックイベントを付与
document.querySelectorAll('.modal__close-btn, .modal-overlay').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = this.closest('.modal');
        if (modal) {
            modal.classList.remove('is-visible');
        }
    });
});

</script>
</html>