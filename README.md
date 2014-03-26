Loginchecka
===========

Small login component that addsd a config auth driver to casually drop in yo app

![Loginchecka login screen](http://i.imgur.com/BVpmOcc.png)

Instructions
------------
* do a `php artisan config:publish zwacky/loginchecka`
* add `'Zwacky\Loginchecka\LogincheckaServiceProvider'` to your app.php providers array
* change `'driver' => 'config'` in config/auth.php

Add or modify accounts
----------------------
Assuming you're using the config auth driver, you can modify the access accounts `config/packages/zwacky/loginchecka/config.php` under `valid_logins`.

Default the identifier to use is username. If you're using an eloquent auth driver and your logins need an email to authenticate, change `config_driver.identifier` in the loginchecka config.