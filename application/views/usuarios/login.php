<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SoftSkill People</title>
        <link rel="stylesheet" href="http://172.16.10.15/tramitacion_judicial/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://172.16.10.15/tramitacion_judicial/assets/bootstrap/css/signin.css">

    <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?>">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>">
      <!-- Ionicons -->
      <link rel="stylesheet" href="<?php echo base_url("assets/ionicons-2.0.1/css/ionicons.min.css"); ?>">

<!--ini-->
<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">

<style type="text/css">
body{
    background-color: #fff;
    padding-top:0px;
}
.fondo{
    background-image: url("<?php echo base_url('assets/dist/img/background_serbanc.jpg');?>");
}
.logo{
padding: 10px 0px;    
}
.frase{
    padding: 30px 0px; 
    text-align: center;
}
.marco{
    top: 0px;
 width: 900px;   
}
.vertical-offset-100{
    padding-top:70px;
    padding-bottom:60px;
}
.soft{
    font-family: 'Fira Sans Extra Condensed', sans-serif;
    font-size: 30px;
    font-weight: bold;
}
</style>
<!--fin-->
  </head>

   <body>
            <!--ini-->
            <div class="container marco" >
                <div class="row">
                    <div class="col-xs-12 logo"><img src="<?php echo base_url('assets/dist/img/logo_serbanc.jpg');?>" width="230" /></div>    
                    
                </div>
            </div>   
            <!--fin-->

        <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <?php
        if (!empty($msg)) {
            echo $this->session->flashdata('msg');
        }
        
        if(isset($_GET["u"])){
                switch ($_GET["u"]){
                    case '1':
                    ?>
                    <div class="alert alert-danger text-center">La cuenta a la cual desea ingresar se encuentra Inactivo.</div>
                    <?php
                    break;
                }
            }
        ?>
         <div class="col-xs-12 fondo">   
            <div class="container" >
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row center">
                                    <span class="soft">SoftSkill People</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?= form_open() ?>
                                    <fieldset>
                                       <?php if (validation_errors()) : ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger" role="alert">
                                                    <?= validation_errors() ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($error)) : ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $error ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!--<label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>-->

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span> 
                                                <input class="form-control" placeholder="Usuario" name="usuario" id="usuario" type="text" autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" value="">
                                            </div>
                                        </div>

                                        <input class="btn btn-lg btn-primary btn-block" type="submit" id="login" value="Ingresar »">
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
           <!--ini-->
           <div class="container marco" >
                <div class="row">
                    <div class="col-xs-12 frase">Operamos desde 1983 como una organización orientada a brindar soluciones de valor agregado a sus clientes en el ámbito de la Cobranza y Aseguramiento de Ingresos.</div>
                </div>
            </div> 
           <!--fin--> 
</html>