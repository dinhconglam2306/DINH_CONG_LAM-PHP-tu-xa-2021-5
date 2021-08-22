<?php

class FormFrontend
{

    public static function input($type, $id, $name, $value = '', $class = '')
    {
        $xhtml = sprintf('<input type="%s" id="%s" name="%s" value="%s" class="form-control %s">', $type, $id, $name, $value, $class);
        return $xhtml;
    }
    //Create RowForm
    public static function rowForm($for, $labelName, $input)
    {
        $xhtml = sprintf(
            '<div class="col-md-6">
                <label for="%s" class="required">%s</label>
                %s
            </div>',
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
}
