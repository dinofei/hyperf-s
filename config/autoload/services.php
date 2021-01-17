<?php

return [
    'consumers' => value(function () {
        $options = [
            'connect_timeout' => 5.0,
            'recv_timeout' => 5.0,
            'pool' => [
                'min_connections' => 1,
                'max_connections' => 32,
                'connect_timeout' => 10.0,
                'wait_timeout' => 3.0,
                'heartbeat' => -1,
                'max_idle_time' => 60.0,
            ],
        ];
        $services = [];
        $consumers = [];

        foreach ($services as $name => $interface) {
            $consumers[] = [
                'name' => $name,
                'service' => $interface,
                'protocol' => 'jsonrpc-http',
                'load_balancer' => 'random',
                'nodes' => [
                    ['host' => '127.0.0.1', 'port' => 9502],
                ],
                'options' => $options,
            ];
        }
        return $consumers;
    }),
];
