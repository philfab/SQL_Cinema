document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('modal-overlay');
    if (!overlay) return; 

    function closeModal() {
        history.replaceState (null, null, overlay.dataset.path);     
        overlay.style.display = 'none';  
    }

    const closeButton = document.querySelector('.close-modal');
    if (closeButton) {
        closeButton.onclick = closeModal;
    }

    overlay.onclick = function(event) {
        if (event.target === overlay) {
            closeModal();
        }
    };

    const openCastingButton = document.querySelector('.open-casting');
    openCastingButton.addEventListener('click', () => {
        document.getElementById('casting-modal').style.display = 'flex';
        document.body.style.overflow =  'hidden';
    });
    
    const closeCastingButton = document.querySelector('.close-casting');
    closeCastingButton.addEventListener('click', () => {
        document.getElementById('casting-modal').style.display = 'none';
        document.body.style.overflow =  'auto';
    });
    
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

