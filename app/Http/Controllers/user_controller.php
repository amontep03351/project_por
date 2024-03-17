<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class user_controller extends Controller
{
    public function __construct()
    {
        // ทำงานที่ต้องการทุกครั้งเมื่อมีการเรียกใช้งาน Controller นี้
    }

    public function index()
    {
        return view('user/index');
    }
    public function getUsers()
    {
        $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมดจากฐานข้อมูล
        return response()->json($users); // ส่งข้อมูลผู้ใช้กลับเป็น JSON response
    }
    public function create()
    {
        return view('user/create');
    }
    public function store(Request $request)
    {
        try {
            // Validate ข้อมูลที่ส่งมาจากแบบฟอร์ม
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // สร้างผู้ใช้ใหม่
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json(['success' => true, 'message' => 'บันทึกข้อมูลผู้ใช้ใหม่เรียบร้อยแล้ว']);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->validator->getMessageBag()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function edit()
    {
        // หาข้อมูลผู้ใช้โดยใช้ ID ที่ระบุ
        $id  = request('id');
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function updateUser(Request $request)
    {
      try {
        // ค้นหาข้อมูลผู้ใช้ที่ต้องการอัปเดต
        $user = User::findOrFail($request->input('Editid'));

        // อัปเดตข้อมูลด้วยข้อมูลใหม่ที่ส่งมาจากแบบฟอร์ม
        if ($request->input('Editpassword')!='') {
          $user->update([
              'name' => $request->input('Editname'),
              'email' => $request->input('Editemail'),
              'password' => Hash::make($request->input('Editpassword')),
              // อัปเดตฟิลด์อื่น ๆ ตามต้องการ
          ]);
        }else {
          $user->update([
              'name' => $request->input('Editname'),
              'email' => $request->input('Editemail'),
              // อัปเดตฟิลด์อื่น ๆ ตามต้องการ
          ]);
        }


        // ส่งการตอบกลับเป็น JSON ยืนยันว่าข้อมูลได้ถูกอัปเดตเรียบร้อยแล้ว
         return response()->json(['success' => true, 'message' => 'User updated successfully']);
      } catch (ValidationException $e) {
          return response()->json(['success' => false, 'errors' => $e->validator->getMessageBag()]);
      } catch (\Exception $e) {
          return response()->json(['success' => false, 'message' => $e->getMessage()]);
      }

    }

}
