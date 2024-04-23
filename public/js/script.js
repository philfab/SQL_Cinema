document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('modal-overlay');

  function closeModal() {
        history.replaceState (null, null, overlay.dataset.path);     
        overlay.style.display = 'none';  
  }

  document.querySelector('.close-modal').onclick = closeModal;

  overlay.onclick = function(event) {
      if (event.target === overlay) {
          closeModal();
      }
  };


});
  
