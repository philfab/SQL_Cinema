document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('modal-overlay');
    const closeButton = document.querySelector('.close-modal');
    const openCastingButton = document.querySelector('.open-casting');
    const closeCastingButton = document.querySelector('.close-casting');
    const openKindButton = document.querySelector('.open-kinds');
    const closeKindButton = document.querySelector('.close-kinds');
    const checkboxes = document.querySelectorAll('.actor-container input[type="checkbox"]');
    const submitButton = document.querySelector('.input-del-role');

    if (overlay){
        function closeModal() {
            history.replaceState (null, null, overlay.dataset.path);     
            overlay.style.display = 'none';  
        }
        overlay.onclick = function(event) {
            if (event.target === overlay) {
                closeModal();
            }
        };
    }
   
    if (closeButton) {
        closeButton.onclick = closeModal;
    }

    if (openCastingButton) 
    openCastingButton.addEventListener('click', () => {
        document.getElementById('casting-modal').style.display = 'flex';
        document.body.style.overflow =  'hidden';
    });
    
    if (closeCastingButton)
    closeCastingButton.addEventListener('click', () => {
        document.getElementById('casting-modal').style.display = 'none';
        document.body.style.overflow =  'auto';
    });

    if (openKindButton)
    openKindButton.addEventListener('click', () => {
        document.getElementById('kinds-modal').style.display = 'flex';
        document.body.style.overflow =  'hidden';
    });
    
    if (closeKindButton)
    closeKindButton.addEventListener('click', () => {
        document.getElementById('kinds-modal').style.display = 'none';
        document.body.style.overflow =  'auto';
    });

   function updateButtonState() {
        if (!submitButton) return;

        const isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        submitButton.disabled = !isAnyChecked;
    }

    if (checkboxes && checkboxes.length > 0) {
        updateButtonState();
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonState);
        });
    }

});

function toggleRoleSelect(checkbox, actorId) {
    var select = document.getElementById('role-select-' + actorId);
    if (checkbox.checked) {
        select.disabled = false; 
        select.selectedIndex = 1;
        select.style.opacity=1;
    } else {
        select.disabled = true; 
        select.selectedIndex = 0;
        select.style.opacity=0.5;
    }
}

