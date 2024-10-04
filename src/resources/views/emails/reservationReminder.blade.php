<!DOCTYPE html>
<html>
<head>
    <title>予約のリマインド</title>
</head>
<body>
    <h1>{{ $reservation->user->name }}様</h1>
    <p>以下の内容で本日の予約がございます。</p>

    <p>レストラン: {{ $reservation->restaurant->name }}</p>
    <p>予約日時: {{ $reservation->date }} {{ $reservation->time }}</p>

    <p>ご来店をお待ちしております。</p>

    <p>よろしくお願いします。</p>
</body>
</html>
