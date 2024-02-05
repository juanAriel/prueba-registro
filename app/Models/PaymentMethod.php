<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 *
 * @property $id
 * @property $card_number
 * @property $exp_time
 * @property $type_pay
 * @property $code-card
 * @property $price
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaymentMethod extends Model
{
    
    static $rules = [
		'card_number' => 'required',
		'exp_time' => 'required',
		'type_pay' => 'required',
		'code_card' => 'required',
		'price' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['card_number','exp_time','type_pay','code_card','price'];



}
