@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>お問い合わせ</h2>
            </div>
        <form class="form" action="/confirm" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                        <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
                    </div>
                    <div class="form__error">
                        @error('last_name')
                            {{ $message }}
                        @enderror
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--radio">
                        <input type="radio" id="form__input--radio-1" name="gender" value="1"
{{ old('gender') == 1 ? ' checked': 'none' }}
                        <label for="form__input--radio-1">男性</label>
                        <input type="radio" id="form__input--radio-2" name="gender" value="2"
{{ old('gender') == 2 ? ' checked': 'none' }} />
                        <label for="form__input--radio-2">女性</label>
                        <input type="radio" id="form__input--radio-3" name="gender" value="3"
{{ old('gender') == 3 ? ' checked': 'none' }} />
                        <label for="form__input--radio-3">その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="tel" name="tel-1" placeholder="080" value="{{ old('tel-1') }}" /><!--inputに桁数制限-->
                        <input type="tel" name="tel-2" placeholder="1234" value="{{ old('tel-2') }}" />
                        <input type="tel" name="tel-3" placeholder="5678" value="{{ old('tel-3') }}" />
                    </div>
                    <div class="form__error">
                        <!-- @error('tel-1tel-2tel-3')
                            {{ $message }}
                        @enderror -->
                        @error('tel-1')
                            {{ $message }}
                        @enderror
                        @error('tel-2')
                            {{ $message }}
                        @enderror
                        @error('tel-3')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                    </div>
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例：千駄ヶ谷マンション" value="{{ old('building') }}" />
                    </div>
                    <div class="form__error">
                        @error('building')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>



            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類  </span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <!-- <input type="text" name="category" placeholder="test@example.com" value="{{ old('category_id') }}" /> -->
{{ old('category_id') }}

@if(old('category_id'))
YES
@endif



                        <select class="create-form__item-select" name="category_id">


                        @if(old('category_id'))
                            <!--<option value="0" disabled>選択してください</option>-->
                            @foreach ($categories as $category)
                            <option value="{{$category['id']}}" 
                                @if($category['id'] == old('category_id'))
                                selected
                                @endif
                            >{{$category['category']}}</option>
                            @endforeach
                        @else
                        <option value="0" disabled selected>選択してください</option>
                            @foreach ($categories as $category)
                            <option value="{{$category['id']}}">{{$category['category']}}</option>
                            @endforeach

                        @endif

                        </select>

                    </div>
                    <div class="form__error">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>



            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                </div>
                <div class="form__group-detail">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" >{{ old('detail') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
        
    </div>
<!-- 
    @if(session('success'))
        <div id="alert-message" class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div id="alert-messages" class="alert alert-danger">
            <ul>
        @foreach ($errors->all() as $error_num=>$error)
            <li>{{ $error_num }} &nbsp;{{ $error }}</li>
        @endforeach
            </ul>
        </div>
    @endif 
-->


@endsection