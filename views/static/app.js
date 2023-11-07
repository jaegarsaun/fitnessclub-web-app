
const adminButton = document.getElementById('admin');
const memberButton = document.getElementById('member');
const trainerButton = document.getElementById('trainer');

const buttons = [adminButton, memberButton, trainerButton];

buttons.forEach(function(button, index) {
    button.addEventListener('click', (event) => {
        // call php code to set session variables
        // for now console log button id
        console.log(button.id);
    })
})