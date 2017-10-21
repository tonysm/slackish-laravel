<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'owner_id',
        'default_channel_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defaultChannel()
    {
        return $this->belongsTo(Channel::class, 'default_channel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    /**
     * @param string $name
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createChannel(string $name)
    {
        return $this->channels()
            ->create(['name' => $name]);
    }
}
