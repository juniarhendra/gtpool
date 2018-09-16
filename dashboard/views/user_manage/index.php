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
                <label class="col-sm-3 control-label">Real Name <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="namalengkap" value="<?php echo $RealName; ?>" placeholder="Real Name" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan nama lengkap..." data-trigger="click" required />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Username <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="username" value="<?php echo $UserName;?>" placeholder="UserName" class="form-control input-sm popovers" data-trigger="click" <?php echo $readonly;?> required />
                </div>
              </div>

              <div class="form-group" style="display:<?php echo $displayPasswd;?>;">
                <label class="col-sm-3 control-label">Password <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="password" name="password_1" value="<?php echo $password_1;?>" placeholder="Password" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan Password..." data-trigger="click" <?php echo $reqPasswd;?>; />
                </div>
              </div>

              <div class="form-group" style="display:<?php echo $displayPasswd;?>;">
                <label class="col-sm-3 control-label">Password Again <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="password" name="password_2" value="<?php echo $password_2;?>" placeholder="Password Again" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan Ulangi Password..." data-trigger="click" <?php echo $reqPasswd;?>; />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Group User <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                  <select name="grupuser" class="select2" required data-placeholder="Choose One" style="width:240px;">
                    <option value=""></option>
                    <?php 
                        foreach ($grupCombo->result() as $row_grup) {
                          if ($row_grup->GroupId == $GroupIdUp) {
                            echo "<option value='".$row_grup->GroupId."' selected >&nbsp;".$row_grup->GroupName."</option>";
                          }else{
                            echo "<option value='".$row_grup->GroupId."'>&nbsp;".$row_grup->GroupName."</option>";
                          }
                     }?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                  <input type="text" name="desk" value="<?php echo $Description;?>" placeholder="Description" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan keterangan tambahan..." data-trigger="click" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-6">
                  <div class="ckbox ckbox-primary">
                    <input name="aktif" id="checkboxPrimary" type="checkbox" <?php echo $checked;?> value="1">
                    <label for="checkboxPrimary"> Status Active</label>
                  </div>
                </div>
              </div>


          </div><!-- panel-body -->

          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="save" value="<?php echo $lblInputBtn;?>" class="btn btn-primary">
                  <input type="reset" name="reset" value="CANCEL" class="btn btn-default" onclick="window.location.href = '<?php echo site_url($content)?>'">
              </div>
            </div>
          </div><!-- panel-footer -->
        </form>

      </div><!-- row -->


      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title"><?php echo $lblListData;?></h3>
        </div>

        <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-striped" id="listdata">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Realname</th>
                  <th>Username</th>
                  <th>Description</th>
                  <th>Status Active</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
            <?php 
              if($show->num_rows() == 0){
              } else {
                $no = 1;
                foreach($show->result() as $query){
            ?>
              <tr class="odd">
                <td><?php echo $no;?>.</td>
                <td class="datatablePrimer"><?php echo $query->RealName;?></td>
                <td><?php echo $query->UserName;?></td>
                <td><?php echo $query->Description;?></td>
                <td><?php echo $query->Active;?></td>
                <td class="table-action">
                  <a href="<?php echo site_url('user_manage/up/'.$query->UserId);?>" title="Update"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url('user_manage/del/'.$query->UserId.'');?>" title="Delete" class="delete-row"
                    onClick="return confirm('Are you sure you want to delete data \n<?php echo $query->RealName;?> ?')">
                    <i class="fa fa-trash-o"></i>
                  </a>
                </td>
              </tr>
            <?php $no++;}?>
            </tbody>
            <?php }?>
           </table>
          </div><!-- table-responsive -->

        </div><!-- panel-body -->

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
