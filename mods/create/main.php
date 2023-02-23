<?php

$engine = parse_ini_file(ENGINE .'/lib/config/globals.ini', true);
$domain = parse_ini_file(DOMAIN .'/lib/config/globals.ini', true);
$keys = array(array_keys($engine));

$config = array_replace_recursive($engine, $domain);
$extras = array('key' => array_merge($keys, $config));
$config_data = array_merge($extras, $config);

$ignore = 'key, config, google';

foreach ($config_data as $section => $section_content) {

    if($id === $section) {

        if((strpos($ignore, $section) === false)) {
            
            echo '<header id="'. $section .'" class="'. icon('configure') .'">
                <div class="txt">
                    <h1 class="header">'. ucwords($section) .'</h1>
                    <span class="subheader">Configure settings</span>
                </div>
                </header>';
                    
                echo '<div class="input-form" style="padding-bottom:0rem;">
                    <ul>
                
                    <li>
                        <span class="icon solid fa-search">Search Content</span>
                        <input id="searching" type="text" value="'. $search .'" />
                    </li>
                
                    </ul>
                </div>';
    
              echo '<div class="tbl-responsive-vertical shadow-z-1">
              
              <table id="tbl" class="sortMe tbl tbl-hover">
                
                  <thead>
                      <tr>
                        <th scope="col"><button style="width:100%;">name</button></th>
                        <th scope="col"><button style="width:100%;">details</button></th>
                        <th scope="col"><button style="width:100%;">actions</button></th>
                      </tr>
                  </thead>
                    
                  <tbody id="search">';
            
            ksort($section_content);
            
            foreach($section_content as $key => $value) {
                
                $globals = ENGINE .'/lib/config/globals.ini';
                $default = ini_section($section, $globals);
                $format = $default[$key]['format'];

                $text = (($value === 'value') ? $key[$value['value']] : ini($section, $key));
                $format = ((strpos(explode(',', $format)[1], '/') !== FALSE) ? explode('/', explode(',', $format)[1])[0] .' '. explode(',', $format)[0] : explode(',', $format)[1] .' '. explode(',', $format)[0]);
                $notes = (($value === 'notes') ? $key[$value['notes']] : $default[$key]['notes']);
            
                $key = str_replace("_", " ", $key); 
                $txt = str_replace("_", " ", $text);
                $txt = ((strlen($txt)) ? strtolower($txt) : '<fade>Empty</fade>');

                echo '<tr>
                    
                    <td width="33%" scope="row" data-label="name" data-title="name" data-type="'. ucwords($key) .'">

                        <header class="nomargin nopadding">
                            <div class="txt">
                                <strong class="header">'. ucwords($key) .'</strong>
                            </div>
                        </header>
                    
                    </td>

                    <td width="33%" scope="row" data-label="details" data-title="details" data-type="'. ucwords($txt) .'">

                        <p>
                            <xsmall>'. $section .' | '. $format .'</xsmall><br />
                            <fade style="overflow:hidden;text-overflow:ellipsis;">'. ucwords(substr($txt, 0, 100)) . ((strlen($txt) > 100) ? '...' : null) .'</fade>

                        </p>

                    </td>

                    <td width="33%" scope="row" data-label="actions" data-title="actions">';

                        $status = 'configure';
                        $cat = $section;
                        $edit = ((strlen($status) > 0) ? 'admin?action='. $status .'&event=edit&obj='. $cat .'&id='. $key : 'admin?action='. $key .'&event=edit&obj='. $id);
                    
                        echo '<a class="button primary icon solid fa-edit" href="'. getLink($edit) .'"></a>
                        
                    </td>
                
                </tr>';
            
            }
            
            echo '</tbody>
            
            </table>
            
            </div>';

        }
    
    }
    
}

?>