@extends('layouts.app_noHeader')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')
        <div class="thanks__content">
            <div class="thanks__heading">
                <h2>お問い合わせありがとうございました</h2>
            </div>
            <button type="button" onclick="location.href='/'">HOME</button>
        </div>
@endsection