<?php

namespace App\Models\Manufacture;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="MachineAvailability",
 *      required={"machine_id", "shiftment_id", "work_date", "duration_target", "uom_id"},
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
 *          property="duration_target",
 *          description="standart duration machine work",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="duration_off",
 *          description="duration_off",
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
class MachineAvailability extends Model
{
    use HasFactory;
    //     use SoftDeletes;

    public $table = 'machine_availabilities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'machine_id',
        'shiftment_id',
        'work_date',
        'duration_target',
        'duration_off',
        'uom_id'
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
        'duration_target' => 'decimal:2',
        'duration_off' => 'decimal:2',
        'uom_id' => 'integer'
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
        'duration_target' => 'required|numeric',
        'duration_off' => 'nullable|numeric',
        'uom_id' => 'required'
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
    public function uom()
    {
        return $this->belongsTo(\App\Models\Base\Uom::class, 'uom_id');
    }

    protected function getWorkDateAttribute($value){
        return localFormatDate($value);
    }
}
