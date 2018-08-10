<?php 

use php\gui\{ UXForm, UXWebView };

use php\gui\layout\UXAnchorPane;

$form = new UXForm();

$web = new UXWebView();
$web->engine->load("https://vk.com/venity");

UXAnchorPane::setAnchor($web, 8);

$form->add($web);
$form->show();
