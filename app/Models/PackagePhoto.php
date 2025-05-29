<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePhoto extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'package_photos';

    protected $fillable = [
        'package_tour_id',
        'photo',
    ];

    public function packageTour()
    {
        return $this->belongsTo(PackageTour::class);
    }

}
