# Millenium PHP framework

[![Build Status](https://travis-ci.org/milleniumphp/milleniumframework.svg?branch=master)](https://travis-ci.org/milleniumphp/milleniumframework)
[![Build Status](https://img.shields.io/packagist/dt/superhabber/mill.svg)](https://packagist.org/packages/superhabber/mill)
[![Latest Stable Version](https://img.shields.io/packagist/v/superhabber/mill.svg)](https://packagist.org/packages/superhabber/mill)
[![License](https://poser.pugx.org/superhabber/mill/license.svg)](https://packagist.org/packages/superhabber/mill)
#

simple and modern PHP framework

## Getting Started

Let's go download the Millenium framework

### Installing

For downloading install composer package with command:

```
composer create-project superhabber/mill <folder_name>
```
## Documentation

[documentation of framework](https://docs-millphp.herokuapp.com)
## Testing

-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 

## Main site

[Millenium PHP organization](https://milleniumphp.herokuapp.com)

## Authors

* **Yaroslav Palamarchuk** - *Initial work* - [superhabber](https://github.com/superhabber)
See also the list of [contributors](https://github.com/milleniumphp/milleniumframework/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details