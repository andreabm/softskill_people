 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Entidades
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
    <div class="row">


        <div class="col-xs-12">        
        <?php 
            $msje_eliminar = $this->session->flashdata('msje_eliminar');
            if(!empty($msje_eliminar)){?>
            <div id="alertita" class="alert alert-<?php if($msje_eliminar[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_eliminar[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_eliminar[0]==1){echo 'El postulante se ha eliminado.';}else{echo 'No se ha podido eliminar el postulante.';}?>
            </div>        
            <?php }?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12"></div>
        <form action="<?php echo base_url("/index.php/operaciones/agregar_entidad");?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Entidad</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
          <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Afps</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Salud</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <table id="postulantes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($afps)) {
                    foreach($afps as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['nombre_entidad'] ?></td>                          
                          <td><a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_entidad/'.$p['id_entidad'])?>">Editar</a></td>
                        </tr>
                        <?php
                    }
                }?>
                </tbody>
              </table>
              </div>

              <div class="tab-pane" id="timeline">
                <table id="postulantes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($salud)) {
                    foreach($salud as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['nombre_entidad'] ?></td>                          
                          <td><a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_entidad/'.$p['id_entidad'])?>">Editar</a></td>
                        </tr>
                        <?php
                    }
                }                
                ?>
                </tbody>
              </table>
              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
      </div>
      <!-- /.row -->
    </section>
<!--MODAL VER POSTULANTE-->