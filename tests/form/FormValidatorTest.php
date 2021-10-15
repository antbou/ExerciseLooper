<?php

use Looper\core\services\Field;
use PHPUnit\Framework\TestCase;
use Looper\core\services\FormValidator;


class FormValidatorTest extends TestCase
{

    /**
     * Change l'accessibilité des méthodes privée en public
     *
     * @param [type] $name
     * @return object
     */
    protected static function getMethod($name): object
    {
        $class = new \ReflectionClass('\\Looper\\core\\services\\FormValidator');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testIsPostValid()
    {
        $postTrue = [
            'formName' => [
                'title' => 'test'
            ],
        ];

        $postBadName = [
            'formNameFalse' => [
                'title' => 'test'
            ],
        ];

        $postNotMultiArray = [
            'formName'
        ];

        $method = self::getMethod('isPostValid');
        $form = new FormValidator('formName');

        $_POST = $postBadName;
        $this->assertFalse($method->invokeArgs($form, []));

        $_POST = $postNotMultiArray;
        $this->assertFalse($method->invokeArgs($form, []));

        $_POST = $postTrue;
        $this->assertTrue($method->invokeArgs($form, []));

        return $form;
    }

    /**
     * @depends testIsPostValid
     */
    public function testIsSet(FormValidator $form)
    {

        $postTrue = [
            'title' => 'test'
        ];

        $postBadName = [
            'tit23le' => 'test'
        ];

        $method = self::getMethod('isSet');
        $form->addField(['fieldTitle' => new Field('title', 'string', true)]);

        $form->post = $postTrue;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['fieldTitle']]));

        $form->post = $postBadName;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['fieldTitle']]));
    }

    /**
     * @depends testIsPostValid
     */
    public function testIsNotEmpty(FormValidator $form)
    {

        $postEmpty = [
            'title' => ''
        ];

        $postNotEmpty = [
            'title' => 'bonjour'
        ];

        $method = self::getMethod('isNotEmpty');
        $form->addField(['fieldCanBeEmpty' => new Field('title', 'string', true)]);
        $form->addField(['fieldCannotBeEmpty' => new Field('title', 'string', false)]);

        // Le champs à le droit d'être vide

        $form->post = $postEmpty;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['fieldCanBeEmpty']]));
        $form->post = $postNotEmpty;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['fieldCanBeEmpty']]));

        // Le champs ne doit pas être vide
        $form->post = $postEmpty;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['fieldCannotBeEmpty']]));
        $form->post = $postNotEmpty;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['fieldCannotBeEmpty']]));
    }

    /**
     * @depends testIsPostValid
     */
    public function testIsString(FormValidator $form)
    {

        $postIsNotString = [
            'title' => 12
        ];

        $postIsString = [
            'title' => 'bonjour'
        ];

        $method = self::getMethod('isString');
        $form->addField(['field' => new Field('title', 'string', true)]);

        // les champs doit être de type string

        $form->post = $postIsString;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['field']]));
        $form->post = $postIsNotString;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['field']]));
    }

    /**
     * @depends testIsPostValid
     */
    public function testIsInt(FormValidator $form)
    {

        $postIsInt = [
            'title' => 12
        ];

        $postIsNotInt1 = [
            'title' => 'bonjour'
        ];

        $postIsNotInt2 = [
            'title' => '12'
        ];

        $postIsNotInt3 = [
            'title' => 125.33
        ];

        $postIsNotInt4 = [
            'title' => ''
        ];

        $method = self::getMethod('isInt');
        $form->addField(['field' => new Field('title', 'int', true)]);

        // les champs doit être de type int

        $form->post = $postIsInt;
        $this->assertTrue($method->invokeArgs($form, [$form->getFields()['field']]));
        $form->post = $postIsNotInt1;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['field']]));
        $form->post = $postIsNotInt2;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['field']]));
        $form->post = $postIsNotInt3;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['field']]));
        $form->post = $postIsNotInt4;
        $this->assertFalse($method->invokeArgs($form, [$form->getFields()['field']]));
    }
}
