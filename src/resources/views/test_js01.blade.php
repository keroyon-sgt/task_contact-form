@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

<style>
/* 最低限のスタイル */
.modal-dialog {
  width: 100%;
  max-width: 64.25rem;
  margin: 2rem auto;
}

.dialog-open {
  display: block;
  width: 300px;
  margin: 4rem auto;
  padding: 1rem;
  border: 1px solid hsla(0, 0, 40%, 1);
  text-align: center;
  border-radius: 5px;
}

.dialog-panel {
  position: absolute;
  width: -moz-fit-content;
  width: -webkit-fit-content;
  width: fit-content;
  height: -moz-fit-content;
  height: -webkit-fit-content;
  height: fit-content;
  top: 15%;
  left: 0;
  right: 0;
  margin: auto;
  padding: 0;
  border: 2px solid hsla(0, 0, 40%, 1);
  background: hsla(0, 0, 100%, 1);
  border-radius: 5px;
}

/* native backdrop */
.dialog-panel::backdrop {
  background-color: rgba(0, 0, 0, .5);
}

/* polyfill backdrop */
.dialog-panel + .backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, .5);
}

.dialog-panel__message {
  margin: auto;
  padding: 4rem 3rem 0;
}

.dialog-panel__buttons {
  text-align: center;
  padding: 2rem 0 2.5rem;
}

.dialog__button {
  display: inline-block;
  min-width: 5rem;
  padding-top: .625rem;
  padding-bottom: .525rem;
  border: 1px solid hsla(0, 0, 40%, 1);
  border-radius: 5px;
  text-align: center;
  line-height: 1.5;
}

.dialog__button:not(:first-of-type) {
  margin-left: 1.75rem;
}

.dialog__close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 2.3rem;
  height: 2.3rem;
  background-color: hsla(0, 0, 20%, 1);
  font-size: 2rem;
  color: hsla(0, 0, 100%, 1);
  border-radius: 50%;
}

</style>



<script src="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.5.0/dialog-polyfill.min.js" defer></script>
<script src="main.js" defer></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    class ModalDialog {
  constructor() {
    this.wrap = document.getElementById('modal-dialog');
    this.open = document.getElementById('dialog-open');
    this.dialog = document.querySelector("[role='dialog']");
    this.yes = document.getElementById('dialog-yes');
    this.no = document.getElementById('dialog-no');
    this.close = document.getElementById('dialog-close');
    this.returnSpan = document.getElementById('return-value');

    // Polyfillを読み込む関数
    dialogPolyfill.registerDialog(this.dialog);

    this.showDialog();
    this.hideDialog();
    this.respondValue();
  }
  showDialog() {
    this.open.addEventListener('click', () => {
      this.dialog.showModal();
      this.dialog.style.visibility = 'visible';
      this.dialog.classList.remove('is-motioned');
      this.dialog.setAttribute('tabindex', '0');
      this.dialog.focus();
    });
  }
  hideDialog() {
    this.yes.addEventListener('click', () => {
      this.hideProcess('はい');
    });
    this.no.addEventListener('click', () => {
      this.hideProcess('いいえ');
    });
    this.close.addEventListener('click', () => {
      this.hideProcess('きみ、閉じるボタンを押したね...');
    });
    this.dialog.addEventListener('cancel', () => {
      this.hideProcess('Escapeボタン押しました？');
    });
    this.dialog.addEventListener('click', (event) => {
      if (event.target === this.dialog) {
        this.hideProcess('きみ、ウィンドウの外を押したね...');
      }
    });
  }
  hideProcess(resText) {
    this.dialog.close(resText);
    this.dialog.classList.add('is-motioned');
    this.wrap.setAttribute('tabindex', '0');
    this.wrap.focus();
    setTimeout(() => {
      this.dialog.style.visibility = 'hidden';
    }, 250);
  }
  respondValue() {
    this.dialog.addEventListener('close', () => {
      this.returnSpan.innerHTML = this.dialog.returnValue;
    });
  }
}

const modalDialog = new ModalDialog();
</script>

@endsection

@section('content')
<div id="modal-dialog" class="modal-dialog">
  <h1>モーダルダイアログ</h1>
  <button type="button" id="dialog-open" class="dialog-open">
    モーダルダイアログ<br>
    (モーダルウィンドウ)を開く
  </button>
  <dialog id="dialog-panel" class="dialog-panel" role="dialog" aria-describedby="d-message">
    <p id="d-message" class="dialog-panel__message" role="document">
      モーダルダイアログ(モーダルウィンドウ)<br>
      とはどんなものか知っていますか？
    </p>
    <div class="dialog-panel__buttons">
      <button type="button" id="dialog-yes" class="dialog__button">はい</button>
      <button type="button" id="dialog-no" class="dialog__button">いいえ</button>
    </div>
    <button type="button" id="dialog-close" class="dialog__close" aria-label="このモーダルダイアログを閉じる">
      ×
    </button>
  </dialog>
  <p class="dialog-response">
    ダイアログの返り値：<span id="return-value"></span>
  </p>
</div>




@endsection