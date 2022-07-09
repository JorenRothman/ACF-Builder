<?php

use Joren\ACFBuilder\FieldGroupLocations;
use PHPUnit\Framework\TestCase;


final class FieldGroupLocationsTest extends TestCase
{
    public function testAnd()
    {
        $fieldGroupLocations = new FieldGroupLocations();
        $fieldGroupLocations->and('post_type', '==', 'page');
        $fieldGroupLocations->and('post_type', '==', 'post');


        $this->assertEquals([
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'page'],
                ['param' => 'post_type',  'operator' => '==',  'value' => 'post']
            ]
        ], $fieldGroupLocations->build());
    }

    public function testOr()
    {
        $fieldGroupLocations = new FieldGroupLocations();
        $fieldGroupLocations->or('post_type', '==', 'page');
        $fieldGroupLocations->or('post_type', '==', 'post');

        $expected = [
            [
                ['param' => 'post_type',  'operator' => '==',  'value' => 'page']
            ],
            [
                ['param' => 'post_type',  'operator' => '==',  'value' => 'post'],
            ]
        ];

        $this->assertEquals($expected, $fieldGroupLocations->build());
    }

    public function testAndOrAnd()
    {
        $fieldGroupLocations = new FieldGroupLocations();
        $fieldGroupLocations->and('post_type', '==', 'page');
        $fieldGroupLocations->or('post_type', '==', 'post');
        $fieldGroupLocations->and('post_status', '==', 'publish');

        $this->assertEquals([
            [
                ['param' => 'post_type',  'operator' => '==',  'value' => 'page'],
            ],
            [
                ['param' => 'post_type', 'operator' =>  '==',  'value' => 'post'],
                ['param' => 'post_status',  'operator' => '==',  'value' => 'publish'],
            ],
        ], $fieldGroupLocations->build());
    }
}
