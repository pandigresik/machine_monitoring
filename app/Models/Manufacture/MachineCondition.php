<?php

namespace App\Models\Manufacture;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="MachineCondition",
 *      required={"machine_id", "shiftment_id", "work_date", "start", "end", "amount_minutes"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="machine_id",
 *          description="machine_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="shiftment_id",
 *          description="shiftment_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="work_date",
 *          description="work_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="uom_id",
 *          description="uom_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class MachineCondition extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'machine_conditions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'machine_id',
        'shiftment_id',
        'work_date',
        'start',
        'end',
        'amount_minutes',
        'category_off_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'machine_id' => 'integer',
        'shiftment_id' => 'integer',
        'work_date' => 'date',
        'start' => 'datetime',
        'end' => 'datetime',
        'amount_minutes' => 'decimal:2',
        'category_off_id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'machine_id' => 'required',
        'shiftment_id' => 'required',
        'work_date' => 'required',
        'start' => 'required',
        'end' => 'required',
        // 'amount_minutes' => 'required|numeric',
        'description' => 'nullable|string|max:200'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function machine()
    {
        return $this->belongsTo(\App\Models\Base\Machine::class, 'machine_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shiftment()
    {
        return $this->belongsTo(\App\Models\Base\Shiftment::class, 'shiftment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Base\CategoryOff::class, 'category_off_id');
    }

    public function getWorkDateAttribute($value){
        return localFormatDate($value);
    }

    public function getStartAttribute($value){
        return localFormatDateTime($value);
    }

    public function getEndAttribute($value){
        return localFormatDateTime($value);
    }

    public function getAmountMinutesAttribute($value){
        return localNumberFormat($value, 0);
    }
}
