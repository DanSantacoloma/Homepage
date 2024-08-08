document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname;
    const currentSearch = window.location.search;

    if (currentPath === '/Homepage/View/newTask.php') {
        const addTaskButton = document.getElementById('newCustomer');
        if (addTaskButton) {
            addTaskButton.addEventListener('click', () => {
                function openCenteredPopup(url, width, height) {
                    const pageWidth = window.innerWidth;
                    const pageHeight = window.innerHeight;
                    const screenX = window.screenX || window.screenLeft;
                    const screenY = window.screenY || window.screenTop;
                    const left = screenX + Math.max(0, (pageWidth - width) / 2);
                    const top = screenY + Math.max(0, (pageHeight - height) / 2);

                    const popup = window.open(
                        url,
                        'popupWindow',
                        `width=${width},height=${height},top=${top},left=${left},scrollbars=yes,resizable=no`
                    );

                    if (popup) {
                        popup.focus();
                    }
                }

                const newPopupWidth = 300;
                const newPopupHeight = 200;
                const newPopupUrl = '../View/newCustomer.html'; // Replace with your URL
                openCenteredPopup(newPopupUrl, newPopupWidth, newPopupHeight);
            });
        }
    }

    if (currentPath === '/Homepage/View/editActivity.php') {
        document.getElementById('newStep').addEventListener('click', function() {
            const inputs = document.querySelectorAll('.container-steps .form-control');
        
            // Check if the last input field is empty
            const lastInput = inputs[inputs.length - 1];
            if (lastInput && lastInput.value.trim() === '') {
                alert('Please fill out the current step before adding a new one.');
                return; // Stop execution to prevent creating a new step
            }
        
            // Create a new step container
            var newStep = document.createElement('div');
            newStep.className = 'step centered'; // Add 'centered' class for styling
            
            // Create a new text input
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.className = 'form-control full-width mb-3';
            newInput.placeholder = 'Step details';
        
            // Append the input to the new step container
            newStep.appendChild(newInput);
            
            // Append the new step container to the container-steps div
            document.querySelector('.container-steps').appendChild(newStep);
        });
    }
});
