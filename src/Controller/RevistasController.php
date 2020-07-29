<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Revistas Controller
 *
 * @property \App\Model\Table\RevistasTable $Revistas
 * @method \App\Model\Entity\Revista[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RevistasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if ((!empty($this->request->getQuery('busca')) && $this->request->getQuery('busca')) ||
            (!empty($this->request->getQuery('buscaQ')) && $this->request->getQuery('buscaQ'))){

            $data = $this->request->getQueryParams();

            $revistas = $this->getTableLocator()->get('Revistas')->find();
            if((!empty($this->request->getQuery('busca')) && $this->request->getQuery('busca'))) {
                $revistas->where(['OR' => [
                    ['issn' => $data['busca']],
                    ['titulo LIKE' => '%' . $data['busca'] . '%']
                ]]);
            }
            if((!empty($this->request->getQuery('buscaQ')) && $this->request->getQuery('buscaQ'))){
                $revistas->where(['estrato' => $data['buscaQ']]);
            }

            $revistas = $this->paginate($revistas);
            $this->set(compact('revistas'));
        }else {
            $revistas = $this->paginate($this->Revistas);
            $this->set(compact('revistas'));
        }

    }
}
