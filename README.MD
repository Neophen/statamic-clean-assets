## Description

Checks all your content files for each assets `url` or `id` if no content file uses it, it will delete that file.

**Danger** it doesn't check if your script files uses assets, so it will delete them too. Only use this if you know that your assets should only be used in your content files, meaning all the files in the 'site/content' folder.


## Installation

1. Copy the "CleanAssets" folder contents to your Statamic `site/addons` directory
2. Run `php please update:addons` to load the addon's dependencies.

## Usage

 * run `php please clean_assets` at the root of your project folder

## License

[MIT License](http://emd.mit-license.org)
