<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Cluster;

use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class Pendingtasks
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Cluster
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class PendingTasks extends AbstractEndpoint
{
    /**
     * @return string
     */
    public function getURI()
    {
        $uri   = "/_cluster/pending_tasks";

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'local',
            'master_timeout',
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }
}
