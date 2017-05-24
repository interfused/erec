<?php //registration popup modal ?>
<!-- Button trigger modal -->


<div id="reg-modal-wrap" class="modal-reg modal">
	<h2 class="modal-title">Register today</h2>

	<div class="" style="padding:20px;">
		<p>Benefits of registration include:</p>
		<ul>
		  <li>Create and manage your online dossier</li>
		  <li>Industry specific jobs</li>
		  <li>Create and bookmark jobs</li>
		  <li>Create job alerts which get periodically sent to your email </li>
	  </ul>
		<p class="register-submit"><a href="#register-modal-wrap" class="open-popup-link button button-medium" >Register Now</a></p>
        </div>
<button title="Close (Esc)" type="button" class="mfp-close">×</button></div>
<a href="#reg-modal-wrap" class="open-popup-link">Show inline popup</a>
| 
<a class="image-link" href="http://eyerecruit.com/assets/uploads/2014/10/small.jpg">Open popup</a>
	

<script>
jQuery(document).ready(function() {
  jQuery('.image-link').magnificPopup({type:'image'});
  jQuery('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

});

jQuery("#proceedBtn").click(function(e) {
 e.preventDefault();
    //jQuery.magnificPopup.close();
	//jQuery('li#register-modal a').trigger('click');

jQuery.magnificPopup.open({
  items: {
    src: '#register-modal-wrap'
  },
  type: 'inline'

  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
}, 0);

});

</script>