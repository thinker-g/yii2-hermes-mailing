<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 */
namespace thinker_g\HermesMailing\installer;

use yii\db\Migration as YiiMigration;
use Yii;

/**
 *
 * @author thinker_g
 * @property string $tableName
 */
class Migration extends YiiMigration
{

    public $table = '{{%hermes_mail}}';

    public $columns = [
        'id' => 'int primary key auto_increment',
        'from' => 'varchar(50)',
        'to' => 'varchar(50)',
        'cc' => 'varchar(50)',
        'bcc' => 'varchar(50)',
        'reply_to' => 'varchar(50)',
        'from_name' => 'varchar(50)',
        'subject' => 'varchar(100)',
        'body' => 'text',
        'created' => 'timestamp default current_timestamp',
        'last_sent' => 'timestamp',
        'retry_times' => 'int',
        'status' => 'varchar(10)',
        'assigned_to_svr' => 'int',
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

    public function getTableName()
    {
        return $this->db->getSchema()
            ->getRawTableName($this->table);
    }

    public function isTableExists()
    {
        return in_array($this->getTableName(), $this->db->getSchema()->tableNames);
    }

}

?>