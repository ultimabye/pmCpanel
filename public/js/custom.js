<div>
    <a href="https://wa.me/971502853242">
      <img src="whatsapp-icon.png" alt="WhatsApp Icon"></a>
  </div>
   window.addEventListener('scroll', function() {
      var whatsappPlugin = document.querySelector('.whatsapp-plugin');
      var scrollPosition = window.scrollY || window.pageYOffset;
      
      if (scrollPosition > 300) {
        whatsappPlugin.style.display = 'block';
      } else {
        whatsappPlugin.style.display = 'none';
      }
    });