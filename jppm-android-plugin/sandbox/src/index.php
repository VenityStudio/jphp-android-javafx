<?php 

use php\gui\{ UXForm, UXButton };

$form = new UXForm();

$b = new UXButton("Hello from JPHP");
$b->on("click", function () use ($b) {
	$b->text = "you click the button";
});
$b->x = 100;
$b->y = 150;

$form->add($b);
$form->show();
