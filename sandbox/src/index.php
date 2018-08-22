<?php 

use php\android{ UXView, UXMobileApplication, UXAppBar, UXSwatch, UXAndroidDialog, UXNavigationDrawer, UXSidePopupView, UXToast, UXMaterialIcons, UXAndroidAlert, UXRating };
use php\gui{ UXButton, UXLabel };

$view = new UXView();
$view->onUpdateAppBar(function (UXAppBar $appBar) {
	$appBar->title = new UXLabel("jPHP Demo");
	$appBar->items->add((new UXMaterialIcons("RATE_REVIEW"))->button(function (){
		$a = new UXAndroidAlert("ERROR");
		$a->title = new UXLabel("Оцыните наше творение");
		$a->content = $r = new UXRating;
		$r->updateOnHover = true;
		$r->partialRating = true;
		$r->rating = 4.5;
		$a->show();
	}));
});

$view->center = $b = new UXButton("test jphp");

$b->on('click', function () use ($pop) {
	$dialog = new UXAndroidDialog();
	$dialog->title = new UXLabel("Диалог, привет!");
	$dialog->content = $b = new UXButton("Show toast");
	$b->on('click', function (){
		$toast = new UXToast();
		$toast->text = "The Toster xD";
		$toast->show();
	});
	$dialog->show();
});

UXMobileApplication::setSwatch(UXSwatch::of("red"));
UXMobileApplication::getStatusbar()->color = "#ef5350";
UXMobileApplication::addView(UXView::HOME_NAME, $view);
UXMobileApplication::showView(UXView::HOME_NAME);


