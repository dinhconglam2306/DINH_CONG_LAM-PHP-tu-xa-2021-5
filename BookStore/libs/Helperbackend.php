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
        $datUrl = URL::createLink($module, $controller, 'changeGroupACP', ['id' => $id, 'group_acp' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="#" data-url="%s" id="group-%s"class="btn %s rounded-circle btn-change btn-sm"><i class="fas %s"></i></a>', $datUrl, $id, $colorClass, $icon);
    }

    //Create Icon Status
    public static function itemStatus($module, $controller, $id, $value)
    {
        $datUrl = URL::createLink($module, $controller, 'changeStatus', ['id' => $id, 'status' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 'inactive') {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="#" data-url="%s" id="status-%s"class="btn %s rounded-circle btn-change btn-sm"><i class="fas %s"></i></a>', $datUrl, $id, $colorClass, $icon);
    }

    //Create Icon Status
    public static function itemSpecial($module, $controller, $id, $value)
    {
        $datUrl = URL::createLink($module, $controller, 'changeSpecial', ['id' => $id, 'special' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="#" data-url="%s" id="special-%s"class="btn %s rounded-circle btn-change btn-sm"><i class="fas %s"></i></a>', $datUrl, $id, $colorClass, $icon);
    }

    public static function itemNew($module, $controller, $id, $value)
    {
        $datUrl = URL::createLink($module, $controller, 'changeNew', ['id' => $id, 'new' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="#" data-url="%s" id="new-%s"class="btn %s rounded-circle btn-change btn-sm"><i class="fas %s"></i></a>', $datUrl, $id, $colorClass, $icon);
    }

    public static function itemIshome($module, $controller, $id, $value)
    {
        $datUrl = URL::createLink($module, $controller, 'changeIshome', ['id' => $id, 'is_home' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<a href="#" data-url="%s" id="special-%s"class="btn %s rounded-circle btn-change btn-sm"><i class="fas %s"></i></a>', $datUrl, $id, $colorClass, $icon);
    }

    //Create history item
    public static function itemHistory($by, $time, $id = '')
    {
        // if ($time) $time = date('H:i:s d/m/Y', strtotime($time));
        $xhtml = sprintf('
        <p class="mb-0"><i class="far fa-user"></i> <span class="modified-by-%s">%s</span></p>
        <p class="mb-0"><i class="far fa-clock"></i> <span class="status-%s">%s</span></p>
        ', $id, $by, $id, $time);
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
    public static function createMessage()
    {
        $message = Session::get('message');
        $xhtml = '';
        if (!empty($message)) {
            $xhtml = '
            <div class="alert alert-success alert-dismissible" id="success-message">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                <ul class="list-unstyled mb-0">
                <li class="text-white">' . $message . '</li>
                </ul>
            </div>';
        }
        Session::delete('message');
        return $xhtml;
    }

    public static function randomString()
    {
        $length       = random_int(9, 12);
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result        = substr($arrCharacter, 0, $length);
        return $result;
    }


    public static function fieldSearchAccepted($paramSearch, $keyword, $table = '')
    {
        $str = "";
        foreach ($paramSearch as  $value) {
            if ($table != '') {
                $str .= sprintf("`%s`.`%s`LIKE %s OR", $table, $value, $keyword);
            } else {
                $str .= sprintf("`%s`LIKE %s OR", $value, $keyword);
            }
            //`u`.`username` LIKE $keyword OR `u`.`fullname` LIKE $keyword OR `u`.`email` LIKE $keyword)
        }
        return substr($str, 0, -2);;
    }


    public static function BackEndMenuDashBoard($href)
    {
        $xhtml = sprintf('
        <li class="nav-item">
            <a href="%s" data-name ="index" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        ', $href);
        return $xhtml;
    }
    public static function BackEndMenu($dataName, $iconClass, $title, $arrList)
    {
        $xhtmlList  = '<ul class="nav nav-treeview">';
        foreach ($arrList as $key => $value) {
            $key = explode('|',$key);
            $keyName = $key[0];
            $keyDataAction = $key[1];
            $xhtmlList .= sprintf('
            <li class="nav-item">
                <a href="%s" class="nav-link " data-action="%s">
                    <i class="far fa-circle nav-icon"></i>
                    <p>%s</p>
                </a>
            </li>
            ', $value, $keyDataAction,$keyName);
        }
        $xhtmlList .= '</ul>';

        $xhtml = sprintf('
            <li class="nav-item">
                <a href="#" data-name ="%s" class="nav-link">
                    <i class="nav-icon %s"></i>
                    <p>%s<i class="right fas fa-angle-left"></i></p>
                </a>
                %s
            </li>
            ', $dataName, $iconClass, $title, $xhtmlList);
        return $xhtml;
    }

    public static function createImage($folder,$pictureName,$attribute=null){
        
        $class = !empty($attribute['class'])? $attribute['class'] : '';
        $width = !empty($attribute['width'])? $attribute['width'] : '';
        $height = !empty($attribute['height'])? $attribute['height'] : '';
        $alt    = !empty($attribute['alt'])? $attribute['alt'] : '';

        $attrStr = "class='$class' width='$width' height='$height' alt='$alt'";
        
        $picture            = sprintf('<img src="%s" %s />', URL_UPLOAD . $folder . DS . 'default.png',$attrStr);
        $picturePath        = PATH_UPLOAD . $folder . DS . $pictureName;
        if (file_exists($picturePath) && !empty($pictureName))  $picture  = sprintf('<img src="%s" %s/>', URL_UPLOAD . $folder . DS . $pictureName,$attrStr);

        return $picture;
    }
}
