# OATS Phoenix API - PHP SDK

PHP SDK to interact with the OATS Phoenix API (earlweb.net);

## Installation

You can install the package via composer:

```bash
composer require weble/oatsphoenixapi
```

## Usage

``` php
$oats = new Weble\OATSPhoenixApi\OATS(
	'[OATS_API_URL]',
  	'[TOKEN]'
);

$oats->browse();
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email daniele@weble.it instead of using the issue tracker.

## Credits

- [Daniele Rosario](https://github.com/Skullbock)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
