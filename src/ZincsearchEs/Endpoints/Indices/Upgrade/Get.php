<?php

declare(strict_types = 1);
/**
 * User: zach
 * Date: 01/20/2014
 * Time: 14:34:49 pm
 */

namespace ZincsearchEs\Endpoints\Indices\Upgrade;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Post
 *
 * @category ZincsearchEs
 * @package ZincsearchEs\Endpoints\Indices
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
        $index = $this->index;
        $uri   = "/_upgrade";

        if (isset($index) === true) {
            $uri = "/$index/_upgrade";
        }


        return $uri;
    }


    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'wait_for_completion',
            'only_ancient_segments',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
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
