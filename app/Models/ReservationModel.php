<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'user_id',
        'merchant_id',
        'merchant_name',
        'name',
        'phone',
        'laptop_model',
        'complaint',
        'reservation_date',
        'service_location',
        'status',
        'notes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /* =========================
       QUERY UTAMA
    ========================== */

    /**
     * Ambil reservasi merchant
     */
    public function getByMerchant(
        int $merchantId,
        ?string $status = null,
        ?int $limit = null
    ): array {
        $builder = $this->where('merchant_id', $merchantId);

        if ($status !== null) {
            $builder->where('status', $status);
        }

        $builder->orderBy('created_at', 'DESC');

        if ($limit !== null) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    /**
     * Ambil reservasi user
     */
    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Hitung reservasi merchant berdasarkan status
     */
    public function countByMerchant(int $merchantId, ?string $status = null): int
    {
        $builder = $this->where('merchant_id', $merchantId);

        if ($status !== null) {
            $builder->where('status', $status);
        }

        return $builder->countAllResults();
    }

    /**
     * Update status reservasi
     */
    public function updateStatus(int $id, string $status, ?string $notes = null): bool
    {
        $data = ['status' => $status];

        if ($notes !== null) {
            $data['notes'] = $notes;
        }

        return $this->update($id, $data);
    }

    /**
     * Detail reservasi dengan merchant
     */
    public function getWithMerchant(int $reservationId): ?array
    {
        return $this->select('reservations.*, merchants.business_name, merchants.address')
                    ->join('merchants', 'merchants.id = reservations.merchant_id', 'left')
                    ->where('reservations.id', $reservationId)
                    ->first();
    }
}
