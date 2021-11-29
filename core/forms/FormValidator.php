<?php

namespace Looper\core\forms;

use Looper\core\forms\Field;

class FormValidator
{
    private array $fields;
    public string $name;
    public array $post;
    public string $error;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->fields = [];
    }

    /**
     * Effectue une vérification des différents champs du formulaires
     *
     * @return boolean
     */
    public function process(): bool
    {
        if (!$this->isPostValid()) {
            return false;
        }

        $flag = true;

        foreach ($this->fields as $field) {

            $checkType = 'is' . ucfirst($field->type);

            /**
             * Vérification suivante :
             * Le champs existe
             * Le champs n'est pas vide ou accepte d'être vide
             */
            if (
                !$this->isSet($field) ||
                !$this->isNotEmpty($field) ||
                !$this->$checkType($field) ||
                (empty($field->valueToVerify) ? false : !$this->inArray($field))
            ) {
                $flag = false;
                continue;
            }
        }

        return $flag;
    }

    private function isInt(Field $field): bool
    {
        if (!is_int($this->post[$field->name])) {
            $field->error = "La valeur entrée n'est pas correcte";
            return false;
        }

        $field->value = intval($this->post[$field->name]);

        return true;
    }

    private function isString(Field $field): bool
    {
        if (!is_string($this->post[$field->name]) && empty($field->multi)) {
            $field->error = "La valeur entrée n'est pas correcte";
            return false;
        }
        if (empty($field->multi)) {
            $field->value = $this->post[$field->name];
        } else {
            $field->value = [];
            foreach ($field->multi as $key) {

                $field->value += [array_keys($this->post[$field->name], $this->post[$field->name][$key])[0] => $this->post[$field->name][$key]];
            }
        }

        return true;
    }

    private function isNotEmpty(Field $field): bool
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

    private function isSet(Field $field): bool
    {

        if (!isset($this->post[$field->name]) || !array_key_exists($field->name, $this->post)) {
            $field->error = "Error lors du traitement du champs";
            return false;
        }
        if (!empty($field->multi)) {
            foreach ($this->post[$field->name] as $key => $value) {
                if (in_array($key, $field->multi)) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }

    private function inArray(Field $field): bool
    {
        return in_array($this->post[$field->name], $field->valueToVerify);
    }

    /**
     * Vérifie que POST contient bien un tableau multidimensionnel avec le bon nom
     *
     * @return boolean
     */
    private function isPostValid(): bool
    {

        if (!isset($_POST[$this->name]) || !is_array($_POST[$this->name])) {
            $this->error = "Erreurs lors du traitement";
            return false;
        }

        $this->post = $_POST[$this->name];

        return true;
    }

    public function addField($field): FormValidator
    {
        $this->fields += $field;
        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
