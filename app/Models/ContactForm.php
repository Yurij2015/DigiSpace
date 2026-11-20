<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $message
 * @property string|null $email
 * @property string|null $source
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|ContactForm newModelQuery()
 * @method static Builder<static>|ContactForm newQuery()
 * @method static Builder<static>|ContactForm query()
 * @method static Builder<static>|ContactForm whereCreatedAt($value)
 * @method static Builder<static>|ContactForm whereEmail($value)
 * @method static Builder<static>|ContactForm whereId($value)
 * @method static Builder<static>|ContactForm whereMessage($value)
 * @method static Builder<static>|ContactForm whereName($value)
 * @method static Builder<static>|ContactForm wherePhone($value)
 * @method static Builder<static>|ContactForm whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class ContactForm extends Model
{
    /** Lead submitted through the main contact page (/contact-us). */
    public const SOURCE_CONTACT_PAGE = 'contact-us';

    /** Lead submitted through the SaaS development landing (/development/saas). */
    public const SOURCE_SAAS_LANDING = 'development-saas';

    /** Lead submitted through the business software landing (/development/business). */
    public const SOURCE_BUSINESS_LANDING = 'development-business';

    /** Lead submitted through the Laravel development landing (/development/laravel). */
    public const SOURCE_LARAVEL_LANDING = 'development-laravel';

    /** Lead submitted through the Symfony development landing (/development/symfony). */
    public const SOURCE_SYMFONY_LANDING = 'development-symfony';

    /** Lead submitted through the API & integrations landing (/development/api-integrations). */
    public const SOURCE_API_INTEGRATIONS_LANDING = 'development-api-integrations';

    /** Lead submitted through the PHP/Laravel support & upgrades landing (/development/php-support). */
    public const SOURCE_PHP_SUPPORT_LANDING = 'development-php-support';

    /** Lead submitted through the PHP code audit landing (/development/php-audit). */
    public const SOURCE_PHP_AUDIT_LANDING = 'development-php-audit';

    protected $fillable = ['first_name', 'last_name', 'name', 'email', 'phone', 'message', 'source'];
}
