<?php 

use php\android{ UXView, UXMobileApplication };

$view = new UXView(UXView::HOME_NAME, new \php\gui\UXButton("test"));

UXMobileApplication::addView(UXView::HOME_NAME, $view);
 
