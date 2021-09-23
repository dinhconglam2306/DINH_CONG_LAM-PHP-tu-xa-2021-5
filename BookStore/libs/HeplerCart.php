<?php

class HeplerCart
{

    public static function createDivClassMb3($type, $id, $placeholder, $name = null)
    {
        $xhtml = sprintf('
        <div class="mb-3">
            <div class="input-group">
                <input type="%s" name="%s" class="form-control rounded" id="%s" placeholder="%s" required="">
            </div>
        </div>
        ', $type, $name, $id, $placeholder);
        return $xhtml;
    }
    public static function radio($id, $name, $value, $for, $title)
    {
        $xhtml = sprintf('
        <div class="custom-control custom-radio">
            <input id="%s" name="%s" type="radio" class="custom-control-input" required="" value="%s">
            <label class="custom-control-label" for="%s">%s</label>
        </div>
        ', $id, $name, $value, $for, $title);
        return $xhtml;
    }


    public static function statusCheckStatusOrder($src, $title)
    {
        $xhtml = sprintf('
        <div class="row d-flex icon-content"> <img class="icon" src="%s">
            <div class="d-flex flex-column">
                <p class="font-weight-bold">%s</p>
            </div>
        </div>
        ', $src, $title);
        return $xhtml;
    }
}
