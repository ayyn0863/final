<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/reg.css" src="">
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
                <div v-if="NameError" class="error">お名前を入力してください</div>
                <br>
                猫ちゃんの品種<br>
                    <div class="sel sel--black-panther">
                        <select name="select-profession" id="select-profession">
                            <option value="" disabled>品種</option>
                            <option value="za" disabled>雑種</option>
                            <option value="a">アメリカンショートヘア</option>
                            <option value="su">スコティッシュフォールド</option>
                            <option value="ro">ロシアンブルー</option>
                            <option value="ra">ラグドール</option>
                            <option value="sya">シャム</option>
                            <option value="no">ノルウェージャンフォレストキャット</option>
                            <option value="ma">マンチカン</option>
                            <option value="me">メインクーン</option>
                            <option value="pe">ペルシャ</option>
                        </select>
                    </div>
                <br>
                説明<br>
                <textarea v-model="text" class="text" name="cattext" cols="30" rows="5" placeholder="説明を入力してください"></textarea><br>
                <div v-if="TextError" class="error">説明を入力してください</div>
                <br>
                <div class="bobo">
                    <a href="reg-output.php" class="btn btn-border" @click="submitForm"><span>登録する</span></a>
                </div>
            </div>
        </div>
        </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <script src="script/reg.js"></script>
    </body>
</html>