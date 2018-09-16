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
                <label class="col-sm-3 control-label">Company Name <span class="asterisk">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="nama" value="<?php echo $CompanyName; ?>" placeholder="Company Name" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan nama perusahaan..." data-trigger="click" required />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Company Address </label>
                <div class="col-sm-6">
                  <textarea name="alamat" id="autoResizeTA" class="form-control popovers" rows="5" style="height: 70px;" data-toggle="popover" data-placement="top" data-content="Isi dengan alamat perusahaan..." data-trigger="click"><?php echo $CompanyAddress; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                  <input type="text" name="desk" value="<?php echo $CompanyDescription;?>" placeholder="Description" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan keterangan perusahaan..." data-trigger="click" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telephone</label>
                <div class="col-sm-6">
                  <input type="text" name="telp" value="<?php echo $CompanyTelp;?>" placeholder="Telephone" class="form-control input-sm popovers" data-toggle="popover" data-placement="top" data-content="Isi dengan nomor telepon perusahaan..." data-trigger="click" />
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
          <h3 class="panel-title">List Company</h3>
        </div>

        <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-striped" id="listdata">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Telephone</th>
                  <th style="width:10%;">Active</th>
                  <th style="width:10%;">User Entry</th>
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

                  <a href="" title="Detail" data-toggle="modal" data-target=".popup-detail<?php echo $query->CompanyId;?>">
                    <?php echo $query->CompanyName;?>
                  </a>
                  <div class="modal fade popup-detail<?php echo $query->CompanyId;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                              <h4 class="modal-title"><?php echo $query->CompanyName;?></h4>
                          </div>
                          <div class="modal-body">

                            <div class="panel-body panel-body-nopadding">

                                <div class="form-group">
                                  <label class="col-sm-12 control-label"><u><b>Company Description</b></u></label>
                                  <div class="col-sm-12">
                                    <p class="text-primary" style="margin-top:4px;text-align:justify;">
                                      <?php echo $query->CompanyDescription;?>
                                    </p>
                                  </div>
                                </div>

                            </div><!-- panel-body -->

                          </div>
                      </div>
                    </div>
                  </div>

                </td>
                <td><?php echo $query->CompanyAddress;?></td>
                <td><?php echo $query->CompanyNoTelp;?></td>
                <td><?php echo $query->CompanyStatusAktif;?></td>
                <td><?php echo $query->UserName;?></td>
                <td class="center"><?php echo $query->CompanyLastUpdate;?></td>
                <td class="center"><?php echo $query->CompanyCreationDate;?></td>
                <td class="table-action">
                  <a href="<?php echo site_url('company_manage/up/'.$query->CompanyId);?>" title="Update"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url('company_manage/del/'.$query->CompanyId.'');?>" title="Delete" class="delete-row"
                    onClick="return confirm('Are you sure you want to delete data \n<?php echo $query->CompanyName;?> ?')">
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
    send_form(document.formdata,"company_manage/save","#gsContent");
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
