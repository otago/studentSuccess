"heyday/silverstripe-versioneddataobjects": "2.0.5",
"silverstripe-australia/addressable": "1.2.0 ",
"symbiote/silverstripe-gridfieldextensions": "2.0.2",
"unclecheese/betterbuttons": "1.2.*",
"unclecheese/display-logic": "1.3.3",
"undefinedoffset/sortablegridfield": "0.6.10"

# Image settings

Any page can use images and have them specified for different sized of the browser, breakpoints. This can be done using
YML setting

```
ImageExtension:
  sizes:
    1024
    780
    640
  exclude_classes:
    Page
```

Above example sets different images for browser sizes 1024, 780 and 640. And it adds images for all the objects in the CMS except Page class

To view these images you will have to use a specific function built in to the ImageExtensionHelper class.

```
$SizedImage('Image').Pure
```

above will add a picutre tab with all the breakpoints to the system.

There are two methods in the CMS which you can user to generate image tags

```

$Image.Add(WIDTH, HEIGHT, ALT_TEXT, CLASS, ID)
$Image.Pure(ALT_TEXT, CLASS, ID)
$Image.AddFluid(WIDTH, HEIGHT, ALT_TEXT, CLASS, ID)
$Image.PureFluid(ALT_TEXT, CLASS, ID)
$SizedImage('Image').Add(WIDTH, HEIGHT, ALT_TEXT, CLASS, ID)
$SizedImage('Image').Pure(ALT_TEXT, CLASS, ID)

$Image.URLWithSuffix // this adds a m get param for the file modified time to cache files 

```
there was a composer.json file we don't know why!!!! -Al
{
    "name": "silverstripers/silverstripe-core",
    "description": "Core Module for SilverStripe projects developed by SilverStripers",
    "type": "silverstripe-module",
    "keywords": ["silverstripe", "core"],
    "authors": [
    {
        "name": "Nivanka Fonseka",
        "email": "nivanka@silverstripers.com"
    }],
    "require": {
        "silverstripe/framework": "~3.1"
    }
    
}


