document.getElementById('openModalButton').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
});

document.getElementById('closeModalButton').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
});

document.getElementById('openModalButton1').addEventListener('click', function() {
    document.getElementById('modal1').style.display = 'block';
    document.getElementById('modalOverlay1').style.display = 'block';
});

document.getElementById('closeModalButton1').addEventListener('click', function() {
    document.getElementById('modal1').style.display = 'none';
    document.getElementById('modalOverlay1').style.display = 'none';
});

document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function (event) {
        const todoId = button.getAttribute('data-id'); // タスクIDを取得
        if (!confirm('本当に削除しますか？')) {
            event.preventDefault(); // キャンセルの場合
        } else {
            // 対応するフォームを送信
            document.getElementById(`deleteForm${todoId}`).submit();
        }
    });
});