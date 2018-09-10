# UXEvent

- **класс** `UXEvent` (`php\gui\event\UXEvent`)
- **пакет** `gui`
- **исходники** `php/gui/event/UXEvent.php`

**Классы наследники**

> [UXWebEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWebEvent.ru.md), [UXWindowEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWindowEvent.ru.md), [UXContextMenuEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXContextMenuEvent.ru.md), [UXKeyEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXKeyEvent.ru.md), [UXMouseEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXMouseEvent.ru.md), [UXWebErrorEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWebErrorEvent.ru.md), [UXScrollEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXScrollEvent.ru.md), [UXDragEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXDragEvent.ru.md)

**Описание**

Class Event

---

#### Свойства

- `->`[`sender`](#prop-sender) : `UXNode|UXWindow`
- `->`[`target`](#prop-target) : `object|UXNode`

---

#### Статичные Методы

- `UXEvent ::`[`makeMock()`](#method-makemock)

---

#### Методы

- `->`[`copyFor()`](#method-copyfor)
- `->`[`isConsumed()`](#method-isconsumed)
- `->`[`consume()`](#method-consume) - _..._

---
# Статичные Методы

<a name="method-makemock"></a>

### makeMock()
```php
UXEvent::makeMock(mixed $sender): UXEvent
```

---
# Методы

<a name="method-copyfor"></a>

### copyFor()
```php
copyFor(object $newSender): UXEvent
```

---

<a name="method-isconsumed"></a>

### isConsumed()
```php
isConsumed(): bool
```

---

<a name="method-consume"></a>

### consume()
```php
consume(): void
```
...