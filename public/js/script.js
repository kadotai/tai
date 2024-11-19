// document.getElementById('openModalButton').addEventListener('click', function() {
//     document.getElementById('modal').style.display = 'block';
//     document.getElementById('modalOverlay').style.display = 'block';
// });

// document.getElementById('closeModalButton').addEventListener('click', function() {
//     document.getElementById('modal').style.display = 'none';
//     document.getElementById('modalOverlay').style.display = 'none';
// });

// document.getElementById('openModalButton1').addEventListener('click', function() {
//     document.getElementById('modal1').style.display = 'block';
//     document.getElementById('modalOverlay1').style.display = 'block';
// });

// document.getElementById('closeModalButton1').addEventListener('click', function() {
//     document.getElementById('modal1').style.display = 'none';
//     document.getElementById('modalOverlay1').style.display = 'none';
// });


document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal');
    const modalOverlay = document.getElementById('modalOverlay');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');

    // ページロード時にエラーがある場合、モーダルを自動的に開く
    if (modal && modalOverlay && document.querySelector('.error-message')) {
        modal.style.display = 'block';
        modalOverlay.style.display = 'block';
    }

    // 通常のモーダルを開くボタンの動作
    if (openModalButton) {
        openModalButton.addEventListener('click', function() {
            modal.style.display = 'block';
            modalOverlay.style.display = 'block';
        });
    }

    // モーダルを閉じるボタンの動作
    if (closeModalButton) {
        closeModalButton.addEventListener('click', function() {
            modal.style.display = 'none';
            modalOverlay.style.display = 'none';
        });
    }
});

// 以下は編集用モーダルのスクリプト（編集モーダルにも同様の変更が必要な場合はこちらを修正）
document.addEventListener('DOMContentLoaded', function() {
    const modal1 = document.getElementById('modal1');
    const modalOverlay1 = document.getElementById('modalOverlay1');
    const openModalButton1 = document.getElementById('openModalButton1');
    const closeModalButton1 = document.getElementById('closeModalButton1');
    const editButtons = document.querySelectorAll('.edit-button');
    const closeEdit = document.querySelectorAll('.close-modal'); 

    // 編集モーダルの通常の動作
    if (openModalButton1) {
        openModalButton1.addEventListener('click', function () {
            modal1.style.display = 'block';
            modalOverlay1.style.display = 'block';
        });
    }

    if (closeModalButton1) {
        closeModalButton1.addEventListener('click', function () {
            modal1.style.display = 'none';
            modalOverlay1.style.display = 'none';
        });
    }

    //モーダルを開く処理
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const todoId = button.dataset.id;
            const modal = document.getElementById(`modal${todoId}`);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // モーダルを閉じる処理
    closeEdit.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal1');
            if(modal) {
                modal.style.display = 'none';
            }

        });
    });

});

console.log(editButtons); 
console.log(closeEdit);




document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function (event) {
        const todoId = button.getAttribute('data-id'); 
        if (!confirm('本当に削除しますか？')) {
            event.preventDefault(); 
        } else {
            document.getElementById(`deleteForm${todoId}`).submit();
        }
    });
});
