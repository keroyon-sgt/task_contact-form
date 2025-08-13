@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
@endsection

@section('content')
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>お問い合わせ内容確認</h2>
            </div>
            <form class="form" action="/contacts" method="post">
@csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                {{ $contact['last_name'] }}&nbsp;{{ $contact['first_name'] }}
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly />&nbsp;&nbsp;
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />

<?php

switch ($contact['gender']) {
    case 1:
        echo "男性";
        break;
    case 2:
        echo "女性";
        break;
    case 3:
        echo "その他";
        break;
}

?>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                {{ $contact['tel-1'] }}{{ $contact['tel-2'] }}{{ $contact['tel-3'] }}
                                <input type="hidden" name="tel-1" value="{{ $contact['tel-1'] }}" />
                                <input type="hidden" name="tel-2" value="{{ $contact['tel-2'] }}" />
                                <input type="hidden" name="tel-3" value="{{ $contact['tel-3'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                {{ $category_list[ $contact['category_id'] ] }}
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <!-- {{ $contact['detail'] }}kakikaeru text->textarea
                                <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly /> -->
                                <textarea name="detail" readonly >{{ $contact['detail'] }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            
                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                    <button class="form__button-correct" type="submit" name="correct" value="correct">修正</button>
                </div>
            </form>
        </div>

@endsection