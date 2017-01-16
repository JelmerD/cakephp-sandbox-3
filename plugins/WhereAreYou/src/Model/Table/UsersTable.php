<?php
namespace WhereAreYou\Model\Table;

use Cake\I18n\Date;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\Table;

/**
 * Class UsersTable
 *
 * @property GroupsTable $Groups
 * @property LocationsTable $Locations
 *
 * @package WhereAreYou\Model\Table
 */
class UsersTable extends Table
{
    /**
     * {@inheritDoc}
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('way_users');
        $this->hasMany('WhereAreYou.Locations', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Generate a new hash
     *
     * @param $groupId
     * @return string
     */
    public function generate($groupId)
    {
        $hash = sha1(uniqid());
        $data = [
            'hash' => $hash,
            'group_id' => $groupId
        ];
        if ($this->exists($data)) {
            return $this->generate($groupId);
        }
        $ent = $this->newEntity($data);
        if ($this->save($ent)) {
            return $hash;
        }
        throw new InternalErrorException('There was an error while saving');
    }

    public function addLocation($groupId, $hash, $data) {
        $user = $this->find()
            ->where([
                'group_id' => $groupId,
                'hash' => $hash
            ])
            ->first();
        if (!$user) {
            throw new InternalErrorException('User not found');
        }
        $ent = $this->Locations->newEntity([
            'user_id' => $user->id,
            'lat' => (double)$data['lat'],
            'lng' => (double)$data['lng'],
        ]);
        if (!$this->Locations->save($ent)) {
            throw new InternalErrorException('Failed while saving');
        }
    }
}