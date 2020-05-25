<?php

namespace app\controllers;

use app\models\Lectores;
use app\models\Usuarios;
use Yii;
use yii\bootstrap4\Alert;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['registrar'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    }

    public function actionRegistrar()
    {
        $model = new Usuarios(['scenario' => Usuarios::SCENARIO_CREAR]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha creado el usuario correctamente.');
            return $this->redirect(['site/login']);
        }

        return $this->render('registrar', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null)
    {
        if ($id === null) {
            if (Yii::$app->user->isGuest) {
                return Yii::$app->getResponse()->redirect([Url::to(['site/login'], 302)]);
            } else {
                if (Yii::$app->user->id === $id) {
                    Yii::$app->session->setFlash('error', 'Sólo tiene permiso para cambiar sus propios datos de usuario.');
                    return $this->goHome();
                } else {
                    $model = Yii::$app->user->identity;
                }
            }
        } else {
            $model = Usuarios::findOne($id);
        }

        $model->scenario = Usuarios::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha modificado correctamente.');
            return $this->goHome();
        }

        $listaLectores = Lectores::listaHash();

        $model->password = '';
        $model->password_repeat = '';
    
        return $this->render('update', [
            'model' => $model,
            'laListaDeLectores' => $listaLectores,
        ]);
    }
}
