# staysafe/password-policy-builder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
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

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Antonios Pavlakis][link-author]
- [All Contributors][link-contributors]

## License

The BSD 3-Clause License. Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/staysafe/password-policy-builder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/License-BSD%203--Clause-blue.svg
[ico-travis]: https://img.shields.io/travis/staysafe/password-policy-builder/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/staysafe/password-policy-builder.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/staysafe/password-policy-builder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/staysafe/password-policy-builder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/staysafe/password-policy-builder
[link-travis]: https://travis-ci.org/staysafe/password-policy-builder
[link-code-quality]: https://scrutinizer-ci.com/g/staysafe/password-policy-builder
[link-downloads]: https://packagist.org/packages/staysafe/password-policy-builder
[link-author]: https://github.com/pavlakis
[link-contributors]: ../../contributors