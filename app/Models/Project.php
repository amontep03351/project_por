<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Project extends Model
{
    use HasFactory;

    protected $table = 'tb_project'; // กำหนดชื่อตารางในฐานข้อมูล

    protected $primaryKey = 'project_id'; // กำหนด primary key ของตาราง

    protected $fillable = [ // กำหนดฟิลด์ที่ใช้ในการเพิ่มข้อมูลแบบ Mass Assignment
        'project_name',
    ];
    // เมธอดสำหรับ query โปรเจคตาม project_id
    public static function getProjectById($id)
    {
        // ใช้คำสั่ง SQL เพื่อ query ข้อมูลโปรเจคตาม project_id ที่ระบุ
        $sql = "SELECT A.*,B.name FROM tb_tasks A
        LEFT JOIN users B ON  B.id = A.user_id
        WHERE A.project_id  = ?";

        // ใช้คำสั่ง DB::select() เพื่อทำการ query และรับผลลัพธ์เป็น array
        $projects = DB::select($sql, [$id]);

        // ส่งผลลัพธ์กลับเป็น array ของโปรเจค (หรือ null หากไม่พบข้อมูล)
        return $projects;
    }
}
