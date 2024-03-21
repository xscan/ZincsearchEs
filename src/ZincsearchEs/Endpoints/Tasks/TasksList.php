<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Tasks;

use ZincsearchEs\Common\Exceptions;
use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class TasksLists
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Tasks
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class TasksList extends AbstractEndpoint
{

    /**
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        return "/_tasks";
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'node_id',
            'actions',
            'detailed',
            'parent_node',
            'parent_task',
            'wait_for_completion',
            'group_by',
            'task_id'
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
