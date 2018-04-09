<?php
/**
 * Created by PhpStorm.
 * User: Augusto
 * Date: 7/4/2018
 * Time: 16:53
 */

namespace Entity;


class Page
{

    public $content;
    public $count;
    public $page;
    public $size;

    public function __construct($content, $count, $page, $size)
    {
        $this->content = $content;
        $this->count = $count;
        $this->page = $page;
        $this->size = $size;
    }


}