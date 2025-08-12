@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}?d={{str_pad(rand(0,99999999),8,0, STR_PAD_LEFT)}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> <!-- for bootstrap-4 -->
<script src="https://cdn.tailwindcss.com"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
$(function () {
    $('.js-open').click(function () {
        $("body").addClass("no_scroll"); // 背景固定させるクラス付与
        var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
        $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
    });
    // オーバーレイクリックでもモーダルを閉じるように
    $('.js-close ').click(function () {     //, #overlay
        $("body").removeClass("no_scroll"); // 背景固定させるクラス削除
        $('#overlay, .modal-window').fadeOut();
    });
});
</script>


@endsection

@section('content')
<div class="contact__alert">
    @if(session('message'))
    <div class="contact__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="contact__alert--danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>
    <div class="contact__content">
        <div class="section__title">
            <h2>Admin</h2>
        </div>
    <div class="search-form__box">
        <form class="search-form" action="/admin/search" method="get">
            @csrf
<!-- <div class="search-form__item"> -->
                <input class="search-form__item-input" type="text" name="keyword" value="{{ $request->keyword }}" placeholder="名前やメールアドレスを入力してください"  />
<!-- </div><div class="search-form__item"> -->
                <select class="search-form__item-select" name="gender">
                    <option value="">性別</option>
                    <option value="1"
@if($request->gender==1||null == $request->gender)
 selected
@endif
>男性</option>
                    <option value="2"
@if($request->gender==2)
 selected
@endif
                    >女性</option>
                    <option value="3"
@if($request->gender==3)
 selected
@endif
                    >その他</option>
                </select>
<!-- </div><div class="search-form__item"> -->
                <select class="search-form__item-select" name="category_id">
                    <option value="" disabled selected>お問い合わせの種類</option>
                    @foreach ($category_list as $category_id => $category)
@if($category_id == $request->category_id)
                    <option value="{{$category_id}}" selected>{{$category}}</option>
@else
                    <option value="{{$category_id}}">{{$category}}</option>
@endif
@endforeach
                </select>
<!-- </div><div class="search-form__item"> -->
                <input class="search-form__date-select" type="date" name="created_at" value="@if(null == $request->created_at))年/月/日@else{{$request->created_at}}@endif" />
<!-- </div><div class="search-form__item"> -->
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>
<!-- </div> -->
        </form>
        <div class="search-form__button">
            <button class="search-form__button-reset"  onclick=location.href="/admin">リセット</button>
        </div>
    </div>

<!-- ------------------------------------------------- -->
<!-- エクスポート -->
        <div class="search-form__box">
            <div class="export__button"><button class="search-form__button-export" value="export">エクスポート</button></div>
            <div class="pagination">{{ $contacts->links() }}</div>
        </div>

<!-- ------------------------------------------------- -->
    <div id="overlay" class="overlay"></div>

<!-- ------------------------------------------------- -->

    <div class="contact-table">
        <table class="contact-table__inner">
        <tr class="contact-table__row">
            <th class="contact-table__header" style="width:15%">お名前</th>
            <th class="contact-table__header" style="width:10%">性別</th>
            <th class="contact-table__header" style="width:25%">メールアドレス</th>
            <th class="contact-table__header" style="width:25%">お問い合わせの種類</th>
            <!-- <th class="contact-table__header">お問い合わせの内容</th> -->
            <th class="contact-table__header" style="width:15%"></th>
        </tr>
<?php $modal_count=0 ?>
        @foreach ($contacts as $contact)
<?php $modal_count++ ?>
        <tr class="contact-table__row">
            <td class="contact-table__item">
                {{ $contact['last_name'] }}&nbsp;
                {{ $contact['first_name'] }}
            </td>
            <td class="contact-table__item">
{{$contact['gender']==1 ? "男性" : ($contact['gender']==2? "女性" :"その他") }}
            </td>

            <td class="contact-table__item contact-table__item-email">
                {{ $contact['email'] }}
            </td>

            <td class="contact-table__item">
                {{ $category_list[ $contact['category_id'] ] }}
            </td>
            <td class="contact-table__item">
                <div class="detail-panel__button">
                <button class="detail-panel__button-open js-open button-open"  data-id="{{$modal_count}}">詳細</button>
                </div>
            </td>
        </tr>
        @endforeach
        </table>
    </div>


    <!-- ------------------------------------------------- -->

<?php $modal_count=0 ?>

@foreach ($contacts as $contact)
<?php $modal_count++ ?>
<div class="modal-window" data-id="modal{{$modal_count}}">
    <div class="modal-close__button">
        <button class="modal-close__button-submit js-close button-close"  data-id="{{$modal_count}}">✖</button>

    </div>
    <div class="modal-table">
        <table class="modal-table__inner">
            <tr class="modal-table__row">
                <th class="modal-table__header">お名前</th>
                <td class="modal-table__item">
                    {{ $contact['last_name'] }}&nbsp;
                    {{ $contact['first_name'] }}
                </td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">性別</th>
                <td class="modal-table__item">
{{$contact['gender']==1 ? "男性" : ($contact['gender']==2? "女性" :"その他") }}
                </td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">メールアドレス</th>
                <td class="modal-table__item">
                    {{ $contact['email'] }}
                </td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">お問い合わせの種類</th>
                <td class="modal-table__item">
                    {{ $category_list[ $contact['category_id'] ] }}
                </td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">お問い合わせの内容</th>
                <td class="modal-table__item">
                    {{ $contact['detail'] }}
                </td>
            </tr>
            <tr class="modal-table__row">
                <td class="modal-table__item" colspan="2">
                    <form class="delete-form" action="/admin/delete" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $contact['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
</div>
    </div>
@endforeach


</div>


<?php

// switch ($contact['gender']) {
//     case 1:
//         echo "男性";
//         break;
//     case 2:
//         echo "女性";
//         break;
//     case 3:
//         echo "その他";
//         break;
// }

?>

<!-- 
@foreach ($contacts as $contact)
{{ $contact['first_name'] }}<br />
{{ $contact['category_id'] }}<br /> -->
<?php

// var_dump($contact);
// var_dump($categories);
// var_dump($category_list);
?>
<!-- @endforeach -->
<!-- 
old=
{{ old('keyword') }}
req=
{{ $request->keyword }}

<?php
// var_dump($request->keyword);

?>
 -->

<?php
echo'<br />Auth check =';
var_dump(Auth::check());
?>


@endsection
