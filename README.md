# Laravel Advert Component

Advert Component for Laravel Application.

[![Build Status](https://scrutinizer-ci.com/g/ibrandcc/advert/badges/build.png?b=master)](https://travis-ci.org/ibrandcc/advert)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ibrandcc/advert/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ibrandcc/advert/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ibrandcc/advert/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ibrandcc/advert/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/ibrand/advert/v/stable)](https://packagist.org/packages/ibrand/advert)
[![Latest Unstable Version](https://poser.pugx.org/ibrand/advert/v/unstable)](https://packagist.org/packages/ibrand/advert)


### 安装

```
composer require ibrand/advert:~1.0 -vvv
```

低于 Laravel5.5 版本:

config/app.php文件providers数组中添加：

```
iBrand\Component\Advert\AdvertServiceProvider::class
```
生成配置请执行:
```
php artisan vendor:publish --provider="iBrand\Component\Advert\AdvertServiceProvider"

```