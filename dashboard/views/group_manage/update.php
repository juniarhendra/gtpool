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
                <label class="col-sm-3 control-label">Group Name <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="group" value="<?php echo $GroupName; ?>" placeholder="Group Name" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan nama grup..." data-trigger="click" required />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                  <input type="text" name="desk" value="<?php echo $Description;?>" placeholder="Description" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan keterangan tambahan..." data-trigger="click" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Menu Setting</label>
                <div class="col-sm-9">
                  <?php 
                    foreach($showMenuActive->result() as $queryMenuActive){
                      if ($queryMenuActive->MenuParentId == 0) {
                        $getMenuChecked = $this->group_model->show_menu_checked_loop($param,$queryMenuActive->MenuId);
                        if ($getMenuChecked->row()->total != 0) $checked = 'checked="checked"';
                        else $checked = '';
                  ?>
                    <div class="ckbox ckbox-primary">
                      <input type="checkbox" class="parentmenu_<?php echo $queryMenuActive->MenuId;?>" id="menu_<?php echo $queryMenuActive->MenuId;?>" value="<?php echo $queryMenuActive->MenuId;?>" name="menu[]" <?php echo $checked;?> />
                      <label for="menu_<?php echo $queryMenuActive->MenuId;?>"><b><?php echo $queryMenuActive->MenuName;?></b></label>
                    </div>

                      <?php 
                        foreach($showMenuActive->result() as $queryMenuActiveChild){
                          if ($queryMenuActiveChild->MenuParentId == $queryMenuActive->MenuId) {
                              $getMenuChecked = $this->group_model->show_menu_checked_loop($param,$queryMenuActiveChild->MenuId);
                              if ($getMenuChecked->row()->total != 0) $checked = 'checked="checked"';
                              else $checked = '';
                      ?>
                              <div class="ckbox ckbox-primary">
                                &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="childmenu_<?php echo $queryMenuActiveChild->MenuParentId;?>" id="menu_<?php echo $queryMenuActiveChild->MenuId;?>" value="<?php echo $queryMenuActiveChild->MenuId;?>" name="menu[]" <?php echo $checked;?> />
                                --- <label for="menu_<?php echo $queryMenuActiveChild->MenuId;?>"><i><?php echo $queryMenuActiveChild->MenuName;?></i></label>
                              </div>
                              <script type="text/javascript">
                                  jQuery(document).ready(function() {
                                      var parentmenuid  = <?php echo $queryMenuActive->MenuId;?>;
                                      jQuery('.parentmenu_'+parentmenuid).click(function () {
                                        if ($('.parentmenu_'+parentmenuid).is(':checked') == true) {
                                          jQuery('.childmenu_'+parentmenuid).attr('checked', 'checked');
                                        }else{
                                          jQuery('.childmenu_'+parentmenuid).removeAttr('checked');
                                        }
                                      });

                                      var childmenu_  = <?php echo $queryMenuActiveChild->MenuParentId;?>;
                                      jQuery('.childmenu_'+childmenu_).click(function () {
                                        if ($('.childmenu_'+childmenu_).is(':checked') == true) {
                                          jQuery('.parentmenu_'+childmenu_).attr('checked', 'checked');
                                        }else{
                                          jQuery('.parentmenu_'+childmenu_).removeAttr('checked');
                                        }
                                      });
                                  });
                              </script>
                      <?php
                          }
                        }
                      ?>
                  <?php
                    }}
                  ?>
                </div>
              </div>

          </div><!-- panel-body -->

          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="save" value="<?php echo $lblInputBtn;?>" class="btn btn-primary">
                  <input type="reset" name="reset" value="CANCEL" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("group_manage/index")?>'">
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
                  <th>Group Name</th>
                  <th>Description</th>
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
                <td class="datatablePrimer"><?php echo $query->GroupName;?></td>
                <td><?php echo $query->Description;?></td>
                <td class="table-action">
                  <a href="<?php echo site_url('group_manage/up/'.$query->GroupId);?>" title="Update"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url('group_manage/del/'.$query->GroupId.'');?>" title="Delete" class="delete-row"
                    onClick="return confirm('Are you sure you want to delete data \n<?php echo $query->GroupName;?> ?')">
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
    send_form(document.formdata,"group_manage/save","#gsContent");
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