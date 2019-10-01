## Installation

1. Copy the "DynamicToken" folder contents to your Statamic `site/addons` directory
2. Run `php please update:addons` to load the addon's dependencies.

## Configuration

You can configure the addon by visiting CP > Addons > Dynamic Token:

  * **Refresh interval** - an interval for updating your csrf token every `n` minutes.
  * **CSS Selector** - If you want to change the default selector, **note** this will break `{{ form:create }}`.

## Usage

 * disable CSRF verification by adding `/!/DynamicToken` to the `csrf_exclude` array in `site/settings/system.yaml`. Don't worry we check that the referrer is comming from your `APP_URL`, but this still carries its own risks.
 * add a `{{ dynamic_token }}` to your layout file just before `</body>` tag.
 * add an `APP_URL=<your_site_url>` to your `.env` file.
e.g.:`APP_URL=site.com`
local development: `APP_URL=localhost`

## Examples

```
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dynamic Token</title>
</head>
<body>

	{{ form:create in="superfans" }}
		{{ fields }}
			<label>{{ display }}
				<input type="text" name="{{ field }}" value="{{ old }}" />
			</label>
		{{ /fields }}
	{{ /form:create }}

	{{ dynamic_token }}

</body>
</html>
```

## License

[MIT License](http://emd.mit-license.org)
