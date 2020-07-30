<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Evaluation Controller
 *
 * @property \App\Model\Table\EvaluationTable $Evaluation
 *
 * @method \App\Model\Entity\Evaluation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EvaluationController extends AuctionBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ReceiveEvaluationUsers', 'EvaluationUsers', 'Bidinfos'],
        ];
        $evaluation = $this->paginate($this->Evaluation);

        $this->set(compact('evaluation'));
    }

    /**
     * View method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evaluation = $this->Evaluation->get($id, [
            'contain' => ['ReceiveEvaluationUsers', 'EvaluationUsers', 'Bidinfos'],
        ]);

        $this->set('evaluation', $evaluation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evaluation = $this->Evaluation->newEntity();
        if ($this->request->is('post')) {
            $evaluation = $this->Evaluation->patchEntity($evaluation, $this->request->getData());
            if ($this->Evaluation->save($evaluation)) {
                $this->Flash->success(__('The evaluation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evaluation could not be saved. Please, try again.'));
        }
        $receiveEvaluationUsers = $this->Evaluation->ReceiveEvaluationUsers->find('list', ['limit' => 200]);
        $evaluationUsers = $this->Evaluation->EvaluationUsers->find('list', ['limit' => 200]);
        $bidinfos = $this->Evaluation->Bidinfos->find('list', ['limit' => 200]);
        $this->set(compact('evaluation', 'receiveEvaluationUsers', 'evaluationUsers', 'bidinfos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluation = $this->Evaluation->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluation = $this->Evaluation->patchEntity($evaluation, $this->request->getData());
            if ($this->Evaluation->save($evaluation)) {
                $this->Flash->success(__('The evaluation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The evaluation could not be saved. Please, try again.'));
        }
        $receiveEvaluationUsers = $this->Evaluation->ReceiveEvaluationUsers->find('list', ['limit' => 200]);
        $evaluationUsers = $this->Evaluation->EvaluationUsers->find('list', ['limit' => 200]);
        $bidinfos = $this->Evaluation->Bidinfos->find('list', ['limit' => 200]);
        $this->set(compact('evaluation', 'receiveEvaluationUsers', 'evaluationUsers', 'bidinfos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluation = $this->Evaluation->get($id);
        if ($this->Evaluation->delete($evaluation)) {
            $this->Flash->success(__('The evaluation has been deleted.'));
        } else {
            $this->Flash->error(__('The evaluation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
