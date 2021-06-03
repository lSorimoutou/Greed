<?php

use PHPUnit\Framework\TestCase;

include 'greed.class.php';

/**
 * GreedTest
 * @group group
 */
class GreedTest extends TestCase
{
    /* score => (valeur => occurences) */
    private const SCORE_RULES = array(
        100 => array(1 => 1),
        50 => array(5 => 1),
        1000 => array(1 => 3),
        200 => array(2 => 3),
        300 => array(3 => 3),
        400 => array(4 => 3),
        500 => array(5 => 3),
        600 => array(6 => 3)
    );

    /** @test_error_arg 
     * On envoie 7 dés !
     */
    public function test_error_arg()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->expectException(InvalidArgumentEXCEPTION::class);
        $greedTest->score(array(1, 2, 3, 4, 5, 6, 7));
    }

    /** @test_base1 
     * On obtient qu'un 1, on devrait obtenir un score de 100
     */
    public function test_base1()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(1)), 100);
    }

    /** @test_base2 
     * Un simple 5 devrait donner un score de 50
     */
    public function test_base2()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(5)), 50);
    }

    /** @test_base3
     * Trois 1 devrait donner un score de 1000
     */
    public function test_base3()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(1, 1, 1)), 1000);
    }

    /** @test_base4
     * Trois 2 devrait donner un score de 200
     */
    public function test_base4()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 2)), 200);
    }

    /** @test_base5
     * Trois 3 devrait donner un score de 300
     */
    public function test_base5()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(3, 3, 3)), 300);
    }

    /** @test_base6
     * Trois 4 devrait donner un score de 400
     */
    public function test_base6()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(4, 4, 4)), 400);
    }

    /** @test_base7
     * Trois 5 devrait donner un score de 500
     */
    public function test_base7()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(5, 5, 5)), 500);
    }

    /** @test_base8
     * Trois 6 devrait donner un score de 600
     */
    public function test_base8()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(6, 6, 6)), 600);
    }

    /** @test_straight
     * Dans le cas du Straight, on dois obtenir un score de 1200
     */
    public function test_straight()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(1, 2, 3, 4, 5, 6)), 1200);
    }


    /** @test_three_pairs
     * Dans le cas de trois pairs, on dois obtenir un score de 800
     */
    public function test_three_pairs()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 3, 3, 4, 4)), 800);
    }

    /** @test_special1
     * Cas ou on a 4 fois deux (score multiplié par 2)
     */
    public function test_special1()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 2, 2)), 400);
    }

    /** @test_special2
     * Cas ou on a 5 fois deux (score multiplié par 4)
     */
    public function test_special2()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 2, 2, 2)), 800);
    }

    /** @test_special3
     * Cas ou on a 6 fois deux (score multiplié par 8)
     */
    public function test_special3()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 2, 2, 2, 2)), 1600);
    }

    /** @test_normal1
     * 
     */
    public function test_normal1()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(2, 2, 2, 4, 4, 4)), 600);
    }

    /** @test_normal2
     * 
     */
    public function test_normal2()
    {
        $greedTest = new Greed(self::SCORE_RULES);
        $this->assertSame($greedTest->score(array(3, 2, 2, 1, 4, 5)), 150);
    }
}
