<?php

namespace Looper\core\services;

use Looper\core\services\Field;

class FormValidator
{
    private array $fields;
    public string $name;
    private array $post;
    public string $error;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function process()
    {
        if (!$this->isPostValid()) {
            return;
        }

        foreach ($this->fields as $field) {

            $checkType = 'is' . ucfirst($field->type);

            /**
             * Vérification suivante :
             * Le champs existe
             * Le champs n'est pas vide ou accepte d'être vide
             */
            if (!$this->isSet($field) || !$this->isNotEmpty($field) || !$this->$checkType($field)) {
                continue;
            }
        }
    }

    private function isInt(Field $field)
    {
        if (!is_int($this->post[$field->name])) {
            $field->error = "Le champs n'est du bon type";
            return false;
        }

        $field->value = intval($this->post[$field->name]);

        return true;
    }

    private function isString(Field $field)
    {
        if (!is_string($this->post[$field->name])) {
            $field->error = "Le champs n'est du bon type";
            return false;
        }
        $field->value = htmlspecialchars($this->post[$field->name]);
        return true;
    }

    public function addField(Field $field): void
    {
        $this->fields[] = $field;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    private function isNotEmpty(Field $field)
    {
        if ($field->canBeEmpty) {
            return true;
        }

        if (empty($this->post[$field->name])) {
            $field->error = "Veuillez remplire ce champs";
            return false;
        }
        return true;
    }

    private function isSet(Field $field)
    {
        if (!isset($this->post[$field->name])) {
            $field->error = "Error lors du traitement du champs";
            return false;
        }
        return true;
    }

    private function isPostValid(): bool
    {
        if (!isset($_POST[$this->name])) {
            $this->error = "Erreurs lors du traitement";
            return false;
        }

        $this->post = $_POST[$this->name];

        return true;
    }
}
