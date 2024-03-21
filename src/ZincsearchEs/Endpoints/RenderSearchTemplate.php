<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Render
 *
 * @category ZincsearchEs
 * @package ZincsearchEs\Endpoints
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */

class RenderSearchTemplate extends AbstractEndpoint
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
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        $id = $this->id;

        $uri   = "/_render/template";

        if (isset($id) === true) {
            $uri = "/_render/template/$id";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array();
    }

    /**
     * @return array
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return isset($this->body) ? 'POST' : 'GET';
    }
}
