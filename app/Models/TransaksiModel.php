<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['metode', 'jumlah', 'id_game', 'no_trans', 'customer', 'server_game'];

    public function getAllDataWithRelation()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_transaksi');

        $result = $builder
            ->select('tb_transaksi.*, tb_game.id_game, tb_game.top_up, tb_game.name_game, tb_user.customer')
            ->join('tb_game', 'tb_game.id_game = tb_transaksi.id_game')
            ->join('tb_user', 'tb_user.customer = tb_transaksi.customer')
            ->get()
            ->getResult();

        return $result;
    }



    public function getGameData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_game');
        return $builder->get()->getResult();
    }

    public function getUserData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');
        return $builder->get()->getResult();
    }
    public function getAllData()
    {
    }

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_transaksi');
        return $builder->insert($data);
    }
    public function getDataById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_transaksi');
        $builder->where('id_transaksi', $id);
        return $builder->get()->getRow();
    }
    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_transaksi');
        $builder->where('id_transaksi', $id);
        return $builder->update($data);
    }
    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_transaksi');
        $builder->where('id_transaksi', $id);
        return $builder->delete();
    }
}
