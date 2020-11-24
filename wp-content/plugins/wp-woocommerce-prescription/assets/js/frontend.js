"use strict"

jQuery(document).ready(function(){


var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");

var prescriptionModel = document.getElementById("myPrescritionModal");

var span = document.getElementsByClassName("close")[0];
var myPrescritionclose = document.getElementsByClassName("myPrescritionclose")[0];


var captionText = document.getElementById("caption");
   jQuery(document).on('click','.attach-prescription .tab-container .tabheading', function(){
       var text_val=jQuery(this).text();
       text_val=text_val.trim();
       jQuery.when(jQuery('.attach-prescription .tab-container .tabheading').removeClass('active')).then(jQuery(this).addClass('active'));
     if (text_val == adminajax.strings.prescription_uploaded) {
           jQuery.when(jQuery('.attach-prescription .tab-content .upload-prescription').css('display', 'none')).then(jQuery('.attach-prescription .tab-content .uploaded-prescription').css('display', 'block'));
       }
     if (text_val == adminajax.strings.browse_image) {
           jQuery.when(jQuery('.attach-prescription .tab-content .uploaded-prescription').css('display', 'none')).then(jQuery('.attach-prescription .tab-content .upload-prescription').css('display', 'block'));
       }
    });

    jQuery(document).on('click', '.valid-prescription .close', function(){
           jQuery(this).parents('#prescriptionDetailModal').remove();
    });
    jQuery('input[type=radio][name=prescription_upload]').change(function () {

      if (this.value == 'now') {
        jQuery(".attach-prescription").css("display", "block");
        jQuery.ajax({
          url: adminajax.url,
          type: "POST",
          data: {
            'action': 'wkwp_attachment_save_time', 'time': this.value
          },
          success: function (response) {
            jQuery.when(jQuery('.valid-prescription').append(response)).then(jQuery('.valid-prescription #prescriptionDetailModal').css('display', 'block'));
          },
          error: function (error) {
            console.log(adminajax.strings.error)
          }
        });
      }else{
        jQuery(".attach-prescription").css("display", "none");
        jQuery.ajax({
            url: adminajax.url,
            type: "POST",
          data: { 'action': 'wkwp_attachment_save_time', 'time':  this.value },
            success: function(response) {
                 jQuery.when(jQuery('.valid-prescription').append(response)).then(jQuery('.valid-prescription #prescriptionDetailModal').css('display', 'block'));
            },
            error: function(error) {
              console.log(adminajax.strings.error)
            }
          });
      }
    });

    jQuery(document).on('click', '.valid-prescription', function(){

          prescriptionModel.style.display = "flex";

    });



    jQuery(document).on('click', '.uploaded_prescription.checkout .new-upload img', function () {
    
      var current_image = jQuery(this).attr('src');
      modal.style.display = "flex";
      modalImg.src = current_image;
      captionText.innerHTML = this.alt;
   
    });


    // When the user clicks on <span> (x), close the modal
    
    if(span != undefined){

      span.onclick = function () {

        modal.style.display = "none";

      }
    }

    if (myPrescritionclose != undefined) {

      myPrescritionclose.onclick = function () {
 
        prescriptionModel.style.display = "none"
      }
    }

    jQuery('.attach-prescription .upload-prescription').on('click','.close', function(){
           jQuery(this).parents('#prescriptionModal').remove();
    });

    jQuery('.attach-prescription .upload-prescription, .uploaded_prescription.checkout').on('click', '.new-upload img', function(){
           var current_image = jQuery(this).attr('src');
           modal.style.display = "flex";
           modalImg.src = current_image;
           captionText.innerHTML = this.alt;
    });

    jQuery('input[type=file]#attach-prescription-input').change(function () {
       var fd = new FormData();
       var fileName=this.files[0].name;
       var elem = jQuery(this);
       var individual_file = elem[0].files[0];
       fd.append("file", individual_file);
      fd.append("action", 'wkwp_add_session_prescription');
       fileName = fileName.split('.');
       var fileLength=fileName.length;
       var ext=fileName[fileLength-1];
       if (ext!='jpg' && ext!='png' && ext!='jpeg') {
         alert(adminajax.strings.invalid_image);
       } else {
          jQuery.ajax({
            url: adminajax.url,
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
              if (response){
                jQuery.when(jQuery('.upload-prescription').append('<div class="new-upload"><img src="' + response + '" style="height:100%"><button class="remove-prescription"><span class="remove-txt">Remove</span><span class="cross-sign">X</span></button></>')).then(location.reload());
              }else{
                alert("You are uploading same image again!!")
              }
            },
            error: function(error) {
              console.log(adminajax.strings.error)
            }
          })
       }
    });

    jQuery('input[type=file]#attach-prescription-input-later').change(function () {
       var fd = new FormData();
       var fileName=this.files[0].name;
       var elem = jQuery(this);
       var individual_file = elem[0].files[0];
       var order_id = 0;
       if (document.querySelector('#order_id')) {
         order_id = document.querySelector('#order_id').value;
       }
       console.log(individual_file);
       fd.append("file", individual_file);
      fd.append("action", 'wkwp_add_order_prescription_from_uploaded');
       fd.append("order_id", order_id);
       fileName = fileName.split('.');
       var fileLength=fileName.length;
       var ext=fileName[fileLength-1];
       if (ext!='jpg' && ext!='png' && ext!='jpeg') {
         alert(adminajax.strings.invalid_image);
       } else {
          jQuery.ajax({
            url: adminajax.url,
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
              if(response){
                jQuery.when(jQuery('.upload-prescription').append('<div class="new-upload"><img src="'+response+'" style="height:100%"><button class="remove-prescription"><span class="remove-txt">Remove</span><span class="cross-sign">X</span></button></>')).then(location.reload());
              }
              else{
                alert(adminajax.strings.error);
                
              }
            },
            error: function(error) {
              console.log(adminajax.strings.error)
            }
          })
       }
    });
    jQuery(document).on('click','.remove-prescription', function(e) {
        e.preventDefault();
        var to_be_remove=jQuery(this);
        var remove_prescription=jQuery(this).siblings('img').attr('src');
        jQuery.ajax({
          url: adminajax.url,
          type: "POST",
          data: { 'action': 'wkwp_remove_session_prescription', 'remove_prescription':remove_prescription},
          success: function(response) {
             jQuery.when(jQuery(to_be_remove).parents('.new-upload').css('display', 'none')).then(location.reload());
          },
          error: function(error) {
            console.log(adminajax.strings.error)
          }
        })
    });

    jQuery('.uploaded-prescription .new-upload').on('click', function(){
         var clicked_val=jQuery(this);
         var val_img= clicked_val.children('img').attr('src');
         jQuery.ajax({
           url: adminajax.url,
           type: "POST",
           data: { 'action': 'wkwp_add_session_prescription_from_uploaded', 'add_prescription':val_img},
           success: function(response) {
                alert(response);
                location.reload();
           },
           error: function(error) {
             console.log(adminajax.strings.error)
           }
         })
    });
});
