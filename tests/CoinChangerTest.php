<?php

namespace Rollenes\GivingChange;

class CoinChangerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CoinChanger
     */
    private $coinChanger;

    protected function setUp()
    {
        $this->coinChanger = new CoinChanger();
    }

    public function testShouldGiveNoChange()
    {
        $coins = $this->coinChanger->change(0);

        $this->assertCount(0, $coins);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldRiseExceptionWhenAmountIsNegative()
    {
        $this->coinChanger->change(-10);
    }

    /**
     * @dataProvider availableCoins
     */
    public function testShouldGiveOneCoin($amount)
    {
        $coins = $this->coinChanger->change($amount);

        $this->assertCount(1, $coins);
        $this->assertContains($amount, $coins);
    }

    public function availableCoins()
    {
        return [
            [0.01],
            [0.02],
            [0.05],
            [0.1],
            [0.2],
            [0.5],
            [1],
            [2],
            [5]
        ];
    }

    /**
     * @dataProvider twoCoins
     */
    public function testShouldGiveTwoCoins($amount)
    {
        $coins = $this->coinChanger->change($amount);

        $this->assertCount(2, $coins);
        $this->assertEquals($amount, array_sum($coins));
    }

    public function twoCoins()
    {
        return [
            [0.03],
            [0.04],
            [6]
        ];
    }

    public function testShouldGiveThreeCoins()
    {
        $coins = $this->coinChanger->change(1.07);

        $this->assertCount(3, $coins);
        $this->assertEquals(1.07, array_sum($coins));
    }
} 