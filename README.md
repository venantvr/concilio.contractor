Not ready for production yet...

Usage :

```
concilio\contractor::get()->log(__FILE__, __FUNCTION__);
```

```
concilio\contractor::get()->log(__FILE__, __FUNCTION__)->require(isset($variable) == true);
```

```
$i = 0;
$j = 1;

concilio\contractor::get()->log(__FILE__, __FUNCTION__)->evaluate(
function test() use($i, $j) {
    return $i == $j;
});
```
