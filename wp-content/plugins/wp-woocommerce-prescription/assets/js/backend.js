"use strict"

jQuery(document).ready(function(){


      var modal = document.getElementById("myModal");

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var modalImg = document.getElementById("img01");
      var captionText = document.getElementById("caption");

      jQuery(document).on('click', '.ordered_prescription .new-upload img', function(){
            var current_image = jQuery(this).attr('src');
              modal.style.display = "flex";
              modalImg.src = current_image;
              captionText.innerHTML = this.alt;
      });
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal

      if (span != undefined){

            span.onclick = function () {
                  modal.style.display = "none";
            }
      }
      jQuery('#prescription_heading').on('focus', function(){
            jQuery('.woocommerce-prescription_page_settings form #heading-error').text('');
      });
      jQuery('#prescription_content').on('focus', function(){
            jQuery('.woocommerce-prescription_page_settings form #content-error').text('');
      });
      jQuery('.woocommerce-prescription_page_settings form').on('submit', function(e){
            var sub_form=jQuery('.woocommerce-prescription_page_settings form');
            var heading = jQuery('#prescription_heading').val();
            var content = jQuery('#prescription_content').val();
            if (heading == '' || content == '' || heading.length > 100 ) {
                e.preventDefault();
                  if (heading=='') {
                        jQuery('.woocommerce-prescription_page_settings form #heading-error').text('Please Fill In Heading Field');
                  }
                  if (heading.length > 100) {
                        jQuery('.woocommerce-prescription_page_settings form #heading-error').text("Heading length can't be greater than 100 characters.");
                  }
                  if (content=='') {
                        jQuery('.woocommerce-prescription_page_settings form #content-error').text('Please Fill In Content Field');
                  }
            } else {
              jQuery(sub_form).submit();
            }
      });
      
});
