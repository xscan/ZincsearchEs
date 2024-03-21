<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Cat;

use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class Pendingtasks
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Cat
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
        $uri   = "/_cat/pending_tasks";

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
            'h',
            'help',
            'v',
            's',
            'format',
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
