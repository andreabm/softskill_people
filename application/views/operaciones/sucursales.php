 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sucursales
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
    <div class="row">


        <div class="col-xs-12">        
        <?php 
        $msje_eliminar = $this->session->flashdata('msje_eliminar');
            if(!empty($msje_eliminar)){
            ?>
            <div id="alertita" class="alert alert-<?php if($msje_eliminar[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_eliminar[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_eliminar[0]==1){echo 'El postulante se ha eliminado.';}else{echo 'No se ha podido eliminar el postulante.';}?>
            </div>        
            <?php }?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/operaciones/agregar_sucursal");?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Sucursal</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Sucursales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="postulantes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($sucursales)) {
                    foreach($sucursales as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['sucursal'] ?></td>                          
                          <td><a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_sucursal/'.$p['id_sucursal'])?>">Editar</a></td>
                        </tr>
                        <?php
                    }
                }                
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<!--MODAL VER POSTULANTE-->