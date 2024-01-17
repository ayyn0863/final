function validateForm() {
    var radios = document.getElementsByName("catid");
    var isChecked = false;

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        alert("猫を選択してください。");
    }

    return isChecked;
}