# UXEvent

- **class** `UXEvent` (`php\gui\event\UXEvent`)
- **package** `gui`
- **source** `php/gui/event/UXEvent.php`

**Child Classes**

> [UXWebEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWebEvent.md), [UXWindowEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWindowEvent.md), [UXContextMenuEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXContextMenuEvent.md), [UXKeyEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXKeyEvent.md), [UXMouseEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXMouseEvent.md), [UXWebErrorEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXWebErrorEvent.md), [UXScrollEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXScrollEvent.md), [UXDragEvent](https://github.com/VenityStudio/android/tree/master/jphp-android-ext/api-docs/classes/php/gui/event/UXDragEvent.md)

**Description**

Class Event

---

#### Properties

- `->`[`sender`](#prop-sender) : `UXNode|UXWindow`
- `->`[`target`](#prop-target) : `object|UXNode`

---

#### Static Methods

- `UXEvent ::`[`makeMock()`](#method-makemock)

---

#### Methods

- `->`[`copyFor()`](#method-copyfor)
- `->`[`isConsumed()`](#method-isconsumed)
- `->`[`consume()`](#method-consume) - _..._

---
# Static Methods

<a name="method-makemock"></a>

### makeMock()
```php
UXEvent::makeMock(mixed $sender): UXEvent
```

---
# Methods

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