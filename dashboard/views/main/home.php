    <div class="contentpanel">

      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-users"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Jumlah Perusahaan</small>
                    <h1><?php echo $countComp;?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Aktif</small>
                    <h4><?php echo $countCompAct;?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Tidak Aktif</small>
                    <h4><?php echo $countCompNoAct;?></h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-users"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Jumlah Perusahaan</small>
                    <h1><?php echo $countComp;?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Aktif</small>
                    <h4><?php echo $countCompAct;?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Tidak Aktif</small>
                    <h4><?php echo $countCompNoAct;?></h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-gears"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Jumlah Total Proyek</small>
                    <h1><?php echo $countProjTot->num_rows();?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Proyek Selesai</small>
                    <h4><?php echo $countProjDone;?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Proyek Berjalan</small>
                    <h4><?php echo $countProjProc;?></h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-gears"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Proyek Bulan Ini</small>
                    <h1><?php echo $countProjNow->num_rows();?></h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Proyek Selesai</small>
                    <h4><?php echo $countProjNowDone;?></h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">Proyek Berjalan</small>
                    <h4><?php echo $countProjNowProc;?></h4>
                  </div>
                </div><!-- row -->

              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
      </div><!-- row -->

      <div class="row">
        <div class="col-sm-8 col-md-8">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row" style="height:333px;">
                <div class="col-sm-11">
                  <h5 class="subtitle mb5">Graph Project Activity Level This Year</h5>
                  <canvas id="canvas" height="237" width="400"></canvas>
                </div><!-- col-sm-8 -->
              </div><!-- row -->

              <div class="tinystat pull-left">
                <div id="sparkline" class="chart mt5"></div>
                <div class="datainfo">
                  <span class="text-muted">Graph Project Activity Level</span>
                  <h4>Year <?php echo $yearsNow;?></h4>
                </div>
              </div><!-- tinystat -->
              <div class="tinystat pull-right">
                <div id="sparkline2" class="chart mt5"></div>
                <div class="datainfo">
                  <span class="text-muted">Total Project Year <?php echo $yearsNow;?></span>
                  <h4><?php echo $countProjYNow->num_rows();?> item</h4>
                </div>
              </div><!-- tinystat -->

            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-9 -->

        <div class="col-sm-6 col-md-4">
          <div class="panel panel-default panel-alt widget-messaging">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="#" class="panel-edit" style="cursor:default;"><i class="fa fa-gears"></i></a>
              </div><!-- panel-btns -->
              <h3 class="panel-title">Latest projects</h3>
            </div>
            <div class="panel-body">
              <ul>
                <?php 
                  foreach($newProjShow->result() as $querynewProj){
                ?>
                <li>
                  <small class="pull-right"><?php echo $querynewProj->ProjectLastUpdate;?></small>
                  <h4 class="sender"><?php echo $querynewProj->CompanyName;?></h4>
                  <small><?php echo $querynewProj->ProjectName;?></small>
                </li>
                <?php }?>
              </ul>
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        </div><!-- row -->

    </div><!-- contentpanel -->

    <script>
      var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
      var lineChartData = {
        labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
        datasets : [
          {
            label: "My First dataset",
            fillColor : "rgba(220,220,220,0.2)",
            strokeColor : "rgba(220,220,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(220,220,220,1)",
            data : [<?php echo $countProjPerMYNowjan;?>]
          }
        ]

      }

    window.onload = function(){
      var ctx = document.getElementById("canvas").getContext("2d");
      window.myLine = new Chart(ctx).Line(lineChartData, {
        responsive: true
      });
    }
    </script>