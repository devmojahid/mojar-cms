<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\Backend\Models\Email;

use Mojar\CMS\Models\Model;

/**
 * Mojar\Backend\Models\Email\EmailTemplateUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplateUser query()
 * @mixin \Eloquent
 */
class EmailTemplateUser extends Model
{
    protected $table = 'email_template_users';
    protected $fillable = ['user_id', 'email_template_id'];
}
