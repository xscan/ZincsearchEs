<?php

declare(strict_types = 1);

namespace ZincsearchEs\Namespaces;

use ZincsearchEs\Endpoints\Remote\Info;

/**
 * Class RemoteNamespace
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Namespaces\TasksNamespace
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class RemoteNamespace extends AbstractNamespace
{
    /**
     * @param array $params Associative array of parameters
     *
     * @return array
     */
    public function info($params = array())
    {
        /** @var callable $endpointBuilder */
        $endpointBuilder = $this->endpoints;

        /** @var Info $endpoint */
        $endpoint = $endpointBuilder('Remote\Info');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
