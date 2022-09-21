<?php

namespace frontend\controllers;


use common\models\Product;
use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class CartController
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package frontend\controllers
 */
class CartController extends Controller
{

    // public $cart;
    // public function __construct()
    // {
    //     $this->cart = \Yii::$app->cart;
    // }
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        // if(Yii::$app->user->isGuest){

        // }
        $cart = \Yii::$app->cart;
        $cartItems = $cart->getItems();
        // dd($cartItems);
        // VarDumper::dump($cartItems);

        return $this->render('index', [
            'items' => $cartItems
        ]);
        
    }

    public function actionAdd($id , $quantity=1)
    {

        $product = Product::findOne($id);
        $cart = \Yii::$app->cart;

        $cart->add($product, $quantity);
        return $this->redirect('index');
    }


    public function actionDelete($id , $quantity=1)
    {

        $product = Product::findOne($id);
        $cart = \Yii::$app->cart;
        $cart->remove($product->id);

        return $this->redirect('index');
    }


    public function actionAddQuantity($id , $quantity=1)
    {

        $product = Product::findOne($id);
        $cart = \Yii::$app->cart;

        $cart->plus($product->id, $quantity);
        return $this->redirect('index');
    }
}