<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/iroiro.css">
    <title>猫の里親-更新画面-</title>
</head>
<body>
    <div class="bg_pattern Paper_v2"></div>
    <h1 class="sample">更新</h1>

    <div class="container">
        <div class="left-aligned-text">
            <form action="update-output.php" method="post">
                <input type="hidden" name="catid" value="<?php echo $currentCat['catid']; ?>">
                <label for="catname">猫の名前:</label>
                <input type="text" id="catname" name="catname" value="<?php echo $currentCat['catname']; ?>"><br>

                <label for="text">猫の説明:</label>
                <textarea id="text" name="text"><?php echo $currentCat['text']; ?></textarea><br>

                <a href="list.php" class="btn btn-border"><span>戻る</span></a>
                <button type="submit" class="btn btn-border" id="editLink"><span>更新</span></button>
            </form>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="script/update1.js"></script> -->
</body>
</html>