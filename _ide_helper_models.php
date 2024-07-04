<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\NutritionTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutritionType whereUpdatedAt($value)
 */
	class NutritionType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $stock
 * @property string $description
 * @property string $type
 * @property string|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductMedia> $medias
 * @property-read int|null $medias_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NutritionType> $nutritionTypes
 * @property-read int|null $nutrition_types_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent implements \App\Interfaces\HasImage {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\ProductMediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMedia whereUpdatedAt($value)
 */
	class ProductMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property float $rating min: 0; max: 5
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\TransactionProduct|null $transactionProduct
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ProductRatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRating whereUserId($value)
 */
	class ProductRating extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string|null $payment_method
 * @property string|null $delivery_method
 * @property string $status
 * @property string|null $paid_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionProduct> $transactionProducts
 * @property-read int|null $transaction_products_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeliveryMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $product_id
 * @property int|null $rating_id
 * @property string $name
 * @property float $price
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductMedia> $medias
 * @property-read int|null $medias_count
 * @property-read \App\Models\ProductRating|null $rating
 * @property-read \App\Models\Transaction $transaction
 * @method static \Database\Factories\TransactionProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereRatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionProduct whereUpdatedAt($value)
 */
	class TransactionProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $email
 * @property mixed $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserCart> $cartItems
 * @property-read int|null $cart_items_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserSavedProduct> $savedProduct
 * @property-read int|null $saved_product_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User search(string $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|User users()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject, \App\Interfaces\HasImage {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserCartFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCart whereUserId($value)
 */
	class UserCart extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $birth_date
 * @property string|null $profile_photo
 * @property string|null $preferred_payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePreferredPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserSavedProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSavedProduct whereUserId($value)
 */
	class UserSavedProduct extends \Eloquent {}
}

