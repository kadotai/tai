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
    const openModalButton = document.getElementById('openModalButton1');
    const closeModalButton = document.getElementById('closeModalButton1');


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

document.addEventListener('DOMContentLoaded', function() {

    const editButtons = document.querySelectorAll('.edit-button');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const todoId = button.dataset.id;
            const todoTitle = button.dataset.title;
            const todoContents = button.dataset.contents;

            // console.log(`Editing Todo ID: ${todoId}`);
            // console.log(`Modal ID: modal${todoId}`);

            const modal = document.getElementById(`modalEdit${todoId}`);
            
            if (modal) {
                modal.style.display = 'block';
            }
            const titleInput = modal.querySelector('input[name="title"]');
                const contentsInput = modal.querySelector('input[name="contents"]');

                if (titleInput) {
                    titleInput.value = todoTitle; 
                }

                if (contentsInput) {
                    contentsInput.value = todoContents; 
                }

                
            const imageInput = modal.querySelector(`#image${todoId}`);
            const imagePreview = modal.querySelector(`#imagePreview${todoId}`);

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;
                        img.width = 100; 
                        imagePreview.innerHTML = ''; 
                        imagePreview.appendChild(img); 
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });

    const closeModalButtons = document.querySelectorAll('.closeModalButton');

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modalEdit');
            if(modal) {
                modal.style.display = 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modalEdit');

    modals.forEach(modal => {
        let isDragging = false;
        let offsetX = 0;
        let offsetY = 0;

        modal.addEventListener('mousedown', (e) => {
            
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'BUTTON') {
                return;
            }
            isDragging = true;
            offsetX = e.clientX - modal.offsetLeft;
            offsetY = e.clientY - modal.offsetTop;
            document.body.style.userSelect = 'none'; 
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                modal.style.left = `${e.clientX - offsetX}px`;
                modal.style.top = `${e.clientY - offsetY}px`;
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            document.body.style.userSelect = ''; 
        });
    });
});


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

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    if (searchInput && searchForm) {
        searchForm.addEventListener('submit', function(event) {
            const query = searchInput.value.trim();
            if (query === '') {
                event.preventDefault();
                alert('検索ワードを入力してください。');
            }
        });
    }
});

const modal = document.getElementById("modalEdit");

// モーダルをドラッグで動かせるようにする（オプション）
modal.addEventListener("mousedown", (e) => {
  let startX = e.clientX;
  let startY = e.clientY;
  let rect = modal.getBoundingClientRect();

  const onMouseMove = (e) => {
    modal.style.left = `${rect.left + e.clientX - startX}px`;
    modal.style.top = `${rect.top + e.clientY - startY}px`;
  };

  const onMouseUp = () => {
    window.removeEventListener("mousemove", onMouseMove);
    window.removeEventListener("mouseup", onMouseUp);
  };

  window.addEventListener("mousemove", onMouseMove);
  window.addEventListener("mouseup", onMouseUp);
});