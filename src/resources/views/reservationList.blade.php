@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservationList.css') }}">
@endsection

@section('content')
<div class="reservation-list">
    <table class="reservation-table">
        <tr>
            <th>Shop</th>
            <th>Date</th>
            <th>Time</th>
            <th>Number of People</th>
            <th>User</th>
        </tr>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->restaurant->name }}</td>
                <td>{{ $reservation->date }}</td>
                <td>{{ $reservation->time }}</td>
                <td>{{ $reservation->number }}</td>
                <td>{{ $reservation->user->name }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection