<?php 

use php\gui\{ UXForm, UXScreen, UXButton };

use php\gui\layout\UXAnchorPane;

$form = new UXForm();

$button = new UXButton("Hello from JPHP");
$button->on("click", fn => $button->text .= " :D");

$form->add($button);

$form->size = [
	UXScreen::getWidth(),
	UXScreen::getHeight()
];

$form->show();
