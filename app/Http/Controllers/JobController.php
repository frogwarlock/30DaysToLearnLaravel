<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{ // its not necessary due to Laravel already having a 'Route::resource' method
  //what it does is create all the routes for the resource controller
  //when using RESTful or RESTful-like routes
    public function index(){
        $jobs = Job::with('employer')->latest()->simplePaginate(4); //eager loading - reduce sql queries.

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create(){
        return view('jobs.create');
    }

    public function show(Job $job){
        return view('jobs.show', ['job' => $job]);
    }

    public function store(){
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        return redirect('/jobs');
    }

    public function edit(Job $job){

        return view('jobs.edit', [ 'job' => $job ]);
    }

    public function update(Job $job){
        //authorize (On hold)

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);


        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/'. $job->id);
    }

    public function destroy(Job $job){
        //authorize - on hold

        $job->delete();

        return redirect('/jobs');
    }

}

