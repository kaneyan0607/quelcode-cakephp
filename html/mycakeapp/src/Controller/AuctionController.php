<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event; // added.
use Exception; // added.

class AuctionController extends AuctionBaseController
{
    // デフォルトテーブルを使わない
    public $useTable = false;

    // 初期化処理
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        // 必要なモデルをすべてロード
        $this->loadModel('Users');
        $this->loadModel('Biditems');
        $this->loadModel('Bidrequests');
        $this->loadModel('Bidinfo');
        $this->loadModel('Bidmessages');
        $this->loadModel('Evaluation');
        // ログインしているユーザー情報をauthuserに設定
        $this->set('authuser', $this->Auth->user());
        // レイアウトをauctionに変更
        $this->viewBuilder()->setLayout('auction');
    }

    // トップページ
    public function index()
    {
        // ページネーションでBiditemsを取得
        $auction = $this->paginate('Biditems', [
            'order' => ['endtime' => 'desc'],
            'limit' => 10
        ]);
        $this->set(compact('auction'));
    }

    // 商品情報の表示
    public function view($id = null)
    {
        // $idのBiditemを取得
        $biditem = $this->Biditems->get($id, [
            'contain' => ['Users', 'Bidinfo', 'Bidinfo.Users']
        ]);
        // オークション終了時の処理
        if ($biditem->endtime < new \DateTime('now') and $biditem->finished == 0) {
            // finishedを1に変更して保存
            $biditem->finished = 1;
            $this->Biditems->save($biditem);
            // Bidinfoを作成する
            $bidinfo = $this->Bidinfo->newEntity();
            // Bidinfoのbiditem_idに$idを設定
            $bidinfo->biditem_id = $id;
            // 最高金額のBidrequestを検索
            $bidrequest = $this->Bidrequests->find('all', [
                'conditions' => ['biditem_id' => $id],
                'contain' => ['Users'],
                'order' => ['price' => 'desc']
            ])->first();
            // Bidrequestが得られた時の処理
            if (!empty($bidrequest)) {
                // Bidinfoの各種プロパティを設定して保存する
                $bidinfo->user_id = $bidrequest->user->id;
                $bidinfo->user = $bidrequest->user;
                $bidinfo->price = $bidrequest->price;
                $this->Bidinfo->save($bidinfo);
            }
            // Biditemのbidinfoに$bidinfoを設定
            $biditem->bidinfo = $bidinfo;
        }
        // Bidrequestsからbiditem_idが$idのものを取得
        $bidrequests = $this->Bidrequests->find('all', [
            'conditions' => ['biditem_id' => $id],
            'contain' => ['Users'],
            'order' => ['price' => 'desc']
        ])->toArray();
        // オブジェクト類をテンプレート用に設定
        $this->set(compact('biditem', 'bidrequests'));
    }

    // 出品する処理
    public function add()
    {
        // Biditemインスタンスを用意
        $biditem = $this->Biditems->newEntity();
        // POST送信時の処理
        if ($this->request->is('post')) {
            $biditem_data = $this->request->getData();
            $image = $this->request->getData('image'); //画像情報受け取り
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION); //アップロードしたファイルの拡張子を取得
            $check_array = ['jpg', 'gif', 'png'];             //アップロードを許可するファイルの拡張子を代入
            $extension_permission = array_search($extension, $check_array); //検索対象の配列$check_arrayに存在するか確認

            //アップロードされたファイルが画像ファイルかどうかチェック
            if ($extension_permission === false) {
                $this->Flash->error(__('「jpg」「gif」「png」のいずれかの画像ファイルでアップロードしてください。'));
            } else {

                $image_path_name = '../webroot/img/biditem_img/' . date("YmdHis") . $image['name'];
                move_uploaded_file($image['tmp_name'], $image_path_name); //ファイル名の先頭に時間をくっつけて/webroot/img/bid_itemに移動
                $biditem_data['image_path'] = 'biditem_img/' . date("YmdHis") . $image['name'];


                // $biditemにフォームの送信内容を反映
                $biditem = $this->Biditems->patchEntity($biditem, $biditem_data);
                // $biditemを保存する
                if ($this->Biditems->save($biditem)) {
                    // 成功時のメッセージ
                    $this->Flash->success(__('保存しました。'));
                    // トップページ（index）に移動
                    return $this->redirect(['action' => 'index']);
                }
            }
            // 失敗時のメッセージ
            $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
        }
        // 値を保管
        $this->set(compact('biditem'));
    }

    // 入札の処理
    public function bid($biditem_id = null)
    {
        // 入札用のBidrequestインスタンスを用意
        $bidrequest = $this->Bidrequests->newEntity();
        // $bidrequestにbiditem_idとuser_idを設定
        $bidrequest->biditem_id = $biditem_id;
        $bidrequest->user_id = $this->Auth->user('id');
        // POST送信時の処理
        if ($this->request->is('post')) {
            // $bidrequestに送信フォームの内容を反映する
            $bidrequest = $this->Bidrequests->patchEntity($bidrequest, $this->request->getData());
            // Bidrequestを保存
            if ($this->Bidrequests->save($bidrequest)) {
                // 成功時のメッセージ
                $this->Flash->success(__('入札を送信しました。'));
                // トップページにリダイレクト
                return $this->redirect(['action' => 'view', $biditem_id]);
            }
            // 失敗時のメッセージ
            $this->Flash->error(__('入札に失敗しました。もう一度入力下さい。'));
        }
        // $biditem_idの$biditemを取得する
        $biditem = $this->Biditems->get($biditem_id);
        $this->set(compact('bidrequest', 'biditem'));
    }

    // 落札者とのメッセージ
    public function msg($bidinfo_id = null)
    {
        // Bidmessageを新たに用意
        $bidmsg = $this->Bidmessages->newEntity();
        // POST送信時の処理
        if ($this->request->is('post')) {
            // 送信されたフォームで$bidmsgを更新
            $bidmsg = $this->Bidmessages->patchEntity($bidmsg, $this->request->getData());
            // Bidmessageを保存
            if ($this->Bidmessages->save($bidmsg)) {
                $this->Flash->success(__('保存しました。'));
            } else {
                $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
            }
        }
        try { // $bidinfo_idからBidinfoを取得する
            $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
        } catch (Exception $e) {
            $bidinfo = null;
        }
        // Bidmessageをbidinfo_idとuser_idで検索
        $bidmsgs = $this->Bidmessages->find('all', [
            'conditions' => ['bidinfo_id' => $bidinfo_id],
            'contain' => ['Users'],
            'order' => ['created' => 'desc']
        ]);
        $this->set(compact('bidmsgs', 'bidinfo', 'bidmsg'));
    }

    // 落札情報の表示
    public function home()
    {
        // 自分が落札したBidinfoをページネーションで取得
        $bidinfo = $this->paginate('Bidinfo', [
            'conditions' => ['Bidinfo.user_id' => $this->Auth->user('id')],
            'contain' => ['Users', 'Biditems'],
            'order' => ['created' => 'desc'],
            'limit' => 10
        ])->toArray();
        $this->set(compact('bidinfo'));
    }

    // 出品情報の表示
    public function home2()
    {
        // 自分が出品したBiditemをページネーションで取得
        $biditems = $this->paginate('Biditems', [
            'conditions' => ['Biditems.user_id' => $this->Auth->user('id')],
            'contain' => ['Users', 'Bidinfo'],
            'order' => ['created' => 'desc'],
            'limit' => 10
        ])->toArray();
        $this->set(compact('biditems'));
    }

    //落札者の取引後終了後ページ
    public function shippingBuyer($bidinfo_id = null)
    {

        $bidinfo = $this->Bidinfo->get($bidinfo_id, [
            'contain' => ['Biditems', 'Users', 'Evaluation', 'Biditems.Users']
        ]);
        // POST送信時の処理
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // $bidinfoにフォームの送信内容を反映
            $bidinfo = $this->Bidinfo->patchEntity($bidinfo, $data);
            // $bidinfoを保存する
            if ($this->Bidinfo->save($bidinfo)) {
                // 成功時のメッセージ
                $this->Flash->success(__('出品者に連絡しました。'));
                // トップページ（home）に移動
                return $this->redirect(['action' => 'home']);
            } else {
                // 失敗時のメッセージ
                $this->Flash->error(__('出品者に連絡できませんでした。もう一度入力下さい。'));
                //var_dump($bidinfo);
            }
        }

        //値を保管
        $this->set(compact(['bidinfo']));
    }

    //出品者の取引終了後ページ
    public function shippingExhibitor($bidinfo_id = null)
    {
        $bidinfo = $this->Bidinfo->get($bidinfo_id, [
            'contain' => ['Biditems', 'Users', 'Evaluation', 'Biditems.Users']
        ]);
        // POST送信時の処理
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // $bidinfoにフォームの送信内容を反映
            $bidinfo = $this->Bidinfo->patchEntity($bidinfo, $data);
            // $bidinfoを保存する
            if ($this->Bidinfo->save($bidinfo)) {
                // 成功時のメッセージ
                $this->Flash->success(__('発送連絡しました。'));
                // トップページ（index）に移動
                return $this->redirect(['action' => 'home2']);
            } else {
                // 失敗時のメッセージ
                $this->Flash->error(__('発送連絡に失敗しました。もう一度入力下さい。'));
                //var_dump($bidinfo);
            }
        }

        //値を保管
        $this->set(compact(['bidinfo']));
    }

    //落札者の取引評価
    public function evaluationBuyer($bidinfo_id = null)
    {
        // 取引評価のevaluationインスタンスを用意
        $evaluation = $this->Evaluation->newEntity();
        $bidinfo = $this->Bidinfo->get($bidinfo_id, [
            'contain' => ['Biditems', 'Users', 'Evaluation', 'Biditems.Users']
        ]);
        // POST送信時の処理
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // $evaluationにフォームの送信内容を反映
            $evaluation = $this->Evaluation->patchEntity($evaluation, $data);
            //var_dump($evaluation);
            // $evaluationを保存する
            if ($this->Evaluation->save($evaluation)) {
                // 成功時のメッセージ
                $this->Flash->success(__('出品者を評価しました。'));
                // トップページ（index）に移動
                return $this->redirect(['action' => 'home']);
                //var_dump($evaluation);
            } else {
                // 失敗時のメッセージ
                $this->Flash->error(__('コメントと5段階評価を入力下さい。'));
                //var_dump($evaluation);
            }
        }

        //値を保管
        $this->set(compact(['evaluation', 'bidinfo']));
    }

    //出品者の取引評価
    public function evaluationExhibitor($bidinfo_id = NULL)
    {
        // 取引評価のevaluationインスタンスを用意
        $evaluation = $this->Evaluation->newEntity();
        $bidinfo = $this->Bidinfo->get($bidinfo_id, [
            'contain' => ['Biditems', 'Users', 'Evaluation', 'Biditems.Users']
        ]);
        // POST送信時の処理
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // $evaluationにフォームの送信内容を反映
            $evaluation = $this->Evaluation->patchEntity($evaluation, $data);
            //var_dump($evaluation);
            // $evaluationを保存する
            if ($this->Evaluation->save($evaluation)) {
                // 成功時のメッセージ
                $this->Flash->success(__('落札者を評価しました。'));
                // トップページ（index）に移動
                return $this->redirect(['action' => 'home2']);
                //var_dump($evaluation);
            } else {
                // 失敗時のメッセージ
                $this->Flash->error(__('コメントと5段階評価を入力下さい。'));
                //var_dump($evaluation);
            }
        }

        //値を保管
        $this->set(compact(['evaluation', 'bidinfo']));
    }

    //取引評価の平均値とコメント
    public function average($user_id = NULL)
    {
        //被評価ユーザーの情報を取得
        $evaluations = $this->paginate('Evaluation', [
            'conditions' => ['Evaluation.receive_evaluation_user_id' => $user_id],
            'contain' => ['Users'],
            'order' => ['created' => 'desc'],
            'limit' => 10
        ])->toArray();

        $counter = 0;
        foreach ($evaluations as $evaluation) {
            $counter++;
        }

        //もしも評価実績がなければindexへ返す
        if (empty($counter)) {
            $this->Flash->error(__('評価実績がありません。'));
            // トップページ（index）に移動
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('evaluations'));
    }
}
