<?php
/**
 * Created by PhpStorm.
 * User: Pierr
 * Date: 12/03/2019
 * Time: 08:50
 */

namespace App\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\RelationshipEntity(type="CONSULT")
 */
class NodeConsultation {
    /**
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @OGM\StartNode(targetEntity="NodeVisitor")
     */
    protected $visitor;

    /**
     * @OGM\EndNode(targetEntity="NodeAccomodation")
     */
    protected $accomodation;

    /**
     * @OGM\Property(type="int")
     */
    protected $nbVisits;

    public function __construct(NodeVisitor $visitor, NodeAccomodation $accomodation)
    {
        $this->visitor = $visitor;
        $this->accomodation = $accomodation;
        $this->nbVisits = 1;
    }

    /**
     * @return mixed
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * @param mixed $visitor
     */
    public function setVisitor($visitor): void
    {
        $this->visitor = $visitor;
    }

    /**
     * @return mixed
     */
    public function getAccomodation()
    {
        return $this->accomodation;
    }

    /**
     * @param mixed $accomodation
     */
    public function setAccomodation($accomodation): void
    {
        $this->accomodation = $accomodation;
    }

    /**
     * @return mixed
     */
    public function getNbVisits()
    {
        return $this->nbVisits;
    }

    /**
     * @param mixed $nbVisits
     */
    public function setNbVisits($nbVisits): void
    {
        $this->nbVisits = $nbVisits;
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

}