#Common helpers

## Classes, that helps you write stable code

### Demo
#### 1. Task: get value from array and check existing, replace default value

```php
use Helpers\CommonHelpers as ch;

$dict = [
    'order_id' => '122',
    'delivery_id' => '1'
];

$orderId = (int) ch::getArrayValue('order_id', $dict, 0);
```

#### 2. Task: get first value from array and check that it is not an empty string
For example if you handle request and wants to handle get/post parameters.
It can be received from some filter, which has many values, for example radio group or something like that.
And you want to get first value of many values.

```php
use Helpers\CommonHelpers as ch;
use Filters\ColorHandler as ColorFilter;

$filters = [];
// var_dump($_GET['filter_colors']);
// after json_decode:
// [
//     0 => 'green',
//     1 => 'blue'
//     ...
// ]
...
// try to convert json format, returns empty array as default value
$filters['colors'] = ch::fromJSON(ch::getArrayValue('filter_colors', $_GET, []));
...
// get first color in colors. Sets empty string as default value
$firstColor = (int) ch::getFirstValue('colors', $filters, '');

// run filter by first color if necessary
if (ch::isFilledString($firstColor)) {
    /** @var FilterHandlerInterface $filter */
    $filterInstance = new ColorFilter();
    $idSet = $filterInstance->runFilter($firstColor);
}
```
