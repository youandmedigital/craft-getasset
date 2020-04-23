<p align="center">
    <img src="https://github.com/youandmedigital/craft-getasset/blob/master/src/icon.svg" alt="GetAsset" width="150"/>
</p>

# GetAsset for Craft 3.1

This little plugin looks in a certain folder for a file that was last modified and returns the value in Twig.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

```
cd /path/to/project
```

2. Then tell Composer to load the plugin:

```
composer require youandmedigital/craft-getasset
```

## Introduction

This little plugin looks in a certain folder for a file that was last modified and returns the value in Twig.

This might be useful to you if

- You're running Craft 3.1 or above
- You're not using something like Asset Rev or Twigpack for Webpack
- You've setup your local build system to hash your compiled CSS or Javascript
- You're looking for a low-fi solution to pull in your hashed CSS or Javascript files and make them available in your templates


## Examples

### Output a file that was last modified in a directory

Inside /assets/css there are 3 files, with the following timestamps:
```
22 Apr 22:54 c.min.d6df804850.css
22 Apr 22:55 plugin.css
22 Apr 22:54 ie.min.8af08fe73b.css
```

In our Twig templates, we set a variable and give GetAssets a folder path to search:
```
{% set settings =
    {
        path: '/assets/css/'
    }
%}
{% set file = craft.getasset.config(settings) %}
<link rel="stylesheet" href="/assets/css/{{ file }}">
```

This example Twig code would output:
```
<link rel="stylesheet" href="/assets/css/plugin.css">
```

### Output a file that was last modified in a directory, which matches a regex pattern

Inside /assets/css there are 4 files, with the following timestamps:
```
22 Apr 22:54 c.min.d6df804850.css
22 Apr 22:50 c.min.a8xd808007.css
22 Apr 22:55 p.min.d6df804850.css
22 Apr 22:54 ie.min.8af08fe73b.css
```

In our Twig templates, we set a variable, give GetAssets a folder path to search and a regex pattern to match:
```
{% set settings =
    {
        path: '/assets/css/',
        pattern: '/^(c).min.*\\S{10}.css$/'
    }
%}
{% set file = craft.getasset.config(settings) %}  
<link rel="stylesheet" href="/assets/css/{{ file }}">
```

This example Twig code would output:
```
<link rel="stylesheet" href="/assets/css/c.min.d6df804850.css">
```

## Configuring GetAsset

- **path** `(string, required)`: A valid folder for GetAsset to search
- **pattern** `(string, optional, default value '*')`: A regex pattern to match

Example configuration:
```
{% set myVarSettings =
    {
        path: '<path>',
        pattern: '<pattern>'
    }
%}
{% set myVar = craft.getasset.config(myVarSettings) %}
```