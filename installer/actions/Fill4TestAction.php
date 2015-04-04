<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 */

namespace thinker_g\HermesMailing\installer\actions;

use yii\helpers\Console;
use yii\base\Exception;
use Yii;

class Fill4TestAction extends InstallerAction
{

    public $barLen = 70;

    /**
     * Run to insert a certain number of test email entries.
     * @param int $insertCount Number of emails to insert.
     * @param string $from From address where the token "{seq}" will be replaced by the sequence number.
     * @param string $to To address where the token "{seq}" will be replaced by the sequence number.
     * @return int
     */
    public function run($insertCount = 1000, $from = "from_{seq}@example.com", $to = "to_{seq}@example.com")
    {
        $trans = $this->migration->db->beginTransaction();
        try {
            $this->migration->db->createCommand('set autocommit=0;')->execute();
            for ($i = 0; $i < $insertCount; $i++) {
                $this->controller->stdout("\r");
                $this->addTestEmail(
                    str_replace('{seq}', $i, $from),
                    str_replace('{seq}', $i, $to)
                );
                $percent = $i / $insertCount;

                $bar = str_pad('', (int)($this->barLen * $percent), '=', STR_PAD_LEFT);
                $bar = str_pad ($bar, $this->barLen, ' ', STR_PAD_RIGHT);

                $bar .= " " . (int)($percent * 100) + 1 . '%';
                $this->controller->stdout($bar, Console::FG_BLUE);
            }
            $trans->commit();
            $this->controller->stderr("\n$i mails inserted.\n", Console::FG_GREEN);
        } catch (Exception $e) {
            $trans->rollBack();
            $this->controller->stderr("Some errors happened.\n", Console::FG_RED);
            $this->controller->stderr($e->getMessage() . PHP_EOL, Console::FG_RED);
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