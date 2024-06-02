<?php


namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'customer';
    protected $returnType = 'object';
    protected $allowedFields = ['customer', 'email', 'password', 'country', 'phone_number'];

    public function saveUser($data)
    {
        return $this->insert($data);
    }

    public function getAllData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');
        return $builder->get()->getResult();
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

    public function getUserByCustomer($customer)
    {
        return $this->where('customer', $customer)->first();
    }

    public function userExists($customer)
    {
        return $this->where('customer', $customer)->countAllResults() > 0;
    }
    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');
        $builder->where('customer', $id);
        return $builder->delete();
    }
    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');
        $builder->where('customer', $id);
        return $builder->update($data);
    }
}

?>
