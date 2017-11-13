<?php

namespace Test\Unit;


use PHPUnit\Framework\TestCase;
use App\Repositories\HitsCounts;
use App\Models\HitsCount;

class HitsCountsTest extends TestCase
{
    protected $repos;

    public function setUp()
    {
        // truncate DB (table)
        HitsCount::truncate();

        $this->repos = new HitsCounts();
    }

    public function tearDown()
    {
        unset($this->repos);
    }

    public function testGetTotalHits()
    {
        $this->assertEquals(0, $this->repos->getTotalHits());

        // Prepare test data
        $input = [
            ['domain' => 'vnexpress.net', 'ip' => '225.225.8.12'],
            ['domain' => 'dantri.com.net', 'ip' => '225.225.147.25'],
        ];
        $this->createHitRequests($input);
        $this->assertEquals(2, $this->repos->getTotalHits());

        // Input some other test data
        $input = [
            ['domain' => 'vnexpress.net', 'ip' => '225.225.8.12'],
            ['domain' => 'vnexpress.net', 'ip' => '225.225.8.12'],
            ['domain' => 'dantri.com.net', 'ip' => '225.225.147.25'],
        ];
        $this->createHitRequests($input);
        $this->assertEquals(5, $this->repos->getTotalHits());
    }

    public function testGetHitsByDomain()
    {
        // Prepare test data
        $input = [
            ['domain' => 'vnexpress.net', 'ip' => '225.225.8.12'],
            ['domain' => 'vnexpress.net', 'ip' => '225.225.8.12'],
            ['domain' => 'dantri.com.net', 'ip' => '225.225.147.25'],
        ];
        $this->createHitRequests($input);
        $output = $this->repos->getHitsByDomain();
        $this->assertEquals(2, count($output));

        $this->assertEquals('dantri.com.net', $output[0]->domain);
        $this->assertEquals(1, $output[0]->sub_total);

        $this->assertEquals('vnexpress.net', $output[1]->domain);
        $this->assertEquals(2, $output[1]->sub_total);
    }

    private function createHitRequests(array $input)
    {
        foreach ($input as $item) {
            $this->repos->createHitRequest($item['domain'], $item['ip']);
        }
    }
}