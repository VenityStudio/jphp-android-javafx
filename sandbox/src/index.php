<?php 

use php\android{ UXView, UXMobileApplication };
use php\gui\UXButton;

$view = new UXView();
$view->center = new UXButton("test jphp");
UXMobileApplication::addView(UXView::HOME_NAME, $view);
 
