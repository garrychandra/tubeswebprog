const form = document.getElementById('form')
const fullname_input = document.getElementById('fullname-input')
const email_input = document.getElementById('email-input')
const password_input = document.getElementById('password-input')
const error_message = document.getElementById('error-message')

form.addEventListener('submit', (e) => {
    let errors = []

    if (fullname_input) {
        errors = getSignupFormErrors(fullname_input.value, email_input.value, password_input.value)
        // kalo ada fullname input -> lagi di sign up page
    } else {
        errors = getLoginFormErrors(email_input.value, password_input.value)
        // kalo gaada fullname input -> lagi di login page
    }

    if (errors.length > 0) {
        e.preventDefault()
        error_message.innerText = errors.join("! ")
        // kalo ada error, nanti muncul 3 tulisan yg di errors.push
    }
})

function getSignupFormErrors(fullname, email, password) {
    let errors = []

    if (fullname === '' || fullname == null) {
        errors.push('Full name is required')
        fullname_input.parentElement.classList.add('incorrect')
    }

    if (email === '' || email == null) {
        errors.push('Email is required')
        email_input.parentElement.classList.add('incorrect')
    }

    if (password === '' || password == null) {
        errors.push('Password is required')
        password_input.parentElement.classList.add('incorrect')
        password_input.parentElement.classList.add('incorrect')
    }

    if(password.length < 8) {
        errors.push('At least 8 characters')
    }

    return errors
}


function getLoginFormErrors(email, password) {
    if (email === '' || email == null) {
        errors.push('Email is required')
        email_input.parentElement.classList.add('incorrect')
    }

    if (password === '' || password == null) {
        errors.push('Password is required')
        password_input.parentElement.classList.add('incorrect')
        password_input.parentElement.classList.add('incorrect')
    }

    if(password.length < 8) {
        errors.push('At least 8 characters')
    }

    return errors
}


const allInputs = [fullname_input, email_input, password_input].filter(input => input != null)

allInputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.parentElement.classList.contains('incorrect'))  {
            input.parentElement.classList.remove('incorrect')
            error_message.innerText = ''
        }
    })
})
