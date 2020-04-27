# Incrementor

Generate String from a template in bulk. This can be used to generate

## How to use

Basic & Fast Usage of the library:

```php
<?php

use \nhalstead\Incrementor\Incrementor;

// Using the Get Method you can get a collection of the output.
$generated = Incrementor::get('TEST_{0000^}', 10);

var_dump($generated);
// object(Tightenco\Collect\Support\Collection)#4 (1) {
//   ["items":protected]=>
//   array(10) {
//     [0]=>
//     string(9) "TEST_0000"
//     [1]=>
//     string(9) "TEST_0001"
//     [2]=>
//     string(9) "TEST_0002"
//     [3]=>
//     string(9) "TEST_0003"
//     [4]=>
//     string(9) "TEST_0004"
//     [5]=>
//     string(9) "TEST_0005"
//     [6]=>
//     string(9) "TEST_0006"
//     [7]=>
//     string(9) "TEST_0007"
//     [8]=>
//     string(9) "TEST_0008"
//     [9]=>
//     string(9) "TEST_0009"
//   }
// }

?>
```
