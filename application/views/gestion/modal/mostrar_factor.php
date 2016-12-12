<?php

    if(!empty($factor_seleccionadas)){
        
        foreach($factor_seleccionadas as $b){
            $check[] = $b['id_factor'];        
        }       
 
        foreach($factor as $k=>$a){              
        if (in_array($k,$check)) {
            $checked = 'checked';
        } else {
            $checked = '';
        }
        $app = array(      
            'name' => 'factor['.$k.']',
            'value' => ''.$a.'',
            'checked' => ''.$checked.''
        );
        echo "<div class='col-md-1'>";
        echo form_checkbox($app);
        echo $a."</div>";
    
        }
                    
    }else{
    
        foreach($factor as $k=>$a){
        $app = array(
        'name' => 'factor['.$k.']',
        'value' => ''.$a.''
        );
        echo "<div class='col-md-1'>";
        echo form_checkbox($app);
        echo $a."</div>";
    }
        
    }
    
    
 ?>