
const adminButton = document.getElementById('admin');
const memberButton = document.getElementById('member');
const trainerButton = document.getElementById('trainer');

const buttons = [adminButton, memberButton, trainerButton];

buttons.forEach(function(button, index) {
    button.addEventListener('click', (event) => {
        // // call php code to set session variables
        // var buttonId = button.id;
        // var xhr = new XMLHttpRequest();
        //
        // try{
        //     xhr.open('PUT', 'http://localhost:63342/inet2005-finalproject-jaegarsaun/views/landing.php', true);
        //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //
        //     xhr.onreadystatechange = function () {
        //         if (xhr.readyState === 4 && xhr.status === 200) {
        //             console.log('Session variable set successfully');
        //         }
        //     };
        //
        //     xhr.send('buttonId=' + encodeURIComponent(buttonId));
        //
        // }catch (e){
        //     console.log(e)
        // }



    })
})