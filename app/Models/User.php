<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\Role;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\Laravel\Facades\Image;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasImage;

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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function uploadImage(UploadedFile $image, $directory): string
    {
        $profile = $this->profile;
        $fileName = time() . '_profile_' . \Str::slug($profile->name, "_") . "." . $image->getClientOriginalExtension();
        $path = $directory . '/' . $fileName;

        $image = Image::read($image);
        $aspectRatio = $image->width() / $image->height();

        if ($aspectRatio == 1) {
            $image->scale(300);
        } else {
            $image->crop(300, 300, position: "center");
        }

        $image->save(public_path($path));
        return $profile->update(["profile_photo" => asset($path)]);
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
    )
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
}
