## Description

Checks all your content files for each assets `url` or `id` if no content file uses it, it will delete that file.

**Danger** it doesn't check if your script files uses assets, so it will delete them too. Only use this if you know that your assets should only be used in your content files, meaning all the files in the 'site/content' folder.


## Installation

1. Copy the "CleanAssets" folder contents to your Statamic `site/addons` directory
2. Run `php please update:addons` to load the addons dependencies.

## Usage

 * run `php please clean_assets` at the root of your project folder

## License

Icons made by [Freepik](https://www.flaticon.com/authors/freepik) from [www.flaticon.com](https://www.flaticon.com/)

[MIT License](http://emd.mit-license.org)
