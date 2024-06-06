<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;width: max-content;margin: auto;">

        @foreach ($qrCodes as $item)
        <div style="padding: 16px; border-radius: 16px;border: 2px solid gray">
            {!! $item['qr'] !!}
            <h1 style="font-family: Arial, Helvetica, sans-serif;text-align: center; margin-bottom: 0">{{ $item['code'] }}</h1>
        </div>
        @endforeach
    </div>
</body>
</html>
