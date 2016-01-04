<?php

namespace lo\modules\love\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use Sunra\PhpSimple\HtmlDomParser;
use lo\modules\love\models\Parser;
use lo\core\helpers\StringHelper;

/**
 * PageController implements the CRUD actions for Author model.
 */
class ParserController extends Controller
{
    /**
     * Действия
     * @return array
     */

    protected $data = [];
    protected $get_aphs=[]; // массив полученных строк
    protected $check_aphs=[]; // проверенные строки
    protected $show_aphs=[]; // готовые

    public function actionIndex()
    {
        $model = new Parser();
        return $this->render('index',  [
            'model' => $model,
        ]);
    }

    public function actionGrab()
    {
        $this->data = \Yii::$app->request->post('dataq');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if($this->data['file']){
            $html = HtmlDomParser::file_get_html(Yii::getAlias('@storage') . $this->data['file']);
        }
        else{
            $html = HtmlDomParser::file_get_html('http://www.e-reading.ws/chapter.php/22166/'.$this->data['id'].'/Ermishin_-_Aforizmy.html');
        }

        /*
                // for sight.php?city=
                $item['title'] = $html->find('div.vrezka_sh a.lite', 0)->plaintext;
                $item['title'] = iconv("windows-1251", "utf-8", $item['title']);
        */

        $this->get_dom($html, 'div.section');

        echo json_encode('<pre>'.print_r($this->get_aphs, true).'</pre>');
    }

    // получаем строки
   private function get_dom($html, $tag_in=''){
        foreach($html->find('div.section') as $div){
            foreach($div->children() as $p){
                $item['aph'] =  str_replace('&nbsp;', ' ', $p->plaintext);
                $item['tag'] = $p->tag;
                $item['str'] = StringHelper::strMd5($p->plaintext, false);
                $this->get_aphs[]=$item;
            }
        }
    }



    private function addItem($id, $item){

        $model = $this->findModel($id);

        if($model){
            $model->setScenario('update');
            $model->text = $item['text'];
            $model->save();
            return 'есть запись';
        } else{
            return 'без добавления';
            $model = new Town();
            $model->setScenario('insert');
            $model->id = $id;
            $model->name = $item['title'];
            $model->intro = $item['intro'];
            //var_dump($model->attributes);

            if($model->validate()){
                $model->save();
                return 'запись добавлена';
            }
            else{
                return print_r($model->getErrors(), true);
            }
        }
    }

    /**
     * Finds the KeyStorageItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KeyStorageItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parser::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }
}
