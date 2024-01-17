document.getElementById('editLink').addEventListener('click', function() {
    var selectedCatId = document.querySelector('input[name="catid"]:checked');
    if (selectedCatId) {
        // 選択されたラジオボタンがあれば、update-input.phpにリダイレクト
        window.location.href = 'update-input.php?catid=' + selectedCatId.value;
    } else {
        alert('猫を選択してください。');
    }
});