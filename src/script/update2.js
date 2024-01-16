new Vue({
    el: '#appForm',
    data: {
        catname: "<?php echo $row['catname']; ?>",
        cattext: "<?php echo $row['text']; ?>",
        errorMsg: ''
    },
    methods: {
        submitForm: function () {
            if (!this.catname || !this.cattext) {
                // エラーメッセージを表示
                this.errorMsg = '入力エラー: 猫ちゃんのお名前と説明を入力してください。';
            } else {
                // フォームを送信
                this.$el.submit();
            }
        }
    }
});