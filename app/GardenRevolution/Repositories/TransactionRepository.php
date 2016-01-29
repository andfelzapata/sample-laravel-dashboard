<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Transaction;

use App\GardenRevolution\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    /*
     * @var Transaction model
     */
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /*
     * @param array $data 
     * @return bool
     */
    public function create(array $data)
    {
        $this->transaction = $this->transaction->newInstance()->create($data);
        return $this->transaction;
    }

    /*
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->transaction = $this->transaction->newInstance()->find($id);

        if( is_null($this->transaction) ) 
        {
            return false;
        }

        $this->transaction->fill($data);

        return $this->transaction->save();
    }

    /*
     * @param $id
     * @param array $columns
     * @return $mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->transaction = $this->transaction->newInstance()->find($id,$columns);

        return $this->transaction;
    }

    /*
     * @param $id
     * @return bool|null
     */
    public function delete($id)
    {
        $this->transaction = $this->transaction->newInstance()->find($id);

        if( is_null($this->transaction) )
        {
            return false;
        }

        return $this->transaction->delete();
    }
}
