<?php 

use php\android{ UXView, UXMobileApplication, UXAppBar, UXSwatch, UXAndroidDialog, UXNavigationDrawer, UXSidePopupView };
use php\gui{ UXButton, UXLabel };

$view = new UXView();
$view->onUpdateAppBar(function (UXAppBar $appBar) {
	$appBar->title = new UXLabel("jPHP Demo");
});

$view->center = $b = new UXButton("test jphp");

$b->on('click', function () use ($pop) {
	$dialog = new UXAndroidDialog();
	$dialog->title = new UXLabel("Диалог, привет!");
	$dialog->content = new UXButton("Show menu");
	$dialog->show();
});

UXMobileApplication::setSwatch(UXSwatch::of("red"));
UXMobileApplication::addView(UXView::HOME_NAME, $view);
UXMobileApplication::showView(UXView::HOME_NAME);


