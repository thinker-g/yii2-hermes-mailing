<?php
namespace thinkerg\HermesMailing\components;

use yii\db\Migration as YiiMigration;
use yii\db\Exception as DbException;
use Yii;

class Migration extends YiiMigration
{
    
    public $tableName = '{{%email_queue}}';
    
    public $columns = [
        'id' => 'int primary key auto_increment',
        'to' => 'varchar(50)',
        'from' => 'varchar(50)',
        'from_name' => 'varchar(50)',
        'reply_to' => 'varchar(50)',
        'is_html' => 'bool default true',
        'subject' => 'varchar(100)',
        'body' => 'text',
        'created' => 'timestamp default current_timestamp',
        'last_sent' => 'timestamp',
        'retry_times' => 'int',
        'status' => 'varchar(10)',
        'send_by' => 'int',
        'sent_by' => 'int', 
        'signature' => 'varchar(32)',
    ];
    
    public function up()
    {
        $this->createTable($this->tableName, $this->columns);
        return true;
    }
    
    public function down()
    {
        $this->dropTable($this->tableName);
        return true;
    }
    
}

?>