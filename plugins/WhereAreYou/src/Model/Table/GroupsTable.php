<?php
namespace WhereAreYou\Model\Table;

use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\Table;
use WhereAreYou\Model\Table\UsersTable;

/**
 * Class GroupsTable
 *
 * @property UsersTable $Users
 *
 * @package WhereAreYou\Model\Table
 */
class GroupsTable extends Table
{
    /**
     * {@inheritDoc}
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->setTable('way_groups');
        $this->hasMany('WhereAreYou.Users', [
            'foreignKey' => 'group_id'
        ]);
    }

    /**
     * Generate a new hash
     *
     * @return string
     */
    public function generate() {
        $hash = sha1(uniqid());
        $data = [
            'hash' => $hash
        ];
        if ($this->exists($data)) {
            return $this->generate();
        }
        $ent = $this->newEntity($data);
        if ($this->save($ent)) {
            return $hash;
        }
        throw new InternalErrorException('There was an error while saving');
    }
}