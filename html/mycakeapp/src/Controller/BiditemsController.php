<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Biditems Controller
 *
 * @property \App\Model\Table\BiditemsTable $Biditems
 *
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BiditemsController extends AuctionBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $biditems = $this->paginate($this->Biditems);

        $this->set(compact('biditems'));
    }

    /**
     * View method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $biditem = $this->Biditems->get($id, [
            'contain' => ['Users', 'Bidinfo', 'Bidrequests'],
        ]);

        $this->set('biditem', $biditem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $biditem = $this->Biditems->newEntity();
        if ($this->request->is('post')) {
            $biditem = $this->Biditems->patchEntity($biditem, $this->request->getData());
            if ($this->Biditems->save($biditem)) {
                $this->Flash->success(__('The biditem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditem could not be saved. Please, try again.'));
        }
        $users = $this->Biditems->Users->find('list', ['limit' => 200]);
        $this->set(compact('biditem', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $biditem = $this->Biditems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $biditem = $this->Biditems->patchEntity($biditem, $this->request->getData());
            if ($this->Biditems->save($biditem)) {
                $this->Flash->success(__('The biditem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditem could not be saved. Please, try again.'));
        }
        $users = $this->Biditems->Users->find('list', ['limit' => 200]);
        $this->set(compact('biditem', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $biditem = $this->Biditems->get($id);
        if ($this->Biditems->delete($biditem)) {
            $this->Flash->success(__('The biditem has been deleted.'));
        } else {
            $this->Flash->error(__('The biditem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
