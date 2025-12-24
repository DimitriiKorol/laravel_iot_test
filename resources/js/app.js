import './bootstrap';

function hideForm(event) {
    event.currentTarget.parentNode.parentNode.style.display = 'none';
}

window.hideForm = hideForm;

function showForm(event) {
    event.preventDefault();
    let popupForm = document.querySelector('.pop-form-wrapper');
    popupForm.style.display = 'flex';
}

window.showForm = showForm;

console.log('Vite JS is working!');