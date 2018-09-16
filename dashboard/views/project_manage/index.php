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
                <label class="col-sm-3 control-label">Project Code <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="kode" value="<?php echo $ProjectCode;?>" placeholder="Project Code" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan kode project..." data-trigger="click" required />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Company Name <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                  <select name="company" class="select2" required data-placeholder="Choose One" style="width:240px;">
                    <option value=""></option>
                    <?php 
                        foreach ($compAct->result() as $row_company) {
                          if ($row_company->CompanyId == $CompanyIdUp) {
                            echo "<option value='".$row_company->CompanyId."' selected >&nbsp;".$row_company->CompanyName."</option>";
                          }else{
                            echo "<option value='".$row_company->CompanyId."'>&nbsp;".$row_company->CompanyName."</option>";
                          }
                     }?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Project Name <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <textarea name="pekerjaan" id="autoResizeTA" class="form-control popovers" rows="5" style="height: 70px;" data-toggle="popover" data-placement="top" data-content="Isi dengan nama pekerjaan..." data-trigger="click" required><?php echo $ProjectName; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Status Process <span class="asterisk">*</span></label>
                <div class="col-sm-9">
                  <select name="status" class="select2" required data-placeholder="Choose One" style="width:240px;">
                    <option value=""></option>
                    <option value='Processing' <?php echo $ProjectStatusProc; ?>>&nbsp; Processing</option>
                    <option value='Done' <?php echo $ProjectStatusDone; ?>>&nbsp; Done</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Description <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <textarea name="desk" id="autoResizeTA" class="form-control popovers" rows="5" style="height: 70px;" data-toggle="popover" data-placement="top" data-content="Isi dengan keterangan/detail pekerjaan..." data-trigger="click" required><?php echo $ProjectDescription; ?></textarea>
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
                  <th>Project Code</th>
                  <th>Company Name</th>
                  <th>Project</th>
                  <th>Status</th>
                  <th style="width:10%">User Entry</th>
                  <th>Date Entry</th>
                  <th>Last Update</th>
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
                <td class="datatablePrimer">

                  <a href="" title="Detail" data-toggle="modal" data-target=".popup-detail<?php echo $query->ProjectId;?>">
                    <?php echo $query->ProjectCode;?>
                  </a>
                  <div class="modal fade popup-detail<?php echo $query->ProjectId;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                              <h4 class="modal-title"><?php echo $query->ProjectCode;?></h4>
                          </div>
                          <div class="modal-body">

                            <div class="panel-body panel-body-nopadding">

                                <div class="form-group">
                                  <label class="col-sm-12 control-label"><u><b>Description</b></u></label>
                                  <div class="col-sm-12">
                                    <p class="text-primary" style="margin-top:4px;text-align:justify;">
                                      <?php echo $query->ProjectDescription;?>
                                    </p>
                                  </div>
                                </div>

                            </div><!-- panel-body -->

                          </div>
                      </div>
                    </div>
                  </div>

                </td>
                <td><?php echo $query->CompanyName;?></td>
                <td><?php echo $query->ProjectName;?></td>
                <td class="center"><?php echo $query->ProjectStatus;?></td>
                <td class="center"><?php echo $query->UserName;?></td>
                <td class="center"><?php echo $query->ProjectLastUpdate;?></td>
                <td class="center"><?php echo $query->ProjectLastUpdate;?></td>
                <td class="table-action">
                  <a href="<?php echo site_url('project_manage/up/'.$query->ProjectId);?>" title="Update"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url('project_manage/del/'.$query->ProjectId.'');?>" title="Delete" class="delete-row"
                    onClick="return confirm('Are you sure you want to delete data \n<?php echo $query->ProjectName;?> ?')">
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
    send_form(document.formdata,"project_manage/save","#gsContent");
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
