document.addEventListener('DOMContentLoaded', function(){
    var lastSecond;
    function updateTime(){
        var currentDate = new Date();
        var days = ['Sunday','Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var dayOfWeek = days[currentDate.getDay()];
        document.getElementById('Day').textContent = 'Today is ' + dayOfWeek;
        //Colombia
        var time = new Date().toLocaleString('en-US', {timeZone: 'America/Bogota'});
        document.getElementById('Time').textContent = time;
        //Chile
        var timeChile = new Date().toLocaleString('en-US', {timeZone: 'America/Santiago'});
        document.getElementById('TimeChile').textContent = timeChile;
        //Israel
        var timeIsrael = new Date().toLocaleString('en-US', {timeZone: 'Asia/Jerusalem'});
        document.getElementById('TimeIsrael').textContent = timeIsrael;
    }

    updateTime();

    setInterval(function(){
        var currentSecond = new Date().getSeconds();
        if(currentSecond !== lastSecond){
            updateTime();
            lastSecond = currentSecond;
        }
    });

});


var input = document.getElementById('search-input');
var searchUri;
var searchInProgress = false;
input.addEventListener('input', function() {
    var searchTerm = input.value.trim();
    if (searchTerm !== "") {
        var encodedSearchTerm = encodeURIComponent(searchTerm);
        searchUri = "https://www.google.com/search?q=" + encodedSearchTerm;
        
    }else {
        searchUri = null; // Reset searchUri if input is empty
    }
});

// Add keydown event listener to the input
input.addEventListener('keydown', function(event) {
    // Check if the Enter key was pressed
    if (event.key === "Enter" && event.target === input) {
        event.preventDefault();
        if(!searchInProgress && searchUri){
            searchInProgress = true;
             // Open the search results in a new browser tab
            window.open(searchUri, '_blank');
            setTimeout(function() {
                searchInProgress = false;
            }, 1000); // Adjust delay as needed
        }
       

    }
});



document.addEventListener('DOMContentLoaded', () => {
    const addTaskButton = document.getElementById('NewTaskButton');
    addTaskButton.addEventListener('click', () => {

        const width = 450;  // Desired width of the popup window
        const height = 500; // Desired height of the popup window

        // Calculate the center position relative to the entire screen
        const left = (window.screen.width / 2) - (width / 2) + window.screenX;
        const top = (window.screen.height / 2) - (height / 2) + window.screenY;

        // Open the popup window
        const popupWindow = window.open(
            'View/newTask.php',
            'popup',
            `width=${width},height=${height},top=${top},left=${left},scrollbars=yes,resizable=no`
        );

        // Optional: Focus the new window
        if (popupWindow) {
            popupWindow.focus();
        }
        const newPopupWidth = 450;
        const newPopupHeight = 500;
        const newPopupUrl = '../View/newTask.php'; // Replace with your URL
        openCenteredPopup(newPopupUrl, newPopupWidth, newPopupHeight);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the class 'editTaskLink'
    const links = document.querySelectorAll('.editTaskLink');
    
    links.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default link behavior
            
            // Get the URL from the href attribute
            const url = link.getAttribute('href');

            // Define the dimensions of the popup window
            const width = 635;
            const height = 700;
    
            // Calculate the position to center the popup
            const left = (window.innerWidth / 2) - (width / 2) + window.screenX;
            const top = (window.innerHeight / 2) - (height / 2) + window.screenY;
    
            // Open the popup window with the desired URL
            const popupWindow = window.open(
                url, // URL for the popup
                'popupWindow', // Name of the popup window
                `width=${width},height=${height},top=${top},left=${left},scrollbars=yes,resizable=no`
            );
    
            // Optional: Focus the popup window
            if (popupWindow) {
                popupWindow.focus();
            }
        });
        link.querySelector('button')?.addEventListener('click', (event) => {
            event.stopPropagation(); // Stop the event from propagating to the parent <a> element
            event.preventDefault(); // Prevent the default button behavior if needed
            // Additional button logic here if needed
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn.btn-dark.mark-done').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default button action

            var taskId = this.getAttribute('data-task-id');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost:8080/Homepage/Controller/activityRequest.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log('Response:', xhr.responseText); // Log the response
                    if (xhr.status === 200 && xhr.responseText.trim() === 'success') {
                        var taskElement = button.closest('a'); // Get the parent <a> element
                        if (taskElement) {
                            // Add fade-out class
                            taskElement.classList.add('fade-out', 'hidden');

                            // Remove the element after the fade-out effect completes
                            setTimeout(function() {
                                taskElement.remove(); // Remove the <a> element from the DOM
                            }, 500); // Match this duration with the CSS transition duration
                        }
                    } else {
                        alert('Failed to update task status. Response: ' + xhr.responseText);
                    }
                }
            };

            // Send AJAX request with taskId, status, and action
            xhr.send('taskId=' + encodeURIComponent(taskId) + '&status=1&action=updateCompletion');
        });
    });
});









