<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class dashboard_controller extends Controller
{
    public function __construct()
    {
        // ทำงานที่ต้องการทุกครั้งเมื่อมีการเรียกใช้งาน Controller นี้
    }

    public function index()
    {
        return view('login/index');
    }
    public function dashboard()
    {
        return view('dashboard/index');
    }

    public function Home()
    {
      $data['projects'] = Project::all();
      return view('dashboard/home',$data);
    }
    public function getListTask()
    {
      $id  = request('id');
      $data['project'] = Project::getProjectById($id);
      return view('dashboard/TaskList',$data);

    }
}
