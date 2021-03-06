<?php

namespace ipc\modules\project\controllers;

use ipc\modules\project\models\Attach;

use ipc\modules\project\models\History;
use ipc\modules\project\modules\config\models\Status;
use Yii;
use ipc\modules\project\models\Check;
use yii\helpers\Json;
use yii\web\Response;


/**
 * CheckController implements the CRUD actions for Check model.
 */
class CheckController extends ProjectController
{

    public function actionReject()
    {
        $session = Yii::$app->session;

        if(empty(Yii::$app->request->post('project_id'))){
            $session->setFlash('error', '参数异常');
            return $this->redirect('/project/check');
        }
        $model = Check::findOne(Yii::$app->request->post('project_id')) ;

        $model->status = Status::getValue(Status::REJECTED);

        if($model->save()){
            $history = new History();
            $history->project_id = $model->project_id;
            $history->status = $model->status;
            $history->note = Yii::$app->request->post('note');
            $history->save();
            $session->setFlash('success', '修改成功');
            unset($session['currentProject']);
        }

        return $this->redirect('/project/check');
    }

    public function actionSave()
    {
        $p = Yii::$app->request->post('Attach');

        $session = Yii::$app->session;

        if(empty($p['project_id'])){
            $session->setFlash('error', '参数异常');
            return $this->redirect('/project/check');
        }
        $model = Check::findOne($p['project_id']) ;

        $tmp = [];
        if(is_array($p['file']))
        {
            foreach($p['file'] as $item){
                $tmp[] = Json::decode($item);
            }
        }
        $attach = Attach::findOne(['project_id'=>$model->project_id]);
        if($attach == null)
        {
            $attach = new Attach();
            $attach->project_id = $model->project_id;
        }
        $attach->prove_id = $p['prove_id'];
        $attach->title = $p['title'];
        $attach->file = Json::encode($tmp);
        $attach->remark = $p['remark'];

        if($model !== null && $attach->save()){
            $model->status = Status::getValue(Status::CHECKING);
            if($model->save()){
                $history = new History();
                $history->project_id = $model->project_id;
                $history->status = $model->status;
                $history->note = $p['remark'];
                $history->save();

                $session->setFlash('success', '修改成功');
                unset($session['currentProject']);
            }

        }

        return $this->redirect('/project/check');
    }

    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $routes = empty(Yii::$app->modules['filemanager']['routes']) ? false : Yii::$app->modules['filemanager']['routes'] ;
        if($routes === false || empty($routes['uploads']))
        {
            $routes = [
                'baseUrl' => '',
                'basePath' => '@ipc/web',
                'uploadPath' => 'uploads',
            ];
        }

        $model = new Attach();

        $result = $model->saveUploadedFile($routes);

        if ($model->isImage()) {
            $model->createDefaultThumb($routes['basePath']);
        }

        return $result;
    }

    public function actionConfirm()
    {
        $session = Yii::$app->session;
        $p = Yii::$app->request->post();
        if(empty($p['Attach']['attach_id'])){
            $session->setFlash('error', '参数异常');
            return $this->redirect('/project/approve');
        }
        $model = Attach::findOne($p['Attach']['attach_id']);
        $model->status = 1;
        if($model->save()){
            $session->setFlash('success', '修改成功');
        }else{
            $session->setFlash('error', '参数异常');
        }
//        $session['currentProject'] = $model->project_id;
        return $this->redirect($this->selfUrl);
    }
}
