# SS 4 update:
Steps
devbuild

replace `vendor/silverstripe/assets/src/Dev/Tasks/FileMigrationHelper.php:442` with :
```php
private function stripAssetsDir($path, $base = '')
    {

        return str_replace(
            'assets/',
            '',
            $path
        );
    }
```


```php
    $heroconf = GridFieldConfig_RelationEditor::create();
    
    $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'));
    $herogridfield = GridField::create('StaffProfiledItem', 'Dunedin campus hero', $this->StaffProfiledItem(), $heroconf);
```

then run ` php -d memory_limit=6000M vendor/silverstripe/framework/cli-script.php dev/tasks/MigrateFileTask`

******************************
"heyday/silverstripe-versioneddataobjects": "2.0.5",
"silverstripe-australia/addressable": "1.2.0 ",
"symbiote/silverstripe-gridfieldextensions": "2.0.2",
"unclecheese/betterbuttons": "1.2.*",
"unclecheese/display-logic": "1.3.3",
"undefinedoffset/sortablegridfield": "0.6.10"


******************************
******************************
******************************

