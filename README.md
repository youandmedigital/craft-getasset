# GetAsset for Craft

This plugin retrieves the most recently modified file based on a specified folder path.

## Use case
Your build system adds a hash to assets so that they are version controlled. For example, `c.min.543e2b4059.css`. You might have a css folder on your web server that has more than 1 css file. You just want to select the most recently modified file. You might want to add a regex pattern to filter out results.

## Usage

Example 1:
```  
<link rel="stylesheet" href="/assets/css/{{ craft.stamp.options('/assets/css/') }}">
```

Would output:
```
<link rel="stylesheet" href="/assets/css/mycss.css">
```

Example 2:
```  
<link rel="stylesheet" href="/assets/css/{{ craft.stamp.options('/assets/css/', '/^(c).min.*\\S{10}.css$/') }}">
```

Would output:
```
<link rel="stylesheet" href="/assets/css/c.min.543e2b4059.css">
```


## Options
	- **filePath** (required): Is the path to your folder
	- **filePattern** (optional): Accepts a regex pattern

If you would like to do this via Craft, have a look at https://github.com/aelvan/Stamp-Craft/

## Changelog
