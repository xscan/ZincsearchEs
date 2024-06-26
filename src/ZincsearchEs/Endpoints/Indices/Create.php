<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Create
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Indices
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Create extends AbstractEndpoint
{
    /**
     * @param array|object $body
     *
     * @throws \ZincsearchEs\Common\Exceptions\InvalidArgumentException
     * @return $this
     */
    public function setBody($body)
    {
        if (isset($body) !== true) {
            return $this;
        }

        $this->body = $body;

        return $this;
    }

    /**
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        if (isset($this->index) !== true) {
            throw new Exceptions\RuntimeException(
                'index is required for Create'
            );
        }
        $index = $this->index;
        $uri   = "/$index";

        if (isset($index) === true) {
            $uri = "/$index";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'timeout',
            'master_timeout',
            'update_all_types',
            'wait_for_active_shards',
            'include_type_name'
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'PUT';
    }
}
