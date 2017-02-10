  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio 
        <small>Resumen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo count($usuarios);?></h3>
              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo count($postulantes);?></h3>
              <p>Postulantes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
                <!-- AREA CHART -->
         <div class="col-md-6">          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Entrevistas Semanal del mes <?=date('M');?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
          </div>
          </div>
          <!-- AREA CHART FIN-->
          <!-- DONUT CHART -->
          <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Entrevistas Semanal del mes <?=date('M');?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="627" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.200012px;"><desc>Created with Raphaël 2.1.0</desc><defs></defs><path style="opacity: 0;" fill="none" stroke="#3c8dbc" d="M313.5,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,401.7277551949771,180.44625304313007" stroke-width="2" opacity="0"></path><path style="" fill="#3c8dbc" stroke="#ffffff" d="M313.5,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,404.56364732624417,181.4248826052307L441.1151459070204,194.03833029452744A135,135,0,0,1,313.5,285Z" stroke-width="3"></path><path style="opacity: 1;" fill="none" stroke="#f56954" d="M401.7277551949771,180.44625304313007A93.33333333333333,93.33333333333333,0,0,0,229.78484627831412,108.73398312817662" stroke-width="2" opacity="1"></path><path style="" fill="#f56954" stroke="#ffffff" d="M404.56364732624417,181.4248826052307A96.33333333333333,96.33333333333333,0,0,0,227.09400205154566,107.40757544301087L187.92726941747117,88.10097469226493A140,140,0,0,1,445.8416327924656,195.6693795646951Z" stroke-width="3"></path><path style="opacity: 0;" fill="none" stroke="#00a65a" d="M229.78484627831412,108.73398312817662A93.33333333333333,93.33333333333333,0,0,0,313.47067846904883,243.333328727518" stroke-width="2" opacity="0"></path><path style="" fill="#00a65a" stroke="#ffffff" d="M227.09400205154566,107.40757544301087A96.33333333333333,96.33333333333333,0,0,0,313.46973599126824,246.3333285794739L313.4575884998742,284.9999933380171A135,135,0,0,1,192.4120097954186,90.31165416754118Z" stroke-width="3"></path><text style="text-anchor: middle; font: 800 15px &quot;Arial&quot;;" x="313.5" y="140" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" font-size="15px" font-weight="800" transform="matrix(1.6311,0,0,1.6311,-198.1553,-94.0291)" stroke-width="0.6130952380952381"><tspan dy="5">In-Store Sales</tspan></text><text style="text-anchor: middle; font: 14px &quot;Arial&quot;;" x="313.5" y="160" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" font-size="14px" transform="matrix(1.9444,0,0,1.9444,-296.5556,-143.5556)" stroke-width="0.5142857142857143"><tspan dy="5">30</tspan></text></svg></div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- DONUT CHART FIN -->  
      </div>

      <div class="clearfix">&nbsp;</div>

      <div class="row">
          <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Founder</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="<?=base_url("assets/dist/img/user1-128x128.jpg")?>" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="<?=base_url("assets/dist/img/user8-128x128.jpg")?>" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="<?=base_url("assets/dist/img/user7-128x128.jpg")?>" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="<?=base_url("assets/dist/img/user6-128x128.jpg")?>" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
              </div>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->

<script>
  $(function () {
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#f56954", "#00a65a"],
      data: [
        {label: "No Entrevistados", value: <?php echo $tot_entrevista_no;?>},
        {label: "Entrevistados", value: <?php echo $tot_entrevista_si;?>}
      ],
      hideHover: 'auto'
    });
    //DONUT CHART
    //AREA CHART
    var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        data:<?php print_r($array_entre);?>,       
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
    //AREA CHART


  });


</script>