<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Validation\ValidationException;

class project_controller extends Controller
{
    public function __construct()
    {
        // ทำงานที่ต้องการทุกครั้งเมื่อมีการเรียกใช้งาน Controller นี้
    }

    public function index()
    {
        return view('project/index');
    }
    public function getProjects()
    {
       $projects = Project::all();
       return response()->json($projects);
    }
    public function create()
    {
        return view('user/create');
    }
    public function store(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
       $existingProject = Project::where('project_name', $request->projectName)->first();
       if ($existingProject) {
           return response()->json(['success' => true, 'message' => 'ชื่อโปรเจคถูกใช้ไปแล้ว']);

       }else {
         // สร้างโปรเจคใหม่
          $project = new Project();
          $project->project_name = $request->projectName;
          $project->save();

          return response()->json(['success' => true, 'message' => 'บันทึกข้อมูลโปรเจคใหม่เรียบร้อยแล้ว']);
       }

    }

    public function edit()
    {
        // หาข้อมูลผู้ใช้โดยใช้ ID ที่ระบุ
        $id  = request('id');
        $Project = Project::findOrFail($id);
        return response()->json($Project);
    }
    public function updateproject(Request $request)
    {
      try {
        // ค้นหาข้อมูลที่ต้องการอัปเดต
        $Project = Project::findOrFail($request->input('Editid'));
        $Project->update([
            'project_name' => $request->input('EditProjectname'),
        ]);

        // ส่งการตอบกลับเป็น JSON ยืนยันว่าข้อมูลได้ถูกอัปเดตเรียบร้อยแล้ว
         return response()->json(['success' => true, 'message' => 'Project updated successfully']);
      } catch (ValidationException $e) {
          return response()->json(['success' => false, 'errors' => $e->validator->getMessageBag()]);
      } catch (\Exception $e) {
          return response()->json(['success' => false, 'message' => $e->getMessage()]);
      }

    }

}
