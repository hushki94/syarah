<?php

namespace frontend\controllers;

use common\models\CartItem;
use common\models\Product;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
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
class CartController extends \frontend\base\Controller
{


    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST' , 'DELETE' ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $cartItems = Yii::$app->session->get(CartItem::SESSION_KEY , []);

        } else {
            $cartItems = CartItem::findBySql(
                "
            SELECT 
                c.product_id as id,
                p.image,
                p.title,
                p.price,
                c.quantity,
                p.price * c.quantity as total_price
            FROM cart_items c
            LEFT JOIN product p on p.id = c.product_id
            WHERE c.created_by = :userId",
                ['userId' => Yii::$app->user->id]
            )
            ->asArray()
            ->all();
        }

        return $this->render('index', [
            'items' => $cartItems
        ]);
    }


    public function actionAdd()
    {
        $id = Yii::$app->request->post('id');
        $product = Product::find()->id($id)->one();
        if(!$product){
            throw new NotFoundHttpException('Product does not exist');
        }

        if(Yii::$app->user->isGuest){
            
            $found = false;
            $cartItems  = Yii::$app->session->get(CartItem::SESSION_KEY , []);
            foreach ($cartItems as &$item) {
                if($item['id'] == $id){
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }

            if(!$found){
                $cartItem = [
                    'id' => $id,
                    'title' => $product->title,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total_price' => $product->price,
                ];

                $cartItems[] = $cartItem;
            }

            Yii::$app->session->set(CartItem::SESSION_KEY , $cartItems);
        }else{
            $userId =  Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->productId($id)->one();
            if($cartItem){
                $cartItem->quantity++;
            }else{
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = Yii::$app->user->id;
                $cartItem->quantity = 1 ;
            }
            if($cartItem->save()){
                return [
                    'success'=> true
                ];
            }
            return [
                'success' => false,
                'errors' => $cartItem->errors
            ];
        }
    }


    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest){
            $cartItems = Yii::$app->session->get(CartItem::SESSION_KEY , []);
            foreach ($cartItems as $i => &$cartItem) {
                if($cartItem['id'] == $id){
                    array_splice($cartItems , $i , 1);
                    break;
                }
            }
            Yii::$app->session->set(CartItem::SESSION_KEY , $cartItems);
        }else{
            CartItem::deleteAll(['product_id' => $id , 'created_by' => Yii::$app->user->id]);
        }
        return $this->redirect(['index']);
    }


    public function actionChangeQuantity()
    {
        $id = Yii::$app->request->post('id');
        $product = Product::find()->id($id)->one();
        if(!$product){
            throw new NotFoundHttpException('Product does not exist');
        }

        $quantity = Yii::$app->request->post('quantity');

        if(Yii::$app->user->isGuest){
            $cartItems  = Yii::$app->session->get(CartItem::SESSION_KEY , []);
            foreach ($cartItems as &$cartItem) {
                if($cartItem['id'] == $id){
                   $cartItem['quantity'] = $quantity;
                   break;
                }
            }
            Yii::$app->session->set(CartItem::SESSION_KEY , $cartItems);

        }else{
            $item = CartItem::find()->userId(Yii::$app->user->id)->productId($id)->one();
            if($item){
                $item->quantity = $quantity;
                $item->save();
            }
        }

        return  CartItem::getTotalQuantity(Yii::$app->user->id);
    }

    public function actionRemoveAll()
    {
    }
}
