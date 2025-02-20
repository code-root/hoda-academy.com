<?php

namespace App\Http\Traits;


trait TokenTraits
    {


        public function generateCustomToken( $request)
        {
        // Get data directly from the request
        $ip = $request->ip(); // IP address
        $userAgent = $request->header('User-Agent'); // Device and browser details
        $deviceType = $request->input('device_type', 'unknown'); // Device type (e.g. mobile or desktop), if not sent it will be considered 'unknown'

        // Add current time and random data to increase the uniqueness of the token
        $timestamp = microtime(true);
        $randomData = bin2hex(random_bytes(10));
        // Merge the data together into a single string
        $dataToHash = $ip . $userAgent . $deviceType ;

        // Generate token using SHA256 algorithm
        $token = hash('sha256', $dataToHash);
        return [
        'success' => true,
        'token' => $token,
        'data' => [
        'ip' => $ip,
        'user_agent' => $userAgent,
        'device_type' => $deviceType,
        'timestamp' => $timestamp,
        ]
        ];
        }

    }
