
 // To display the promo items. The code is in index
   function detailsmodal(id){
     var data = {"id" : id};
     jQuery.ajax({
       url : '/Habitual/includes/007modal.php',
       method : "post",
       data : data,
       success: function(data){
         jQuery('body').append(data);
         jQuery('#details-modal').modal('toggle');
       },
       error: function(){alert("Something went wrong!")},
     });
   }

  // To close the display of promo items
     function closeModel(){
       jQuery('#details-modal').modal('hide');
       setTimeout(function(){
         jQuery('#details-modal').remove();
         jQuery('.modal-backdrop').remove();
       },500);
     }

// For Navbar Dropdown
   function dropdownMenu(){
     var x = document.getElementById("dropdownClick");
     if (x.className === "navbar") {
       x.className += " responsive";
     }else {
       x.className = "navbar";
     }
   }
