 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carteras
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
    <div class="row">

        <?php
        /*
        echo '<pre>';
          print_r($carteras);
        echo '</pre>';
        */
        ?>

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
        <form action="<?php echo base_url("/index.php/operaciones/agregar_cartera");?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Cartera</button>
        </div>
        </form>
    </div>
    <br />

    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Carteras</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="carteras" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Cartera</th>
                  <th>Area</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($carteras)){
                        foreach($carteras as $t){?>
                        <tr>
                            <td><?php echo $t['cartera'] ?></td>
                            <td><?php echo $t['area'] ?></td>
                            <td><a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_cartera/'.$t['id_cartera'])?>">Editar </a>
                            </td>
                    </tr>  
                  <?php }
                } ?>                    
                </tbody>
                <tfoot>
               
                </tfoot>
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
<script>
$(document).ready(function(){
    $('#carteras').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
</script>