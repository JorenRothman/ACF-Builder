<?php

use Joren\ACFBuilder\FieldGroup;
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
                ['post_type', '==', 'page'],
                ['post_type', '==', 'post']
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
                ['post_type', '==', 'page']
            ],
            [
                ['post_type', '==', 'post'],
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
                ['post_type', '==', 'page'],
            ],
            [
                ['post_type', '==', 'post'],
                ['post_status', '==', 'publish'],
            ],
        ], $fieldGroupLocations->build());
    }
}
