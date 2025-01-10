<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class UserController extends Controller
{
    public function chunk_index(){
        $usersData = [];
        Student::chunk(3, function ($users) use (&$usersData) {
            foreach ($users as $user) {
                $usersData[] = $user; // Collect all data to send to view
            }
            
        });
        return $usersData;
    }

    public function chunk_update(){
        Student::where("age",26)->chunkById(3,function($student){
            $student->each->update(["age"=>30]);
        });
    }

    public function lazy_index(){
        $student=Student::lazy();
        return $student;
    }


    public function lazy_update(){
        $student=Student::where('age',30)->lazyById(3)->each->update(["age"=>26]);
    }

}
