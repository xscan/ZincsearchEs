<?php

declare(strict_types = 1);

namespace ZincsearchEs;

use GuzzleHttp\Ring\Client\CurlHandler;
use GuzzleHttp\Ring\Client\CurlMultiHandler;
use GuzzleHttp\Ring\Client\Middleware;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ZincsearchEs\Common\Exceptions\InvalidArgumentException;
use ZincsearchEs\Common\Exceptions\RuntimeException;
/**
 * Class ClientBuilder
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
  */
class ClientBuilder
{      
   /** @var callable */
   private $endpoints;

    private $handler;

    /** @var array */
    private $hosts;

    /** @var  string */
    private $serializer = '\ZincsearchEs\Serializers\SmartSerializer';
    
    /** @var array */
    private $connectionParams;

    /**@var string */
    private $apiKey;
    /**
     * @return ClientBuilder
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param array $multiParams
     * @param array $singleParams
     * @throws \RuntimeException
     * @return callable
     */
    public static function defaultHandler($multiParams = [], $singleParams = [])
    {
        $future = null;
        if (extension_loaded('curl')) {
            $config = array_merge([ 'mh' => curl_multi_init() ], $multiParams);
            if (function_exists('curl_reset')) {
                $default = new CurlHandler($singleParams);
                $future = new CurlMultiHandler($config);
            } else {
                $default = new CurlMultiHandler($config);
            }
        } else {
            throw new \RuntimeException('ZincsearchEs-PHP requires cURL, or a custom HTTP handler.');
        }

        return $future ? Middleware::wrapFuture($default, $future) : $default;
    }

    /**
     * @param array $params
     * @throws \RuntimeException
     * @return CurlMultiHandler
     */
    public static function multiHandler($params = [])
    {
        if (function_exists('curl_multi_init')) {
            return new CurlMultiHandler(array_merge([ 'mh' => curl_multi_init() ], $params));
        } else {
            throw new \RuntimeException('CurlMulti handler requires cURL.');
        }
    }

    /**
     * @return CurlHandler
     * @throws \RuntimeException
     */
    public static function singleHandler()
    {
        if (function_exists('curl_reset')) {
            return new CurlHandler();
        } else {
            throw new \RuntimeException('CurlSingle handler requires cURL.');
        }
    }

    /**
     * @param array $hosts
     * @return $this
     */
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;

        return $this;
    }

       /**
     * @param array $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setConnectionParams(array $params)
    {
        $this->connectionParams = $params;

        return $this;
    }

    /**
     * @return Client
     */
    public function build()
    {

        if (is_null($this->handler)) {
            $this->handler = ClientBuilder::defaultHandler();
        }

    
            if (is_null($this->connectionParams)) {
                $this->connectionParams = [];
            }

            // Make sure we are setting Content-Type and Accept (unless the user has explicitly
            // overridden it
            if (isset($this->connectionParams['client']['headers']) === false) {
                $this->connectionParams['client']['headers'] = [
                    'Content-Type' => ['application/json'],
                    'Accept' => ['application/json']
                ];
            } else {
                if (isset($this->connectionParams['client']['headers']['Content-Type']) === false) {
                    $this->connectionParams['client']['headers']['Content-Type'] = ['application/json'];
                }
                if (isset($this->connectionParams['client']['headers']['Accept']) === false) {
                    $this->connectionParams['client']['headers']['Accept'] = ['application/json'];
                }
                $this->connectionParams['client']['headers']['Authorization'] = ['Basic YWRtaW46Q29tcGxleHBhc3MjMTIz'];
            }
        

        if (is_null($this->hosts)) {
            $this->hosts = $this->getDefaultHost();
        }

        if (is_null($this->endpoints)) {
            $serializer = $this->serializer;

            $this->endpoints = function ($class) use ($serializer) {
                $fullPath = '\\ZincsearchEs\\Endpoints\\' . $class;
                if ($class === 'Bulk' || $class === 'Msearch' || $class === 'MsearchTemplate' || $class === 'MPercolate') {
                    return new $fullPath($serializer);
                } else {
                    return new $fullPath();
                }
            };
        }

        $registeredNamespaces = [$this->hosts[0],$this->apiKey];
        $this->transport = null;
        // $connections = $this->buildConnectionsFromHosts($this->hosts);

        // $this->connectionPool = new $this->connectionPool(
        //     $connections,
        //     $this->selector,
        //     $this->connectionFactory,
        //     $this->connectionPoolArgs
        // );
        // $this->transport = new Transport($this->retries, $this->sniffOnStart, $this->connectionPool, $this->logger);
        // foreach ($this->registeredNamespacesBuilders as $builder) {
        //     /** @var NamespaceBuilderInterface $builder */
        //     $registeredNamespaces[$builder->getName()] = $builder->getObject($this->transport, $this->serializer);
        // }
        // return $this;
        return $this->instantiate($this->transport, $this->endpoints, $registeredNamespaces);
    }

        /**
     * @param Transport|null $transport
     * @param callable $endpoint
     * @param Object[] $registeredNamespaces
     * @return Client
     */
    protected function instantiate($transport, callable $endpoint, array $registeredNamespaces)
    {
        return new Client($transport, $endpoint, $registeredNamespaces);
    }
    //  /**
    //  * @param array $params
    //  * @param string $arg
    //  *
    //  * @return null|mixed
    //  */
    // public function extractArgument(&$params, $arg)
    // {
    //     if (is_object($params) === true) {
    //         $params = (array) $params;
    //     }

    //     if (array_key_exists($arg, $params) === true) {
    //         $val = $params[$arg];
    //         unset($params[$arg]);

    //         return $val;
    //     } else {
    //         return null;
    //     }
    // }

    // public function get($params)
    // {
    //     $id = $this->extractArgument($params, 'id');
    //     $index = $this->extractArgument($params, 'index');
    //     $type = $this->extractArgument($params, 'type');

    //     /** @var callable $endpointBuilder */
    //     $endpointBuilder = $this->endpoints;

    //     /** @var \ZincsearchEs\Endpoints\Get $endpoint */
    //     $endpoint = $endpointBuilder('Get');
    //     $endpoint->setID($id)
    //              ->setIndex($index)
    //              ->setType($type);
    //     $endpoint->setParams($params);

    //     return $this->performRequest($endpoint);
    // }

    // public function index($params)
    // {
    //     $id = $this->extractArgument($params, 'id');
    //     $index = $this->extractArgument($params, 'index');
    //     $type = $this->extractArgument($params, 'type');
    //     $body = $this->extractArgument($params, 'body');

    //     /** @var callable $endpointBuilder */
    //     $endpointBuilder = $this->endpoints;

    //     /** @var \ZincsearchEs\Endpoints\Index $endpoint */

    //     $endpoint = $endpointBuilder('Index');
    //     $endpoint->setID($id)
    //              ->setIndex($index)
    //              ->setType($type)
    //              ->setBody($body);
    //     $endpoint->setParams($params);

    //     return $this->performRequest($endpoint);
    // }

    // public function search($params = array())
    // {
    //     $index = $this->extractArgument($params, 'index');
    //     $type = $this->extractArgument($params, 'type');
    //     $body = $this->extractArgument($params, 'body');

    //     /** @var callable $endpointBuilder */
    //     $endpointBuilder = $this->endpoints;

    //     /** @var \ZincsearchEs\Endpoints\Search $endpoint */
    //     $endpoint = $endpointBuilder('Search');
    //     $endpoint->setIndex($index)
    //              ->setType($type)
    //              ->setBody($body);
    //     $endpoint->setParams($params);

    //     return $this->performRequest($endpoint);
    // }
    



    /**
     * @return array
     */
    private function getDefaultHost()
    {
        return ['localhost:9200'];
    }

    /**
     * @param array $hosts
     *
     * @throws \InvalidArgumentException
     * @return \ZincsearchEs\Connections\Connection[]
     */
    private function buildConnectionsFromHosts($hosts)
    {
        if (is_array($hosts) === false) {
            $this->logger->error("Hosts parameter must be an array of strings, or an array of Connection hashes.");
            throw new InvalidArgumentException('Hosts parameter must be an array of strings, or an array of Connection hashes.');
        }

        $connections = [];
        foreach ($hosts as $host) {
            if (is_string($host)) {
                $host = $this->prependMissingScheme($host);
                $host = $this->extractURIParts($host);
            } elseif (is_array($host)) {
                $host = $this->normalizeExtendedHost($host);
            } else {
                $this->logger->error("Could not parse host: ".print_r($host, true));
                throw new RuntimeException("Could not parse host: ".print_r($host, true));
            }
            $connections[] = $this->connectionFactory->create($host);
        }

        return $connections;
    }

    /**
     * @param array $host
     * @return array
     */
    private function normalizeExtendedHost(array $host)
    {
        if (isset($host['host']) === false) {
            $this->logger->error("Required 'host' was not defined in extended format: ".print_r($host, true));
            throw new RuntimeException("Required 'host' was not defined in extended format: ".print_r($host, true));
        }

        if (isset($host['scheme']) === false) {
            $host['scheme'] = 'http';
        }
        if (isset($host['port']) === false) {
            $host['port'] = '9200';
        }
        return $host;
    }

    /**
     * @param string $host
     *
     * @throws \InvalidArgumentException
     * @return array
     */
    private function extractURIParts($host)
    {
        $parts = parse_url($host);

        if ($parts === false) {
            throw new InvalidArgumentException("Could not parse URI");
        }

        if (isset($parts['port']) !== true) {
            $parts['port'] = 9200;
        }

        return $parts;
    }

    /**
     * @param string $host
     *
     * @return string
     */
    private function prependMissingScheme($host)
    {
        if (!filter_var($host, FILTER_VALIDATE_URL)) {
            $host = 'http://' . $host;
        }

        return $host;
    }
}
