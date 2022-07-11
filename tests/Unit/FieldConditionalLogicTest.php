<?php

use Joren\ACFBuilder\FieldConditionalLogic;
use Joren\ACFBuilder\Fields\TrueFalse;
use PHPUnit\Framework\TestCase;

class FieldConditionalLogicTest extends TestCase
{

    public function testAnd()
    {
        $trueFalse = new TrueFalse('True false');
        $trueFalse2 = new TrueFalse('True false 2');

        $conditionalLogic = new FieldConditionalLogic;

        $conditionalLogic->and($trueFalse, '==', true);
        $conditionalLogic->and($trueFalse2, '==', false);

        $this->assertEquals([
            [
                ['field' => 'field_true_false', 'operator' => '==', 'value' => '1'],
                ['field' => 'field_true_false_2', 'operator' => '==', 'value' => '0']
            ]
        ], $conditionalLogic->build());
    }

    public function testOr()
    {
        $trueFalse = new TrueFalse('True false');
        $trueFalse2 = new TrueFalse('True false 2');

        $conditionalLogic = new FieldConditionalLogic;

        $conditionalLogic->or($trueFalse, '==', true);
        $conditionalLogic->or($trueFalse2, '==', false);

        $this->assertEquals([
            [
                ['field' => 'field_true_false', 'operator' => '==', 'value' => '1'],

            ],
            [
                ['field' => 'field_true_false_2', 'operator' => '==', 'value' => '0']
            ]
        ], $conditionalLogic->build());
    }

    public function testAndOrAnd()
    {
        $trueFalse = new TrueFalse('True false');
        $trueFalse2 = new TrueFalse('True false 2');
        $trueFalse3 = new TrueFalse('True false 3');

        $conditionalLogic = new FieldConditionalLogic;

        $conditionalLogic->and($trueFalse, '==', true);
        $conditionalLogic->or($trueFalse2, '==', false);
        $conditionalLogic->and($trueFalse3, '==', true);

        $this->assertEquals([
            [
                ['field' => 'field_true_false', 'operator' => '==', 'value' => '1'],

            ],
            [
                ['field' => 'field_true_false_2', 'operator' => '==', 'value' => '0'],
                ['field' => 'field_true_false_3', 'operator' => '==', 'value' => '1']
            ]
        ], $conditionalLogic->build());
    }
}
