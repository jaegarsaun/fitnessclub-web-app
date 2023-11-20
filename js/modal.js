var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    closeModal();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

// open modal function
function openModal(scheduleIdParam){
    console.log(scheduleIdParam); // should log the schedule ID passed from the button

    modal.style.display = "block";

    // Access the input element by ID and set its value
    var scheduleIdInput = document.getElementById('scheduleid');
    scheduleIdInput.value = scheduleIdParam;

    console.log(scheduleIdInput.value); // should log the value assigned to the input element
}
function closeModal(){
    modal.style.display = "none";
    scheduleid.value = ''; // reset value
}
