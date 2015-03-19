# Hermes Emailing Module

Multi-process emailing suite (module, command) for yii2.0.

## Installation

### 1. Downloading

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thinker-g/yii2-hermes-mailing:dev-master
```

or add

```
"thinker-g/yii2-hermes-mailing": "dev-master"
```

to the require section of your `composer.json` file.

You could also download a copy directly from the [GitHub project page](http://github.com/thinker-g/yii2-hermes-mailing).
If you do in this way, you'll be needing to setup the directory of alias `@thinkerg/HermesMailing`. Here's an example.

In config/main.php, assume that you put `yii2-hermes-mailing` folder in `extensions/` of your project:

```php
return [
    'id' => 'app-console',
    ...
    'aliases' => [
        '@thinkerg/HermesMailing' => '@app/extensions/yii2-hermes-mailing',
        ...
    ],
    ...
];
```

In the example `@app` is the app's root alias, which will be replaced by its real path. It could be '@common', '@frontend', '@backend' in an advanced template.

### 2. Installing

#### a. Configuring

#### b. Initializing (creating database table and generating AR model)

#### c. Fill up some test data


-----


## Usage
Check before taking off:

1. InstallerMode is off. ([[installerMode]] => false)
2. Test mode is off. ([[testMode]] => false)
2. Your "mailer" application component is functioning.


Once the extension is installed, simply use it in your code by  :

```php

```

## Configuration

Under development, coming soon!

This part will cover a lot of interesting features:

 - Sending control (Indirect control of memory consumption and execution time.)
 - Spamming rules complying
 - Distributed deployment
 - Using dedicated email database service
 - Customizations (replacing mailer, AR, etc.)
 - Events

Please read temporarily the property comments in the code for usage of them.