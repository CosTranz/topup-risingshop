<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        helper('form');
        $gameModel = new GameModel();
        $userData = new UserModel();
        $transaksiModel = new TransaksiModel();

        // Get game data
        $gameData = $gameModel->getAllData();

        // Get user data
        $userData = $userData->getAllData();

        // Get transaction data with relation
        $transaksiData = $transaksiModel->getAllDataWithRelation();

        // Calculate total income for each game
        $totalIncome = [];
        foreach ($gameData as $game) {
            $gameId = $game->id_game;
            $totalIncome[$gameId] = 0;

            foreach ($transaksiData as $transaksi) {
                if ($transaksi->id_game == $gameId) {
                    $totalIncome[$gameId] += $transaksi->jumlah;
                }
            }
        }

        // Calculate total number of registered users
        $totalUsers = count($userData);

        $data = [
            'title' => 'Dashboard',
            'content' => 'v_dashboard',
            'getData' => $gameData,
            'getDataUser' => $userData,
            'totalIncome' => $totalIncome,
            'totalUsers' => $totalUsers,
        ];

        return view('layout/template', $data);
    }
}
