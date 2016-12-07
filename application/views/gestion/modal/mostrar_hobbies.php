<?php
    foreach($hobbies as $k=>$a){
        $app = array(
        'name' => 'hobbies['.$k.']',
        'value' => ''.$a.''
        );
        echo "<div class='col-md-1'>";
        echo form_checkbox($app);
        echo $a."</div>";
    }
 ?>