    <div class="contentpanel">

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">My Profile</h4>
        </div>

        <form action="" name='formdata' method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
          <div class="panel-body panel-body-nopadding">

              <div class="form-group">
                <label class="col-sm-3 control-label">Real Name</label>
                <div class="col-sm-6">
                  <p class="text-primary" style="margin-top:10px;"><?php echo $RealName; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm-6">
                  <p class="text-primary" style="margin-top:10px;"><?php echo $UserName; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Group User</label>
                <div class="col-sm-6">
                  <p class="text-primary" style="margin-top:10px;"><?php echo $GroupName; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                  <p class="text-primary" style="margin-top:10px;"><?php echo $Description; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Status Active</label>
                <div class="col-sm-6">
                  <p class="text-primary" style="margin-top:10px;"><?php echo $checked; ?></p>
                </div>
              </div>

          </div><!-- panel-body -->

          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                  <input type="reset" name="reset" value="UPDATE PROFILE" class="btn btn-primary" onclick="window.location.href = '<?php echo site_url('user_manage/up/'.$userId)?>'">
              </div>
            </div>
          </div><!-- panel-footer -->
        </form>

      </div><!-- row -->

    </div><!-- contentpanel -->

<script>
  function savedata()
  {
    send_form(document.formdata,"user_manage/save","#gsContent");
  }

  jQuery(document).ready(function() {

    jQuery('#listdata').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Select2
    jQuery('select').select2({
        minimumResultsForSearch: -1
    });

    // Popover
    jQuery('.popovers').popover();
    
    jQuery('select').removeClass('form-control');
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
     
  });
</script>
