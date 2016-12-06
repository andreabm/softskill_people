<table class="table">
<?php //var_dump($postulante); ?>
    <tr>
        <th>RUT</th>
        <td><?php echo $postulante[0]['rut']?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?php echo $postulante[0]['nombre']?></td>
    </tr>
    <tr>
        <th>Fecha Nacimiento</th>
        <td><?php echo $postulante[0]['fecha_nacimiento']?></td>
    </tr>
    <tr>
        <th>Estado civil</th>
        <td><?php echo $postulante[0]['edo_civil']?></td>
    </tr>
    <tr>
        <th>Fono movil</th>
        <td><?php echo $postulante[0]['fono_movil']?></td>
    </tr>
    <tr>
        <th>Fono fijo</th>
        <td><?php echo $postulante[0]['fono_fijo']?></td>
    </tr>
    <tr>
        <th>Discapacidad</th>
        <td><?php echo $postulante[0]['discapacidad']?></td>
    </tr>
    <tr>
        <th>Fuente</th>
        <td><?php echo $postulante[0]['fuente']?></td>
    </tr>
    <tr>
        <th>Pretensiones de Renta</th>
        <td><?php echo $postulante[0]['pretension_renta']?></td>
    </tr>
    <tr>
        <th>Fecha de Entrevista</th>
        <td><?php echo $postulante[0]['fecha_entrevista']?></td>
    </tr>
    <tr>
        <th>Califica</th>
        <?php
        if ($postulante[0]['clasificado'] == 1){
            $val = 'Si';
          } elseif (!empty($postulante[0]['id_motivo_no_califica'])) {
            $val = 'No. '.$motivos_no_califica[$postulante[0]['id_motivo_no_califica']];
          } else {
            $val = 'No reportado';
          }
          ?>
        <td><?php echo $val?></td>
    </tr> 
    <tr>
        <th>Cargo</th>
        <td><?php echo $postulante[0]['cargo']?></td>
    </tr>
    <tr>
        <th>Turnos disponibles</th>
        <?php
        $turnos_string = ''; 
        foreach ($turnos as $t) {
            $turnos_string .= $t['turno'].'<br>';
        }
        ?>
        <td><?php echo $turnos_string ?></td>
    </tr>
    <tr>
        <th>Direccion</th>
        <td><?php echo $postulante[0]['direccion']?></td>
    </tr>
</table>