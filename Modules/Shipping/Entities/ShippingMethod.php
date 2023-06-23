<?php

namespace Modules\Shipping\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Translatable\HasTranslations;

class ShippingMethod extends Model
{
    use HasFactory , HasTranslations;
    protected $guarded = ['id'];
    public $translatable = [];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (isModuleActive('FrontendMultiLang')) {
            $this->translatable = ['method_name'];
        }
    }
    public function request_user()
    {
        return $this->belongsTo(User::class,'request_by_user','id')->withDefault();
    }

    public function methodUse(){
        return $this->hasMany(ProductShipping::class,'shipping_method_id', 'id');
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class,'carrier_id','id')->withDefault();
    }
}
