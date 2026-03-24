<?php

return [
    // Future-proof: simple driver switch (only 'api' provided here)
    'driver' => env('VPIC_DRIVER', 'api'),

    'http' => [
        'timeout' => env('VPIC_HTTP_TIMEOUT', 8),
    ],

    'errors' => [
        // strict: any non-zero ErrorCode -> throw VpicDecodeException (default)
        'strict' => env('VPIC_STRICT_ERRORS', true),
        // when strict=false, codes in this list are tolerated (e.g., [0,10])
        'relaxed_allow' => [0, 10],
    ],
];
