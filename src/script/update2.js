new Vue({
    el: '#appForm',
    data: {
        catname: "<?php echo $row['catname']; ?>",
        cattext: "<?php echo $row['text']; ?>",
        errorMsg: ''
    },
    methods: {
        submitForm: function () {
            // catidがセットされているか確認
            if (!this.catid) {
                this.errorMsg = 'エラー: catidが設定されていません。';
                return;
            }

            if (!this.catname || !this.cattext) {
                // エラーメッセージを表示
                this.errorMsg = '入力エラー: 猫ちゃんのお名前と説明を入力してください。';
            } else {
                // フォームを送信
                this.$el.submit();
            }
        },
        goBack: function () {
            // 戻るボタンのクリック時の処理
            window.history.back();
        }
    }
});