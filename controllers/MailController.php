<?php

namespace thinker_g\HermesMailing\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * MailController implements the CRUD actions for HermesMail model.
 * @property \thinker_g\HermesMailing\Module $module
 */
class MailController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all HermesMail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = Yii::createObject($this->module->searchModelClass);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchModel->find(),
            'pagination' => ['pageSize' => 10]
        ]);

        $searchModel->load(Yii::$app->request->queryParams);
        if ($searchModel->validate()) {
            foreach ($searchModel->attributes as $key => $value) {
                $dataProvider->query->andFilterWhere(['like', $key, $value]);
            }
        }

        return $this->render($this->module->indexView, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HermesMail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render($this->module->viewView, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HermesMail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::createObject($this->module->modelClass);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render($this->module->createView, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HermesMail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render($this->module->updateView, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HermesMail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HermesMail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HermesMail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $modelClass = $this->module->modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
