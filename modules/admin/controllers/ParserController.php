<?php

namespace lo\modules\love\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use Sunra\PhpSimple\HtmlDomParser;
use lo\modules\love\models\Parser;
use lo\core\helpers\StringHelper;
use lo\core\actions\crud;
use lo\core\components\settings\FormModel;

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
    protected $get_aphs = []; // массив полученных строк
    protected $check_aphs = []; // проверенные строки
    protected $show_aphs = []; // готовые


    public function actions()
    {
        return [
            'settings' => [
                'class' => crud\Settings::className(),
                'keys' => [
                    'love.parser.page' => [
                        'label' => 'Страница с афоризмами',
                        'type' => FormModel::TYPE_TEXTINPUT
                    ]
                ]
            ],
        ];
    }


    public function actionIndex()
    {
        $model = new Parser();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionGrab()
    {
        $this->data = \Yii::$app->request->post('dataq');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($this->data['file']) {
            $html = HtmlDomParser::file_get_html(Yii::getAlias('@storage') . $this->data['file']);
        } else {
            $html = HtmlDomParser::file_get_html('http://www.e-reading.ws/chapter.php/22166/' . $this->data['id'] . '/Ermishin_-_Aforizmy.html');
        }

        if ($this->data['id']) {
            \Yii::$app->settings->set('love.parser.page', $this->data['id']);
        }

        /*
                // for sight.php?city=
                $item['title'] = $html->find('div.vrezka_sh a.lite', 0)->plaintext;
                $item['title'] = iconv("windows-1251", "utf-8", $item['title']);
        */

        $this->get_dom($html, 'div.section');
        $this->check_dom();
        $this->show_dom();

        echo json_encode('<pre>' . print_r($this->show_aphs, true) . '</pre>');
    }

    // получаем строки
    private function get_dom($html, $tag_in = '')
    {
        foreach ($html->find('div.section') as $div) {
            foreach ($div->children() as $p) {
                $item['aph'] = Html::encode(str_replace('&nbsp;', ' ', $p->plaintext));
                $item['tag'] = $p->tag;
                $item['str'] = StringHelper::strMd5($p->plaintext, false);
                $this->get_aphs[] = $item;
            }
        }
    }


// проверяем и убираем лишнее
    private function check_dom()
    {
        $aph = [];
        $i = 0;
        $f = 0;

        if ($this->data['glue']) {

            foreach ($this->get_aphs AS $a) {
                if ($a['tag'] != 'p') {
                    $i++;
                    $f = 0;
                } else {

                    preg_match('/\[([A-Za-z\d_]+)\]/is', $a['aph'], $sup);

                    if (isset($sup[0])) {
                        $text = str_replace($sup[0], '', $a['aph']);
                        $id_sup = $sup[1];
                    } else {
                        $text = $a['aph'];
                        $id_sup = 0;
                    }

                    if (!$f) {
                        $aph[$i]['text'] = $text;
                        $aph[$i]['sup'] = $id_sup;
                        $f = 1;
                    } else {
                        $aph[$i]['text'] = $aph[$i]['text'] . "\r\n" . $text;
                    }
                }
            }
        } //---------
        else {
            foreach ($this->get_aphs AS $a) {
                if ($a['tag'] == 'p') {

                    preg_match('/\[([A-Za-z\d_]+)\]/is', $a['aph'], $sup);

                    if (isset($sup[0])) {
                        $text = str_replace($sup[0], '', $a['aph']);
                        $id_sup = $sup[1];
                    } else {
                        $text = $a['aph'];
                        $id_sup = 0;
                    }

                    $aph[$i]['text'] = StringHelper::mbTrim($text);
                    $aph[$i]['sup'] = $id_sup;

                    $i++;
                }
            }
        }
        $this->check_aphs = $aph;
    }

    private function show_dom()
    {
        $aph = [];
        $i = 0;
        foreach ($this->check_aphs AS $aph) {
            $item['text'] = StringHelper::mbTrim($aph['text']);
            $item['str'] = StringHelper::strMd5($aph['text'], false);
            $item['id_prim'] = $aph['sup'];
            $item['hash'] = StringHelper::strMd5($aph['text']);
            $item['db'] = $this->getItem($item['hash']);
            $this->show_aphs[] = $item;
        }
    }


    // вставка в базу
    function todb_dom(){
        foreach ($this->show_aphs AS $a){
            if($a['db']){
                $data_aph=[
                    'text'=>  htmlspecialchars($a['text']),
                    'id_lib'=>$this->data['id_lib'],
                    'id_prim'=>$a['id_prim'],
                    'prim'=>'',
                    'date'=>date('Y-m-d H:i:s'),
                ];
               // if($this->upd_aut) $data_aph['id_aut']=$this->id_aut;
               // $this->model_mx->Update($data_aph, $a['db']);
            }
            else{
                $data_aph=[
                    'text'=>  htmlspecialchars($a['text']),
                    'id_lib'=>$this->id_lib,
                    'id_aut'=>$this->id_aut,
                    'id_prim'=>$a['id_prim'],
                    'hash'=>$a['hash'],
                    'hide'=>0,
                    'date'=>date('Y-m-d H:i:s'),
                ];
               // $this->model_mx->Insert($data_aph);
            }
            debug($data_aph);
        }

    }



    private function getItem($hash)
    {
        $model = $this->findModel($hash);
        if ($model) {
            return $model->id;
        }
        return false;
    }

    private function addItem($id, $item)
    {

        $model = $this->findModel($id);

        if ($model) {
            $model->setScenario('update');
            $model->text = $item['text'];
            $model->save();
            return 'есть запись';
        } else {
            return 'без добавления';
            $model = new Parser();
            $model->setScenario('insert');
            $model->id = $id;
            $model->name = $item['title'];
            $model->intro = $item['intro'];
            //var_dump($model->attributes);

            if ($model->validate()) {
                $model->save();
                return 'запись добавлена';
            } else {
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
    protected function findModel($hash)
    {
        if (($model = Parser::find()->where('hash = :hash', ['hash' => $hash])->one()) !== null) {
            return $model;
        } else {
            return false;
        }
    }

/*    public function actionHash()
    {
        set_time_limit(0);

        $models = Parser::find()->all();

        foreach($models as $model){
            $hash = StringHelper::strMd5($model->text);
            $model->setScenario('update');
            $model->hash = $hash;
            $model->save();
        }
        echo $hash;
    }*/

}
