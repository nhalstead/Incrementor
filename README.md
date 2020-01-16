# Incrementor

Generate String from a tempalte in bulk. This can be used to generate 

## How to use

Basic & Fast Usage of the library:

```php
<?php

use \nhalstead\Incrementor;

// Using the Get Methtod you can get a collection of the output.
$generated = Incrementor('TEST_{0000^}')::get();

?>
```
