<?php

namespace App\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 * @OGM\Node(label="Visitor")
 */
class NodeVisitor {


    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="string") */
    protected $name;

    /**
     * @OGM\Relationship(relationshipEntity="NodeConsultation",direction="OUTGOING", type="CONSULT", collection=true, mappedBy="visitor")
     */
    protected $consultations;

    /**
     * NodeVisitor constructor.
     */
    public function __construct()
    {
        $this->consultations = new Collection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    /**
     * @param mixed $consultations
     */
    public function setConsultations($consultations): void
    {
        $this->consultations = $consultations;
    }


}