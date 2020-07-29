<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Revistas Model
 *
 * @method \App\Model\Entity\Revista newEmptyEntity()
 * @method \App\Model\Entity\Revista newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Revista[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Revista get($primaryKey, $options = [])
 * @method \App\Model\Entity\Revista findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Revista patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Revista[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Revista|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Revista saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Revista[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Revista[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Revista[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Revista[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RevistasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('revistas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('issn')
            ->maxLength('issn', 10)
            ->requirePresence('issn', 'create')
            ->notEmptyString('issn');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 150)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->scalar('estrato')
            ->maxLength('estrato', 5)
            ->requirePresence('estrato', 'create')
            ->notEmptyString('estrato');

        return $validator;
    }
}
