#Class Image
Class Image was created to provide ussual actions with images.
Now it supports such methods as resize and save.

#Usage
```php
$image = Image::open('test.jpg');

$image->resizeToWidth(100);

$image->save("test_width.jpg");
```