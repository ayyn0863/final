document.getElementById('editLink').addEventListener('click', function() {
    var selectedCatId = document.querySelector('input[name="catid"]:checked');
    if (selectedCatId) {
        // 選択されたラジオボタンがあれば、delete-output.phpにリダイレクト
        window.location.href = 'delete-output.php?catid=' + selectedCatId.value;
    } else {
        alert('猫を選択してください。');
    }
});