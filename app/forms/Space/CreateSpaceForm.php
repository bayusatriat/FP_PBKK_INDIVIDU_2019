<?php
namespace App\Forms\Space;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
// Validation
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Digit;

class CreateSpaceForm extends Form
{
    public function initialize($entity = null, $options = [])
    {
        if (isset($options["edit"])) {
            $spaceId = new Hidden('space_id', [
                "required" => true,
            ]);

            $this->add($spaceId);
        }

        $towerId = new Text('tower_id', [
            "class" => "form-control",
            "placeholder" => "Tower ID"
        ]);

        $towerId->addValidators([
            new PresenceOf(['message' => 'Tower ID is required']),
            new Digit(['message' => 'Tower ID is numerical only']),
        ]);

        $projectTableId = new Text('project_table_id', [
            "class" => "form-control",
            "placeholder" => "Project Table ID",
        ]);

        $projectTableId->addValidators([
            new PresenceOf(['message' => 'Project Table ID is required']),
            new Digit(['message' => 'Project Table ID is numerical only']),
        ]);

        $leg = new Text('leg', [
            "class" => "form-control",
            "placeholder" => "Leg",
        ]);

        $leg->addValidators([
            new PresenceOf(['message' => 'Leg is required']),
        ]);

        $height = new Text('height', [
            "class" => "form-control",
            "placeholder" => "Height",
        ]);

        $height->addValidators([
            new PresenceOf(['message' => 'Height is required']),
            new Digit(['message' => 'Height is numerical only']),
        ]);

        $merk = new Text('merk', [
            "class" => "form-control",
            "placeholder" => "Merk",
        ]);

        $merk->addValidators([
            new PresenceOf(['message' => 'Merk is required']),
        ]);

        $berat = new Text('berat', [
            "class" => "form-control",
            "placeholder" => "Berat",
        ]);

        $berat->addValidators([
            new PresenceOf(['message' => 'Berat is required']),
            new Digit(['message' => 'Berat is numerical only']),
        ]);

        $diameter = new Text('diameter', [
            "class" => "form-control",
            "placeholder" => "Diameter",
        ]);

        $diameter->addValidators([
            new PresenceOf(['message' => 'Diameter is required']),
            new Digit(['message' => 'Diameter is numerical only']),
        ]);

        $publish = new Submit('publish', [
            "name" => "publish",
            "value" => "Publish",
            "class" => "btn btn-primary",
        ]);

        $this->add($towerId);
        $this->add($projectTableId);
        $this->add($leg);
        $this->add($height);
        $this->add($merk);
        $this->add($berat);
        $this->add($diameter);
        $this->add($publish);
    }
}