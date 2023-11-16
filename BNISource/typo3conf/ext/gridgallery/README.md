# TYPO3 Extension `Grid Gallery`

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg?style=for-the-badge)](https://paypal.me/pmlavitto)
[![Latest Stable Version](https://img.shields.io/packagist/v/lavitto/typo3-gridgallery?style=for-the-badge)](https://packagist.org/packages/lavitto/typo3-gridgallery)
[![TYPO3](https://img.shields.io/badge/TYPO3-gridgallery-%23f49700?style=for-the-badge)](https://extensions.typo3.org/extension/gridgallery/)
[![License](https://img.shields.io/packagist/l/lavitto/typo3-gridgallery?style=for-the-badge)](https://packagist.org/packages/lavitto/typo3-gridgallery)

> This extension adds a modern grid gallery content element to your TYPO3 website.

- **Demo**: [www.lavitto.ch/typo3-ext-gridgallery](https://www.lavitto.ch/typo3-ext-gridgallery)
- **Gitlab Repository**: [gitlab.com/lavitto/typo3-gridgallery](https://gitlab.com/lavitto/typo3-gridgallery)
- **TYPO3 Extension Repository**: [extensions.typo3.org/extension/gridgallery](https://extensions.typo3.org/extension/gridgallery/)
- **Found an issue?**: [gitlab.com/lavitto/typo3-gridgallery/issues](https://gitlab.com/lavitto/typo3-gridgallery/issues)

## 1. Introduction

### Features

- Based on extbase & fluid
- Simple and fast installation
- No configuration needed
- No user-side image-manipulation needed
- Fully responsive
- Support for high resolution screens

### Screenshots

#### Smartphone

![Smartphone Example](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-xs_tmb.png)
- [Full Size Screenshot](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-xs.png)

#### Tablet

![Tablet Example](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-sm_tmb.png)
- [Full Size Screenshot](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-sm.png)

#### Desktop

![Desktop Example](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-md_tmb.png)
- [Full Size Screenshot](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-fe-md.png)

## 2. Installation

### Installation using Composer

The recommended way to install the extension is by using [Composer](https://getcomposer.org/). In your Composer based 
TYPO3 project root, just do `composer req lavitto/typo3-gridgallery`.

### Installation from TYPO3 Extension Repository (TER)

Download and install the extension `gridgallery` with the extension manager module.

## 3. Minimal setup

1)  Include the static TypoScript of the extension.
2)  Create a grid gallery content element on a page

## 4. Administration

### Create content element

1)  Create a new content element and select "Grid Gallery"

![Create content element](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-be1_tmb.png)
- [Full Size Screenshot](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-be1.png) 

### Add images and set options

1) Simple upload or add media files (currently only images are supported!)
2) Enable/disable click-enlarge function
3) Override [default row height](#5-configuration)
4) Override [default margins](#5-configuration)

![Add images and set options](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-be2_tmb.png)
- [Full Size Screenshot](https://cdn.lavitto.ch/typo3/lavitto/typo3-gridgallery/gridgallery-be2.png)

## 5. Configuration

### Constants

This default properties can be changed by **Constant Editor**:

| Property             | Description                                    | Type      | Default value   |
| -------------------- | ---------------------------------------------- | --------- | --------------- |
| templateRootPath     | Path of Fluid Templates                        | string    | <i>null</i>              |
| partialRootPath      | Path of Fluid Partials                         | string    | <i>null</i>              |
| defaultRowHeight     | Default height of each gallery row in pixels   | integer   | 150             |
| defaultRenderFactor  | Default render factor of gallery images. Rendered image height = defaultRowHeight * defaultRenderFactor   | float   | 1.5 |
| defaultMargins       | Default margin between the images in pixels    | integer   | 2               |
| defaultCaptions      | Enable to show captions by default             | boolean   | true            |
| defaultRandomize     | Enable to randomize the image-order by default | boolean   | false           |
| defaultLastRow       | Default value to handle the last row           | options   | nojustify       |
| defaultBorder        | Default space around the content element       | integer   | -1              |
| thumbnailCropVariant | This crop variant is used to generate the thumbnails | string   | thumbnail              |
| lightboxCropVariant  | This crop variant is used to generate the lightbox image       | string   | default              |
| captionFields        | The content of these field(s) will be used to generate the caption (if captions are enabled). Fieldnames separated by commas and ordered by priority (example: "description, title, alternative")       | string   | description              |
| enableJquery         | Includes jQuery to the page                    | boolean   | false           |

## 6. Contribute

Please create an issue at https://gitlab.com/lavitto/typo3-gridgallery/issues.

**Please use GitLab only for bug-reports or feature-requests. For support use the TYPO3 community channels or contact us by email.**

## 7. Support

If you need private or personal support, contact us by email on [info@lavitto.ch](mailto:info@lavitto.ch). 

**Be aware that this support might not be free!**
