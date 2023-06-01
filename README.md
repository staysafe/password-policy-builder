# staysafe/password-policy-builder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Coverage Status][ico-coveralls]][link-coveralls]
[![Total Downloads][ico-downloads]][link-downloads]


## Install

Via Composer

``` bash
$ composer require staysafe/password-policy-builder
```

## Usage

``` php
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder($policy);
        if ($passwordPolicyBuilder->isValid($password)) {   
            // password meets the Password Policy
        }
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.


## Credits

- [Antonios Pavlakis][link-author]
- [Peter Mead]

## License

The BSD 3-Clause License. Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/staysafe/password-policy-builder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/License-BSD%203--Clause-blue.svg
[ico-travis]: https://img.shields.io/travis/staysafe/password-policy-builder/master.svg?style=flat-square
[ico-coveralls]: https://coveralls.io/repos/github/staysafe/password-policy-builder/badge.svg
[ico-downloads]: https://img.shields.io/packagist/dt/staysafe/password-policy-builder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/staysafe/password-policy-builder
[link-coveralls]: https://coveralls.io/github/staysafe/password-policy-builder
[link-downloads]: https://packagist.org/packages/staysafe/password-policy-builder
[link-author]: https://github.com/pavlakis