<?php

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitConfigController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($database , $username,$password)
    {
        /*initial configuration*/
        $configContent = <<<EOL
DB_NAME="$database"
DB_USERNAME="$username"
DB_PASSWORD="$password"
TARGET_URL="https://pwe1.pw/"
EOL;
		$envOutputPath = dirname(__FILE__).'/../.env';
		file_put_contents($envOutputPath, $configContent);
		//done
		echo "Initialization done";
    }
}
