<?php
namespace App\Forms\Project;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
// Validation
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Digit;

class CreateProjectForm extends Form
{
    public function initialize($entity = null, $options = [])
    {
        if (isset($options["edit"])) {
            $projectTableId = new Hidden('project_table_id', [
                "required" => true,
            ]);

            $this->add($projectTableId);
        }

        $towerId = new Text('tower_id', [
            "class" => "form-control",
            "placeholder" => "Tower ID"
        ]);

        $towerId->addValidators([
            new PresenceOf(['message' => 'Tower ID is required']),
            new Digit(['message' => 'Tower ID is numerical only']),
        ]);

        $projectId = new Text('project_id', [
            "class" => "form-control",
            "placeholder" => "Project ID",
        ]);

        $projectId->addValidators([
            new PresenceOf(['message' => 'Project ID is required']),
        ]);

        $portofolio = new Text('portofolio', [
            "class" => "form-control",
            "placeholder" => "Portofolio",
        ]);

        $portofolio->addValidators([
            new PresenceOf(['message' => 'Portofolio is required']),
        ]);

        $ubis = new Text('ubis', [
            "class" => "form-control",
            "placeholder" => "Ubis",
        ]);

        $ubis->addValidators([
            new PresenceOf(['message' => 'Ubis is required']),
        ]);

        $planGroup = new Text('plan_group', [
            "class" => "form-control",
            "placeholder" => "Plan Group",
        ]);

        $planGroup->addValidators([
            new PresenceOf(['message' => 'Plan Group is required']),
        ]);

        $userStatLv1 = new Text('user_stat_lv_1', [
            "class" => "form-control",
            "placeholder" => "User Stat Lv 1",
        ]);

        $userStatLv1->addValidators([
            new PresenceOf(['message' => 'User Stat Lv 1 is required']),
        ]);

        $userStatLv2 = new Text('user_stat_lv_2', [
            "class" => "form-control",
            "placeholder" => "User Stat Lv 2",
        ]);

        $userStatLv2->addValidators([
            new PresenceOf(['message' => 'User Stat Lv 2 is required']),
        ]);

        $namaTenant = new Text('nama_tenant', [
            "class" => "form-control",
            "placeholder" => "Nama Tenant",
        ]);

        $namaTenant->addValidators([
            new PresenceOf(['message' => 'Nama Tenant is required']),
        ]);

        $publish = new Submit('publish', [
            "name" => "publish",
            "value" => "Publish",
            "class" => "btn btn-primary",
        ]);

        $this->add($towerId);
        $this->add($projectId);
        $this->add($portofolio);
        $this->add($ubis);
        $this->add($planGroup);
        $this->add($userStatLv1);
        $this->add($userStatLv2);
        $this->add($namaTenant);
        $this->add($publish);
    }
}