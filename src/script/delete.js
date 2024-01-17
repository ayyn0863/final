function showAlertAndRedirect() {
    // ラジオボタンが選択されているか確認
    var radioButtons = document.getElementsByName("catid");
    var radioButtonChecked = false;

    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            radioButtonChecked = true;
            break;
        }
    }

    if (!radioButtonChecked) {
        alert("削除する猫を選択してください。");
        return false;
    }

    return true;
}