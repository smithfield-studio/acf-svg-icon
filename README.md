# Advanced Custom Fields: SVG Icon

This enhances [Advanced Custom Field](https://www.advancedcustomfields.com/pro/) plugin by adding an svg icon custom field.

## Compatibility

* ACF 5.0.0 and up, that means the pro version.
* ACF 4 (not supported).

## Installation

### via Composer

1. Add a line to your repositories array:
    ```yml
    "repositories": [
        {
        "type": "package",
        "package": {
            "name": "akandco/acf-svg-icon",
            "type": "wordpress-muplugin",
            "version": "3.0.0",
            "dist": {
            "type": "zip",
            "url": "web/app/plugin-zips/acf-svg-icon-modified-3.0.0.zip"
            }
        }
        },
        ...
    ]
    ```
1. Add a line to your require block: `"akandco/acf-svg-icon": "^2",`
1. Add to mu-plugins:
    ```yml
    "web/app/mu-plugins/{$name}/": [
        "type:wordpress-muplugin",
        "akandco/acf-svg-icon",
        ...
  ```
1. Run: `composer update`
1. Add icons to `assets/images/icons` and/or the Media Library

### Theme filters/overrides

Add icons from our assets folder (using Sage)

```php
// Add icons from our assets folder
add_filter('acf_svg_icon_filepath', function($filepath) {
    $icons = glob(get_template_directory() . '/resources/images/icons/*.svg');

    foreach ($icons as $filename) {
        $filepath[] = $filename;
    }

    return $filepath;
});
```

Remove the inclusion of media library icons

```php
// Remove the inclusion of media library icons
add_filter('acf_svg_icon_include_media_library', '__return_false');
```

## Contributing

If you gonna change some JS or CSS, we use GULP in order to uglify and minify assets. So please do the following for your PR:
1. install node modules : `npm install`
2. install gulp dependencies : `npm install gulp`
3. then minify assets : `gulp dist`

## Changelog


### 3.0.0 - 10 Feb 2021
* Version bump as probs not compatible with previous versions since updates/overrides made
* Feature: add filter `acf_svg_icon_include_media_library` to disable icons/svgs in the media library

### 2.0.5 - Late 2020
* No idea! Some stuff to fix sage assets folders probably?
* Fix: bug (or weird requirment) meant we needed a `-` in icon names

### 2.0.4 - 28 Oct 2019
* FEATURE : add filter `acf_svg_icon_parsed_svg` to filter the icons list
* FIX : fix PHP fatal error with SVG inclusion
* FIX : temporary fix an issue with acf_format method
* IMPROVE : respect WP coding standards

### 2.0.3 - 04 Feb 2019
* FIX : Mixing custom and media sources

### 2.0.2 - 04 Feb 2019
* FIX : Return array in get_all_svg_files function (reverted in 2.0.3)

### 2.0.1 - 19 Nov 2018
* FEATURE [#8](https://github.com/BeAPI/acf-svg-icon/issues/8) :  improve performances on parsing svg from library
* FEATURE [#9](https://github.com/BeAPI/acf-svg-icon/issues/9) :  upload custom SVGs

### 1.2.1 - 21 Aug 2017
* fix notice $acf->version property undefined on ACF versions under 5.6
* use built-in wrapper acf_get_setting('version') to retrieve version

### 1.2.0 - 27 July 2017
* Add compatibility for ACF 5.6.0 and more versions
* Still keep compatibility for ACF 5.6.0 and lower versions
* Add some custom CSS for a more beautiful admin UI
* Now displaying the icon name, not anymore like a slug
* Improve readme

### 1.0.1 - 11 May 2017
* Initial
