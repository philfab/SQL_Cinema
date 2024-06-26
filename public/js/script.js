document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('modal-overlay');
    const closeButton = document.querySelector('.close-modal');
    const openCastingButton = document.querySelector('.open-casting');
    const closeCastingButton = document.querySelector('.close-casting');
    const openKindButton = document.querySelector('.open-kinds');
    const closeKindButton = document.querySelector('.close-kinds');
    const checkboxesDelRole = document.querySelectorAll('.checksDelRole-container input[type="checkbox"]');
    const submitButtonDelRole = document.querySelector('.input-del-role');
    const checkboxesDelKind = document.querySelectorAll('.checksDelKind-container input[type="checkbox"]');
    const submitButtonDelKind = document.querySelector('.input-del-kind');
    const checkboxesDelDirector = document.querySelectorAll('.checksDelDirector-container input[type="checkbox"]');
    const submitButtonDelDirector = document.querySelector('.input-del-director');
    const checkboxesDelActor = document.querySelectorAll('.checksDelActor-container input[type="checkbox"]');
    const submitButtonDelActor = document.querySelector('.input-del-actor');
    const checkboxesDelFilm = document.querySelectorAll('.checksDelFilm-container input[type="checkbox"]');
    const submitButtonDelFilm = document.querySelector('.input-del-film');
    const stars = document.querySelectorAll('#rating-container .star');
    const ratingInput = document.getElementById('note');
    const inputs = document.querySelectorAll('.validate-input');
    
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

        overlay.addEventListener('submit', function(event) {
            if (event.target.tagName === 'FORM') {
                closeModal();
            }
        });
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

   function updateButtonStateDelRole() {
        if (!submitButtonDelRole) return;

        const isAnyChecked = Array.from(checkboxesDelRole).some(checkbox => checkbox.checked);
        submitButtonDelRole.disabled = !isAnyChecked;
    }

    if (checkboxesDelRole && checkboxesDelRole.length > 0) {
        updateButtonStateDelRole();
        checkboxesDelRole.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonStateDelRole);
        });
    }

    function updateButtonStateDelKind() {
        if (!submitButtonDelKind) return;

        const isAnyChecked = Array.from(checkboxesDelKind).some(checkbox => checkbox.checked);
        submitButtonDelKind.disabled = !isAnyChecked;
    }

    if (checkboxesDelKind && checkboxesDelKind.length > 0) {
        updateButtonStateDelKind();
        checkboxesDelKind.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonStateDelKind);
        });
    }

    function updateButtonStateDelDirector() {
        if (!submitButtonDelDirector) return;

        const isAnyChecked = Array.from(checkboxesDelDirector).some(checkbox => checkbox.checked);
        submitButtonDelDirector.disabled = !isAnyChecked;
    }

    if (checkboxesDelDirector && checkboxesDelDirector.length > 0) {
        updateButtonStateDelDirector();
        checkboxesDelDirector.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonStateDelDirector);
        });
    }

    function updateButtonStateDelActor() {
        if (!submitButtonDelActor) return;

        const isAnyChecked = Array.from(checkboxesDelActor).some(checkbox => checkbox.checked);
        submitButtonDelActor.disabled = !isAnyChecked;
    }

    if (checkboxesDelActor && checkboxesDelActor.length > 0) {
        updateButtonStateDelActor();
        checkboxesDelActor.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonStateDelActor);
        });
    }

    function updateButtonStateDelFilm() {
        if (!submitButtonDelFilm) return;

        const isAnyChecked = Array.from(checkboxesDelFilm).some(checkbox => checkbox.checked);
        submitButtonDelFilm.disabled = !isAnyChecked;
    }

    if (checkboxesDelFilm && checkboxesDelFilm.length > 0) {
        updateButtonStateDelFilm();
        checkboxesDelFilm.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonStateDelFilm);
        });
    }

    function setStarRating(value) {
        resetStarColors();
        stars.forEach(star => {
            if (star.dataset.value <= value) {
                star.style.color = 'orange';
            }
        });
    }

    function setStarRating(value) {
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('far');
                star.classList.add('fas'); // étoile pleine
            } else {
                star.classList.add('far');
                star.classList.remove('fas'); // étoile vide
            }
        });
    }

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            setStarRating(this.dataset.value);
        });

        star.addEventListener('mouseout', function() {
            setStarRating(ratingInput.value);
        });

        star.addEventListener('click', function() {
            ratingInput.value = this.dataset.value;
            setStarRating(this.dataset.value);
        });
    });

    //une étoile par défaut
    if (ratingInput) 
    setStarRating(ratingInput.value);

    if (inputs)
    inputs.forEach(input => {
        input.addEventListener('keydown', function(event) {
            if (!/[\p{L}' ]/u.test(event.key)) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('input[type="url"]').forEach(input => {
        const previewId = input.getAttribute('data-preview-target');
        const preview = document.getElementById(previewId);

        input.addEventListener('mouseover', function() {
            const url = input.value;
            if (url) {
                preview.src = url;
                preview.style.display = 'block';
            }
        });

        input.addEventListener('mouseout', function() {
            preview.style.display = 'none';
        });
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

