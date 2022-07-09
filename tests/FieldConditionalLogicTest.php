<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Fields\Text;
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
                ['field' => '151c33bae13714896d7b8b06d0addc93', 'operator' => '==', 'value' => '1'],
                ['field' => 'd466702699b4afa6dc4ee732758cfc80', 'operator' => '==', 'value' => '0']
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
                ['field' => '151c33bae13714896d7b8b06d0addc93', 'operator' => '==', 'value' => '1'],

            ],
            [
                ['field' => 'd466702699b4afa6dc4ee732758cfc80', 'operator' => '==', 'value' => '0']
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
                ['field' => '151c33bae13714896d7b8b06d0addc93', 'operator' => '==', 'value' => '1'],

            ],
            [
                ['field' => 'd466702699b4afa6dc4ee732758cfc80', 'operator' => '==', 'value' => '0'],
                ['field' => '06854dff27bcdb0b292c7b40db1942c9', 'operator' => '==', 'value' => '1']
            ]
        ], $conditionalLogic->build());
    }
}
