<?php

class Projects extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="project_table_id", type="integer", length=10, nullable=false)
     */
    protected $project_table_id;

    /**
     *
     * @var integer
     * @Column(column="tower_id", type="integer", length=10, nullable=false)
     */
    protected $tower_id;

    /**
     *
     * @var string
     * @Column(column="project_id", type="string", length=11, nullable=false)
     */
    protected $project_id;

    /**
     *
     * @var string
     * @Column(column="portofolio", type="string", length=15, nullable=false)
     */
    protected $portofolio;

    /**
     *
     * @var string
     * @Column(column="ubis", type="string", length=15, nullable=false)
     */
    protected $ubis;

    /**
     *
     * @var string
     * @Column(column="plan_group", type="string", length=4, nullable=false)
     */
    protected $plan_group;

    /**
     *
     * @var string
     * @Column(column="user_stat_lv_1", type="string", length=5, nullable=false)
     */
    protected $user_stat_lv_1;

    /**
     *
     * @var string
     * @Column(column="user_stat_lv_2", type="string", length=5, nullable=false)
     */
    protected $user_stat_lv_2;

    /**
     *
     * @var string
     * @Column(column="nama_tenant", type="string", length=10, nullable=false)
     */
    protected $nama_tenant;

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
     * Method to set the value of field project_id
     *
     * @param string $project_id
     * @return $this
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;

        return $this;
    }

    /**
     * Method to set the value of field portofolio
     *
     * @param string $portofolio
     * @return $this
     */
    public function setPortofolio($portofolio)
    {
        $this->portofolio = $portofolio;

        return $this;
    }

    /**
     * Method to set the value of field ubis
     *
     * @param string $ubis
     * @return $this
     */
    public function setUbis($ubis)
    {
        $this->ubis = $ubis;

        return $this;
    }

    /**
     * Method to set the value of field plan_group
     *
     * @param string $plan_group
     * @return $this
     */
    public function setPlanGroup($plan_group)
    {
        $this->plan_group = $plan_group;

        return $this;
    }

    /**
     * Method to set the value of field user_stat_lv_1
     *
     * @param string $user_stat_lv_1
     * @return $this
     */
    public function setUserStatLv1($user_stat_lv_1)
    {
        $this->user_stat_lv_1 = $user_stat_lv_1;

        return $this;
    }

    /**
     * Method to set the value of field user_stat_lv_2
     *
     * @param string $user_stat_lv_2
     * @return $this
     */
    public function setUserStatLv2($user_stat_lv_2)
    {
        $this->user_stat_lv_2 = $user_stat_lv_2;

        return $this;
    }

    /**
     * Method to set the value of field nama_tenant
     *
     * @param string $nama_tenant
     * @return $this
     */
    public function setNamaTenant($nama_tenant)
    {
        $this->nama_tenant = $nama_tenant;

        return $this;
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
     * Returns the value of field tower_id
     *
     * @return integer
     */
    public function getTowerId()
    {
        return $this->tower_id;
    }

    /**
     * Returns the value of field project_id
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Returns the value of field portofolio
     *
     * @return string
     */
    public function getPortofolio()
    {
        return $this->portofolio;
    }

    /**
     * Returns the value of field ubis
     *
     * @return string
     */
    public function getUbis()
    {
        return $this->ubis;
    }

    /**
     * Returns the value of field plan_group
     *
     * @return string
     */
    public function getPlanGroup()
    {
        return $this->plan_group;
    }

    /**
     * Returns the value of field user_stat_lv_1
     *
     * @return string
     */
    public function getUserStatLv1()
    {
        return $this->user_stat_lv_1;
    }

    /**
     * Returns the value of field user_stat_lv_2
     *
     * @return string
     */
    public function getUserStatLv2()
    {
        return $this->user_stat_lv_2;
    }

    /**
     * Returns the value of field nama_tenant
     *
     * @return string
     */
    public function getNamaTenant()
    {
        return $this->nama_tenant;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("towerdb");
        $this->setSource("projects");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Projects[]|Projects|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Projects|\Phalcon\Mvc\Model\ResultInterface
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
            'project_table_id' => 'project_table_id',
            'tower_id' => 'tower_id',
            'project_id' => 'project_id',
            'portofolio' => 'portofolio',
            'ubis' => 'ubis',
            'plan_group' => 'plan_group',
            'user_stat_lv_1' => 'user_stat_lv_1',
            'user_stat_lv_2' => 'user_stat_lv_2',
            'nama_tenant' => 'nama_tenant'
        ];
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'projects';
    }

}
