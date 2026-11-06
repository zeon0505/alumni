<?php

namespace App\Auth;

use App\Models\Alumni;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class AlumniUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials (nim + password).
     */
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        $credentials = array_filter(
            $credentials,
            fn ($key) => ! Str::contains($key, 'password'),
            ARRAY_FILTER_USE_KEY
        );

        if (empty($credentials)) {
            return null;
        }

        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            $query->where($key, $value);
        }

        return $query->first();
    }
}
