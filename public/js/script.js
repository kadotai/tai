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

document.getElementById('Button2{{$todo->id}}').addEventListener('click', function() {
    if(!confirm('本当に削除しますか？')) {
        event.preventDefault();
    } else {
        document.getElementById('deleteForm{{$todo->id}}').submit();
    }
});
