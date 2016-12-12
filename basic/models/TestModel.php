<?php
/**
 * Created by PhpStorm.
 * User: evgenijampleev
 * Date: 12.12.16
 * Time: 9:31
 */

namespace app\models;


use yii\base\Model;

class TestModel extends Model{

    public $title;
    public $content;
    public $description;

    public function rules()
    {
        return [
            [['title', 'content', 'description'], 'safe']
        ];
    }
}