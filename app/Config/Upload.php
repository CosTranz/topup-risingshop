<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Upload extends BaseConfig
{
    public $path = ROOTPATH . 'uploads/img/';
    public $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif']; // Sesuaikan dengan jenis file gambar yang diizinkan
    public $maxSize = 1024 * 2; // Ukuran maksimal file (dalam kilobita), sesuaikan dengan kebutuhan Anda
}
