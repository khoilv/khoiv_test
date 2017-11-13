<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * HitsCount model class that inherits from Eloquent Model class
 */
class HitsCount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hits_count';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'domain', 'count', 'created_at', 'updated_at'
    ];
}