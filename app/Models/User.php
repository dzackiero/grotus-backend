<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\Role;
use App\Interfaces\HasImage;
use App\Traits\InteractWithImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasImage
{
    use HasFactory, Notifiable, InteractWithImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /* INTERFACES */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageSize(): array
    {
        return [
            "width" => 300,
            "height" => 300,
            "ratio" => 1,
        ];
    }

    public function uploadImageCallback(string $asset): bool
    {
        return $this->profile->update(["profile_photo" => $asset]);
    }


    /* RELATIONSHIP */

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /* METHODS */

    public static function createUser(
        string         $name,
        string         $email,
        string         $password = "password",
        ?string        $address = null,
        ?string        $birthDate = null,
        ?PaymentMethod $preferredPayment = null,
        ?string        $profileLink = null,
        Role           $role = Role::User,
    ): User
    {
        $user = User::create([
            "email" => $email,
            "password" => \Hash::make($password),
            "role" => $role->value
        ]);

        UserProfile::create([
            "user_id" => $user->id,
            "name" => $name,
            "address" => $address,
            "birth_date" => $birthDate,
            "profile_photo" => $profileLink,
            "preferred_payment" => $preferredPayment,
        ]);
        return $user;
    }

    public function uploadProfile(UploadedFile $image): bool
    {
        $userProfile = $this->profile;
        if ($userProfile->profile_photo) {
            Storage::delete($userProfile->profile_photo);
        }

        return $this->uploadImage($image, "profile", "profile_" . str($userProfile->name)->slug("_"));
    }
}
