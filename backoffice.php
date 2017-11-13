<?php

require 'vendor/autoload.php';

use App\Repositories\HitsCounts;

$repos = new HitsCounts();

// get the total number of hits on all domains
$total = $repos->getTotalHits();

// get hit statistics data by domain
$data = $repos->getHitsByDomain();

// get hit statistics data by domain & unique users.
$detailData = $repos->getHitsByUniqueUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show statistics</title>
</head>
<body>
<h2>Total of hits of all domains: <span style="color: red;"><?php echo $total; ?></span></h2>
<h2>Hit statistics by domain</h2>
<table width="680" border="1" cellspacing="2" cellpadding="2">
    <thead>
    <tr>
        <th width="10%">No</th>
        <th width="60%">Web-site domain</th>
        <th width="15%">Hits</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($data) {
        foreach ($data as $index => $row) {
            ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlentities($row->domain); ?></td>
                <td><?php echo $row->sub_total; ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
<h2>Hit statistics by unique users</h2>
<table width="680" border="1" cellspacing="2" cellpadding="2">
    <thead>
    <tr>
        <th width="10%">No</th>
        <th width="30%">Web-site domain</th>
        <th width="30%">Unique users</th>
        <th width="15%">Hits</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($detailData) {
        foreach ($detailData as $index => $row) {
            ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo htmlentities($row->domain); ?></td>
                <td><?php echo htmlentities($row->ip); ?></td>
                <td><?php echo $row->count; ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>