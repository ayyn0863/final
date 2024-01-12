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
                            <option value="hacker">Hacker</option>
                            <option value="gamer">Gamer</option>
                            <option value="developer">Developer</option>
                            <option value="programmer">Programmer</option>
                            <option value="designer">Designer</option>
                        </select>
                    </div>
                <br>
                説明<br>
                <input v-model="text" type="text" class="text" name="cattext"><br>
                <div v-if="TextError" class="error">説明を入力してください</div>
        
                <div class="bobo">
                    <button class="example" type="button" @click="submitForm"><span>登録する</span></button>
                </div>
            </div>
        </div>
        </form>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <script src="script/reg.js"></script>
    </body>
</html>