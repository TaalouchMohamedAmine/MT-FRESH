<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector;
use InvalidArgumentException;

class NeonPostgresConnector extends PostgresConnector
{
    /**
     * Add Neon's endpoint startup parameter without converting it to a -c GUC.
     */
    protected function getDsn(array $config)
    {
        $endpoint = $config['endpoint'] ?? null;
        unset($config['endpoint'], $config['server_options']);

        $dsn = parent::getDsn($config);

        if (! $endpoint) {
            return $dsn;
        }

        if (! preg_match('/^[A-Za-z0-9_-]+$/', $endpoint)) {
            throw new InvalidArgumentException('The Neon database endpoint ID has an invalid format.');
        }

        return $dsn.";options='endpoint={$endpoint}'";
    }
}
