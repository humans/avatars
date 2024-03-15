# Humans — Default Avatars
Download the default avatars using unavatar.io and ui-avatars.com.

## Setup
```bash
composer require humans/avatars
```

## Usage
This will return the first successful photo.

```php
use Humans\Avatars\Facades\Avatars;
use Humans\Avatars\Attempt;
use Humans\Avatars\Providers;

$response = Avatars::attempt(
    new Attempt(new Providers\Unavatar, 'jaggy@humans.ph'),
    new Attempt(new Providers\Unavatar, 'jaggy'),
    new Attempt(new Providers\Unavatar, 'jaggy@hey.com'),
    new Attempt(new Providers\UiAvatars, 'Jaggy Gauran'),
);

$response->contents;
$response->extension;
```

## Testing
Avatars provides two testing fakes to make testing a lot easier.

### Force a success with specific contents

```php
Avatar::pass('example image content', 'gif');
```

### Force the avatar to fail

```php
Avatar::fail();
```
