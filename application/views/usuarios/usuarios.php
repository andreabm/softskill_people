 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small> del sistema</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="ejecutivos" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Rut</th>
                  <th>Nombre</th>
                  <th>Rango</th>
                  <th>E-mail</th>
                  <th>Avatar</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($usuarios)){
                        foreach($usuarios as $t){?>
                        <tr>
                            <td><?php echo $t['rut'] ?></td>
                            <td><?php echo $t['nombre'] ?></td>
                            <td><?php echo $t['rango'] ?></td>
                            <td><?php echo $t['mail'] ?></td>
                            <td style="text-align: center;"><img src="<?php echo $t['img'] ?>" class="img-circle" alt="User Image"  style="width: 40px; "></td>
                            <td>
                              <a class="btn btn-xs btn-warning" href="<?php echo base_url('/index.php/usuarios/editar_usuario/'.$t['id_usuario']);?>">Editar</a>
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

</div>
<script>
$(document).ready(function(){
    $('#ejecutivos').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
</script>