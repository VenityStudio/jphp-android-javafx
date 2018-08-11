<?php 

echo "Приветик из JPHP";

use php\android{ UXView, UXMobileApplication };

$view = new UXView("home", new \php\gui\UXButton("test"));

UXMobileApplication::addView($view->getName(), $view);
UXMobileApplication::showView($view->getName());

echo "Скрипт закончен";
