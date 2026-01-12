<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasNotes;
use App\Traits\UsesFileUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoydeepBhowmik\LaravelMediaLibary\Traits\HasMedia;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Onboard\Concerns\GetsOnboarded;
use Spatie\Onboard\Concerns\Onboardable;

class User extends Authenticatable implements Onboardable
{
    use GetsOnboarded, HasApiTokens, HasFactory, HasMedia, HasNotes, Notifiable, UsesFileUploads;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'whatsapp_number',
        'uniqid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $media_fields = ['avatar'];

    protected $append = ['avatar', 'photo'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_of_joining' => 'datetime',
            'password' => 'hashed',
            'bank_details' => 'array',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::bootHasMedia();

        static::creating(function ($user) {
            $date = now()->format('Ymd');
            $paddedUserId = str_pad($user->id ?? 0, 4, '0', STR_PAD_LEFT);
            $user->uniqid = "splm{$date}{$paddedUserId}";
        });
    }

    public function epr()
    {

        return $this->hasMany(Epr::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(UserDesignation::class, 'user_designation_id');
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl('photo');
    }

    public function getPhotoAttribute()
    {
        return $this->getFirstMediaUrl('photo');
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function relatives()
    {

        return $this->hasMany(EmployeeRelative::class);
    }

    public function getDeviceTokens(): HasMany
    {

        return $this->hasMany(DeviceToken::class);
    }

    public function getDeviceTokenArray(): array
    {
        // Ensure the relationship or tokens exist before proceeding
        return $this->getDeviceTokens()?->get()?->pluck('token')?->toArray() ?? [];
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {

        return $this->getDeviceTokenArray();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }

    public function pendingTasks()
    {
        return $this->tasks()->where('status', 'pending');
    }

    public function completedTasks()
    {
        return $this->tasks()->where('status', 'completed');
    }

    public function assignedTasks()
    {

        return $this->tasks()->where('assigner_id', $this->id);
    }

    public function assignedPendingTasks()
    {

        return $this->assignedTasks()->where('status', 'pending');
    }

    public function canAssignTaskTo(string|User $to): bool
    {
        // Fetch assignable designations as an array
        $assignableDesignations = $this->designation()->first()?->assignableDesignations()
            ->get()
            ->pluck('id')
            ->toArray();

        // Get the assignee's designation
        $assignee = $to instanceof User ? $to : User::find($to);

        if (! $assignee) {
            // Assignee not found
            return false;
        }

        if ($assignee->isSuspended()) {
            return false;
        }

        $assigneeDesignation = $assignee->designation()->first()->id ?? null;

        // Allow assignment if both designations are null
        if ($assignableDesignations === [] && $assigneeDesignation === null) {
            return true;
        }

        // Check if the assignee's designation is assignable
        return in_array($assigneeDesignation, $assignableDesignations ?? []);
    }

    public function canViewPrivateInfo(): bool
    {
        return auth()->user()->isAdmin() || $this->id === auth()->user()->id;
    }

    public function isAssigner(string|Task $t): bool
    {
        $task = $t instanceof Task ? $t : Task::find($t);

        return $this->id === $task->assigner_id;
    }

    public function isAssignee(string|Task $t): bool
    {
        $task = $t instanceof Task ? $t : Task::find($t);

        return $this->id === $task->assignee_id;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSuspended(): bool
    {
        return $this->role === 'suspended';
    }

    public function canReview(): bool
    {
        return $this->isAdmin() || $this->hasDesignation('Chief of Content Writer');
    }

    public function hasDesignation(?string $name = null)
    {
        return $this->designation()->first()?->name == $name;
    }

    public static function canApplyForLeave()
    {
        return LeaveApplication::where('user_id', $this->id)
            ->whereMonth('applied_date', Carbon::now()->month)
            ->exists();
    }

    public function leaveApplications()
    {
        return $this->hasMany(LeaveApplication::class);
    }

    protected function approvedLeaveCountByType(string $type, ?int $year = null): int
    {
        $year = $year ?? now()->year;

        return $this->leaveApplications()
            ->where('status', 'approved')
            ->where('type', $type)
            ->get()
            ->sum(function ($leaveApplication) use ($year) {
                $dates = json_decode($leaveApplication->dates, true) ?? [];

                return collect($dates)
                    ->filter(fn ($date) => \Carbon\Carbon::parse($date)->year === $year)
                    ->count();
            });
    }

    public function approvedCL(?int $year = null): int
    {
        return $this->approvedLeaveCountByType('CL', $year);
    }

    public function approvedSL(?int $year = null): int
    {
        return $this->approvedLeaveCountByType('SL', $year);
    }

    public function approvedEL(?int $year = null): int
    {
        return $this->approvedLeaveCountByType('EL', $year);
    }
}
