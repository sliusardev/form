<?php
namespace App\Services;

use App\Models\Subscription;
use Carbon\Carbon;

class LiqPayService
{
    protected mixed $publicKey;
    protected mixed $privateKey;

    public function __construct()
    {
        $this->publicKey = config('services.liqpay.public_key');
        $this->privateKey = config('services.liqpay.private_key');
    }
}
