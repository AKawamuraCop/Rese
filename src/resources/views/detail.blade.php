@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
@if (session('msg'))
<div class="flash_message">
    {{ session('msg') }}
</div>
@endif
<div class="detail-container">
    <div class = "restaurant-info">
        <div class="restaurant-title">
            @if($route == "list")
            <a href="/list" class="btn btn-secondary">＜</a>
            @elseif($route == "mypage")
            <a href="/mypage" class="btn btn-secondary">＜</a>
            @endif
            <h1 class="restaurant-head">{{ $restaurant->name }}</h1>
        </div>
        @if($restaurant->image)
        <div class="restaurant-image">
            <img src="{{ preg_match('/^http/', $restaurant->image) ? $restaurant->image : asset($restaurant->image) }}" alt="Restaurant Image" class="restaurant-card__image">
        </div>
        @else
        <div class="image-default">
            <i class="fa-solid fa-image"></i>
        </div>
        @endif
        <div class="restaurant-detail">
            @foreach($restaurant->areas as $area)
                <span class="tag">#{{ $area->name }}</span>
            @endforeach
            @foreach($restaurant->genres as $genre)
                <span class="tag">#{{ $genre->name }}</span>
            @endforeach
            <p>{{ $restaurant->description }}</p>
        </div>
        <div class="feedback-section">
            @if(Auth::user()->auth ==1)
                <button class="feedback-info-button" onclick="window.location.href='{{ route('feedback.all', $restaurant->id) }}'">全ての口コミ情報</button>
            @endif
            @if($feedback != null)
                <button class="feedback-info-button" onclick="window.location.href='{{ route('feedback.all', $restaurant->id) }}'">全ての口コミ情報</button>
                <div class="feedback-container">
                    <div class="feedback-card">
                        <div class="feedback-edit">
                            @if(Auth::user()->auth ==3)
                                <a href="/feedback/update/{{$restaurant->id}}">口コミを編集</a>
                                <a href="/feedback/delete/{{$restaurant->id}}">口コミを削除</a>
                            @endif
                        </div>
                        <div class="feedback-rating">
                            <span class="feedback-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $feedback->rating ? 'filled' : '' }}">★</span>
                                @endfor
                            </span>
                        </div>
                        <div class="feedback-content">
                            <p>{{ $feedback->comment }}</p>
                        </div>
                    </div>
                </div>
            @else
                @if(Auth::user()->auth ==3)
                    <a class="feedback-link" href="/feedback/{{$restaurant->id}}">口コミを投稿する</a>
                @endif
            @endif
        </div>
    </div>
    @if($show == 'reservation')
        <div class="reservation-form">
            <div class="reservation-title">
                <h2>予約</h2>
            </div>
            <form class="reservation-form-inner" action="/reserve" method="post">
                @csrf
                <input type="hidden" name="route" value="{{ $route }}">
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <div class="reservation-input">
                    <input type="date" id="dateInput" name="date" value="{{ old('date') }}">
                </div>
                <p class="form__error-message">
                    @error('date')
                        {{ $message }}
                    @enderror
                </p>
                <div class="reservation-input">
                <select name="time" id="timeInput" >
                    <option value="">時間を選択</option>
                        @foreach (range(9, 23) as $hour)
                            @foreach (range(0, 1) as $half)
                                @php
                                    $hourFormatted = str_pad($hour, 2, '0', STR_PAD_LEFT);
                                    $minuteFormatted = $half * 30;
                                    $time = "{$hourFormatted}:" . str_pad($minuteFormatted, 2, '0', STR_PAD_LEFT);
                                    $reservationTime = isset($reservation) ? \Carbon\Carbon::parse($reservation->time)->format('H:i') : '';
                                @endphp
                                <option value="{{ $time }}" {{ old('time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        @endforeach
                </select>
                </div>
                <p class="form__error-message">
                    @error('time')
                        {{ $message }}
                    @enderror
                </p>
                <div class="reservation-input">
                    <select id="numberInput" name="number" >
                        <option value="">人数を選択</option>
                        @foreach (range(1, 10) as $number)
                            <option value="{{ $number }}"{{ old('number') == $number ? 'selected' : '' }}>{{ $number }}人</option>
                        @endforeach
                    </select>
                </div>
                <p class="form__error-message">
                    @error('number')
                        {{ $message }}
                    @enderror
                </p>
                <div class="summary-card">
                    <div id="summary">
                        <p id="restaurantName">Shop <span></span></p>
                        <p id="selectedDate">Date <span></span></p>
                        <p id="selectedTime">Time <span></span></p>
                        <p id="selectedNumber">Number <span></span></p>
                    </div>
                </div>
                <button type="submit">予約する</button>
            </form>
        </div>
    @elseif($show == 'review')
        <div class="review-form">
            <h2 class="review">評価</h2>
            <form class="review-form__inner" action="/review" method="post">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <div class="rating">
                        <input type="radio" name="rating" value="1" id="1">
                        <label for="1">★</label>
                        <input type="radio" name="rating" value="2" id="2">
                        <label for="2">★</label>
                        <input type="radio" name="rating" value="3" id="3">
                        <label for="3">★</label>
                        <input type="radio" name="rating" value="4" id="4">
                        <label for="4">★</label>
                        <input type="radio" name="rating" value="5" id="5">
                        <label for="5">★</label>
                    </div>
                    <div class ="comment-area">
                        <textarea class="comment-inner"name="comment" rows="5" placeholder="コメントを書く"></textarea>
                    </div>
                    <button class="review-button">評価する</i></button>
            </form>
        </div>
    @endif
    @if($qrCode)
    <div class="qr-code-section">
        <h3>QRコードで予約情報を確認</h3>
            {!! $qrCode !!}
        <div id="reader" style="width: 250px; height: 250px;"></div>
    </div>
    @endif
</div>

<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    const timeInput = document.getElementById('timeInput');
    const numberInput = document.getElementById('numberInput');
    const restaurantName = '{{ $restaurant->name }}';

    function updateSummary() {
        document.getElementById('restaurantName').querySelector('span').textContent = restaurantName;
        document.getElementById('selectedDate').querySelector('span').textContent = dateInput.value || '';
        document.getElementById('selectedTime').querySelector('span').textContent = timeInput.value || '';
        document.getElementById('selectedNumber').querySelector('span').textContent = numberInput.value ? numberInput.value + '人' : '';
    }

    dateInput.addEventListener('change', updateSummary);
    timeInput.addEventListener('change', updateSummary);
    numberInput.addEventListener('change', updateSummary);

    // 初期更新
    updateSummary();

    // QRコードのスキャン成功時の動作
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`QR Code detected: ${decodedText}`);
        // QRコードデータを含むURLにリダイレクト
        window.location.href = '/reservation/check?data=' + encodeURIComponent(decodedText);
    }

    // QRコードのスキャン失敗時の動作
    function onScanFailure(error) {
        console.warn(`コード読み取りエラー = ${error}`);
    }

    // QRコードスキャナーを初期化
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 }
    );

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});
</script>
@endsection
