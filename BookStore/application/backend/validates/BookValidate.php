<?php

class BookValidate extends Validate
{

    function __construct($params)
    {
        parent::__construct(@$params['form']);
    }

    public function validate()
    {
        $this
            ->addRule('name', 'string', ['min' => 1, 'max' => 255])
            ->addRule('ordering', 'int', ['min' => 1, 'max' => 100])
            ->addRule('status', 'status')
            ->addRule('special', 'status')
            ->addRule('category_id', 'status')
            ->addRule('sale_off', 'int', ['min' => 1, 'max' => 100])
            ->addRule('price', 'int', ['min' => 100, 'max' => 2500000])
            ->addRule('picture', 'file', ['min' => 100, 'max' => 1000000, 'entension' => ['jpg', 'png', 'jfif']], false);
        $this->run();
    }
}
