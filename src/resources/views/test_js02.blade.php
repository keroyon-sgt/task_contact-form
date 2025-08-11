@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

<style>

.modal-container {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  text-align: center;
  background: rgba(0, 0, 0, 0.5);
  overflow: auto;
  /* opacity: 0; */
  visibility: hidden;
  transition: .3s ease-out;
  z-index: 9;
}

.modal-container::before {
  content: "";
  display: inline-block;
  vertical-align: middle;
  height: 100%;
}

.modal-container.active {
  opacity: 1;
  visibility: visible;
}

.modal-body {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  max-width: 500px;
  width: 90%;
}

.modal-close {
  position: absolute;
  top: -30px;
  right: 0;
  font-size: 14px;
  color: #fff;
  background: rgba(0,0,0,60%);
  padding: 4px 15px;
  cursor: pointer;
  border-radius: 5px 5px 0 0;
}

.modal-content {
  background: #fff;
  border: 2px solid #000;
  text-align: left;
  padding: 30px;
  font-weight: bold;
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">

window._uac = {}; // define _uac as a global object
var ua = window.navigator.userAgent.toLowerCase();
var ver = window.navigator.appVersion.toLowerCase();

// check browser version
_uac.browser = (function(){
  if (ua.indexOf('edge') !== -1) return 'edge';                           // Edge
  else if (ua.indexOf("iemobile") !== -1)      return 'iemobile';         // ieMobile
  else if (ua.indexOf('trident/7') !== -1)     return 'ie11';             // ie11
  else if (ua.indexOf("msie") !== -1 && ua.indexOf('opera') === -1){
    if      (ver.indexOf("msie 6.")  !== -1) return 'ie6';              // ie6
    else if (ver.indexOf("msie 7.")  !== -1) return 'ie7';              // ie7
    else if (ver.indexOf("msie 8.")  !== -1) return 'ie8';              // ie8
    else if (ver.indexOf("msie 9.")  !== -1) return 'ie9';              // ie9
    else if (ver.indexOf("msie 10.") !== -1) return 'ie10';             // ie10
  }
  else if (ua.indexOf('chrome')  !== -1 && ua.indexOf('edge') === -1)   return 'chrome';    // Chrome
  else if (ua.indexOf('safari')  !== -1 && ua.indexOf('chrome') === -1) return 'safari';    // Safari
  else if (ua.indexOf('opera')   !== -1) return 'opera';                  // Opera
  else if (ua.indexOf('firefox') !== -1) return 'firefox';                // FIrefox
  else return 'unknown_browser';
})();

// check device
_uac.device = (function(){
  if(ua.indexOf('iphone') !== -1 || ua.indexOf('ipod') !== -1 ) return 'iphone';
  else if (ua.indexOf('ipad')    !== -1 || (ua.indexOf('macintosh') !== -1 && 'ontouchend' in document)) return 'ipad';
  else if (ua.indexOf('android') !== -1) return 'android';
  else if (ua.indexOf('windows') !== -1 && ua.indexOf('phone') !== -1) return 'windows_phone';
  else return '';
})();

// check ios version
_uac.iosVer = (function(){
  if ( /iP(hone|od|ad)/.test( navigator.platform ) ) {
    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
    var versions = [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
    return versions[0];
  }
  else return 0;
})();
_uac.isIE = (_uac.browser.substr(0, 2) === 'ie' && _uac.browser !== 'iemobile');
_uac.isiOS = (_uac.device === 'iphone' || _uac.device === 'ipad');
_uac.isMobile = (ua.indexOf('mobi') !== -1 || _uac.device === 'iphone' || (_uac.device === 'windows_phone' && ua.indexOf('wpdesktop') === -1) || _uac.device === 'iemobile');
_uac.isTablet = (_uac.device === 'ipad' || (_uac.device === 'android' && !_uac.isMobile));
_uac.isTouch  = ('ontouchstart' in window);
_uac.isModern = !(_uac.browser === 'ie6' || _uac.browser === 'ie7' || _uac.browser === 'ie8' || _uac.browser === 'ie9' || (0 < _uac.iosVer && _uac.iosVer < 8));

// Set the results as class names of the html
var homeClass = function() {
  var classStr = ' ';
  classStr += (_uac.browser !== '') ? _uac.browser + " " : 'browser-unknown ',
    classStr += (_uac.device  !== '') ? _uac.device + " "  : 'device-unknown ',
    classStr += (_uac.isMobile) ? 'mobile ' : 'desktop ',
    classStr += (_uac.isTouch) ? 'touch '  : 'mouse ',
    classStr += (_uac.isiOS) ? 'ios ' : '',
    classStr += (_uac.isIE) ? 'ie ' : '',
    classStr += (_uac.isModern) ? 'modern ' : 'old ';
  return classStr;
};

document.addEventListener('DOMContentLoaded', function() {
  document.documentElement.className += homeClass();
});










$(function(){
  // 変数に要素を入れる
  var close = $('.modal-close'),
  container = $('.modal-container');

  //読み込んで5秒後にモーダルウィンドウを表示
  setTimeout(() => {
    container.addClass('active');
    return false;
  },1000);
  //closeボタンをクリックしたらモーダルウィンドウを閉じる
  close.on('click',function(){
    container.removeClass('active');
  });

  //モーダルウィンドウの外側をクリックしたらモーダルウィンドウを閉じる
  $(document).on('click',function(e) {
    if(!$(e.target).closest('.modal-body').length) {
      container.removeClass('active');
    }
  });
});

</script>

@endsection

@section('content')

<div class="modal-container"><!-- モーダルウィンドウ本体の囲み -->
  <div class="modal-body">
    <button type="button" class="modal-close">close</button><!-- 閉じるボタン -->
    <div class="modal-content"><!-- コンテンツエリア -->
      <div class="inn">
        <span class="en">FREE</span>
        <p class="txt">無料提案・相談もお気軽に！</p>
      </div>
      <div class="gray-bg">
        <p class="txt">お客様のご要望をお聞かせください。<br>サイト制作の知識のある担当が無料で診断しご提案させて頂きます。</p>
      </div>
      <div class="btn-area">
        <a href="">お問い合わせはこちらから</a>
      </div>
    </div>
  </div>
</div>



@endsection