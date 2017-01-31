<?php

    if(!empty($hobbies_seleccionadas)){      
        foreach($hobbies_seleccionadas as $b){
            $check[] = $b['id_hobbies'];        
        }       
 
        foreach($hobbies as $k=>$a){              
        if (in_array($k,$check)) {
            $checked = 'checked';
        } else {
            $checked = '';
        }
        $app = array(      
            'name' => 'hobbies['.$k.']',
            'value' => ''.$a.'',
            'checked' => ''.$checked.''
        );
        echo "<div class='col-md-2'>";
        echo form_checkbox($app);
        echo $a."</div>";
    
        }
                    
    }else{
    
        foreach($hobbies as $k=>$a){
        $app = array(
        'name' => 'hobbies['.$k.']',
        'value' => ''.$a.''
        );
        echo "<div class='col-md-2'>";
        echo form_checkbox($app);
        echo $a."</div>";
    }
        
    }
    
    
 ?>