<?php
namespace thinkerg\HermesMailing\console;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * 
 * @author tlsadmin
 *
 * @property $module \thinkerg\HermesMailing\Module
 */
class DefaultController extends Controller
{
    
    public $migration = 'thinkerg\HermesMailing\components\Migration';
    
    public function actionIndex()
    {
        $this->prompt('Hello!', ['a', 'b', 'c']);
        
        return 0;
    }
    
    public function actionInstall() {
        $installStat = [];
        
        $migration = $this->getMigration();
        if (false) {
            $migration->up();
            return 0;
        }
        
        // Generate AR
        if (true) {
            $modelGenerator = Yii::createObject('yii\gii\generators\model\Generator');
            $modelGenerator = new \yii\gii\generators\model\Generator;
            $modelGenerator->tableName = $migration->tableName;
            
            $files = $modelGenerator->generate();
            $answers = [];
            
            foreach ($files as $file) {
                $relativePath = $file->getRelativePath();
                if (is_file($file->path)) {
                    
                } else {
                    echo '    > ' . $this->ansiFormat('[new]', Console::FG_GREEN);
                    echo $this->ansiFormat(" $relativePath\n", Console::FG_CYAN);
                    $answers[$file->id] = true;
                }
            }
            if (!$this->confirm("\nReady to generate the selected files?", true)) {
                $this->stdout("\nNo file was generated.\n", Console::FG_CYAN);
                return;
            }
            
            if ($modelGenerator->save($files, (array) $answers, $results)) {
                $this->stdout("\nFiles were generated successfully!\n", Console::FG_GREEN);
            } else {
                $this->stdout("\nSome errors occurred while generating the files.", Console::FG_RED);
            }
            
            echo preg_replace('%<span class="error">(.*?)</span>%', '\1', $results) . "\n";
        }
        
    }
    
    public function actionUninstall() {
        $this->getMigration()->down();
    }
    
    /**
     * 
     * @return \thinkerg\HermesMailing\components\Migration
     */
    protected function getMigration()
    {
        return Yii::createObject($this->migration);
    }
}

?>