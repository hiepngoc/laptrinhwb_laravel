<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Nếu bạn đã đổi khóa chính trong migration thành 'id',
    // bạn có thể bỏ dòng protected $primaryKey vì 'id' là mặc định.
    // protected $primaryKey = 'location_id'; // XÓA DÒNG NÀY NẾU ĐÃ ĐỔI TRONG MIGRATION

    protected $fillable = [
        'location_name',
        'location_image',
        // Thêm các trường khác mà bạn muốn cho phép gán hàng loạt
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class, 'location_id', 'id');
        // Lưu ý: Khóa ngoại là 'location_id' trong bảng 'tours',
        // và khóa chính bây giờ là 'id' trong bảng 'locations'.
    }
}