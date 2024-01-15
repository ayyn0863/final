<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reg.css">
    <link rel="stylesheet" href="css/iroiro.css">
    <title>猫の里親-登録画面-</title>
</head>
<body>
    <form id="appForm" action="reg-output.php" method="post">
        <div class="bg_pattern Paper_v2"></div>
        <h1 class="sample">登録</h1>

        <div class="container">
            <div class="left-aligned-text">
                猫ちゃんのお名前<br>
                <input v-model="name" type="text" class="text" name="catname"><br>
                <div v-if="!name" class="error">猫ちゃんのお名前を入力してください</div>
                <br>

                猫ちゃんの品種<br>
                <div>
                    <select v-model="hinsyu" name="catbreedid" id="select-breed">
                        <option value="" disabled>品種</option>
                        <option value="1">アメリカンショートヘア</option>
                        <option value="2">シャム</option>
                        <option value="3">スコティッシュフォールド</option>
                        <option value="4">ノルウェージャンフォレストキャット</option>
                        <option value="5">ペルシャ</option>
                        <option value="6">マンチカン</option>
                        <option value="7">メインクーン</option>
                        <option value="8">ラグドール</option>
                        <option value="9">ロシアンブルー</option>
                        <option value="10">雑種</option>  
                    </select>
                </div>
                <div v-if="!hinsyu" class="error">品種を選択してください</div>
                <br>

                説明<br>
                <textarea v-model="text" class="text" name="cattext" cols="30" rows="5" placeholder="説明を入力してください"></textarea><br>
                <div v-if="!text" class="error">説明を入力してください</div>
                <br>

                <!-- エラーメッセージ表示 -->
                <div v-if="errorMsg" class="error">{{ errorMsg }}</div>

                <div class="bobo">
                    <a href="index.html" class="btn btn-border"><span>戻る</span></a>
                    <a href="reg-output.php" class="btn btn-border" @click.prevent="submitForm"><span>登録する</span></a>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/reg.js"></script>
    </body>
</html>