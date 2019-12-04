<?php

class Towers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="tower_id", type="integer", length=10, nullable=false)
     */
    protected $tower_id;

    /**
     *
     * @var string
     * @Column(column="site_id_dmt", type="string", length=12, nullable=false)
     */
    protected $site_id_dmt;

    /**
     *
     * @var string
     * @Column(column="site_name", type="string", length=40, nullable=false)
     */
    protected $site_name;

    /**
     *
     * @var string
     * @Column(column="site_type", type="string", length=11, nullable=false)
     */
    protected $site_type;

    /**
     *
     * @var string
     * @Column(column="regional", type="string", length=40, nullable=false)
     */
    protected $regional;

    /**
     *
     * @var string
     * @Column(column="alamat_act", type="string", length=150, nullable=false)
     */
    protected $alamat_act;

    /**
     *
     * @var string
     * @Column(column="kota_kabupaten", type="string", length=20, nullable=false)
     */
    protected $kota_kabupaten;

    /**
     *
     * @var integer
     * @Column(column="tower_leg", type="integer", length=1, nullable=false)
     */
    protected $tower_leg;

    /**
     *
     * @var integer
     * @Column(column="tower_height", type="integer", length=3, nullable=false)
     */
    protected $tower_height;

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
     * Method to set the value of field site_id_dmt
     *
     * @param string $site_id_dmt
     * @return $this
     */
    public function setSiteIdDmt($site_id_dmt)
    {
        $this->site_id_dmt = $site_id_dmt;

        return $this;
    }

    /**
     * Method to set the value of field site_name
     *
     * @param string $site_name
     * @return $this
     */
    public function setSiteName($site_name)
    {
        $this->site_name = $site_name;

        return $this;
    }

    /**
     * Method to set the value of field site_type
     *
     * @param string $site_type
     * @return $this
     */
    public function setSiteType($site_type)
    {
        $this->site_type = $site_type;

        return $this;
    }

    /**
     * Method to set the value of field regional
     *
     * @param string $regional
     * @return $this
     */
    public function setRegional($regional)
    {
        $this->regional = $regional;

        return $this;
    }

    /**
     * Method to set the value of field alamat_act
     *
     * @param string $alamat_act
     * @return $this
     */
    public function setAlamatAct($alamat_act)
    {
        $this->alamat_act = $alamat_act;

        return $this;
    }

    /**
     * Method to set the value of field kota_kabupaten
     *
     * @param string $kota_kabupaten
     * @return $this
     */
    public function setKotaKabupaten($kota_kabupaten)
    {
        $this->kota_kabupaten = $kota_kabupaten;

        return $this;
    }

    /**
     * Method to set the value of field tower_leg
     *
     * @param integer $tower_leg
     * @return $this
     */
    public function setTowerLeg($tower_leg)
    {
        $this->tower_leg = $tower_leg;

        return $this;
    }

    /**
     * Method to set the value of field tower_height
     *
     * @param integer $tower_height
     * @return $this
     */
    public function setTowerHeight($tower_height)
    {
        $this->tower_height = $tower_height;

        return $this;
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
     * Returns the value of field site_id_dmt
     *
     * @return string
     */
    public function getSiteIdDmt()
    {
        return $this->site_id_dmt;
    }

    /**
     * Returns the value of field site_name
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * Returns the value of field site_type
     *
     * @return string
     */
    public function getSiteType()
    {
        return $this->site_type;
    }

    /**
     * Returns the value of field regional
     *
     * @return string
     */
    public function getRegional()
    {
        return $this->regional;
    }

    /**
     * Returns the value of field alamat_act
     *
     * @return string
     */
    public function getAlamatAct()
    {
        return $this->alamat_act;
    }

    /**
     * Returns the value of field kota_kabupaten
     *
     * @return string
     */
    public function getKotaKabupaten()
    {
        return $this->kota_kabupaten;
    }

    /**
     * Returns the value of field tower_leg
     *
     * @return integer
     */
    public function getTowerLeg()
    {
        return $this->tower_leg;
    }

    /**
     * Returns the value of field tower_height
     *
     * @return integer
     */
    public function getTowerHeight()
    {
        return $this->tower_height;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("towerdb");
        $this->setSource("towers");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Towers[]|Towers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Towers|\Phalcon\Mvc\Model\ResultInterface
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
            'tower_id' => 'tower_id',
            'site_id_dmt' => 'site_id_dmt',
            'site_name' => 'site_name',
            'site_type' => 'site_type',
            'regional' => 'regional',
            'alamat_act' => 'alamat_act',
            'kota_kabupaten' => 'kota_kabupaten',
            'tower_leg' => 'tower_leg',
            'tower_height' => 'tower_height'
        ];
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'towers';
    }

}
