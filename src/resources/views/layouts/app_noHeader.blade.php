<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}" />
    @yield('css')
</head>

<body>
    <main>
        @yield('content')
    </main>
</body>

</html>