<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Tasks;

use ZincsearchEs\Common\Exceptions;
use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class Get
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Tasks
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Get extends AbstractEndpoint
{
    private $taskId;

    /**
     * @param string $taskId
     *
     * @throws \ZincsearchEs\Common\Exceptions\InvalidArgumentException
     * @return $this
     */
    public function setTaskId($taskId)
    {
        if (isset($taskId) !== true) {
            return $this;
        }

        $this->taskId = $taskId;

        return $this;
    }

    /**
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        if (isset($this->taskId) === true) {
            return "/_tasks/{$this->taskId}";
        }

        return "/_tasks";
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'wait_for_completion'
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
