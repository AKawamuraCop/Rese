@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/csvImport.css') }}">
@endsection

@section('content')
@if (session('success'))
<div class="flash_message">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="/csv/import" method="post" enctype="multipart/form-data">
    @csrf
    <label name="csvFile">csvファイル</label>
    <input type="file" name="csvFile" class="" id="csvFile"/>
    <button type="submit">取込</button>
</form>

@endsection
