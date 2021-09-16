<?php
if (!empty($this->specialItems)) {
    foreach ($this->specialItems as $item) {
        @$xhtmlIndexSpecial .= HelperFrontend::showProduct($item,$this->arrParam);
    }
}

echo @$xhtmlIndexSpecial;
