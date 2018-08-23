<?php

namespace php\android;


class UXView
{
    public function __construct($name = "home")
    {
    }

    public function setOnUpdateAppBar(callable $callback)
    {
        
    }

    public function isShowing() : bool
    {

    }

    public $name;

    public function addActionButton(UXFloatingActionButton $fab){}
}