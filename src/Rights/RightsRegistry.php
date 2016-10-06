<?php

namespace Mouf\Security\Rights;

use Mouf\Security\RightsService\RightInterface;
use Mouf\Security\UserManagement\Api\RightDao;

/**
 * This class registers all available rights in Mouf.
 */
class RightsRegistry implements RightDao
{
    /**
     * The list of all supported rights in the application, indexed by right name.
     *
     * @var RightInterface[]
     */
    protected $rights;

    /**
     * @param RightInterface[] $rights The list of all supported rights in the application.
     */
    public function __construct(array $rights)
    {
        $this->rights = [];
        foreach ($rights as $right) {
            $this->rights[$right->getName()] = $right;
        }
    }

    /**
     * Returns a right by name.
     *
     * @param string $name
     *
     * @return RightInterface
     *
     * @throws NotFoundException
     */
    public function get(string $name) : RightInterface
    {
        if (!isset($this->rights[$name])) {
            throw NotFoundException::create($name);
        }

        return $this->rights[$name];
    }

    /**
     * Returns a list of all rights
     *
     * @return RightInterface[]
     */
    public function getAllRights()
    {
        return $this->rights;
    }
}
