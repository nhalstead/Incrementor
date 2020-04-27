# Incrementor

Generate String from a template in bulk. This can be used to generate

## How to use

Basic & Fast Usage of the library:

```php
<?php

use \nhalstead\Incrementor\Incrementor;

// Using the Get Method you can get a collection of the output.
$generated = Incrementor::get('TEST_{0000^}', 10);

?>
```
