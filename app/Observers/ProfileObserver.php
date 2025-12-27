<?php

namespace App\Observers;

use App\Models\Profile;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $profile): void
    {
        $this->logActivity($profile, 'created');
        $this->clearCache();
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        $this->logActivity($profile, 'updated');
        $this->clearCache();
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        $this->logActivity($profile, 'deleted');
        $this->clearCache();
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        $this->logActivity($profile, 'restored');
        $this->clearCache();
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        $this->logActivity($profile, 'force_deleted');
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('team_profile_detail');
    }

    protected function logActivity(Profile $profile, string $event): void
    {
        // Don't log if we don't have a user (e.g. seeder or console command)
        // unless we want to log system actions too.
        
        $userId = Auth::id();
        
        AuditLog::create([
            'user_id' => $userId,
            'auditable_type' => Profile::class,
            'auditable_id' => $profile->id,
            'event' => $event,
            'old_values' => $event === 'updated' ? $profile->getOriginal() : null,
            'new_values' => $profile->getAttributes(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
