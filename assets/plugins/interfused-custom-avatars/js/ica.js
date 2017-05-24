jQuery('.image-editor').cropit();
        jQuery('form#icaForm').submit(function() {
          // Move cropped image data to hidden input
          var imageData = jQuery('.image-editor').cropit('export');
          jQuery('.hidden-image-data').val(imageData);
          // Print HTTP request params
          var formValue = jQuery(this).serialize();
          jQuery('#result-data').text(formValue);
          // Prevent the form from actually submitting
          return false;
        });