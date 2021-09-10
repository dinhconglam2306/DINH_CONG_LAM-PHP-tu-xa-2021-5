<?php

class FormFrontend
{

    public static function input($type, $id, $name, $value = '', $class = '')
    {
        $xhtml = sprintf('<input type="%s" id="%s" name="%s" value="%s" class="form-control %s">', $type, $id, $name, $value, $class);
        return $xhtml;
    }
    //Create RowForm
    public static function rowForm($for, $labelName, $input,$class)
    {
        $xhtml = sprintf(
            '<div class="%s">
                <label for="%s" class="required">%s</label>
                %s
            </div>',
            $class,
            $for,
            $labelName,
            $input
        );
        return $xhtml;
    }

    //Create button form
    public static function button($type, $id, $name, $value, $title)
    {
        $xhtml = sprintf('<button type="%s" id="%s" name="%s" value="%s" class="btn btn-solid">%s</button>', $type, $id, $name, $value, $title);
        return $xhtml;
    }
    public static function selectBox($name, $id, $arrValue, $keySelected = 'default')
    {
        $xhtmlOption = '';
        foreach ($arrValue as $key => $value) {
            $selected = '';
            if (is_numeric($key)) $key = strval($key);
            if ($key === $keySelected) $selected = 'selected';
            $xhtmlOption .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        $xhtml = sprintf('<select name="%s" id="%s">%s</select>', $name,  $id, $xhtmlOption);
        return $xhtml;
    }
}
