@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<style>
/* 開くボタン */
.button-open {
  display: block;
  margin: 0 auto;
  width: 20rem;
  padding: 1em;
  background-color: #3140c9;
  color: #eaeaea;
  border-radius: 20rem;
  cursor: pointer;
}
/* モーダルウィンドウ */
.modal-window {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 300px;
  height: 300px;
  background-color: #dfdddd;
  border-radius: 5px;
  z-index: 11;
  padding: 2rem;
}
/* 閉じるボタン */
.button-close {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 200px;
  padding: 1em;
  background-color: #c96931;
  color: #eaeaea;
  border-radius: 20rem;
  cursor: pointer;
}
/* オーバーレイ */
.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;
  z-index: 10;
}
</style>

<script type="text/javascript">
$(function () {
  $('.js-open').click(function () {
    $("body").addClass("no_scroll"); // 背景固定させるクラス付与
    var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
    $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
  });
  // オーバーレイクリックでもモーダルを閉じるように
  $('.js-close , #overlay').click(function () {
    $("body").removeClass("no_scroll"); // 背景固定させるクラス削除
    $('#overlay, .modal-window').fadeOut();
  });
});
</script>

@endsection

@section('content')
<button class="js-open button-open">open</button>


<div class="modal-window">
    <button class="js-close button-close">Close</button>
</div>

<div id="overlay" class="overlay"></div>



<!-- オーバーレイ -->
  <div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ1 -->
  <div class="modal-window" data-id="modal1">
    <p>モーダルNo.1</p>
    <button class="js-close button-close">Close</button>
  </div>
 <!-- モーダルウィンドウ2 -->
  <div class="modal-window" data-id="modal2">
    <p>モーダルNo.2</p>
    <button class="js-close button-close">Close</button>
  </div>
<!-- モーダルウィンドウ3 -->
  <div class="modal-window" data-id="modal3">
    <p>モーダルNo.3</p>
    <button class="js-close button-close">Close</button>
  </div>
<!-- モーダルウィンドウ4-->
  <div class="modal-window" data-id="modal4">
    <p>モーダルNo.4</p>
    <button class="js-close button-close">Close</button>
  </div>
<!-- ボタン1 -->
  <div class="wrap">
    <button class="js-open button-open" data-id="1">Open1</button>
  </div>
<!-- ボタン2 -->
  <div class="wrap">
    <button class="js-open button-open" data-id="2">Open2</button>
  </div>
<!-- ボタン3 -->
  <div class="wrap">
    <button class="js-open button-open" data-id="3">Open3</button>
  </div>
<!-- ボタン4 -->
  <div class="wrap">
    <button class="js-open button-open" data-id="4">Open4</button>
  </div>
@endsection