<?php


namespace frontend\base;


use common\models\CartItem;
use Yii;

/**
 * Class Controller
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package frontend\base
 */

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        

        $this->view->params['cartItemCount'] = CartItem::getTotalQuantity(Yii::$app->user->id);
        return parent::beforeAction($action);
    }
}