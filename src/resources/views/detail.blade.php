@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-container">
    <div class = "restaurant-info">
        <h1 class="restaurant-title">{{ $restaurant->restaurant_name }}</h1>
        <div class="restaurant-image">
        <img src="{{ $restaurant->image }}" alt="Image of {{ $restaurant->restaurant_name }}">
        </div>
        <div class="restaurant-detail">
            @foreach($restaurant->areas as $area)
                <span class="tag">#{{ $area->area_name }}</span>
            @endforeach
            @foreach($restaurant->genres as $genre)
                <span class="tag">#{{ $genre->genre_name }}</span>
            @endforeach
            <p>{{ $restaurant->description }}</p>
        </div>
    </div>
    <div class="reservation-form">
        <h2 class="reservation">予約</h2>
        <form id="reservationForm" action="/reserve" method="post">
            @csrf
            <input type="hidden" name="route" value="{{ $route }}">
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <input type="hidden" name="restaurant_name" value="{{ $restaurant->restaurant_name }}">
            <input type="date" id="dateInput" name="date" >
            <p class="form__error-message">
                @error('date')
                {{ $message }}
                @enderror
            </p>
            <select name="time" id="timeInput" >
                <option value="">時間を選択</option>
                @foreach (range(9, 23) as $hour)
                    @foreach (range(0, 1) as $half)
                        @php
                            $hourFormatted = str_pad($hour, 2, '0', STR_PAD_LEFT);
                            $minuteFormatted = $half * 30;
                            $time = "{$hourFormatted}:" . str_pad($minuteFormatted, 2, '0', STR_PAD_LEFT);
                        @endphp
                <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                @endforeach
            </select>
            <p class="form__error-message">
                @error('time')
                {{ $message }}
                @enderror
            </p>
            <select id="numberInput" name="number" >
                <option value="">人数を選択</option>
                @foreach (range(1, 10) as $number)
                <option value="{{ $number }}">{{ $number }}人</option>
                @endforeach
            </select>
            <p class="form__error-message">
                @error('number')
                {{ $message }}
                @enderror
            </p>
            <div class="summary-card">
                <div id="summary">
                <p id="restaurantName">レストラン名: <span></span></p>
                <p id="selectedDate">日付: <span></span></p>
                <p id="selectedTime">時間: <span></span></p>
                <p id="selectedNumber">人数: <span></span></p>
            </div>
        </div>
            <button type="submit">予約する</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    const timeInput = document.getElementById('timeInput');
    const numberInput = document.getElementById('numberInput');
    const restaurantName = document.querySelector('[name="restaurant_name"]').value;

    function updateSummary() {
        document.getElementById('restaurantName').querySelector('span').textContent = restaurantName;
        document.getElementById('selectedDate').querySelector('span').textContent = dateInput.value || '未選択';
        document.getElementById('selectedTime').querySelector('span').textContent = timeInput.value || '未選択';
        document.getElementById('selectedNumber').querySelector('span').textContent = numberInput.value ? numberInput.value + '人' : '未選択';
    }

    dateInput.addEventListener('change', updateSummary);
    timeInput.addEventListener('change', updateSummary);
    numberInput.addEventListener('change', updateSummary);

    // Initial update
    updateSummary();
});
</script>
@endsection
