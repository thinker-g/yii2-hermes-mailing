<?php
/**
 * This file is a template to show all available options and their default values.
 * If you are using the same value in the real configuration section in you application.
 * You should not setup that option, and the following value will be assigned internally.
 *
 * @link http://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 * 
 */

/*
 * Here's an example of corn setting. 
 * We are assuming that the user is webmaster and the command ID in the application has been set to "email".
 *
 * This setting will startup a mailing process every 10 seconds. If there's no email to send, the process will exit
 * immediately after it's be started.
 *
 * It is also possible to put this setting in system crontab file /etc/crontab. If do so, please don't forget to
 * specify the user name accordingly.
 ================== crontab setting ==================
 * * * * * sleep 0;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-0 
 * * * * * sleep 10;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-1 
 * * * * * sleep 20;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-2 
 * * * * * sleep 30;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-3 
 * * * * * sleep 40;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-4 
 * * * * * sleep 50;/home/webmaster/yiilab/yii email/send-queue >> /home/webmaster/log/send-queue-5 
 ================== crontab setting ==================
 */
return [
    'class' => 'thinker_g\HermesMailing\console\DefaultController',
    'modelClass' => 'app\models\HermesMail',
    'signatureAttr' => 'signature',
    'statusAttr' => 'status',
    'retryAttr' => 'retry_times',
    'assignedToSvrAttr' => 'assigned_to_svr',

    'attrMap' => [
        'charset' => 'charset',
        'from' => 'from',
        'to' => 'to',
        'reply_to' => 'replyTo',
        'cc' => 'cc',
        'bcc' => 'bcc',
        'subject' => 'subject',
        'html_body' => 'htmlBody'
    ],
    'sentByBehavior' => 'thinker_g\HermesMailing\components\SentByBehavior',
    
    'mailer' => 'mailer',
    'testMode' => false,
    
    'serverID' => 0,
    'maxSent' => null,
    'signSize' => 50,
    'pageSize' => 10,
    'retryTimes' => 0,
    'signUnassigned' => true,
    'renewSignature' => false,
    
    'spamRules' => null,
    'useLiteAntiSpams' => false,
    
    
    'installerMode' => false,
    'installerActions' => [
        'install' => 'thinker_g\HermesMailing\installer\actions\InstallAction',
        'uninstall' => 'thinker_g\HermesMailing\installer\actions\UninstallAction',
        'fill4test' => 'thinker_g\HermesMailing\installer\actions\Fill4TestAction',
        'determine-anti-spams' => 'thinker_g\HermesMailing\installer\actions\DetermineAntiSpamsAction'
    ]
];