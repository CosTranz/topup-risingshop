<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    public function getAllData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        return $builder->get()->getResult();
    }

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        return $builder->insert($data);
    }
    public function getDataById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        $builder->where('id_game', $id);
        return $builder->get()->getRow();
    }
    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        $builder->where('id_game', $id);
        return $builder->update($data);
    }
    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        $builder->where('id_game', $id);
        return $builder->delete();
    }
    public function getGameDetailsById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        $builder->select('*');
        $builder->where('id_game', $id);
        return $builder->get()->getRow();
    }
    public function getAllIdAndName()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        $builder->select('id_game, name_game');
        return $builder->get()->getResultArray();
    }
    
    
}
