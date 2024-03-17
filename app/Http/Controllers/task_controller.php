<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
class task_controller extends Controller
{
    public function index()
    {
        // เรียกดูหน้าแสดงรายการ Task ทั้งหมด
        $data['Projects'] = Project::all();
        $data['User'] = User::all();
        return view('task/index',$data);

    }
    public function getTasks()
    {
      $Tasks = Task::all();
      return response()->json($Tasks);
    }
    public function create()
    {
        // แสดงแบบฟอร์มสำหรับสร้าง Task ใหม่
        return view('tasks/create');
    }

    public function store(Request $request)
    {
        // สร้าง Task ใหม่จากข้อมูลที่ส่งมาจากฟอร์ม
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        // แสดงแบบฟอร์มสำหรับแก้ไข Task
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // อัปเดตข้อมูลของ Task จากข้อมูลที่ส่งมาจากฟอร์ม
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        // ลบ Task
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
