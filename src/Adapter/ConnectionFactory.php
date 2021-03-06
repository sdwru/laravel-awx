<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Awx.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sdwru\Awx\Adapter;

use InvalidArgumentException;

/**
 * This is the adapter connection factory class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ConnectionFactory
{
    /**
     * Establish an adapter connection.
     *
     * @param array $config
     *
     * @return \AwxV2\Adapter\AdapterInterface
     */
    public function make(array $config)
    {
        return $this->createConnector($config)->connect($config);
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \GrahamCampbell\Manager\ConnectorInterface
     */
    public function createConnector(array $config)
    {
        if (!isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }
 
        // This is left in from the original code which also supports the buzz http client
        //  There is no harm in leaving it in here.  Perhaps it will be useful some day.
        switch ($config['driver']) {
            case 'guzzle':
                return new Connector\GuzzleConnector();
        }

        throw new InvalidArgumentException("Unsupported driver [{$config['driver']}].");
    }
}
