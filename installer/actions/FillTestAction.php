<?php
namespace thinkerg\HermesMailing\installer\actions;

use yii\base\Action;
use yii\helpers\Console;
use yii\base\Exception;
use Yii;

class FillTestAction extends Action
{

    public $insertQuantity = 10000;

    public $from = "from_{seq}@example.com";

    public $to = "to_{seq}@example.com";

    /**
     * Run to insert a certain number of test email entries.
     * Number can be set by attribute $insertQuantity.
     * 
     * @return number
     */
    public function run()
    {
        $trans = Yii::$app->db->beginTransaction();
        try {
            Yii::$app->db->createCommand('set autocommit=0;')->execute();
            for ($i = 0; $i < $this->insertQuantity; $i++) {
                $this->addTestEmail(
                    str_replace('{seq}', $i, $this->from),
                    str_replace('{seq}', $i, $this->to)
                );
            }
            $trans->commit();
            $this->controller->stderr("$i mails inserted.\n", Console::FG_GREEN);
        } catch (Exception $e) {
            $trans->rollBack();
            $this->controller->stderr("Some errors happened.\n", Console::FG_RED);
        }

        return 0;

    }

    public function addTestEmail($from, $to)
    {
        $mail = Yii::createObject($this->controller->modelClass);
        $mail->attributes = [
            'to' => $to,
            'from' => $from,
            'reply_to' => $from,
            'from_name' => $from,
            'subject' => 'Hello Hermes Mailing',
            'body' => 'Hey! Thank you for using Hermes Mailing application.'
        ];
        if ($mail->save()) {
            $this->controller->stdout("An example email has been appended to the email queue. ID: {$mail->id}.\n");
            return 0;
        } else {
            $errors = [];
            foreach ($mail->errors as $attr => $err) {
                $errors[$attr] = implode("\n", $err);
            }
            $this->controller->stderr("Some errors happened:\n" . implode("\n\n", $errors));
            return 1;
        }

    }
}

?>