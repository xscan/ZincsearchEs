<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices\Aliases;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Update
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Indices\Aliases
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Update extends AbstractEndpoint
{
    /**
     * @param array $body
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
     * @return string
     */
    public function getURI()
    {
        $uri   = "/_aliases";

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
        );
    }

    /**
     * @return array
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     */
    public function getBody()
    {
        if (isset($this->body) !== true) {
            throw new Exceptions\RuntimeException('Body is required for Update Aliases');
        }

        return $this->body;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }
}
