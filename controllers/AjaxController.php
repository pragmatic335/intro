<?php


namespace app\controllers;


use app\models\Categories;
use app\models\ChargeTypes;
use app\models\Currencies;
use app\models\Objects;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class AjaxController extends Controller
{
    public function actionAjax($mode = null, $submode = null)
    {

        if ($mode == "lists") {
            $method = '_ajax' . 'Get' . ucfirst($mode) . ucfirst($submode);
            if (method_exists($this, $method)) {
                return $this->$method();
            }
        }

        //на все левые обращения выдаем 404
        throw new HttpException(404);
    }


    public function _ajaxGetListsCategories()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $categories = Categories::find()->where(['ilike', 'name', $str])->asArray()->all();

            foreach ($categories as $category) {
                $result['results'][] = ['id' => $category['id'], 'text' => $category['name']];
            }
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    public function _ajaxGetListsTypes()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $types = ChargeTypes::find()->where(['ilike', 'name', $str])->asArray()->all();

            foreach ($types as $type) {
                $result['results'][] = ['id' => $type['id'], 'text' => $type['name']];
            }
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }


    public function _ajaxGetListsCurrencies()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $str = mb_strtoupper(Yii::$app->request->get('q'));
            $currencies = Currencies::find()->where(['ilike', 'name', $str])->asArray()->all();

            foreach ($currencies as $currency) {
                $result['results'][] = ['id' => $currency['id'], 'text' => $currency['name']];
            }
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }


    /**
     * строгий формат возвращаемого массива под select 2 (kartik) ['results' => [ ['id' => 1, 'text' => 'example1'], ['id' => 2, 'text' => 'example2'], []...]]
     * цель: найти полный `адрес` в системе фиас, для которого существует хотя бы одна привязка к строению
     */
    public function _ajaxGetListsFiasaddresses()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $q = mb_strtoupper(Yii::$app->request->get('q'));

            //сам запрос
            //formalname - полный адрес
            //formalname1 - адрес последнего узла
            $sql = '
                    WITH RECURSIVE search_lists(id, parent_id, formalname, formalname1, depth) AS (
                        SELECT f.id,
                               f.parent_id,
                               f.shortname || \' \' || f.formalname,
                               f.formalname,
                               1
                        FROM sh_fias.spr_fias_addrobj f
                        where f.id = 1442682
                        UNION ALL
                        SELECT f.id,
                               f.parent_id,
                               sl.formalname || \', \' ||  f.shortname || \' \' || f.formalname,
                               f.formalname,
                               sl.depth + 1
                        FROM search_lists sl
                             JOIN sh_fias.spr_fias_addrobj f on f.parent_id = sl.id)
                    SELECT *, length(sl.formalname1) len
                    FROM search_lists sl
                    where
                          exists (
                                   select *
                                   from sh_fias.buildings b
                                   where b.fias_ao_id = sl.id
                                   limit 1
                          ) ';


            //  тут-с разрываем входящую строку по пробелу во имя более детальной выборки
            foreach (explode(' ', $q) as $value) {
                if ($value != ' ' && $value != '')

//                    //явно пытаемся найти слово начинающиеся на введенные данные из полного `адреса`
//                    $count = count(Yii::$app->db
//                        ->createCommand
//                        ($sql . ' AND (upper(sl.formalname) like \'% ' . $value . '%\')')
//                        ->queryAll());

                    $sql .= ' AND (upper(sl.formalname) like \'%' . $value . '%\')';

            }


            $sql .= ' order by len asc, sl.formalname1 asc';

            //получаем ассоциатный массив записей по запросу
            $lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($lists as $value) {
                $result['results'][] = ['id' => '*' . $value['id'], 'text' => $value['formalname']];
            }

        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    /**
     * получаем список строений исходя из адреса
     * формат возвращаемого массива ['output' => ['id' => 1, 'name' => '54/1'], ['id' => 2, 'name' => '33 A'], ...]
     */
    public function _ajaxGetListsObjects()
    {
        $result = [];
//        var_dump(Yii::$app->request->post()); die();


        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $objects = Objects::find()->where( ['category_id' => $_POST['depdrop_parents'][0] ])->asArray()->all();
                foreach ($objects as $object) {
                    $result['output'][] = ['id' => $object['id'], 'name' => $object['name']];
                }
            }
        }

//                $address = end($_POST['depdrop_parents']);
//
//
//                if (mb_substr($address, 0, 1) == '*') {
//                    return $this->_ajaxGetListsFiasbuildings();
//                }
//
//
//                $query = (LocalBuilding::find())
//                    ->alias('b')
//                    ->select(new Expression('b.id id, b.num num'))
//                    ->where('(b.town || \', \' ||b.street) = ' . '\'' . $address . '\'')
//                    ->orderBy('(select * from public.str2numeric(b.num))');
//
////                echo $query->createCommand()->rawSql; die();
//                $res = [];
//                foreach ($query->each() as $value) {
//                    $res[] =  ['id' => $value['id'], 'name' => $value['num']];
////                    $result['output'][] = ['id' => $value['id'], 'name' => $value['num']];
//                }
//                if( count( $res ) === 1 ){
//                    $result['output'][] = ['id' => $res[0]['id'], 'name' => $res[0]['name']];
//                    $result['selected'] = $res[0]['id'];
//                } else {
//                    $result['output'] = $res;
//                }
//            }
//        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function _ajaxGetListsFiasbuildings()
    {
        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $result = [];
                $address = end($_POST['depdrop_parents']);
                $address = mb_substr($address, 1);


                $query = (Building::find())
                    ->alias('b')
                    ->select(new Expression('b.id id, b.num num'))
                    ->where('(b.fias_ao_id) = ' . $address)
                    ->orderBy('(select * from public.str2numeric(b.num))');

//                echo $query->createCommand()->rawSql; die();

                foreach ($query->each() as $value) {
                    $result['output'][] = ['id' => $value['id'], 'name' => $value['num']];
                }
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }



    /**
     * получаем список помещений исходя из строения
     * формат возвращаемого массива ['output' => ['id' => 1, 'name' => '54/1'], ['id' => 2, 'name' => '33 A'], ...]
     */
    public function _ajaxGetListsFlats()
    {

        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $result = [];
                $bulding_id = end($_POST['depdrop_parents']);
                $query = (Flat::find())
                    ->alias('f')
                    ->select(new Expression('f.id id, f.num num'))
                    ->where(['f.building_id' => $bulding_id])
                    ->orderBy('(select * from public.str2numeric(f.num))')->asArray();

//                echo $query->createCommand()->rawSql; die();
//                var_dump($query); die();

                foreach ($query->each() as $value) {
//                    var_dump($value); die();
                    $result['output'][] = ['id' => $value['id'], 'name' => $value['num']];
                }
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function _ajaxGetListsTowns()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $q = mb_strtoupper(Yii::$app->request->get('q'));

            $sql = 'select (t.town_type || \' \' || t.town_name) as name, t.town_name as short_name
                      from sh_pdata.towns_local t
                    where (1=1)';

            foreach (explode(' ', $q) as $value) {
                if ($value != ' ' && $value != '')
                    $sql .= ' AND t.town_name ilike \'%' . $value . '%\'';

            }


            $lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($lists as $value) {
                $result['results'][] = ['id' => $value['short_name'], 'text' => $value['name']];
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function _ajaxGetListsStreets()
    {
        $result = [];
        $town = end($_POST['depdrop_parents']);
        if (Yii::$app->request->post() && $town != '' ) {

            $sql = 'select (s.street_type || \' \' || s.street_name) as name, s.street_name as short_name 
                      from sh_pdata.streets_local s 
                    ';


            $lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($lists as $value) {
                $result['output'][] = ['id' => $value['short_name'], 'name' => $value['name']];
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function _ajaxGetListsFiasbuilding()
    {
        $result = [];
        if (Yii::$app->request->get()) {
            $q = mb_strtoupper(Yii::$app->request->get('q'));
            $t = mb_strtoupper(Yii::$app->request->get('t'));
            $s = mb_strtoupper(Yii::$app->request->get('s'));
//            echo Yii::$app->request->get('s'); die();
            //сам запрос
            //formalname - полный адрес
            //formalname1 - адрес последнего узла
//            echo $t . ' ' . $s; die;
            $sql = '
                    WITH fias_buildings AS( WITH RECURSIVE search_lists(id, parent_id, formalname, formalname1, depth) AS (
                        SELECT f.id,
                               f.parent_id,
                               f.shortname || \' \' || f.formalname,
                               f.formalname,
                               1
                        FROM sh_fias.spr_fias_addrobj f
                        where f.id = 1442682
                        UNION ALL
                        SELECT f.id,
                               f.parent_id,
                               sl.formalname || \', \' ||  f.shortname || \' \' || f.formalname,
                               f.formalname,
                               sl.depth + 1
                        FROM search_lists sl
                             JOIN sh_fias.spr_fias_addrobj f on f.parent_id = sl.id)
                    SELECT sl.id as id, sl.formalname1 as formalname1, length(sl.formalname1) as len, (sl.formalname || \', дом \' || b.num) as fullname, b.num as num, b.id as building_id
                    FROM search_lists sl
                    join sh_fias.buildings b on b.fias_ao_id = sl.id
                    where (upper(sl.formalname) like \'%' . $t . '%\') AND (upper(sl.formalname) like \'%' . $s . '%\')       
                     )
                    select *
                     from fias_buildings fb 
                    where (1=1)
                           ';


            //  тут-с разрываем входящую строку по пробелу во имя более детальной выборки
            foreach (explode(' ', $q) as $value) {
                if ($value != ' ' && $value != '')

//                    //явно пытаемся найти слово начинающиеся на введенные данные из полного `адреса`
//                    $count = count(Yii::$app->db
//                        ->createCommand
//                        ($sql . ' AND (upper(sl.formalname) like \'% ' . $value . '%\')')
//                        ->queryAll());

                    $sql .= ' AND  (upper(fb.fullname) like \'%' . $value . '%\')';

            }


            $sql .= ' order by fb.len asc, fb.formalname1 asc, (select * from public.str2numeric(fb.num)) asc';

            //получаем ассоциатный массив записей по запросу
            $lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($lists as $value) {
                $result['results'][] = ['id' => $value['building_id'], 'text' => $value['fullname']];
            }

        }

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ($result);
    }

    public function _ajaxGetListsTownareas() {
        $result = [];
        if (Yii::$app->request->post()) {

            $sql = 'select ta.name as name
                      from sh_pdata.spr_town_area ta 
                    ';


            $lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($lists as $value) {
                $result['output'][] = ['id' => $value['name'], 'name' => $value['name']];
            }

//            $result['output'][] = ['id' => 'Кировский', 'name' => 'Кировский(тест)'];

        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    //получение списка локальных строений, процедура  sh_tools.web_ajax_get_localbuilding
    public function _ajaxGetListsLocalbuildings()
    {

        if (Yii::$app->request->get()) {

            $q = mb_strtoupper(Yii::$app->request->get('q'));
            $json = [];
            $cnt = 0;
            foreach (explode(' ', $q) as $word) {
                $cnt++;
                $key = 'word'.$cnt;
                $json[$key] = $word;
            }
//            var_dump(json_encode( $json, true)); die();

            $sql = "select *
                  from sh_tools.web_ajax_get_localbuilding('" .  json_encode( $json, true) . "')";

//            echo $sql; die();

            $bulding_lists = Yii::$app->db
                ->createCommand
                ($sql)
                ->queryAll();

            //в отображаемом селекте
            foreach ($bulding_lists as $value) {
                $result['results'][] = ['id' => $value['id'], 'text' => $value['full_address']];
            }

        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    /**
     * @return array
     */
    public function _ajaxGetListsOwnTypeForForm(){
        $result = [];
        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $form_id = end($_POST['depdrop_parents']);

                try{
                    $query = \Yii::$app->db->createCommand("select rid, rname from sh_pdata.ps_ownership_form_types(:pform_id)")
                        ->bindValue(':pform_id', $form_id)
                        ->queryAll();
                    $res = [];
                    foreach ($query as $value) {
                        $res[] =  ['id' => $value['rid'], 'name' => $value['rname']];
//                        $result['output'][] = ['id' => $value['rid'], 'name' => $value['rname']];
                    }
                    if( count( $res ) === 1 ){
                        $result['output'][] = ['id' => $res[0]['id'], 'name' => $res[0]['name']];
                        $result['selected'] = $res[0]['id'];
                    } else {
                        $result['output'] = $res;
                    }

                } catch (\Exception $exception){}
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function _ajaxGetListsClientTypeForOwn(){
        $result = [];
        if (Yii::$app->request->post()) {
            if (isset($_POST['depdrop_parents'])) {
                $type_id = end($_POST['depdrop_parents']);
                try{
                    $query = \Yii::$app->db->createCommand("select rclient_type_id, rclient_type_code from sh_pdata.ps_ownership_client_types(:type_id)")
                        ->bindValue(':type_id', $type_id)
                        ->queryAll();
//                    var_dump($query->getRawSql()); die();
                    $res = [];
                    foreach ($query as $value) {
                        $name = $value['rclient_type_code']; // '';
                        switch ( $value['rclient_type_code'] ) {
                            case 'company':
                                $name = 'ЮЛ';
                                break;
                            case 'businessman':
                                $name = 'ИП';
                                break;
                            case 'person':
                                $name = 'ФЛ';
                                break;
                            default:
                        }
                        $res[] =  ['id' => $value['rclient_type_code'], 'name' => $name];
//                        $result['output'][] = ['id' => $value['rclient_type_code'], 'name' => $name];
                    }

                    if( count( $res ) === 1 ){
                        $result['output'][] = ['id' => $res[0]['id'], 'name' => $res[0]['name']];
                        $result['selected'] = $res[0]['id'];
                    } else {
                        $result['output'] = $res;
                    }

                } catch (\Exception $exception){}
            }
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }







}