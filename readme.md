# Humans — Default Avatars
This package allows downloads from multiple providers and it returns the first successful result.

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
    new Providers\Unavatar('jaggy@humans.ph'),
    new Providers\Unavatar('jaggy'),
    new Providers\Unavatar('jaggy@hey.com'),
    new Providers\UiAvatars('Jaggy Gauran'),
);

$response->contents;
$response->extension;
```

## Testing
Avatars provides two testing fakes to make testing a lot easier.

### Force a success with specific contents

```php
Avatars::pass('example image content', 'gif');
```

### Force the avatar to fail

```php
Avatars::fail();
```
