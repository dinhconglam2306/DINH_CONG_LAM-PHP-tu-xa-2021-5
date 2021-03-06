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

    //Create SelectBox
    public static function selectBoxCartStatus($name, $arrValue, $keySelected = 'default', $attributes = '', $class = '', $id = '')
    {
        $xhtmlOption = '';
        foreach ($arrValue as $key => $value) {
            $selected = '';
            if (is_numeric($key)) $key = strval($key);
            if ($key === $keySelected) $selected = 'selected';
            $xhtmlOption .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        $btnClass = '';
        if ($keySelected == 'not-handle') $btnClass = 'handle-danger';
        if ($keySelected == 'processing') $btnClass = 'processing-secondary';
        if ($keySelected == 'not-delivery') $btnClass = 'delivery-warning';
        if ($keySelected == 'delivery') $btnClass = 'delivery-info';
        if ($keySelected == 'delivered') $btnClass = 'delivered-success';
        if ($keySelected == 'cancelled') $btnClass = 'cancelled-dark';
        $xhtml = sprintf('<select id="%s" name="%s" class="custom-select  %s %s" %s>%s</select>', $id, $name, $class, $btnClass, $attributes, $xhtmlOption);
        return $xhtml;
    }

    public static function input($type, $name, $value = '', $readonly = '', $plusBotton = '', $class = '')
    {
        $xhtml = sprintf('<input type="%s" class="form-control %s" name="%s" value="%s" %s>%s', $type, $class, $name, $value, $readonly, $plusBotton);
        return $xhtml;
    }

    //inputSearch
    public static function inputSearch($type,  $name, $id, $placeholder = '')
    {
        $xhtml = sprintf('<input type="%s" class="form-control" name="%s" id="%s" placeholder="%s">', $type,  $name, $id, $placeholder);
        return $xhtml;
    }
    //Create RowForm
    public static function rowForm($labelName, $inputOrselect, $flag = true)
    {
        $start = '*';
        if ($flag == false) $start = '';
        $xhtml = sprintf(
            '<div class="form-group">
                <label>%s<span class="text-danger">%s</span></label>
                %s
              </div>',
            $labelName,
            $start,
            $inputOrselect
        );
        return $xhtml;
    }

    //Create button form
    public static function button($type, $title, $class = '', $icon = '', $attr = '')
    {
        $xhtml = sprintf('<button type="%s" class="%s" data-url="%s"> %s %s</button>', $type, $class, $attr, $icon, $title);
        return $xhtml;
    }

    //Create button Cancel
    public static function cancel($href = '')
    {
        $xhtml = sprintf('<a href="%s" class="btn btn-danger">Cancel</a>', $href);
        return $xhtml;
    }

    //Create FormLogin
    public static function createInputFormLogin($type, $name, $id, $placeholder, $iconClass)
    {
        $xhtml = sprintf('
         <div class="input-group mb-3">
            <input type="%s" name="%s" id="%s" class="form-control" placeholder="%s">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="%s"></span>
                </div>
            </div>
        </div>', $type, $name, $id, $placeholder, $iconClass);
        return $xhtml;
    }
    //Cretate button form
    public static function createButtonFormLogin($type, $title)
    {
        $xhtml = sprintf('
         <button type="%s" class="btn btn-info btn-block">%s</button>', $type, $title);
        return $xhtml;
    }

    //Create textarea form

    public static function textarea($name, $id, $title, $class = '', $row = null, $cols = null)
    {
        $xhtml = sprintf(
            '
         <textarea name="%s" id="%s" class="form-control %s" rows="%s" cols="%s" >%s</textarea>',
            $name,
            $id,
            $class,
            $row = null,
            $cols = null,
            $title
        );
        return $xhtml;
    }
}
