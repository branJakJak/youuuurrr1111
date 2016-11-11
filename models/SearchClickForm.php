<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;


/**
* 
*/
class SearchClickForm extends Model
{
	public $search_term;

	public function rules()
	{
		return [
            ['search_term', 'safe'],
		];
	}
	public function attributeLabels()
	{
		return [
			'search_term'=>'Mobile'
		];
	}
	public function search()
	{
		return (new Query())
			->select(['reference_id','mobilenumber','telephone'])
			->from("person_info")
			->innerJoin("click_log",'click_log.person_id = person_info.id')
			->where(['mobilenumber'=>$this->search_term])
			->orWhere(['telephone'=>$this->search_term])
			->all();
	}

}