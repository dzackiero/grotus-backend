<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\Role;
use App\Interfaces\HasImage;
use App\Traits\InteractWithImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasImage
{
    use HasFactory, Notifiable, InteractWithImage;

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    /* STUB */

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

    public function cartItems(): HasMany
    {
        return $this->hasMany(UserCart::class, "user_id");
    }

    public function savedProduct(): HasMany
    {
        return $this->hasMany(UserSavedProduct::class, "user_id");
    }

    /* SCOPE */

    public function scopeAdmins(Builder $query): Builder
    {
        return $query->where("role", Role::Admin->value);
    }

    public function scopeUsers(Builder $query): Builder
    {
        return $query->where("role", Role::User->value);
    }

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where("name", "LIKE", "%{$keyword}");
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

    /**
     * @param Collection $user {email: string}
     * @param Collection $profile {name: string, address: string, birth_date: string, preferred_payment}
     * @return $this
     */
    public function updateUser(
        Collection $user,
        Collection $profile,
    ): User
    {
        $this->update($user->toArray());
        $this->profile->update($profile->toArray());

        return $this;
    }

    public function addToCart(Product $product, $amount = 1): UserCart
    {
        $cartItem = $this->cartItems()
            ->where("product_id", $product->id)->first();
        if ($cartItem) {
            $cartItem->update([
                "amount" => $cartItem->amount + $amount,
            ]);
            return $cartItem->refresh();
        }

        return UserCart::create([
            "user_id" => $this->id,
            "product_id" => $product->id,
            "amount" => $amount,
        ]);
    }

    public function addToWishlist(Product $product): UserSavedProduct
    {
        if (UserSavedProduct::where("user_id", $this->id)->where("product_id", $product->id)->exists()) {
            throw new \Exception("Duplicate wishlist product", 422);
        }

        return UserSavedProduct::create([
            "user_id" => $this->id,
            "product_id" => $product->id,
        ]);
    }
}
