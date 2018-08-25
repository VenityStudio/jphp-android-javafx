<?php
namespace system {

    use php\android\UXAndroidDialog;
    use php\android\UXAppBar;
    use php\android\UXBottomNavigation;
    use php\android\UXBottomNavigationButton;
    use php\android\UXExceptionDialog;
    use php\android\UXMaterialIcons;
    use php\android\UXMobileApplication;
    use php\android\UXRating;
    use php\android\UXSidePopupView;
    use php\android\UXSwatch;
    use php\android\UXToast;
    use php\android\UXView;
    use php\gui\layout\UXBorderPane;
    use php\gui\layout\UXPane;
    use php\gui\layout\UXPanel;
    use php\gui\layout\UXTilePane;
    use php\gui\layout\UXVBox;
    use php\gui\paint\UXColor;
    use php\gui\UXApplication;
    use php\gui\UXButton;
    use php\gui\UXComboBox;
    use php\gui\UXLabel;
    use php\gui\UXNode;
    use php\gui\UXSlider;
    use php\gui\UXTextField;

    class Loader{

		function showMenu(){
            UXMobileApplication::showLayout("menu");
		}

		function createPreview(String $title, UXNode $node) : UXView {

		    $view = new UXView();
            $view->setOnUpdateAppBar(function (UXAppBar $appBar) use ($title){
                $appBar->title = new UXLabel($title);
                $appBar->navIcon = (new UXMaterialIcons("MENU"))->button(function (){
                    $this->showMenu();
                });
            });

            UXMobileApplication::addView("pre_$title", $view);

            $view->center = $node;
            return $view;
        }

		function createHomeView(){
			$home = new UXView();
			$home->setOnUpdateAppBar(function (UXAppBar $appBar){
				$appBar->title = new UXLabel("Home");
				$appBar->navIcon = (new UXMaterialIcons("MENU"))->button(function (){
					$this->showMenu();
				});
			});

			UXMobileApplication::addView("home", $home);

			$pane = new UXTilePane();
			$pane->alignment = "TOP_CENTER";
			$pane->add($v = new UXVBox());
			$v->add($title = new UXLabel("Добро пожаловать!"));
			$v->add($content = new UXLabel("В открытый Бета-тест!"));
            $home->center = $pane;

		}

		function load(){

            echo "[INFO] Loading Menu\n";

            $pop = new UXSidePopupView($pane = new UXPanel());
            $pane->add($VBox = new UXVBox());
            $VBox->add($header = new UXPanel());
            $header->style = "-fx-background-color: linear-gradient(to right, #56ab2f, #a8e063);";
            $header->add($title = new UXLabel("jPHP Menu"));

            $header->borderWidth = 0;
            $pane->borderWidth = 0;
            $pane->backgroundColor = UXColor::of("#fff");
            $header->backgroundColor = UXColor::of("#fff");
            $title->textColor = UXColor::of("#fff");
            $title->position = [8, 8];
            $title->font->size = 24;
            $header->minWidth = 244;
            $header->minHeight = 134;
            $pop->minWidth = 244;
            $VBox->minWidth = 244;
            $VBox->alignment = "TOP_CENTER";

            $buttons = [["name" => "Home", "icon" => "home", "show" => "home"],
                ["name" => "Dialog", "icon" => "home", "show" => "pre_UXAndroidDialog"],
                ["name" => "Toast", "icon" => "home", "show" => "pre_UXToast"],
                ["name" => "Swatch", "icon" => "home", "show" => "pre_UXSwatch"],
                ["name" => "BottomNav", "icon" => "home", "show" => "pre_UXBottom"],
                ["name" => "StatusBar", "icon" => "home", "show" => "pre_UXStatusBar"],

            ];

            foreach ($buttons as $button) {
                $VBox->add($b = new UXButton($button['name']));
                $b->minWidth = 244;
                $b->maxWidth = 244;
                $b->width = 244;
                $b->on('click', function () use ($button) {
                    UXMobileApplication::showView($button["show"]);
                });
                $b->alignment = "TOP_LEFT";
                $b->backgroundColor = UXColor::of("#00000000");
                $b->graphic = (new UXMaterialIcons($button['icon']))->graphic();
            }

            // DIALOG
            echo "[INFO] Loading Views\n";
            $this->createHomeView();
            $d = new UXButton("Показать диалог");
            $d->on('click', function () {
                $dialog = new UXAndroidDialog();
                $dialog->title = new UXLabel("Диалог");
                $box = new UXVBox();
                $box->add($r = new UXRating());
                $dialog->content = $box;
                $r->rating = 2.5;
                $hide = new UXButton("Закрыть");
                $hide->on('click', function () use ($dialog) {
                    $dialog->hide();
                });
                $box->spacing = 16;
                $box->add($hide);
                $dialog->show();
                $toast = new UXToast();
                $toast->text = "[Рейтинг] - " . $r->rating . "!";
                $toast->show();
            });
            $this->createPreview("UXAndroidDialog", $d);

            // TOAST
            $toast_p = new UXView();
            $toast_p->center = $tpp = new UXTilePane();
            $tpp->add($text = new UXTextField());
            $text->promptText = "Текст";
            $text->text = "тест";
            $tpp->add($slider = new UXSlider());
            $slider->max = 10000; // in ms
            $slider->min = 500; // in ms
            $slider->value = 2000; // 2 sec
            $tpp->add($toast_show = new UXButton("Показать"));
            $toast_show->on('click', function () use ($text, $slider) {
                $toast = new UXToast();
                $toast->text = $text->text;
                $toast->duration = $slider->value;
                $toast->show();
            });
            $this->createPreview("UXToast", $toast_p);

            // SWATCH
            $swatch_p = new UXPane();
            $swatch_p->add($spp = new UXTilePane());
            $spp->add($combo = new UXComboBox());
            $combo->items->addAll(["Red", "Blue", "Green", "Cyan", "Deep_Orange", "Deep_Purple", "Indigo", "Light_Blue", "Pink", "Purple", "Teal", "Light_Green", "Lime", "Yellow", "Amber", "Orange", "Brown", "Grey", "Blue_Grey"]);
            $combo->selected = "Lime";
            $spp->add($swatch_set = new UXButton("Установить"));
            $swatch_set->on('click', function () use ($combo) {
                UXMobileApplication::setSwatch(UXSwatch::of($combo->selected));
                $t = new UXToast();
                $t->text = "Готово!";
                $t->show();
            });
            $spp->hgap = 8;
            $spp->vgap = 8;
            $this->createPreview("UXSwatch", $swatch_p);

            echo "[INFO] Postload...\n";
            UXMobileApplication::setSwatch(UXSwatch::of("green"));
            UXMobileApplication::getStatusbar()->color = "#00897B";
            UXMobileApplication::showView("home");
            UXMobileApplication::addLayout("menu", $pop);

            $main = new UXPane();
            $bottom = new UXBottomNavigation();
            $bottom->items->add($b1 = new UXBottomNavigationButton());
            $b1->graphic = (new UXMaterialIcons("ZOOM_IN"))->graphic();
            $b1->on('click', function () {
                $t = new UXToast();
                $t->text = "+";
                $t->show();
            });

            $bottom->items->add($b1 = new UXBottomNavigationButton());
            $b1->graphic = (new UXMaterialIcons("WIFI"))->graphic();
            $b1->on('click', function () {
                $t = new UXToast();
                $t->text = "ВайFi";
                $t->show();
            });

            $bottom->items->add($b1 = new UXBottomNavigationButton());
            $b1->graphic = (new UXMaterialIcons("ZOOM_OUT"))->graphic();
            $b1->on('click', function () {
                $t = new UXToast();
                $t->text = "-";
                $t->show();
            });

            $view = $this->createPreview("UXBottom", $main);
            $view->bottom = $bottom;
            $main = new UXPane();
            $main->add($tpp = new UXTilePane());
            $tpp->add($text = new UXTextField());
            $text->text = "lime";
            $text->promptText = "Цвет";
            $tpp->add($b = new UXButton("Поставить"));
            $b->on('click', function () use ($text) {
                    UXMobileApplication::getStatusbar()->color = $text->text;
            });
            $this->createPreview("UXStatusBar", $main);

		}
	}
}