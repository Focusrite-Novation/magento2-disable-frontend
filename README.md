# Disable Frontend in Magento 2
Disable the frontend in Magento 2 for using only the Admin and the API routes.

This was forked from [abelbm/magento2-disable-frontend](https://github.com/abelbm/magento2-disable-frontend)

## 1. Install Disable Frontend

### Manual Installation

Install Disable Frontend for Magento2
 * Download the extension
 * Unzip the file
 * Create a folder {Magento root}/app/code/FocusriteNovation/DisableFrontend
 * Copy the content from the unzip folder

### Using Composer

```bash
$ composer require focusrite-novation/magento2-disablefrontend
```

## 2. Enable Disable Frontend

```bash
$ php bin/magento module:enable FocusriteNovation_DisableFrontend
$ php bin/magento setup:upgrade
$ php bin/magento cache:flush
$ php bin/magento setup:di:compile
```
 
## 3. Change the frontend redirect
 
Stores > Configuration > Advanced > Admin > Disable Frontend
 
