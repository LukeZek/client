<?php

namespace LukeBozek\ApiClient\Util;

use PHPUnit\Framework\TestCase;

class ArrayNodeExtractorTest extends TestCase
{
    private $testArray = [
        'keyLevel1' => [
            'keyLevel2' => [
                'keyLevel3' => 'valueLevel3'
            ]
        ]
    ];

    public function testGetFirstLevel()
    {
        $node = [
            'keyLevel1'
        ];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals(
            [
                'keyLevel2' => [
                    'keyLevel3' => 'valueLevel3'
                ]
            ],
            $result
        );
    }

    public function testGetSecondLevel()
    {
        $node = [
            'keyLevel1',
            'keyLevel2'
        ];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals(
            [
                'keyLevel3' => 'valueLevel3'
            ],
            $result
        );
    }

    public function testGetThirdLevel()
    {
        $node = [
            'keyLevel1',
            'keyLevel2',
            'keyLevel3'
        ];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals('valueLevel3', $result);
    }

    public function testGetNonExistentNode()
    {
        $node = [
            'keyLevel6'
        ];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals($this->testArray, $result);
    }

    public function testGetNodeStartingNotFromRootNode()
    {
        $node = [
            'keyLevel6'
        ];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals($this->testArray, $result);
    }

    public function testEmptyNode()
    {
        $node = [];

        $result = ArrayNodeExtractor::extractArrayNode($this->testArray, $node);

        $this->assertEquals($this->testArray, $result);
    }
}
