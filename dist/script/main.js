document.addEventListener('DOMContentLoaded', () => {
    const addButton = document.querySelector('#addButton');
    addButton.addEventListener('click', (e) => {
        e.preventDefault();
        const inputForm = document.querySelector('#inputForm');
        inputForm.classList.toggle('hidden');
        addButton.classList.toggle('close-style');
        
        if (inputForm.classList.contains('hidden')) {
            addButton.innerHTML = '<i class="fa-solid fa-plus"></i> Tambahkan Barang';
        } else {
            addButton.innerHTML = '<i class="fa-solid fa-xmark"></i> Tutup Menu';
        };
    });

    const alert = document.querySelector('#alertPHP');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 3000)
    }
});