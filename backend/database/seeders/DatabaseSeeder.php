<?php

namespace Database\Seeders;

use App\Models\Assignment_request;
use App\Models\check_log;
use App\Models\Leave_request;
use App\Models\Project;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\TaskUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
       $jsonFilePath = "./database/seeders/data.json";
       $jsonContent = file_get_contents($jsonFilePath);
       $dataArray = json_decode($jsonContent, true);
       foreach ($dataArray['company'] as $data) { Company::create($data);}
       foreach ($dataArray['department'] as $data) { Department::create($data);}
       foreach ($dataArray['role'] as $data) { Role::create($data);}
       foreach ($dataArray['status'] as $data) { Status::create($data);}

       foreach ($dataArray['user'] as $data) {
        User::factory()->create([
            'name' => $data['name'],
            'username' => $data['username'], 
            'email' =>  $data['email'],
            'avatar' => $data['avatar'], 
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'role_id' =>$data['role_id'],
            'status_id' => $data['status_id'],
            'password' =>Hash::make($data['password']), 
            'limit_remaining'=> $data['limit_remaining'],
            ]);
       }

       foreach ($dataArray['project'] as $data) { Project::create($data);}
       foreach ($dataArray['task'] as $data) { Task::create($data);}
       foreach ($dataArray['task_user'] as $data) { TaskUser::create($data);}
       foreach ($dataArray['assignment_request'] as $data) { Assignment_request::create($data);}
       foreach ($dataArray['leave_request'] as $data) { Leave_request::create($data);}
       foreach ($dataArray['check_log'] as $data) { Check_log::create($data);}

    }
}
