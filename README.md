# MageQuest_ProductExportDiscreteAttributeColumns

Bundle import/export, but better.

<div>
    <img src="https://img.shields.io/badge/magento-2.4-orange.svg?logo=magento&longCache=true&style=for-the-badge" alt="Magento 2.4"/>
    <img src="https://img.shields.io/packagist/v/magequest/magento2-module-bundle-import-export-enhancements?style=for-the-badge" alt="Packagist Version">
    <img src="https://img.shields.io/badge/License-MIT-blue.svg?longCache=true&style=for-the-badge" alt="MIT License"/>
</div>

## Overview
A Magento 2 module that improves the bundle product import export functionality.

## Features

### Remove/Update Bundle Option Data
* Allows removal of bundle options via import using the 'Empty attribute value constant' (`__EMPTY__VALUE__`) in the `bundle_values` column
* Supports both removing and recreating (essentially updating) bundle options in the same import file
                
#### Why?
Because, without this functionality, updating bundle option data is only additive, i.e. option data is added on top of the existing data. This means option names can't be updated (it will create new additional options) and removing products from an option is not possible. Having to do this manually per product in the admin panel is not acceptable when working with large datasets.

Also, it makes sense. Using the 'Empty attribute value constant' (`__EMPTY__VALUE__`) in almost any other import field (CSV column) removes that data against the specified product when imported. The `bundle_values` column now has feature parity.

## Installation
```
composer require magequest/magento2-module-bundle-import-export-enhancements
bin/magento module:enable MageQuest_BundleImportExportEnhancements
bin/magento setup:upgrade
```

## Compatibility
Magento Open Source / Adobe Commerce 2.4.x

## Contributing
Issues and pull requests welcomed.
