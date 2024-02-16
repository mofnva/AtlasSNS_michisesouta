<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/script.js')}}" defer></script>
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a><img src="images/atlas.png" href="/top"></a></h1>
        <div  class="rightflexho">
            @php
            echo '<img src=images/'.$loginimg.'>';
            @endphp
            <button id="menubutton" class="closed">
                V
            </button>
                <div id="">
                <div>
                <!--<img src="images/arrow.png">-->
            </div>
        </div>
    </header>
    <div id="topmenu" class="hidden right">
                <ul>
                    <li class="toplink menubutton"><a href="/top">ホーム</a></li>
                    <li class="proflink menubutton"><a href="/profile">プロフィール</a></li>
                    <li class="logoutlink menubutton"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                @php
                echo "".$selfname['username']."さん";
                @endphp
                <div>
                <p>フォロー数　　
                @php
                    echo $followscnt;
                @endphp
                名</p>
                </div>
                <div class="right">
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                </div>
                <div>
                <p>フォロワー数　
                @php
                    echo $followedcnt;
                @endphp
                名</p>
                </div>
                <div class="right">
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
</div>
            </div>
            <div class="center">
            <p class="btn"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
