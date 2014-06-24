<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Repository\RepositoryInterface;

class CallbackRealEntity
{
    /**
     * @var \Plu\RerBundle\Repository\RepositoryInterface
     */
    private $repo = null;

    /**
     * @var RealEntity
     */
    private $sub = null;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
        $this->sub = new RealEntity();
    }

    public function __call($method, $args)
    {
        $value = call_user_func_array(array($this->sub, $method), $args);
        if (substr($method, 0, 3) == 'set') {
            $this->repo->update($this);
        }
        return $value;
    }

}