<?php

namespace App\Repositories;


use App\Models\HitsCount;

class HitsCounts
{

    /**
     * Get the total number of hits on all domains
     *
     * @return integer The total number of hits for all domains
     */
    public function getTotalHits()
    {
        $total = HitsCount::sum('count');
        return $total;
    }

    /**
     * Get hit statistics data by domain
     *
     * @return mixed The array of objects (records)
     */
    public function getHitsByDomain()
    {
        $data = HitsCount::selectRaw('domain, SUM(count) as sub_total')
            ->groupBy('domain')
            ->orderBy('domain', 'ASC')
            ->get();
        return $data;
    }

    /**
     * Get hit statistics data by domain & unique users.
     *
     * @return mixed The array of objects (records)
     */
    public function getHitsByUniqueUsers()
    {
        $data = HitsCount::orderBy('domain', 'ASC')->get();
        return $data;
    }

    /**
     * Check hit request
     *
     * @param $domain string The domain
     * @param $ip string The ip address
     * @return mixed Null or hit request object
     */
    public function checkHitRequest($domain, $ip)
    {
        $record = HitsCount::where([['domain', $domain], ['ip', $ip]])->first();
        return $record;
    }

    /**
     * Create hit request
     *
     * @param $domain The domain
     * @param $ip The ip address
     * @return mixed The result of creation
     */
    public function createHitRequest($domain, $ip)
    {
        return HitsCount::create([
            'domain' => $domain,
            'ip' => $ip,
            'count' => 1
        ]);
    }

    /**
     * Update hit request
     *
     * @param $id
     */
    public function updateHitRequest($id)
    {
        $record = HitsCount::find($id);
        $record->count += 1;
        return $record->save();
    }

}