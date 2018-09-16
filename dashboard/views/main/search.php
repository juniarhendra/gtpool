    <div class="contentpanel">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Searching project with keyword
            <span class="keywordSearch">
              <?php echo $keywordSearch;?>
              <br/>
            </span>
          </h4>
          Results : <?php echo $show->num_rows();?> items data.
        </div>
      </div><!-- row -->

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title">List Project</h3>
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
                  <th>User Entry</th>
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
                  <a href="<?php echo site_url('project_manage/up/'.$query->ProjectId);?>" title="Update">
                    <?php echo $query->ProjectCode;?>
                  </a>
                </td>
                <td><?php echo $query->CompanyName;?></td>
                <td><?php echo $query->ProjectName;?></td>
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
