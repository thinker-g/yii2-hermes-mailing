<?php
namespace thinkerg\HermesMailing\installer\actions;

use yii\helpers\Console;
use yii\base\Exception;
use Yii;

class Fill4TestAction extends InstallerAction
{

    public $insertQuantity = 10000;

    public $from = "from_{seq}@example.com";

    public $to = "to_{seq}@example.com";

    public $barLen = 70;

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
                $this->controller->stdout("\r");
                $this->addTestEmail(
                    str_replace('{seq}', $i, $this->from),
                    str_replace('{seq}', $i, $this->to)
                );
                $percent = (int)($i / $this->insertQuantity * $this->barLen);

                $bar = str_pad('', $percent, '=', STR_PAD_LEFT);
                $bar = str_pad ($bar, $this->barLen, ' ', STR_PAD_RIGHT);

                $bar .= " " . $percent . '%';
                $this->controller->stdout($bar, Console::FG_BLUE);
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
            $succeed = "An example email has been appended to the email queue. ID: {$mail->id}.";
            $this->controller->stdout(str_pad($succeed, $this->barLen + 4, ' ', STR_PAD_RIGHT) . PHP_EOL);
            return 0;
        } else {
            $errors = [];
            foreach ($mail->errors as $attr => $err) {
                $errors[$attr] = implode("\n", $err);
            }
            $errMsg = str_pad("Some errors happened:", $this->barLen + 4, ' ', STR_PAD_RIGHT);
            $this->controller->stderr($errMsg . PHP_EOL . implode("\n\n", $errors));
            return 1;
        }

    }
}

?>