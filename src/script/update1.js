function validateForm() {
    var radioButtons = document.getElementsByName('catid');
    var isSelected = false;

    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            isSelected = true;
            break;
        }
    }

    if (!isSelected) {
        alert("猫を選択してください。");
        return false;
    }

    return true;
}