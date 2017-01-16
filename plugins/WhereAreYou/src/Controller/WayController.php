<?php
namespace WhereAreYou\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use WhereAreYou\Model\Table\GroupsTable;

/**
 * Class WayController
 *
 * @property GroupsTable $Groups
 *
 * @package WhereAreYou\Controller
 */
class WayController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('WhereAreYou.Groups');
    }

    public function index()
    {
        $this->viewBuilder()->layout('fullscreen');
        if ($hash = $this->request->getParam('hash')) {
            $exists = $this->Groups->exists([
                'hash' => $hash
            ]);
            if (!$exists) {
                return $this->redirect(['hash' => $this->Groups->generate()]);
            }
            $jsData = [
                'groupHash' => $hash,
                'baseUrl' => Router::url(['plugin' => 'WhereAreYou'], true) . '/',
            ];
            $this->set(compact('jsData'));
        } else {
            return $this->redirect(['hash' => $this->Groups->generate()]);
        }
    }

    public function data()
    {
        $this->set('_serialize', true);
        $this->viewBuilder()->setClassName('Json');
        $group = $this->Groups->findByHash($this->request->getParam('hash'))->first();
        if (!$group) {
            throw new NotFoundException();
        }

        if ($this->request->is('post')) {
            $userHash = $this->request->getData('user');
            if (!$userHash) {
                $userHash = $this->Groups->Users->generate($group->id);
            }
            $this->set('user', $userHash);
            $this->Groups->Users->addLocation($group->id, $userHash, $this->request->getData());
            $this->set('_received', $this->request->getData());
        }
        $users = $this->Groups->Users->find()
            ->where([
                'group_id' => $group->id
            ])
            ->toArray();

        // for some weird reason limit()
        foreach ($users as &$u) {
            $u['locations'] = $this->Groups->Users->Locations->find()
                ->where(['user_id' => $u->id])
                ->order([
                    'created' => 'DESC'
                ])
                ->limit(1)
                ->toArray();
        }

        $this->set([
            'group' => $group->hash,
            'users' => $users
        ]);
    }
}