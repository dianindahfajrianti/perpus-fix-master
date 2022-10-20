<?php 
namespace App\Traits;

Trait GlobalWarn
{

    protected $status = [
        'success' => 'Berhasil',
        'error' => 'Gagal'
    ];

    public function message($exception = 'success',string $message)
    {
        $status = $this->status[$exception] ?: $this->status['success'];
        return [
            'stats' => $exception,
            'title' => $status,
            'message' => $message
        ];
    }
}
?>