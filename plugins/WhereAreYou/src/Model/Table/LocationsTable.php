<?php
namespace WhereAreYou\Model\Table;

use Cake\ORM\Table;
use WhereAreYou\Model\Table\UsersTable;

/**
 * Class LocationsTable
 *
 * @property UsersTable $Users
 *
 * @package WhereAreYou\Model\Table
 */
class LocationsTable extends Table
{
    /**
     * {@inheritDoc}
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->setTable('way_locations');
        $this->addBehavior('Timestamp');
        $this->hasOne('WhereAreYou.Users', [
            'foreignKey' => 'user_id'
        ]);
    }
}