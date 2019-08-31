


<br><br><br><br>
    <!--        Footer   -->
<hr>
<footer class="footer bg-inverse bg-light">
      <div class="col-md-12 text-center">
        &copy Jingo & Sabainah 2019
      </div>
</footer>

<script>
  function get_child_options(){
    var parentID = jQuery('#parent').val();
    jQuery.ajax({
      url: '/Habitual/admin/jingo/habitual.php',
      type: 'POST',
      data: {parentID : parentID},
      success: function(data){
        jQuery('#child').html(data);
      },
      error: function(){alert("Something when wrong with the child options.")},
    });
  }
  jQuery('select[name="parent"]').change(get_child_options);
</script>
