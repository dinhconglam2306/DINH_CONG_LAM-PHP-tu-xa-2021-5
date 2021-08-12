<?php

class FormBackend
{
    //Create SelectBox
    public static function selectBox($name, $arrValue, $keySelected = 'default', $attributes = '', $class = '')
    {
        $xhtmlOption = '';
        foreach ($arrValue as $key => $value) {
            $selected = '';
            if (is_numeric($key)) $key = strval($key);
            if ($key === $keySelected) $selected = 'selected';
            $xhtmlOption .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        $xhtml = sprintf('<select name="%s" class="custom-select %s" %s>%s</select>', $name, $class, $attributes, $xhtmlOption);
        return $xhtml;
    }

    //Create InputFOrm
    public static function input($type, $name, $value = null, $readonly = '',$class = '')
    {
        $xhtml = sprintf('<input type="%s" class="form-control %s" name="%s" value="%s" %s>', $type, $class, $name, $value,$readonly);
        return $xhtml;
    }

    //Create RowForm
    public static function rowForm($labelName, $inputOrselect, $flag = true)
    {
        $require = '*';
        if($flag == false) $require = ' ';
        $xhtml = sprintf(
            '<div class="form-group">  <label>%s<span class="text-danger">%s</span></label>%s</div>',
            $labelName,
            $require,
            $inputOrselect
        );


        return $xhtml;
    }

    //Create button form
    public static function button($type, $title, $class = '')
    {
        $xhtml = sprintf('<button type="%s" class="%s">%s</button>', $type, $class, $title);
        return $xhtml;
    }

    //Create button Cancel
    public static function cancel($href = '')
    {
        $xhtml = sprintf('<a href="%s" class="btn btn-danger">Cancel</a>', $href);
        return $xhtml;
    }
}
