<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Cluster\Settings;

use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class Get
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Cluster\Settings
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */

class Get extends AbstractEndpoint
{
    /**
     * @return string
     */
    public function getURI()
    {
        $uri   = "/_cluster/settings";

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'flat_settings',
            'master_timeout',
            'timeout',
            'include_defaults'
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
