# Hermes Emailing [v1.0.0]

Highly configurable multi-process emailing solution (console command) for yii2.0.

[![Latest Stable Version](https://poser.pugx.org/thinker-g/yii2-hermes-mailing/v/stable)](https://packagist.org/packages/thinker-g/yii2-hermes-mailing)
[![Total Downloads](https://poser.pugx.org/thinker-g/yii2-hermes-mailing/downloads)](https://packagist.org/packages/thinker-g/yii2-hermes-mailing)
[![License](https://poser.pugx.org/thinker-g/yii2-hermes-mailing/license)](https://packagist.org/packages/thinker-g/yii2-hermes-mailing)
[![Powered by Yii 2.0](https://img.shields.io/badge/Powered%20by-Yii%20Framework%202.0-yellowgreen.svg)](http://www.yiiframework.com/)

## Installation

### 1. Downloading

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require --prefer-dist thinker-g/yii2-hermes-mailing:dev-master
```

or add

```bash
"thinker-g/yii2-hermes-mailing": "dev-master"
```

to the require section of your `composer.json` file.

You could also download a copy directly from the [GitHub project page](http://github.com/thinker-g/yii2-hermes-mailing).
If you do in this way, you'll be needing to setup the directory of alias `@thinker_g/HermesMailing`. Here's an example.

In config/main.php, assume that you put `yii2-hermes-mailing` folder in `extensions/` of your project:

```php
return [
    'id' => 'app-console',
    ...
    'aliases' => [
        '@thinker_g/HermesMailing' => '@app/extensions/yii2-hermes-mailing',
        ...
    ],
    ...
];
```

In the example `@app` is the app's root alias, which will be replaced by its real path. It could be '@common', '@frontend', '@backend' in an advanced template.

### 2. Installing

#### a) Configuring
Edit the configuration file of your console appliction ( `console/config/main.php` / `config/console.php` by default) to mount the console command controller.

```php
return [
    'id' => 'app-console',
    ...
    'controllerMap' => [
        'email' => [
            'class' => 'thinker_g\HermesMailing\console\DefaultController',
            'modelClass' => 'common\models\HermesMail',
            'installerMode' => true,
            'testMode' => true
        ],
        ...
    ],
    ...
];
```

Please be noticed that `modelClass` will be used by the command later to generate the AR model, its default value is `app\\models\\HermesMail`.
If you are using a basic yii2.0 template or just want to keep the model in model directory of the console application, you don't need to specify the `modelClass`.
Here we assume that we are using the default advanced yii2.0 template. And of course, you can specify any model name as you want.

Set `installerMode` to **true** will enable some helper actions that will only be used during installation.
And it should be set to **false** (or be removed as **false** is default) when the command is ready for real usage.

`testMode` is a helper option for testing performace and adjusting parameters. When it's enabled, the real "send" operation will randomly return **true** or **false**.
Except this, all other operations will be performed normally.

#### b) Initializing (creating database table and generating AR model)
Be sure that your 'db' application component is functioning, then we can issue the command below to initialize the command.
The default initialization will create a table named `hermes_mail` and its corresponding AR model with the name you specifed above.

```bash
user@localhost:~/ws/advanced$ ./yii email/install
```

You should be seeing this if the command is installed successfully and ready for using.
```bash
user@localhost:~/ws/advanced$ ./yii email/install
Create table hermes_mail? (yes|no) [no]:y
Migrating database...
    > create table hermes_mail ... done (time: 0.065s)
Running 'Model Generator'...

The following files will be generated:
        [new] /home/admin/ws/advanced/common/models/HermesMail.php

Ready to generate the selected files? (yes|no) [yes]:y

Files were generated successfully!
Generating code using template "/home/admin/ws/advanced/vendor/yiisoft/yii2-gii/generators/
model/default"...
 generated /home/admin/ws/advanced/common/models/HermesMail.php
done!

Install complete!
user@localhost:~/ws/advanced$
```

#### c) Fill up some test data

Up to now your program is ready. You could use the generated AR model anywhere in your code, to insert emails to the queue.
To facilitate testing, you could use `email/fill4test` command to prepare(insert) 1000 emails for test.

```bash
user@localhost:~/ws/advanced$ ./yii help email/fill4test

DESCRIPTION

Run to insert a certain number of test email entries.


USAGE

yii email/fill4test [insertCount] [from] [to] [...options...]

- insertCount: int (defaults to 1000)
  Number of emails to insert.

- from: string (defaults to 'from_{seq}@example.com')
  From address where the token "{seq}" will be replaced by the sequence number.

- to: string (defaults to 'to_{seq}@example.com')
  To address where the token "{seq}" will be replaced by the sequence number.
```

Let's say we want 500 emails to give a try:

```bash
user@localhost:~/ws/advanced$ ./yii email/fill4test 500
An example email has been appended to the email queue. ID: 1.
An example email has been appended to the email queue. ID: 2.
...
An example email has been appended to the email queue. ID: 500.
===================================================================== 100%
500 mails inserted.
```

Now let's move on to run something real.




## Usage
### Check before taking off:
*** ATTENTION! Please check following items before you run the test. This will ensure your emails inserted above won't be sent out. ***

- InstallerMode is off. (`installerMode` => false)
- Test mode is on. (`testMode` => true)
- Your "mailer" application component is functioning.

Once the extension is installed, simply use it in your code by  :

```bash
user@localhost:~/ws/advanced$ ./yii email/send-queue
[2015-03-20 09:54:49] Emailing process (server id: 0) started.
[2015-03-20 09:54:49] Signed 100 entries with signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:52] 100 emails processed by signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:52] Signed 100 entries with signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:55] 100 emails processed by signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:55] Signed 100 entries with signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:57] 100 emails processed by signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:54:57] Signed 100 entries with signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:55:01] 100 emails processed by signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:55:01] Signed 100 entries with signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:55:04] 100 emails processed by signature: 89f0bc811b35b23e888674875a630e42.
[2015-03-20 09:55:04] Emailing process (server id: 0) stopped.
user@localhost:~/ws/advanced$
```

If you are seeing some output like this, your command is working. And you can deploy it by configuring your crontab.

### CRONTAB
Please do not forget to disable `testMode` before you setup crontab for real emailing.
Here's an example of crontab seeting for webmaster user.
```bash
 ================== hermes mailing ==================
 * * * * * sleep  0;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-0
 * * * * * sleep 10;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-1
 * * * * * sleep 20;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-2
 * * * * * sleep 30;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-3
 * * * * * sleep 40;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-4
 * * * * * sleep 50;/home/webmaster/yii2Adv/yii email/send-queue >> /home/webmaster/yii2adv/console/logs/send-queue-5
 ================== hermes mailing ==================
```

This setting will start a new emailing process every 10 seconds, every process will work parallely till all mails are sent in the queue.




## Advanced Configuration

*Under development, coming soon!*

This part will cover a batch of interesting features:

 - Sending control (Indirect control of memory consumption and execution time.)
 - Distributed deployment
 - Using dedicated email database service
 - Complying spamming rules
 - Customization (replacing mailer, AR, etc.)
 - Handling events

Please, temporarily, read the property comments in the code for usage of them.




## Contact Me

jiyan.guo@gmail.com
