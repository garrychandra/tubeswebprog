const form = document.getElementById('form');
form.addEventListener('submit', (event) => {
    event.preventDefault();
})

// const username = form.nextElementSibling.username.value.trim();
// const usernameError = document.querySelector('#username + .errorMessage');
// const usernameInput = document.getElementById('username');
// if (username === '') {
//     usernameError.textContent =  'Input your username!';
//     usernameInput.parentNode.classList.add('error');
//     usernameInput.parentNode.classList.remove('success');
// } else {
//     usernameError.textContent = '';
//     usernameInput.parentNode.classList.add('success');
//     usernameInput.parentNode.classList.remove('error');
// }

