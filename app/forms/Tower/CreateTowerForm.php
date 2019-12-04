<?php
namespace App\Forms\Tower;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
// Validation
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Digit;

class CreateTowerForm extends Form
{
    public function initialize($entity = null, $options = [])
    {
        if (isset($options["edit"])) {
            $towerid = new Hidden('tower_id', [
                "required" => true,
            ]);

            $this->add($towerid);
        }

        $siteIdDmt = new Text('site_id_dmt', [
            "class" => "form-control",
            "placeholder" => "Site ID"
        ]);

        $siteIdDmt->addValidators([
            new PresenceOf(['message' => 'Site ID is required']),
        ]);

        $siteName = new Text('site_name', [
            "class" => "form-control",
            "placeholder" => "Site Name",
        ]);

        $siteName->addValidators([
            new PresenceOf(['message' => 'Site Name is required']),
        ]);

        $siteType = new Text('site_type', [
            "class" => "form-control",
            "placeholder" => "Site Type",
        ]);

        $siteType->addValidators([
            new PresenceOf(['message' => 'Site Type is required']),
        ]);

        $regional = new Text('regional', [
            "class" => "form-control",
            "placeholder" => "Regional",
        ]);

        $regional->addValidators([
            new PresenceOf(['message' => 'Regional is required']),
        ]);

        $alamatAct = new Text('alamat_act', [
            "class" => "form-control",
            "placeholder" => "Alamat ACT",
        ]);

        $alamatAct->addValidators([
            new PresenceOf(['message' => 'Alamat ACT is required']),
        ]);

        $kotaKabupaten = new Text('kota_kabupaten', [
            "class" => "form-control",
            "placeholder" => "Kota/Kabupaten",
        ]);

        $kotaKabupaten->addValidators([
            new PresenceOf(['message' => 'Kota/Kabupaten is required']),
        ]);

        $towerLeg = new Text('tower_leg', [
            "class" => "form-control",
            "placeholder" => "Tower Leg",
        ]);

        $towerLeg->addValidators([
            new PresenceOf(['message' => 'Tower Leg is required']),
            new Digit(['message' => 'Tower Leg is numerical only']),
        ]);

        $towerHeight = new Text('tower_height', [
            "class" => "form-control",
            "placeholder" => "Tower Height",
        ]);

        $towerHeight->addValidators([
            new PresenceOf(['message' => 'Tower Height is required']),
            new Digit(['message' => 'Tower Height is numerical only']),
        ]);

        $publish = new Submit('publish', [
            "name" => "publish",
            "value" => "Publish",
            "class" => "btn btn-primary",
        ]);

        $this->add($siteIdDmt);
        $this->add($siteName);
        $this->add($siteType);
        $this->add($regional);
        $this->add($alamatAct);
        $this->add($kotaKabupaten);
        $this->add($towerLeg);
        $this->add($towerHeight);
        $this->add($publish);
    }
}