<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;




class Contact extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    // mass assignable attributes
    protected $fillable = [
        'name', 'email', 'contact_number', 'address', 'notes', 'avatar'
    ];

    // this line defines the relationship of contacts to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    protected static $logName = 'contact';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // these are the attributes to log
            ->logOnly(['name', 'email', 'contact_number', 'address', 'notes', 'avatar'])
            ->logOnlyDirty()                                                    
            ->dontSubmitEmptyLogs();                                            
    }
}
