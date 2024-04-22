document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('modal-overlay');
    const buttons = document.querySelectorAll('.button');

  function closeModal() {
        overlay.style.display = 'none';  
  }

  document.querySelector('.close-modal').onclick = closeModal;

  overlay.onclick = function(event) {
      if (event.target === overlay) {
          closeModal();
      }
  };

  buttons.forEach(function(button) {
    button.addEventListener('click', function(event) {
       
        var newUrl = event.currentTarget.href;
        history.replaceState(null, null, newUrl);
    });
});

});
  
