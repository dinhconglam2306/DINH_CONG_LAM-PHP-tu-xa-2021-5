<?php

class Form
{
    //Create SelectBox
    public static function createSelectbox($name, $class, $arrValue, $keySelected = 'default',$flag=true,$dataUrl=null)
    {
       $xhtmlOption='';
        foreach ($arrValue as $key => $value) {
            $selected='';
            if(is_numeric($key)) $key = strval($key);
            if($key === $keySelected) $selected ='selected';
            $xhtmlOption.=sprintf('<option value="%s" %s>%s</option>',$key,$selected,$value);
        }
        if($flag == true){
            $xhtml = sprintf('<select name="%s" class="%s">%s</select>',$name,$class,$xhtmlOption);
        }else{
            $xhtml = sprintf('<select name="%s" class="%s" data-url="%s">%s</select>',$name,$class,$dataUrl,$xhtmlOption);
        }
        return $xhtml;
    }

    //Create Input
    public static function createInput($type,$class,$name,$value=null)
    {
        $xhtml = sprintf('<input type="%s" class="%s" name="%s" value=%s>',$type,$class,$name,$value);
        return $xhtml;
    }
    
    //Create RowForm
    public static function createRowForm($labelName,$input,$select,$require=true)
    {
        $xhtml='<div class="form-group">  <label>'.$labelName.' <span class="text-danger">*</span></label>';
        if($require == true){
            $xhtml.=$input;
        }else{
            $xhtml.=$select;
        }
        $xhtml.='</div>';

        return $xhtml;
    }

    //Create button form
    public static function createButtonForm($type,$class,$title)
    {
        $xhtml=sprintf('<button type="%s" class="%s">%s</button>',$type,$class,$title);
        return $xhtml;
    }
}
