# Yii2 GTM Widget
[![Build Status](https://travis-ci.org/MainAero/yii2-gtm-widget.svg?branch=master)](https://travis-ci.org/MainAero/yii2-gtm-widget) [![Maintainability](https://api.codeclimate.com/v1/badges/ced413cc7754de2d7c12/maintainability)](https://codeclimate.com/github/MainAero/yii2-gtm-widget/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/ced413cc7754de2d7c12/test_coverage)](https://codeclimate.com/github/MainAero/yii2-gtm-widget/test_coverage)

A Yii2 extensions which provides a widget to render Google Tag Manager `<script>` and `<noscript>` snippets based on Yii2 params configuration.

## Configuration
Add in your `params-local.php` file:
```php
'gtm_id' => '<YOUR_GTM_ID_WITHOUT_GTM_PREFIX> (required)',
'gtm_env' => '<YOUR_ENVIRONMENT_QUERY_STRING> (optional)'
```
E.g.:
```php
'gtm_id' => '1A2B3CD',
'gtm_env' => '&gtm_auth=<TOKEN>w&gtm_preview=<ENV_ID>&gtm_cookies_win=x'
```
If you don't set the `gtm_id` param this widget will return an empty string.
## Usage
In your view file:

```php
<?php
use mainaero\yii\widget\GTM;
...
```

### Render a `<script>` snippet:
```php
<?= GTM::widget(); ?>
```
which renders:
```html
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl+'<YOUR_ENVIRONMENT_QUERY_STRING>';f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-<YOUR_ID>');</script>
<!-- End Google Tag Manager -->
```

### Render a `<noscript>` snippet:
```php
<?= GTM::widget(['type' => 'noscript']); ?>
```
which renders:
```html
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-<YOUR_ID><YOUR_ENVIRONMENT_QUERY_STRING>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
```
