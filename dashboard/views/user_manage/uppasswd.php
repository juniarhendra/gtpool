    <div class="contentpanel">

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title"><?php echo $lblInputForm;?></h4>
        </div>

        <form action="" name='formdata' method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
          <div class="panel-body panel-body-nopadding">

              <?php  if ((validation_errors()!=null) || (!empty($err_msg))){ ?>
              <div class="form-group" style="border:0px;"><label class="col-sm-3 control-label"></label><div class="col-sm-6"><div class="alert alert-danger col-sm-12"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
              <?php echo validation_errors(); echo $err_msg;?>
              </div></div></div>
              <?php }?>

              <?php if(!empty($sks_msg)){ ?>
              <div class="form-group" style="border:0px;"><label class="col-sm-3 control-label"></label><div class="col-sm-6"><div class="alert alert-success col-sm-12"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
              <?php echo $sks_msg; ?>
              </div></div></div>
              <?php }?>

              <div class="form-group">
                <label class="col-sm-3 control-label">Password <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="password" name="password_1" value="<?php echo $password_1;?>" placeholder="Password" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan Password..." data-trigger="click" required />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Password Again <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="password" name="password_2" value="<?php echo $password_2;?>" placeholder="Password Again" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan Ulangi Password..." data-trigger="click" required />
                </div>
              </div>

          </div><!-- panel-body -->

          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="save" value="<?php echo $lblInputBtn;?>" class="btn btn-primary">
                  <input type="reset" name="reset" value="CANCEL" class="btn btn-default" onclick="window.location.href = '<?php echo site_url('user_manage/profile')?>'">
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
