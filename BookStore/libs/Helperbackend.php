<?php

class HelperBackend
{
    //Create button
    public static function button($type, $name, $class = 'btn-info', $options = ['small' => false, 'circle' => false])
    {
        $optionsClass = '';
        if ($options['small']) $optionsClass .= ' btn-sm';
        if ($options['circle']) $optionsClass .= ' rounded-circle';
        return sprintf('<button type="%s" class="btn %s %s">%s</button>', $type, $class, $optionsClass, $name);
    }

    //Create button link
    public static function buttonLink($link, $name, $class = 'btn-info', $options = ['small' => false, 'circle' => false])
    {
        $optionsClass = '';
        if ($options['small']) $optionsClass .= ' btn-sm';
        if ($options['circle']) $optionsClass .= ' rounded-circle';
        return sprintf('<a href="%s" class="btn %s %s">%s</a>', $link, $class, $optionsClass, $name);
    }

    //Create Icon Group ACP
    public static function itemGroupACP($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'changeGroupACP', ['id' => $id, 'group_acp' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="%s" class="btn %s rounded-circle btn-sm"><i class="fas %s"></i></a>', $link, $colorClass, $icon);
    }

    //Create Icon Status
    public static function itemStatus($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'changeStatus', ['id' => $id, 'status' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 'inactive') {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="%s" class="btn %s rounded-circle btn-sm"><i class="fas %s"></i></a>', $link, $colorClass, $icon);
    }

    //Create history item
    public static function itemHistory($by, $time)
    {
        if ($time) $time = date('H:i:s d/m/Y', strtotime($time));
        $xhtml = sprintf('
        <p class="mb-0"><i class="far fa-user"></i> %s</p>
        <p class="mb-0"><i class="far fa-clock"></i> %s</p>
        ', $by, $time);
        return $xhtml;
    }

    // Create HighLight
    public static function highlight($search, $value)
    {
        if (!empty(trim($search))) {
            return preg_replace('/' . preg_quote($search, '/') . '/ui', '<mark>$0</mark>', $value);
        }

        return $value;
    }

    //Create show filterStatus
    public static function showFilterStatus($module, $controller, $itemsStatusCount, $currentFilterStatus, $searchValue)
    {
        $xhtml = '';
        foreach ($itemsStatusCount as $key => $value) {
            $classColor = $key == $currentFilterStatus ? 'btn-info' : 'btn-secondary';
            $params = ['status' => $key];

            if (!empty($searchValue)) $params['search'] = $searchValue;

            $link = URL::createLink($module, $controller, 'index', $params);
            $name = '';
            switch ($key) {
                case 'all':
                    $name = 'All';
                    break;
                case 'active':
                    $name = 'Active';
                    break;
                case 'inactive':
                    $name = 'Inactive';
                    break;
            }
            $xhtml .= sprintf('<a href="%s" class="btn %s">%s <span class="badge badge-pill badge-light">%s</span></a> ', $link, $classColor, $name, $value);
        }
        return $xhtml;
    }


    //Create Message
    public static function createMessage($message)
    {
        $xhtml = '';
        if (!empty($message)) {
            $xhtml = '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul class="list-unstyled mb-0">
                    <li class="text-white">' . $message . '</li>
                </ul>
            </div>';
        }
        return $xhtml;
    }

    //Create SelectBox
    public static function createSelectbox($name, $class, $arrValue, $keySelected = 'default', $flag = true, $dataUrl = null)
    {
        $xhtmlOption = '';
        foreach ($arrValue as $key => $value) {
            $selected = '';
            if (is_numeric($key)) $key = strval($key);
            if ($key === $keySelected) $selected = 'selected';
            $xhtmlOption .= sprintf('<option value="%s" %s>%s</option>', $key, $selected, $value);
        }
        if ($flag == true) {
            $xhtml = sprintf('<select name="%s" class="%s">%s</select>', $name, $class, $xhtmlOption);
        } else {
            $xhtml = sprintf('<select name="%s" class="%s" data-url="%s">%s</select>', $name, $class, $dataUrl, $xhtmlOption);
        }
        return $xhtml;
    }

    //Create InputFOrm
    public static function createInput($type, $class, $name, $value = null)
    {
        $xhtml = sprintf('<input type="%s" class="%s" name="%s" value=%s>', $type, $class, $name, $value);
        return $xhtml;
    }

    //Create RowForm
    public static function createRowForm($labelName, $input, $select, $require = true)
    {
        $xhtml = '<div class="form-group">  <label>' . $labelName . ' <span class="text-danger">*</span></label>';
        if ($require == true) {
            $xhtml .= $input;
        } else {
            $xhtml .= $select;
        }
        $xhtml .= '</div>';

        return $xhtml;
    }

    //Create button form
    public static function createButtonForm($type, $class, $title)
    {
        $xhtml = sprintf('<button type="%s" class="%s">%s</button>', $type, $class, $title);
        return $xhtml;
    }
}
