<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Bidrequests Controller
 *
 * @property \App\Model\Table\BidrequestsTable $Bidrequests
 *
 * @method \App\Model\Entity\Bidrequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BidrequestsController extends AuctionBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Biditems', 'Users'],
        ];
        $bidrequests = $this->paginate($this->Bidrequests);

        $this->set(compact('bidrequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bidrequest = $this->Bidrequests->get($id, [
            'contain' => ['Biditems', 'Users'],
        ]);

        $this->set('bidrequest', $bidrequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bidrequest = $this->Bidrequests->newEntity();
        if ($this->request->is('post')) {
            $bidrequest = $this->Bidrequests->patchEntity($bidrequest, $this->request->getData());
            if ($this->Bidrequests->save($bidrequest)) {
                $this->Flash->success(__('The bidrequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrequest could not be saved. Please, try again.'));
        }
        $biditems = $this->Bidrequests->Biditems->find('list', ['limit' => 200]);
        $users = $this->Bidrequests->Users->find('list', ['limit' => 200]);
        $this->set(compact('bidrequest', 'biditems', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bidrequest = $this->Bidrequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bidrequest = $this->Bidrequests->patchEntity($bidrequest, $this->request->getData());
            if ($this->Bidrequests->save($bidrequest)) {
                $this->Flash->success(__('The bidrequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrequest could not be saved. Please, try again.'));
        }
        $biditems = $this->Bidrequests->Biditems->find('list', ['limit' => 200]);
        $users = $this->Bidrequests->Users->find('list', ['limit' => 200]);
        $this->set(compact('bidrequest', 'biditems', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bidrequest = $this->Bidrequests->get($id);
        if ($this->Bidrequests->delete($bidrequest)) {
            $this->Flash->success(__('The bidrequest has been deleted.'));
        } else {
            $this->Flash->error(__('The bidrequest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
