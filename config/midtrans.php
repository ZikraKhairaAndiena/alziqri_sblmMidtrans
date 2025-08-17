<?php

return [
    'merchantId' => env('MIDTRANS_ID_MERCHANT'),
    'serverKey'     => env('MIDTRANS_SERVER_KEY'),
    'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
    'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized'   => true,
    'is3ds'         => true,
];
