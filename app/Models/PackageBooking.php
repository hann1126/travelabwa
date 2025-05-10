<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBooking extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pack_tour_id',
        'user_is',
        'quantity',
        'star_date',
        'end_date',
        'total_amount',
        'is_paid',
        'proof',
        'pack_bank_id',
        'sub_total',
        'tax',
        'insurance',
    ];

    protected $casts = [
        'star_date'=>'date',
        'end_date'=>'date',
    ];

    public function curtumer(){
        return $this->belongsTo(user::class);
    }

    public function tour(){
        return $this->belongsTo(PackageTour::class);
    }

    public function bank(){
        return $this->belongsTo(PackageBank::class);
    }
}
