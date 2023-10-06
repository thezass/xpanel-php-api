# Xpanel ssh api php

## simple lightweight class for using all api features of [xpanel ssh](https://github.com/xpanel-cp/XPanel-SSH-User-Management/)

## Getting start

````php
<?php
require_once __DIR__ . '/xpanel.php';

$xpanel = new xpanelssh('https://mypanel.com:123', TOKEN, 'admin', 'admin');
>```
````

## add client

```php
// if you just fill user and password create client with 1 gig data without expire time that can just 1 user can connect to it
$xpanel->add_client('myclient','1233');
```

## get client info

```php
// return array of user info
$user_info = $xpanel->client_info('myclient');
```
