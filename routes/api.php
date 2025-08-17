<?php

use App\Http\Controllers\MidtransWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/pembayaran/callback', [MidtransWebhookController::class, 'callback'])
    ->name('pembayaran.callback');
