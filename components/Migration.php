<?php
namespace thinkerg\HermesMailing\components;

use yii\db\Migration as YiiMigration;

class Migration extends YiiMigration
{
    public function up()
    {
        echo 'up!';
    }
    
    public function down()
    {
        echo 'down!';
        return false;
    }
}

?>