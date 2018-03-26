<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="testArray", type="array", nullable=true)
     */
    private $testArray;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set testArray
     *
     * @param array $testArray
     *
     * @return Test
     */
    public function setTestArray($testArray)
    {
        $this->testArray = $testArray;

        return $this;
    }

    /**
     * Get testArray
     *
     * @return array
     */
    public function getTestArray()
    {
        return $this->testArray;
    }
}

