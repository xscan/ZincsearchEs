<?php

declare(strict_types = 1);

namespace ZincsearchEs\Connections;

use ZincsearchEs\Serializers\SerializerInterface;
use ZincsearchEs\Transport;
use Psr\Log\LoggerInterface;

/**
 * Interface ConnectionInterface
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Connections
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
interface ConnectionInterface
{
    /**
     * @param callable $handler
     * @param array $hostDetails
     * @param array $connectionParams connection-specific parameters
     * @param \ZincsearchEs\Serializers\SerializerInterface $serializer
     * @param \Psr\Log\LoggerInterface $log          Logger object
     * @param \Psr\Log\LoggerInterface $trace        Logger object
     */
    public function __construct(
        $handler,
        $hostDetails,
        $connectionParams,
        SerializerInterface $serializer,
        LoggerInterface $log,
        LoggerInterface $trace
    );

    /**
     * Get the transport schema for this connection
     *
     * @return string
     */
    public function getTransportSchema();

    /**
     * Get the hostname for this connection
     *
     * @return string
     */
    public function getHost();

    /**
     * Get the username:password string for this connection, null if not set
     *
     * @return null|string
     */
    public function getUserPass();

    /**
     * Get the URL path suffix, null if not set
     *
     * @return null|string;
     */
    public function getPath();

    /**
     * Check to see if this instance is marked as 'alive'
     *
     * @return bool
     */
    public function isAlive();

    /**
     * Mark this instance as 'alive'
     *
     * @return void
     */
    public function markAlive();

    /**
     * Mark this instance as 'dead'
     *
     * @return void
     */
    public function markDead();

    /**
     * Return an associative array of information about the last request
     *
     * @return array
     */
    public function getLastRequestInfo();

    /**
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param null $body
     * @param array $options
     * @param \ZincsearchEs\Transport $transport
     * @return mixed
     */
	// @codingStandardsIgnoreStart
	// "Arguments with default values must be at the end of the argument list" - cannot change the interface
    public function performRequest($method, $uri, $params = null, $body = null, $options = [], Transport $transport);
	// @codingStandardsIgnoreEnd
}
