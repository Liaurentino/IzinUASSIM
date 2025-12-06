<?php namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table      = 'reservations';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'name', 'phone', 'laptop_model', 'complaint', 'reservation_date', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    
    // Aturan validasi
    protected $validationRules = [
        'name'             => 'required|min_length[3]',
        'phone'            => 'required|min_length[10]|max_length[15]',
        'laptop_model'     => 'required|max_length[255]',
        'complaint'        => 'required',
        'reservation_date' => 'required|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}