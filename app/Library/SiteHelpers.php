<?php

namespace App\Library;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class SiteHelpers
{
    public static function menus($position = 'top', $active = '1')
    {
        $data = array();
        $menu = self::nestedMenu(0, $position, $active);
        foreach ($menu as $row) {
            $child_level = array();
            $p = json_decode($row->access_data, true);


            if ($row->allow_guest == 1) {
                $is_allow = 1;
            } else {
                $is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
            }
            if ($is_allow == 1) {

                $menus2 = self::nestedMenu($row->menu_id, $position, $active);
                if (count($menus2) > 0) {
                    $level2 = array();
                    foreach ($menus2 as $row2) {
                        $p = json_decode($row2->access_data, true);
                        if ($row2->allow_guest == 1) {
                            $is_allow = 1;
                        } else {
                            $is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
                        }

                        if ($is_allow == 1) {

                            $menu2 = array(
                                'menu_id' => $row2->menu_id,
                                'module' => $row2->module,
                                'menu_type' => $row2->menu_type,
                                'url' => $row2->url,
                                'menu_name' => $row2->menu_name,
                                'menu_lang' => json_decode($row2->menu_lang, true),
                                'menu_icons' => $row2->menu_icons,
                                'childs' => array()
                            );

                            $menus3 = self::nestedMenu($row2->menu_id, $position, $active);
                            if (count($menus3) > 0) {
                                $child_level_3 = array();
                                foreach ($menus3 as $row3) {
                                    $p = json_decode($row3->access_data, true);
                                    if ($row3->allow_guest == 1) {
                                        $is_allow = 1;
                                    } else {
                                        $is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
                                    }
                                    if ($is_allow == 1) {
                                        $menu3 = array(
                                            'menu_id' => $row3->menu_id,
                                            'module' => $row3->module,
                                            'menu_type' => $row3->menu_type,
                                            'url' => $row3->url,
                                            'menu_name' => $row3->menu_name,
                                            'menu_lang' => json_decode($row3->menu_lang, true),
                                            'menu_icons' => $row3->menu_icons,
                                            'childs' => array()
                                        );
                                        $child_level_3[] = $menu3;
                                    }
                                }
                                $menu2['childs'] = $child_level_3;
                            }
                            $level2[] = $menu2;
                        }

                    }
                    $child_level = $level2;

                }

                $level = array(
                    'menu_id' => $row->menu_id,
                    'module' => $row->module,
                    'menu_type' => $row->menu_type,
                    'url' => $row->url,
                    'menu_name' => $row->menu_name,
                    'menu_lang' => json_decode($row->menu_lang, true),
                    'menu_icons' => $row->menu_icons,
                    'childs' => $child_level
                );

                $data[] = $level;
            }

        }
        //echo '<pre>';print_r($data); echo '</pre>'; exit;
        return $data;
    }

    public static function nestedMenu($parent = 0, $position = 'top', $active = '1')
    {
        $group_sql = " AND tb_menu_access.group_id ='" . Session::get('gid') . "' ";
        $active = ($active == 'all' ? "" : "AND active ='1' ");
        $Q = DB::select("
		SELECT 
			tb_menu.*
		FROM tb_menu WHERE parent_id ='" . $parent . "' " . $active . " AND position ='{$position}'
		GROUP BY tb_menu.menu_id ORDER BY ordering			
		");
        return $Q;
    }

    public static function CF_encode_json($arr)
    {
        $str = json_encode($arr);
        $enc = base64_encode($str);
        $enc = strtr($enc, 'poligamI123456', '123456poligamI');
        return $enc;
    }

    public static function CF_decode_json($str)
    {
        $dec = strtr($str, '123456poligamI', 'poligamI123456');
        $dec = base64_decode($dec);
        $obj = json_decode($dec, true);
        return $obj;
    }


    public static function columnTable($table)
    {
        $columns = array();
        foreach (DB::select("SHOW COLUMNS FROM $table") as $column) {
            //print_r($column);
            $columns[] = $column->Field;
        }


        return $columns;
    }

    public static function encryptID($id, $decript = false, $pass = '', $separator = '-', & $data = array())
    {
        if (empty($id)) $id = 1;
        $pass = $pass ? $pass : Config::get('app.key');
        $pass2 = Config::get('app.url');;
        $bignum = 200000000;
        $multi1 = 500;
        $multi2 = 50;
        $saltnum = 10000000;
        if ($decript == false) {
            $strA = self::alphaid(($bignum + ($id * $multi1)), 0, 0, $pass);
            $strB = self::alphaid(($saltnum + ($id * $multi2)), 0, 0, $pass2);
            $out = $strA . $separator . $strB;
        } else {
            $pid = explode($separator, $id);


            //    trace($pid);
            $idA = (self::alphaid($pid[0], 1, 0, $pass) - $bignum) / $multi1;
            $idB = (self::alphaid($pid[1], 1, 0, $pass2) - $saltnum) / $multi2;
            $data['id A'] = $idA;
            $data['id B'] = $idB;
            $out = ($idA == $idB) ? $idA : false;
        }
        return $out;
    }

    public static function alphaID($in, $to_num = false, $pad_up = false, $passKey = null)
    {
        $index = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
        if ($passKey !== null) {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // with this patch by Simon Franz (http://blog.snaky.org/)
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID

            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $passhash = hash('sha256', $passKey);
            $passhash = (strlen($passhash) < strlen($index))
                ? hash('sha512', $passKey)
                : $passhash;

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] = substr($passhash, $n, 1);
            }

            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }

        $base = strlen($index);

        if ($to_num) {
            // Digital number    <<--    alphabet letter code
            $in = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number    -->>    alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
//                $bcp =bcpow($base, $t,2)??0;
                $bcp =1;
                $a = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }

        return $out;
    }


    public static function toForm($forms, $layout)
    {
        $f = '';
        usort($forms, "self::_sort");
        $block = $layout['column'];
        $format = $layout['format'];
        $display = $layout['display'];
        $title = explode(",", $layout['title']);

        if ($format == 'tab') {
            $f .= '<ul class="nav nav-tabs">';

            for ($i = 0; $i < $block; $i++) {
                $active = ($i == 0 ? 'active' : '');
                $tit = (isset($title[$i]) ? $title[$i] : 'None');
                $f .= '<li class="' . $active . '"><a href="#' . trim(str_replace(" ", "", $tit)) . '" data-toggle="tab">' . $tit . '</a></li>
				';
            }
            $f .= '</ul>';
        }

        if ($format == 'tab') $f .= '<div class="tab-content">';
        for ($i = 0; $i < $block; $i++) {
            if ($block == 4) {
                $class = 'col-md-3';
            } elseif ($block == 3) {
                $class = 'col-md-4';
            } elseif ($block == 2) {
                $class = 'col-md-6';
            } else {
                $class = 'col-md-12';
            }

            $tit = (isset($title[$i]) ? $title[$i] : 'None');
            // Grid format
            if ($format == 'grid') {
                $f .= '<div class="' . $class . '">
						<fieldset><legend> ' . $tit . '</legend>
				';
            } else {
                $active = ($i == 0 ? 'active' : '');
                $f .= '<div class="tab-pane m-t ' . $active . '" id="' . trim(str_replace(" ", "", $tit)) . '"> 
				';
            }


            $group = array();

            foreach ($forms as $form) {
                $tooltip = '';
                $required = ($form['required'] != '0' ? '<span class="asterix"> * </span>' : '');
                if ($form['view'] != 0) {
                    if ($form['field'] != 'entry_by') {
                        if (isset($form['option']['tooltip']) && $form['option']['tooltip'] != '')
                            $tooltip = '<a href="#" data-toggle="tooltip" placement="left" class="tips" title="' . $form['option']['tooltip'] . '"><i class="icon-question2"></i></a>';
                        $hidethis = "";
                        if ($form['type'] == 'hidden') $hidethis = 'hidethis';
                        $inhide = '';
                        if (count($group) > 1) $inhide = 'inhide';
                        //$ebutton = ($form['type'] =='radio' || $form['option'] =='checkbox') ? "ebutton-radio" : "";
                        $show = '';
                        if ($form['type'] == 'hidden') $show = 'style="display:none;"';
                        if (isset($form['limited']) && $form['limited'] != '') {
                            $limited_start =
                                '
				<?php 
				$limited = isset($fields[\'' . $form['field'] . '\'][\'limited\']) ? $fields[\'' . $form['field'] . '\'][\'limited\'] :\'\';
				if(self::filterColumn($limited )) { ?>
							';
                            $limited_end = '
				<?php } ?>';
                        } else {
                            $limited_start = '';
                            $limited_end = '';
                        }

                        if ($form['form_group'] == $i) {
                            if ($display == 'horizontal') {
                                if ($form['type'] == 'hidden') {
                                    $f .= self::formShow($form['type'], $form['field'], $form['required'], $form['option']);
                                } else {
                                    $f .= $limited_start;
                                    $f .= '					
									  <div class="form-group ' . $hidethis . ' ' . $inhide . '" ' . $show . '>
										<label for="' . $form['label'] . '" class=" control-label col-md-4 text-left"> ' . $form['label'] . ' ' . $required . '</label>
										<div class="col-md-6">
										  ' . self::formShow($form['type'], $form['field'], $form['required'], $form['option']) . ' 
										 </div> 
										 <div class="col-md-2">
										 	' . $tooltip . '
										 </div>
									  </div> ';
                                    $f .= $limited_end;
                                }

                            } else {

                                if ($form['type'] == 'hidden') {
                                    $f .= self::formShow($form['type'], $form['field'], $form['required'], $form['option']);
                                } else {
                                    $f .= $limited_start;
                                    $f .= '					
									  <div class="form-group ' . $hidethis . ' ' . $inhide . '" ' . $show . '>
										<label for="ipt" class=" control-label "> ' . $form['label'] . '  ' . $required . ' ' . $tooltip . ' </label>									
										  ' . self::formShow($form['type'], $form['field'], $form['required'], $form['option']) . ' 						
									  </div> ';
                                    $f .= $limited_end;
                                }


                            }
                        }
                    }

                }
            }
            if ($format == 'grid') $f .= '</fieldset>';
            if ($format == 'tab') $f .= '</div>';
            $f .= '
			</div>
			
			';
        }

        //echo '<pre>'; print_r($f);echo '</pre>'; exit;
        return $f;

    }

    public static function gridClass($layout)
    {
        $column = $layout['column'];
        $format = $layout['format'];

        if ($block == 4) {
            $class = 'col-md-3';
        } elseif ($block == 3) {
            $class = 'col-md-4';
        } elseif ($block == 2) {
            $class = 'col-md-6';
        } else {
            $class = 'col-md-12';
        }


        if (format == 'tab') {
            $tag_open = '<div class="col-md-">';
            $tag_close = '<div class="col-md-">';

        } elseif ($layout['format'] == 'accordion') {

        } else {
            $tag_open = '<div class="col-md-">';
            $tag_close = '</div>';
        }


        return $class;
    }


    public static function formShow($type, $field, $required, $option = array())
    {
        //print_r($option);
        $mandatory = '';
        $attribute = '';
        $extend_class = '';
        if (isset($option['attribute']) && $option['attribute'] != '') {
            $attribute = $option['attribute'];
        }
        if (isset($option['extend_class']) && $option['extend_class'] != '') {
            $extend_class = $option['extend_class'];
        }

        $show = '';
        if ($type == 'hidden') $show = 'style="display:none;"';

        if ($required == 'required') {
            $mandatory = "'required'=>'true'";
        } else if ($required == 'email') {
            $mandatory = "'required'=>'true', 'parsley-type'=>'email' ";
        } else if ($required == 'url') {
            $mandatory = "'required'=>'true', 'parsley-type'=>'url' ";
        } else if ($required == 'date') {
            $mandatory = "'required'=>'true', 'parsley-type'=>'dateIso' ";
        } else if ($required == 'numeric') {
            $mandatory = "'required'=>'true', 'parsley-type'=>'number' ";
        } else {
            $mandatory = '';
        }

        switch ($type) {
            default;
                if ($required != '0') {
                    $mandatory = 'required';
                }
                if (isset($option['prefix']) && $option['prefix'] != '' or isset($option['sufix']) && $option['sufix'] != '') {
                    $form = '<div class="input-group">';
                    if ($option['prefix'] != '')
                        $form .= ' <span class="input-group-addon">' . $option['prefix'] . '</span>';

                    $form .= "<input  type='text' name='{$field}' id='{$field}' value='{{ \$row['{$field}'] }}' 
						{$mandatory}  {$attribute}   class='form-control {$extend_class}' />";
                    //$form .= "{!! Form::text('{$field}', \$row['{$field}'],array('class'=>'form-control','id'=>'{$field}', 'placeholder'=>'', {$mandatory}  )) !!}";

                    if ($option['sufix'] != '')
                        $form .= ' <span class="input-group-addon">' . $option['sufix'] . '</span>';

                    $form .= '</div>';

                } else {
                    // Not sufix or prefix is empty
                    //$form = "{!! Form::text('{$field}', \$row['{$field}'],array('class'=>'form-control','id'=>'{$field}', 'placeholder'=>'', {$mandatory}  )) !!}";
                    $form = "<input  type='text' name='{$field}' id='{$field}' value='{{ \$row['{$field}'] }}' 
						{$mandatory}  {$attribute}   class='form-control {$extend_class}' />";
                }

                break;

            case 'hidden';
                $form = "{!! Form::hidden('{$field}', \$row['{$field}']) !!}";
                break;

            case 'textarea';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "<textarea name='{$field}' rows='5' id='{$field}' class='form-control {$extend_class}'  
				         {$mandatory} {$attribute} >{{ \$row['{$field}'] }}</textarea>";
                break;

            case 'textarea_editor';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "<textarea name='{$field}' rows='5' id='editor' class='form-control editor {$extend_class}'  
						{$mandatory}{$attribute} >{{ \$row['{$field}'] }}</textarea>";
                break;


            case 'text_date';
                $form = "
				<div class=\"input-group m-b\" style=\"width:150px !important;\">
					{!! Form::text('{$field}', \$row['{$field}'],array('class'=>'form-control date')) !!}
					<span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>
				</div>";
                break;

            case 'text_time';
                $form = "
					<div class=\"input-group m-b\" style=\"width:150px !important;\">
						input  type='text' name='{$field}' id='{$field}' value='{{ \$row['{$field}'] }}' 
						{$mandatory}  {$attribute}   class='form-control {$extend_class}'
						data-date-format='yyyy-mm-dd'
						 />
						 <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>
						 </div>
						 ";
                break;

            case 'text_datetime';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "
				<div class=\"input-group m-b\" style=\"width:150px !important;\">
					{!! Form::text('{$field}', \$row['{$field}'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>
				</div>
				";
                break;

            case 'select';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                if ($option['opt_type'] == 'datalist') {
                    $optList = '';
                    $opt = explode("|", $option['lookup_query']);
                    for ($i = 0; $i < count($opt); $i++) {
                        $row = explode(":", $opt[$i]);
                        for ($i = 0; $i < count($opt); $i++) {

                            $row = explode(":", $opt[$i]);
                            $optList .= " '" . trim($row[0]) . "' => '" . trim($row[1]) . "' , ";

                        }
                    }
                    $form = "
					<?php \$" . $field . " = explode(',',\$row['" . $field . "']);
					";
                    $form .=
                        "\$" . $field . "_opt = array(" . $optList . "); ?>
					";

                    if (isset($option['select_multiple']) && $option['select_multiple'] == 1) {

                        $form .= "<select name='{$field}[]' rows='5' {$mandatory} multiple  class='select2 '  > ";
                        $form .= "
						<?php 
						foreach(\$" . $field . "_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(in_array(\$key,\$" . $field . ") ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
                        $form .= "</select>";
                    } else {

                        $form .= "<select name='{$field}' rows='5' {$mandatory}  class='select2 '  > ";
                        $form .= "
						<?php 
						foreach(\$" . $field . "_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(\$row['" . $field . "'] == \$key ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
                        $form .= "</select>";

                    }

                } else {

                    if (isset($option['select_multiple']) && $option['select_multiple'] == 1) {
                        $named = "name='{$field}[]' multiple";
                    } else {
                        $named = "name='{$field}'";

                    }
                    $form = "<select " . $named . " rows='5' id='{$field}' class='select2 {$extend_class}' {$mandatory} {$attribute} ></select>";


                }
                break;

            case 'file';
                if ($required != '0') {
                    $mandatory = 'required';
                }

                if (isset($option['image_multiple']) && $option['image_multiple'] == 1) {
                    $form = '
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles(\'' . $field . '\')"><i class="fa fa-plus-square"></i></a>
					<div class="' . $field . 'Upl">	
					 	<input  type=\'file\' name=\'' . $field . '[]\'  />			
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row[\'' . $field . '\'] = explode(",",$row[\'' . $field . '\']);
					?>
					@foreach($row[\'' . $field . '\'] as $files)
						@if(file_exists(\'.' . $option['path_to_upload'] . '\'.$files) && $files !=\'\')
						<li id="cr-<?php echo $cr;?>" class="">							
							<a href="{{ url(\'' . $option['path_to_upload'] . '/\'.$files) }}" target="_blank" >{{ $files }}</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="' . $option['path_to_upload'] . '{{$files}}">
							<i class="fa fa-trash-o fa-2x"></i></span>
							<input type="hidden" name="curr' . $field . '[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif
					
					@endforeach
					</ul>
					';

                } else {
                    $form = "<input  type='file' name='{$field}' id='{$field}' ";
                    $form .= "@if(\$row['$field'] =='') class='required' @endif ";
                    $form .= "style='width:150px !important;' {$attribute} />
					 	<div >
						{!! self::showUploadedFile(\$row['{$field}'],'$option[path_to_upload]') !!}
						
						</div>					
					";

                }
                break;

            case 'radio';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $opt = explode("|", $option['lookup_query']);
                $form = '';
                for ($i = 0; $i < count($opt); $i++) {
                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $form .= "
					<label class='radio radio-inline'>
					<input type='radio' name='{$field}' value ='" . ltrim(rtrim($row[0])) . "' {$mandatory} {$attribute}";
                    $form .= "@if(\$row['" . $field . "'] == '" . ltrim(rtrim($row[0])) . "') checked=\"checked\" @endif";
                    $form .= " > " . $row[1] . " </label>";
                }
                break;

            case 'checkbox';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $opt = explode("|", $option['lookup_query']);
                $form = "<?php \$" . $field . " = explode(\",\",\$row['" . $field . "']); ?>";
                for ($i = 0; $i < count($opt); $i++) {

                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $form .= "
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='{$field}[]' value ='" . ltrim(rtrim($row[0])) . "' {$mandatory} {$attribute} class='{$extend_class}' ";
                    $form .= "
					@if(in_array('" . trim($row[0]) . "',\$" . $field . "))checked @endif 
					";
                    $form .= " /> " . $row[1] . " </label> ";
                }
                break;

        }

        return $form;
    }

    public static function toMasterDetail($info)
    {

        if (count($info) >= 1) {
            $module = ucwords($info['module']);
            //$data['masterdetailmodel'] 	= '$this->modelview = new  \App\Models\''.$module.'();';

            $data['masterdetailinfo'] = "\$this->data['subgrid']	= (isset(\$this->info['config']['subgrid']) ? \$this->info['config']['subgrid'][0] : array()); ";
            $data['masterdetailgrid'] = "\$this->data['subgrid'] = \$this->detailview(\$this->modelview ,  \$this->data['subgrid'] ,\$id );";
            $data['masterdetailsave'] = "\$this->detailviewsave( \$this->modelview , \$request->all() ,\$this->info['config']['subform'] , \$id) ;";
            $data['masterdetailsubform'] = "\$this->data['subform'] = \$this->detailview(\$this->modelview ,  \$this->info['config']['subform'] ,\$id );";
            $data['masterdetailsubform'] = "
	 	\$relation_key = \$this->modelview->makeInfo(\$this->info['config']['subform']['module']);
	 	\$this->data['accesschild'] = \$this->modelview->validAccess(\$relation_key['id']);	
	 	\$this->data['relation_key'] = \$relation_key['key'];
	 	\$this->data['subform'] = \$this->detailview(\$this->modelview ,  \$this->info['config']['subform'] ,\$id );";

            $tpl = array();
            require_once('../resources/views/mmb/module/template/native/masterdetailform.php');

            $data['masterdetailview'] = $tpl['masterdetailview'];
            $data['masterdetailform'] = $tpl['masterdetailform'];
            $data['masterdetailjs'] = $tpl['masterdetailjs'];
            $data['masterdetaildelete'] = $tpl['masterdetaildelete'];
            $data['masterdetailmodel'] = $tpl['masterdetailmodel'];
        }
        return $data;

    }

    public static function toSubForm($info)
    {
        $data['masterdetailsave'] = "\$this->detailviewsave( \$this->modelview , \$request->all() , \$this->data['subgrid'] , \$id) ;";
    }

    public static function filterColumn($limit)
    {
        if ($limit != '') {
            $limited = explode(',', $limit);
            if (in_array(\Session::get('uid'), $limited)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public static function toView($grids)
    {
        usort($grids, "self::_sort");
        $f = '';
        foreach ($grids as $grid) {
            if (isset($grid['conn']) && is_array($grid['conn'])) {
                $conn = $grid['conn'];
                //print_r($conn);exit;
            } else {
                $conn = array('valid' => 0, 'db' => '', 'key' => '', 'display' => '');
            }

            // IF having Connection
            if ($conn['valid'] == '1') {
                $c = implode(':', $conn);
                $val = "{{ self::formatLookUp(\$row->" . $grid['field'] . ",'" . $grid['field'] . "','$c') }}";
            }

            if ($grid['detail'] == '1') {
                $format_as = (isset($grid['format_as']) ? $grid['format_as'] : '');
                $format_value = (isset($grid['format_value']) ? $grid['format_value'] : '');

                preg_match('~{([^{]*)}~i', $format_value, $match);
                if (isset($match[1])) {
                    $real_value = '{{$row->' . $match[1] . '}}';
                    $format_value = str_replace($match[0], $real_value, $format_value);
                }

                if ($format_as == 'radio' or $format_as == 'file' or $format_as == 'checkbox' or $format_as == 'image') {
                    $val = "{!! self::formatRows(\$row->" . $grid['field'] . ",\$fields['" . $grid['field'] . "'],\$row ) !!}";
                } elseif ($format_as == 'link') {


                    if ($conn['valid'] == '1') {
                        $val = $val;
                    } else {
                        $val = '{{ $row->' . $grid['field'] . '}}';
                    }
                    $val = '<a href="' . $format_value . '">' . $val . ' </a>';


                } elseif ($format_as == 'date') {
                    $val = "{{ date('" . $format_value . "',strtotime(\$row->" . $grid['field'] . ")) }}";
                } else if ($format_as == 'function') {
                    // Format To Custom Function

                    $c = explode("|", $format_value);
                    if (isset($c[2])) {
                        $args = explode(':', $c[2]);
                        if (count($args) >= 2) {
                            $ar = '';
                            foreach ($args as $a) {
                                $ar .= '$row->' . $a . ',';
                            }
                            $val = '<?php $params = array(' . substr($ar, 0, ($ar) - 1) . ') ; ?>';
                            $val .= '<?php echo ' . $c[0] . '::' . $c[1] . '($params) ?>';

                        } else {
                            $val = "{{ " . $c[0] . "::" . $c[1] . "(\$row->" . $c[2] . ") }}";
                        }

                    } else {
                        $val = $format_value;
                    }

                } else {
                    if ($conn['valid'] == '1') {
                        $val = $val;
                    } else {
                        $val = '{{ $row->' . $grid['field'] . '}}';
                    }
                }

                if (isset($grid['limited']) && $grid['limited'] != '') {
                    $limited_start =
                        '
			<?php 
			$limited = isset($fields[\'' . $grid['field'] . '\'][\'limited\']) ? $fields[\'' . $grid['field'] . '\'][\'limited\'] :\'\';
			if(self::filterColumn($limited )) { ?>
						';
                    $limited_end = '
			<?php } ?>';
                } else {
                    $limited_start = '';
                    $limited_end = '';
                }

                $f .= $limited_start;
                $f .= "
					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ self::activeLang('" . $grid['label'] . "', (isset(\$fields['" . $grid['field'] . "']['language'])? \$fields['" . $grid['field'] . "']['language'] : array())) }}</strong></td>
						<td>" . $val . " </td>
						
					</tr>
				";
                $f .= $limited_end;
            }
        }
        return $f;
    }

    public static function transForm($field, $forms = array(), $bulk = false, $value = '')
    {
        $type = '';
        $bulk = ($bulk == true ? '[]' : '');
        $mandatory = '';
        foreach ($forms as $f) {
            if ($f['field'] == $field && $f['search'] == 1) {
                $type = ($f['type'] != 'file' ? $f['type'] : '');
                $option = $f['option'];
                $required = $f['required'];

                if ($required == 'required') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'email') {
                    $mandatory = "data-parsley-type'='email' ";
                } else if ($required == 'date') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'numeric') {
                    $mandatory = "data-parsley-type='number' ";
                } else {
                    $mandatory = '';
                }
            }
        }

        switch ($type) {
            default;
                $form = '';
                break;

            case 'text';
                $form = "<input  type='text' name='" . $field . "{$bulk}' class='form-control input-sm' $mandatory value='{$value}'/>";
                break;

            case 'text_date';
                $form = "<input  type='text' name='$field{$bulk}' class='date form-control input-sm' $mandatory value='{$value}'/> ";
                break;

            case 'text_datetime';
                $form = "<input  type='text' name='$field{$bulk}'  class='date form-control input-sm'  $mandatory value='{$value}'/> ";
                break;

            case 'select';


                if ($option['opt_type'] == 'external') {

                    $data = DB::table($option['lookup_table'])->get();
                    $opts = '';
                    foreach ($data as $row):
                        $selected = '';
                        if ($value == $row->{$option['lookup_key']}) $selected = 'selected="selected"';
                        $fields = explode("|", $option['lookup_value']);
                        //print_r($fields);exit;
                        $val = "";
                        foreach ($fields as $item => $v) {
                            if ($v != "") $val .= $row->{$v} . " ";
                        }
                        $opts .= "<option $selected value='" . $row->{$option['lookup_key']} . "' $mandatory > " . $val . " </option> ";
                    endforeach;

                } else {
                    $opt = explode("|", $option['lookup_query']);
                    $opts = '';
                    for ($i = 0; $i < count($opt); $i++) {
                        $selected = '';
                        if ($value == ltrim(rtrim($opt[0]))) $selected = 'selected="selected"';
                        $row = explode(":", $opt[$i]);
                        $opts .= "<option $selected value ='" . trim($row[0]) . "' > " . $row[1] . " </option> ";
                    }

                }
                $form = "<select name='$field{$bulk}'  class='form-control' $mandatory >
							<option value=''> -- Select  -- </option>
							$opts
						</select>";
                break;

            case 'radio';

                $opt = explode("|", $option['lookup_query']);
                $opts = '';
                for ($i = 0; $i < count($opt); $i++) {
                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $opts .= "<option value ='" . $row[0] . "' > " . $row[1] . " </option> ";
                }
                $form = "<select name='$field{$bulk}' class='form-control' $mandatory ><option value=''> -- Select  -- </option>$opts</select>";
                break;

        }

        return $form;
    }

    public static function bulkForm($field, $forms = array(), $value = '')
    {
        $type = '';
        $bulk = 'true';
        $bulk = ($bulk == true ? '[]' : '');
        $mandatory = '';
        foreach ($forms as $f) {
            if ($f['field'] == $field && $f['search'] == 1) {
                $type = ($f['type'] != 'file' ? $f['type'] : '');
                $option = $f['option'];
                $required = $f['required'];

                if ($required == 'required') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'email') {
                    $mandatory = "data-parsley-type'='email' ";
                } else if ($required == 'date') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'numeric') {
                    $mandatory = "data-parsley-type='number' ";
                } else {
                    $mandatory = '';
                }
            }
        }
        $field = 'bulk_' . $field;

        switch ($type) {
            default;
                $form = '';
                break;

            case 'text';
                $form = "<input  type='text' name='" . $field . "{$bulk}' class='form-control input-sm' $mandatory value='{$value}'/>";
                break;

            case 'text_date';
                $form = "<input  type='text' name='$field{$bulk}' class='date form-control input-sm' $mandatory value='{$value}'/> ";
                break;

            case 'text_datetime';
                $form = "<input  type='text' name='$field{$bulk}'  class='date form-control input-sm'  $mandatory value='{$value}'/> ";
                break;

            case 'select';


                if ($option['opt_type'] == 'external') {

                    $data = DB::table($option['lookup_table'])->get();
                    $opts = '';
                    foreach ($data as $row):
                        $selected = '';
                        if ($value == $row->{$option['lookup_key']}) $selected = 'selected="selected"';
                        $fields = explode("|", $option['lookup_value']);
                        //print_r($fields);exit;
                        $val = "";
                        foreach ($fields as $item => $v) {
                            if ($v != "") $val .= $row->{$v} . " ";
                        }
                        $opts .= "<option $selected value='" . $row->{$option['lookup_key']} . "' $mandatory > " . $val . " </option> ";
                    endforeach;

                } else {
                    $opt = explode("|", $option['lookup_query']);
                    $opts = '';
                    for ($i = 0; $i < count($opt); $i++) {
                        $selected = '';
                        if ($value == ltrim(rtrim($opt[0]))) $selected = 'selected="selected"';
                        $row = explode(":", $opt[$i]);
                        $opts .= "<option $selected value ='" . trim($row[0]) . "' > " . $row[1] . " </option> ";
                    }

                }
                $form = "<select name='$field{$bulk}'  class='form-control' $mandatory >
							<option value=''> -- Select  -- </option>
							$opts
						</select>";
                break;

            case 'radio';

                $opt = explode("|", $option['lookup_query']);
                $opts = '';
                for ($i = 0; $i < count($opt); $i++) {
                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $opts .= "<option value ='" . $row[0] . "' > " . $row[1] . " </option> ";
                }
                $form = "<select name='$field{$bulk}' class='form-control' $mandatory ><option value=''> -- Select  -- </option>$opts</select>";
                break;

        }

        return $form;
    }

    public static function viewColSpan($grid)
    {
        $i = 0;
        foreach ($grid as $t):
            if ($t['view'] == '1') ++$i;
        endforeach;
        return $i;
    }

    public static function blend($str, $data)
    {
        $src = $rep = array();

        foreach ($data as $k => $v) {
            $src[] = "{" . $k . "}";
            $rep[] = $v;
        }

        if (is_array($str)) {
            foreach ($str as $st) {
                $res[] = trim(str_ireplace($src, $rep, $st));
            }
        } else {
            $res = str_ireplace($src, $rep, $str);
        }

        return $res;

    }

    public static function toJavascript($forms, $app, $class)
    {
        $f = '';
        foreach ($forms as $form) {
            if ($form['view'] != 0) {
                if (preg_match('/(select)/', $form['type'])) {
                    if ($form['option']['opt_type'] == 'external') {
                        $table = $form['option']['lookup_table'];
                        $val = $form['option']['lookup_value'];
                        $key = $form['option']['lookup_key'];
                        $lookey = '';
                        if ($form['option']['is_dependency']) $lookey .= $form['option']['lookup_dependency_key'];
                        $f .= self::createPreCombo($form['field'], $table, $key, $val, $app, $class, $lookey);

                    }

                }

            }

        }
        return $f;

    }

    public static function createPreCombo($field, $table, $key, $val, $app, $class, $lookey = null)
    {


        $parent = null;
        $parent_field = null;
        if ($lookey != null) {
            $parent = " parent: '#" . $lookey . "',";
            $parent_field = "&parent={$lookey}:";
        }
        $pre_jCombo = "
		\$(\"#{$field}\").jCombo(\"{!! url('{$class}/comboselect?filter={$table}:{$key}:{$val}') !!}$parent_field\",
		{ " . $parent . " selected_value : '{{ \$row[\"{$field}\"] }}' });
		";
        return $pre_jCombo;
    }

    static public function showNotification()
    {
        $status = Session::get('msgstatus');
        if (Session::has('msgstatus')): ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    toastr.<?php echo $status;?>("<?php echo Session::get('msgstatus');?>", "<?php echo Session::get('messagetext');?>");
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-top-center",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "slideDown",
                        "hideMethod": "fadeOut"

                    }
                });
            </script>
        <?php endif;
    }

    public static function alert($task, $message)
    {
        if ($task == 'error') {
            $alert = '
            <div class="alert alert-danger" role="alert">
              <p>' . $message . '</p>
              <hr>
            </div>
			';
        } elseif ($task == 'success') {
            $alert = '
            <div class="alert alert-success" role="alert">
              <p>' . $message . '</p>
              <hr>
            </div>
			';
        } elseif ($task == 'warning') {
            $alert = '
            <div class="alert alert-warning" role="alert">
              <p>' . $message . '</p>
              <hr>
            </div>
			';
        } else {
            $alert = '
            <div class="alert alert-dark" role="alert">
              <p>' . $message . '</p>
              <hr>
            </div>
			';
        }
        return $alert;

    }

    public static function _sort($a, $b)
    {

        if ($a['sortlist'] == $a['sortlist']) {
            return strnatcmp($a['sortlist'], $b['sortlist']);
        }
        return strnatcmp($a['sortlist'], $b['sortlist']);
    }


    static public function cropImage($nw, $nh, $source, $stype, $dest)
    {
        $size = getimagesize($source); // ukuran gambar
        $w = $size[0];
        $h = $size[1];
        switch ($stype) { // format gambar
            default :
                $simg = imagecreatefromjpeg($source);
                break;

            case 'gif':
                $simg = imagecreatefromgif($source);
                break;

            case 'png':
                $simg = imagecreatefrompng($source);
                break;
        }
        $dimg = imagecreatetruecolor($nw, $nh); // menciptakan image baru
        $wm = $w / $nw;
        $hm = $h / $nh;
        $h_height = $nh / 2;
        $w_height = $nw / 2;
        if ($w > $h) {
            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
        } elseif (($w < $h) || ($w == $h)) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
        } else {
            imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }
        imagejpeg($dimg, $dest, 100);
    }


    public static function showUploadedFile($file, $path, $width = 100)
    {

        $files = public_path() . $path . $file;
        if (file_exists($files) && $file != "") {
            //	echo $files ;
            $info = pathinfo($files);
            if ($info['extension'] == "jpg" || $info['extension'] == "jpeg" || $info['extension'] == "png" || $info['extension'] == "gif" || $info['extension'] == "JPG") {
                $path_file = str_replace("./", "", $path);
                return '<p><a href="' . url($path_file . $file) . '" class="previewImage">
				<img src="' . asset($path_file . $file) . '" border="0" width="' . $width . '" class="img-circle" /></a></p>';
            } else {
                $path_file = str_replace("./", "", $path);
                return '<p> <a href="' . url($path_file . $file) . '" class="tips" title="' . Lang::get('core.btn_download') . '"><i class="fa fa-floppy-o fa-3x" ></i></a>';
            }

        } else {

            return "<img src='" . asset('/uploads/images/no-image.png') . "' border='0' width='" . $width . "' class='img-circle' /></a>";

        }

    }

    public static function globalXssClean()
    {
        // Recursive cleaning for array [] inputs, not just strings.
        $sanitized = static::arrayStripTags(Input::get());
        Input::merge($sanitized);
    }

    public static function arrayStripTags($array)
    {
        $result = array();

        foreach ($array as $key => $value) {
            // Don't allow tags on key either, maybe useful for dynamic forms.
            $key = strip_tags($key);

            // If the value is an array, we will just recurse back into the
            // function to keep stripping the tags out of the array,
            // otherwise we will set the stripped value.
            if (is_array($value)) {
                $result[$key] = static::arrayStripTags($value);
            } else {
                // I am using strip_tags(), you may use htmlentities(),
                // also I am doing trim() here, you may remove it, if you wish.
                $result[$key] = trim(strip_tags($value));
            }
        }

        return $result;
    }

    public static function writeEncoder($val)
    {
        return base64_encode($val);
    }

    public static function readEncoder($val)
    {
        return base64_decode($val);
    }

    public static function formatLookUp($val, $field, $arr)
    {
        $arr = explode(':', $arr);

        if (isset($arr['0']) && $arr['0'] == 1) {
            $Q = DB::select(" SELECT " . str_replace("|", ",", $arr['3']) . " FROM " . $arr['1'] . " WHERE " . $arr['2'] . " = '" . $val . "' ");
            if (count($Q) >= 1) {
                $row = $Q[0];
                $fields = explode("|", $arr['3']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->{$fields[0]} . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->{$fields[1]} . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->{$fields[2]} . ' ' : '');
                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function formatRows($value, $attr, $row = null)
    {

        $conn = (isset($attr['conn']) ? $attr['conn'] : array('valid' => 0, 'db' => '', 'key' => '', 'display' => ''));
        $field = $attr['field'];
        $format_as = (isset($attr['format_as']) ? $attr['format_as'] : '');
        $format_value = (isset($attr['format_value']) ? $attr['format_value'] : '');


        if ($conn['valid'] == '1') {
            $value = self::formatLookUp($value, $attr['field'], implode(':', $conn));
        }


        preg_match('~{([^{]*)}~i', $format_value, $match);
        if (isset($match[1])) {
            $real_value = $row->{$match[1]};
            $format_value = str_replace($match[0], $real_value, $format_value);
        }

        if ($format_as == 'image') {
            // FORMAT AS IMAGE
            $vals = '';
            $values = explode(',', $value);

            foreach ($values as $val) {
                if ($val != '') {
                    if (file_exists('.' . $format_value . $val))
                        $vals .= '<a href="' . url($format_value . $val) . '" class="previewImage"><img src="' . asset($format_value . $val) . '" border="0" width="150" class="img-circle" style="margin-right:2px;" />  </a>';
                }
            }
            $value = $vals;

        } elseif ($format_as == 'link') {
            // FORMAT AS LINK
            $value = '<a href="' . $format_value . '">' . $value . '</a>';

        } else if ($format_as == 'date') {
            // FORMAT AS DATE
            if ($format_value == '') {
                if (defined('CNF_DATE') && CNF_DATE != '') {
                    $value = date("" . CNF_DATE . "", strtotime($value));
                }
            } else {
                $value = date("$format_value", strtotime($value));
            }

        } else if ($format_as == 'file') {
            // FORMAT AS FILES DOWNLOAD
            $vals = '';
            $values = explode(',', $value);
            foreach ($values as $val) {

                if (file_exists('.' . $format_value . $val))
                    $vals .= '<a href="' . asset($format_value . $val) . '"> ' . $val . ' </a><br />';
            }
            $value = $vals;
        } else if ($format_as == 'database') {
            // Database Lookup
            if ($value != '') {
                $fields = explode("|", $format_value);
                if (count($fields) >= 2) {
                    $field_table = str_replace(':', ',', $fields[2]);
                    $field_toShow = explode(":", $fields[2]);
                    //echo " SELECT ".$field_table." FROM ".$fields[0]." WHERE ".$fields[1]." IN(".$value.") ";
                    $Q = DB::select(" SELECT " . $field_table . " FROM " . $fields[0] . " WHERE " . $fields[1] . " IN(" . $value . ") ");
                    if (count($Q) >= 1) {
                        $value = '';
                        foreach ($Q as $qv) {
                            $sub_val = '';
                            foreach ($field_toShow as $fld) {
                                $sub_val .= $qv->{$fld} . ' ';
                            }
                            $value .= $sub_val . ', ';

                        }
                        $value = substr($value, 0, ($value - 2));
                    }
                }
            }
        } else if ($format_as == 'checkbox' or $format_as == 'radio') {
            // FORMAT AS RADIO/CHECKBOX VALUES

            $values = explode(',', $format_value);
            if (count($values) >= 1) {
                for ($i = 0; $i < count($values); $i++) {
                    $val = explode(':', $values[$i]);
                    if (trim($val[0]) == $value) $value = $val[1];
                }

            } else {

                $value = '';
            }

        } elseif ($format_as == 'function') {

            $val = $format_value;
            foreach ($row as $k => $i) {
                if (preg_match("/$k/", $val))
                    $val = str_replace($k, $i, $val);
            }
            $c = explode("|", $val);

            if (isset($c[0]) && class_exists($c[0])) {
                $args = explode(':', $c[2]);
                if (count($args) >= 2) {
                    $value = call_user_func(array($c[0], $c[1]), $args);
                } else {
                    $value = call_user_func(array($c[0], $c[1]), str_replace(":", "','", $c[2]));
                }

            } else {
                $value = 'Class Doest Not Exists';
            }

        } else {

        }

        return $value;


    }

    public static function slideShow($value, $attr, $row = null)
    {

        $conn = (isset($attr['conn']) ? $attr['conn'] : array('valid' => 0, 'db' => '', 'key' => '', 'display' => ''));
        $field = $attr['field'];
        $format_as = (isset($attr['format_as']) ? $attr['format_as'] : '');
        $format_value = (isset($attr['format_value']) ? $attr['format_value'] : '');


        if ($conn['valid'] == '1') {
            $value = self::formatLookUp($value, $attr['field'], implode(':', $conn));
        }


        preg_match('~{([^{]*)}~i', $format_value, $match);
        if (isset($match[1])) {
            $real_value = $row->{$match[1]};
            $format_value = str_replace($match[0], $real_value, $format_value);
        }

        $vals = '';
        $values = explode(',', $value);

        foreach ($values as $val) {
            if ($val != '') {
                if (file_exists('.' . $format_value . $val))
                    $vals .= '<div class="item"><img src="' . asset($format_value . $val) . '" border="0"  />                  </div>
';
            }
        }
        $value = $vals;


        return $value;

    }

    public static function gridDisplay($val, $field, $arr)
    {

        if (isset($arr['valid']) && $arr['valid'] == 1) {
            $fields = str_replace("|", ",", $arr['display']);
            $Q = DB::select(" SELECT " . $fields . " FROM " . $arr['db'] . " WHERE " . $arr['key'] . " = '" . $val . "' ");
            if (count($Q) >= 1) {
                $row = $Q[0];
                $fields = explode("|", $arr['display']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->{$fields[0]} . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->{$fields[1]} . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->{$fields[2]} . ' ' : '');


                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function gridDisplayView($val, $field, $arr)
    {
        $arr = explode(':', $arr);

        if (isset($arr['0']) && $arr['0'] == 1) {
            $Q = DB::select(" SELECT " . str_replace("|", ",", $arr['3']) . " FROM " . $arr['1'] . " WHERE " . $arr['2'] . " = '" . $val . "' ");
            if (count($Q) >= 1) {
                $row = $Q[0];
                $fields = explode("|", $arr['3']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->{$fields[0]} . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->{$fields[1]} . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->{$fields[2]} . ' ' : '');
                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function langOption()
    {
        $path = base_path() . '/resources/lang/';
        $lang = scandir($path);

        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }

        }
        return $t;
    }


    public static function themeOption()
    {

        $path = base_path() . '/resources/views/layouts/';
        $lang = scandir($path);
        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }

        }
        return $t;
    }

    public static function avatar($width = 75)
    {
        $avatar = '<img alt="" src="https://www.gravatar.com/avatar/' . md5(Session::get('email')) . '" class="img-circle" width="' . $width . '" />';
        $Q = DB::table("tb_users")->where("id", '=', Session::get('uid'))->get();
        if (count($Q) >= 1) {
            $row = $Q[0];
            $files = './uploads/users/' . $row->avatar;
            if ($row->avatar != '') {
                if (file_exists($files)) {
                    return '<img src="' . asset('uploads/users') . '/' . $row->avatar . '" border="0" width="' . $width . '" class="img-circle" />';
                } else {
                    return $avatar;
                }
            } else {
                return $avatar;
            }
        }
    }


    public static function BBCode2Html($text)
    {

        $emotion = URL::to('mmb/plugins/markitup/images/emoticons/');

        $text = trim($text);

        // BBCode [code]
        if (!function_exists('escape')) {
            function escape($s)
            {
                global $text;
                $text = strip_tags($text);
                $code = $s[1];
                $code = htmlspecialchars($code);
                $code = str_replace("[", "&#91;", $code);
                $code = str_replace("]", "&#93;", $code);
                return '<pre class="prettyprint linenums"><code>' . $code . '</code></pre>';
            }
        }
        $text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ms', "escape", $text);

        // Smileys to find...
        $in = array(':)',
            ':D',
            ':o',
            ':p',
            ':(',
            ';)'
        );
        // And replace them by...
        $out = array('<img alt=":)" src="' . $emotion . 'emoticon-happy.png" />',
            '<img alt=":D" src="' . $emotion . 'emoticon-smile.png" />',
            '<img alt=":o" src="' . $emotion . 'emoticon-surprised.png" />',
            '<img alt=":p" src="' . $emotion . 'emoticon-tongue.png" />',
            '<img alt=":(" src="' . $emotion . 'emoticon-unhappy.png" />',
            '<img alt=";)" src="' . $emotion . 'emoticon-wink.png" />'
        );
        $text = str_replace($in, $out, $text);

        // BBCode to find...
        $in = array('/\[b\](.*?)\[\/b\]/ms',
            '/\[div\="?(.*?)"?](.*?)\[\/div\]/ms',
            '/\[i\](.*?)\[\/i\]/ms',
            '/\[u\](.*?)\[\/u\]/ms',
            '/\[img\](.*?)\[\/img\]/ms',
            '/\[email\](.*?)\[\/email\]/ms',
            '/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms',
            '/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
            '/\[color\="?(.*?)"?\](.*?)\[\/color\]/ms',
            '/\[quote](.*?)\[\/quote\]/ms',
            '/\[list\=(.*?)\](.*?)\[\/list\]/ms',
            '/\[list\](.*?)\[\/list\]/ms',
            '/\[\*\]\s?(.*?)\n/ms'
        );
        // And replace them by...
        $out = array('<strong>\1</strong>',
            '<div class="\1">\2</div>',
            '<em>\1</em>',
            '<u>\1</u>',
            '<img src="\1" alt="\1" />',
            '<a href="mailto:\1">\1</a>',
            '<a href="\1">\2</a>',
            '<span style="font-size:\1%">\2</span>',
            '<span style="color:\1">\2</span>',
            '<blockquote>\1</blockquote>',
            '<ol start="\1">\2</ol>',
            '<ul>\1</ul>',
            '<li>\1</li>'
        );
        $text = preg_replace($in, $out, $text);

        // paragraphs
        $text = str_replace("\r", "", $text);
        $text = "<p>" . preg_replace("/(\n){2,}/", "</p><p>", $text) . "</p>";
        $text = nl2br($text);

        // clean some tags to remain strict
        // not very elegant, but it works. No time to do better ;)
        if (!function_exists('removeBr')) {
            function removeBr($s)
            {
                return str_replace("<br />", "", $s[0]);
            }
        }
        $text = preg_replace_callback('/<pre>(.*?)<\/pre>/ms', "removeBr", $text);
        $text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);

        $text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "removeBr", $text);
        $text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);

        return $text;
    }

    public static function seoUrl($str, $separator = 'dash', $lowercase = FALSE)
    {
        if ($separator == 'dash') {
            $search = '_';
            $replace = '-';
        } else {
            $search = '-';
            $replace = '_';
        }

        $trans = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }

        return trim(stripslashes(strtolower($str)));
    }


    static function renderHtml($html)
    {

        $html = preg_replace('/(\.+\/)+uploads/Usi', URL::to('uploads'), $html);
        //	$content = str_replace($pattern , URL::to('').'/', $content );
        preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $html, $result);
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all("#</([a-z]+)>#iU", $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        # all tags are closed
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        # close tags
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= "</" . $openedtags[$i] . ">";
            } else {
                unset ($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;


    }

    public static function activeLang($label, $l)
    {
        $activeLang = Session::get('lang');
        $lang = (isset($l[$activeLang]) ? $l[$activeLang] : $label);
        return $lang;

    }

    static public function fieldLang($fields)
    {
        $l = array();
        foreach ($fields as $fs) {
            foreach ($fs as $f)
                $l[$fs['field']] = $fs;
        }
        return $l;
    }

    public static function infoLang($label, $l, $t = 'title')
    {
        $activeLang = Session::get('lang');
        $lang = (isset($l[$t][$activeLang]) ? $l[$t][$activeLang] : $label);
        return $lang;

    }

    public static function auditTrail($request, $note)
    {
        $data = array(
            'module' => $request->segment(1),
            'task' => $request->segment(2),
            'user_id' => \Session::get('uid'),
            'ipaddress' => $request->getClientIp(),
            'note' => $note
        );

        \DB::table('tb_logs')->insert($data);

    }


    static function storeNote($args)
    {
        $args = array_merge(array(
            'url' => '#',
            'userid' => '0',
            'title' => '',
            'note' => '',
            'created' => date("Y-m-d H:i:s"),
            'icon' => 'fa fa-envelope',
            'is_read' => 0
        ), $args);


        \DB::table('tb_notification')->insert($args);
    }

    static function ResumeUserStatus()
    {
        $sql =
            "SELECT 
			SUM(CASE WHEN active ='1' THEN '1' ELSE '0' END) AS s_active ,
			SUM(CASE WHEN active ='0' THEN '1' ELSE '0' END) AS s_inactive ,
			SUM(CASE WHEN active ='2' THEN '1' ELSE '0' END) AS s_banned 

			FROM tb_users ";
        return \DB::select($sql)[0];
    }

    static public function TarihFormat($Tarih)
    {

        if ($Tarih == NULL):
            return '...';
        else:
            $date = date("" . CNF_DATE . "", strtotime($Tarih));
            return $date;

        endif;

    }

    static public function TarihFormat2($Tarih)
    {

        if ($Tarih == NULL):
            return '...';
        else:
            $date = date("" . CNF_DATE . " H:i", strtotime($Tarih));
            return $date;

        endif;

    }

    static public function Status2($Status)
    {

        if ($Status == '0'):
            return Lang::get('core.fr_minactive');
        elseif ($Status == '1'):
            return Lang::get('core.fr_mactive');
        endif;

    }

    static public function departs($departs)
    {

        if ($departs == 1) {
            $value = '<span class="btn btn-block btn-primary btn-sm">' . Lang::get('core.daily') . '</span>';
            return $value;
        } elseif ($departs == 2) {
            return '<span class="btn btn-block btn-warning btn-sm">' . Lang::get('core.onrequest') . '</span>';
        } elseif ($departs == 3) {
            return '<span class="btn btn-block btn-info btn-sm">' . Lang::get('core.setdate') . '</span>';
        }

    }

    static public function departs2($departs)
    {

        if ($departs == 1) {
            $value = Lang::get('core.daily');
            return $value;
        } elseif ($departs == 2) {
            return Lang::get('core.onrequest');
        } elseif ($departs == 3) {
            return Lang::get('core.setdate');
        }

    }


    static function BookingNumber($bookingtype)
    {
        if ($bookingtype == 'tour') {
            $sql = DB::table('book_tour')->where('status', 2)->count();
        } elseif ($bookingtype == 'hotel') {
            $sql = DB::table('book_hotel')->where('status', 2)->count();
        } elseif ($bookingtype == 'flight') {
            $sql = DB::table('book_flight')->where('status', 2)->count();
        } elseif ($bookingtype == 'car') {
            $sql = DB::table('book_car')->where('status', 2)->count();
        } elseif ($bookingtype == 'extra') {
            $sql = DB::table('book_extra')->where('status', 2)->count();
        }
        return $sql;
    }


    static function BookedPass($id, $total)
    {
        $room_single = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype', '=', 1)
            ->where('book_room.status', '=', 1)
            ->count();

        $room_double = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype', '=', 2)
            ->where('book_room.status', '=', 1)
            ->count();

        $room_triple = \DB::table('book_room')
            ->leftJoin('book_tour', 'book_room.bookingID', '=', 'book_tour.bookingID')
            ->where('tourdateID', '=', $id)
            ->where('roomtype', '=', 3)
            ->where('book_room.status', '=', 1)
            ->count();

        $totalbooked = $room_single + ($room_double * 2) + ($room_triple * 3);
        $available = $total - $totalbooked;

        if ($available != '0')
            return '<i class="fa fa-globe fa-2x text-muted" aria-hidden="true"></i>' . $available;
        else {
            return '<i class="fa fa-globe fa-2x text-muted" aria-hidden="true"></i>';
        }

    }


    static public function showPaymentOptions($val = '')
    {
        $value = '';
        if ($val != '') {
            $sql = \DB::table('def_payment_types')->whereIn('paymenttypeID', explode(',', $val))->get();
            foreach ($sql as $v) {
                $value .= "<span class='label label-danger'>" . $v->payment_type . "</span>";
            }
        }
        return $value;
    }

    static public function showPaymentOptions2($val = '')
    {
        $value = '';
        if ($val != '') {
            $sql = \DB::table('def_payment_types')->whereIn('paymenttypeID', explode(',', $val))->get();
            foreach ($sql as $v) {
                $value .= $v->payment_type . " ";
            }
        }
        return $value;
    }

    static public function tour($tour)
    {

        if ($tour == '0'):
            return '<i class="fa fa-bus fa-2x text-muted" aria-hidden="true"></i>';
        elseif ($tour == '1'):
            return '<i class="fa fa-bus fa-2x text-green" aria-hidden="true"></i>';
        endif;

    }

    static public function hotel($hotel)
    {

        if ($hotel == '0'):
            return '<i class="fa fa-bed fa-2x text-muted" aria-hidden="true"></i>';
        elseif ($hotel == '1'):
            return '<i class="fa fa-bed fa-2x text-green" aria-hidden="true"></i>';
        endif;

    }

    static public function flight($flight)
    {

        if ($flight == '0'):
            return '<i class="fa fa-plane fa-2x text-muted" aria-hidden="true"></i>';
        elseif ($flight == '1'):
            return '<i class="fa fa-plane fa-2x text-green" aria-hidden="true"></i>';
        endif;

    }

    static public function car($car)
    {

        if ($car == '0'):
            return '<i class="fa fa-car fa-2x text-muted" aria-hidden="true"></i>';
        elseif ($car == '1'):
            return '<i class="fa fa-car fa-2x text-green" aria-hidden="true"></i>';
        endif;

    }

    static public function extraservices($extraservices)
    {

        if ($extraservices == '0'):
            return '<i class="fa fa-gift fa-2x text-muted" aria-hidden="true"></i>';
        elseif ($extraservices == '1'):
            return '<i class="fa fa-gift fa-2x text-green" aria-hidden="true"></i>';
        endif;

    }

    static public function roomType($roomtype)
    {

        if ($roomtype == '1'):
            return '<i class="fa fa-user fa-2x text-green" aria-hidden="true"></i>';
        elseif
        ($roomtype == '2'):
            return '<i class="fa fa-user fa-2x text-green" aria-hidden="true"></i> <i class="fa fa-user fa-2x text-green" aria-hidden="true"></i>';
        elseif
        ($roomtype == '3'):
            return '<i class="fa fa-user fa-2x text-green" aria-hidden="true"></i><i class="fa fa-user fa-2x text-green" aria-hidden="true"></i><i class="fa fa-user fa-2x text-green" aria-hidden="true"></i> ';
        endif;

    }

    static public function roomType2($roomtype)
    {

        if ($roomtype == '1'):
            return Lang::get('core.single');
        elseif
        ($roomtype == '2'):
            return Lang::get('core.double');
        elseif
        ($roomtype == '3'):
            return Lang::get('core.triple');
        endif;

    }

    static public function showTravellers($val = '')
    {
        $value = '';
        if ($val != '') {
            $sql = \DB::table('travellers')->whereIn('travellerID', explode(',', $val))->get();
            foreach ($sql as $v) {
                $value .= "<span class='label label-info'>" . $v->nameandsurname . "</span>&nbsp;";
            }
        }
        return $value;
    }

    static public function showTravellers2($val = '')
    {
        $value = '';
        if ($val != '') {
            $sql = \DB::table('travellers')->whereIn('travellerID', explode(',', $val))->get();
            foreach ($sql as $v) {
                $value .= "<li>" . $v->nameandsurname . "</li>";
            }
        }
        return $value;
    }

    static public function showInclusions($val = '')
    {
        $value = '';
        if ($val != '') {
            $sql = \DB::table('def_inclusions')->whereIn('inclusionID', explode(',', $val))->get();
            foreach ($sql as $v) {
                $value .= "<li  class='list-group-item'><i class='fa fa-check fa-2x text-green' aria-hidden='true'></i> " . $v->inclusion . "</li>&nbsp;&nbsp;&nbsp;";
            }
        }
        return $value;
    }

    static public function featured($featured)
    {

        if ($featured == 1) {
            return '<i class="fa fa-star fa-2x text-red tips" title="' . Lang::get('core.featured') . '" ></i>';

        } elseif ($featured != 1) {
            return '<i class="fa fa-star fa-2x text-black tips" title="' . Lang::get('core.notfeatured') . '" ></i>';

        }
    }

    static public function definite_departure($definite_departure)
    {

        if ($definite_departure == 2) {
            return '<i class="fa fa-check-square fa-2x text-yellow tips" title="' . Lang::get('core.guaranteeddep') . '"></i>';
        } elseif ($definite_departure != 2) {
            return '<i class="fa fa-ban fa-2x text-red tips" title="' . Lang::get('core.notguaranteeddep') . '"></i>';
        }

    }

}








