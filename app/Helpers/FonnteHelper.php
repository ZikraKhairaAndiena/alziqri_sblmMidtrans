<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class FonnteHelper
{
    public static function kirimPesan($nomor, $pesan)
    {
        $token = env('FONNTE_TOKEN');

        // Format nomor (hapus spasi dan +)
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $nomor,
            'message' => $pesan,
        ]);

        return $response->json();
    }
}
