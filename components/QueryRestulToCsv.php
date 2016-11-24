<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/10/16
 * Time: 10:46 PM
 */

namespace app\components;

use yii\base\Component;

class QueryRestulToCsv extends Component{
    public $raw_result;
    public $path_to_file_output;
    /**
     * @var $file_name Desired filename
     */
    public $file_name;
    public function convert()
    {
        if (!isset($this->file_name)) {
            $this->file_name = uniqid();
        }
        $this->file_name .= date("Y-m-d");
        $this->path_to_file_output = \Yii::getAlias("@app/data") . DIRECTORY_SEPARATOR . $this->file_name.'.csv';
        $fileRes = fopen($this->path_to_file_output, 'w+');
        //write header
        if (isset($this->raw_result[0])) {
            fputcsv($fileRes, array_keys($this->raw_result[0]));
            foreach ($this->raw_result as $currentLine) {
                fputcsv($fileRes, array_values($currentLine));
            }
            fclose($fileRes);
        }else{
            
        }
        return $this->path_to_file_output;
    }
} 