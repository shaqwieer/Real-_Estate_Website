<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'accepted_at', 'rejected_at'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }
    public function scopeByMe($query)
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }
    public function scopeExcept($query, Offer $offer)
    {
        return $query->where('id', '!=', $offer->id);
    }
}
