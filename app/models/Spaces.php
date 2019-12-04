<?php

class Spaces extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="space_id", type="integer", length=10, nullable=false)
     */
    protected $space_id;

    /**
     *
     * @var integer
     * @Column(column="tower_id", type="integer", length=10, nullable=false)
     */
    protected $tower_id;

    /**
     *
     * @var integer
     * @Column(column="project_table_id", type="integer", length=10, nullable=false)
     */
    protected $project_table_id;

    /**
     *
     * @var string
     * @Column(column="leg", type="string", length=1, nullable=false)
     */
    protected $leg;

    /**
     *
     * @var integer
     * @Column(column="height", type="integer", length=3, nullable=false)
     */
    protected $height;

    /**
     *
     * @var string
     * @Column(column="merk", type="string", length=30, nullable=false)
     */
    protected $merk;

    /**
     *
     * @var integer
     * @Column(column="berat", type="integer", length=2, nullable=false)
     */
    protected $berat;

    /**
     *
     * @var integer
     * @Column(column="diameter", type="integer", length=2, nullable=false)
     */
    protected $diameter;

    /**
     * Method to set the value of field space_id
     *
     * @param integer $space_id
     * @return $this
     */
    public function setSpaceId($space_id)
    {
        $this->space_id = $space_id;

        return $this;
    }

    /**
     * Method to set the value of field tower_id
     *
     * @param integer $tower_id
     * @return $this
     */
    public function setTowerId($tower_id)
    {
        $this->tower_id = $tower_id;

        return $this;
    }

    /**
     * Method to set the value of field project_table_id
     *
     * @param integer $project_table_id
     * @return $this
     */
    public function setProjectTableId($project_table_id)
    {
        $this->project_table_id = $project_table_id;

        return $this;
    }

    /**
     * Method to set the value of field leg
     *
     * @param string $leg
     * @return $this
     */
    public function setLeg($leg)
    {
        $this->leg = $leg;

        return $this;
    }

    /**
     * Method to set the value of field height
     *
     * @param integer $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Method to set the value of field merk
     *
     * @param string $merk
     * @return $this
     */
    public function setMerk($merk)
    {
        $this->merk = $merk;

        return $this;
    }

    /**
     * Method to set the value of field berat
     *
     * @param integer $berat
     * @return $this
     */
    public function setBerat($berat)
    {
        $this->berat = $berat;

        return $this;
    }

    /**
     * Method to set the value of field diameter
     *
     * @param integer $diameter
     * @return $this
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;

        return $this;
    }

    /**
     * Returns the value of field space_id
     *
     * @return integer
     */
    public function getSpaceId()
    {
        return $this->space_id;
    }

    /**
     * Returns the value of field tower_id
     *
     * @return integer
     */
    public function getTowerId()
    {
        return $this->tower_id;
    }

    /**
     * Returns the value of field project_table_id
     *
     * @return integer
     */
    public function getProjectTableId()
    {
        return $this->project_table_id;
    }

    /**
     * Returns the value of field leg
     *
     * @return string
     */
    public function getLeg()
    {
        return $this->leg;
    }

    /**
     * Returns the value of field height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Returns the value of field merk
     *
     * @return string
     */
    public function getMerk()
    {
        return $this->merk;
    }

    /**
     * Returns the value of field berat
     *
     * @return integer
     */
    public function getBerat()
    {
        return $this->berat;
    }

    /**
     * Returns the value of field diameter
     *
     * @return integer
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("towerdb");
        $this->setSource("spaces");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spaces[]|Spaces|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spaces|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'space_id' => 'space_id',
            'tower_id' => 'tower_id',
            'project_table_id' => 'project_table_id',
            'leg' => 'leg',
            'height' => 'height',
            'merk' => 'merk',
            'berat' => 'berat',
            'diameter' => 'diameter'
        ];
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'spaces';
    }

}
