<?php


namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ScheduleController extends Controller
{

    private $database;
    private $tablename;
    private $tablename1;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'Schedule';
        $this->tablename1 = 'user/teacher';
    }

    public function create(){
        return view('createSchedule');
    }


    public function store(Request $request)
    {
        $waktu = $request->tanggal;
        $waktuFormatted = date('j F Y', strtotime($waktu));
        $postData = [
            'schedule_title' => $request->schedule_title,
            'kelas' => $request->kelas,
            'date' => $waktuFormatted,
            'StartTime' => $request->waktu1,
            'EndTime' => $request->waktu2,
        ];

        $postRef = $this->database->getReference($this->tablename)->push();
        $postKey = $postRef->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['schedule_id'] = $postKey; // Menggunakan kunci ID sebagai nilai ID dalam data

        $postRef->set($postData);

        if ($postKey) {
            return redirect('Schedule')->with('status', 'Schedule Added Successfully');
        } else {
            return redirect('Schedule')->with('status', 'Schedule not Added');
        }
    }

    public function index(){
        $schedule =  $this->database->getReference( $this->tablename )->getValue();
        return view('Schedule', compact('schedule'));

    }

    public function edit($id){
        $key =$id;
        $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata){
            return view('editSchedule', compact('editdata', 'key'));
        }
        // else {
        //     return redirect('Schedule')->with('status','Schedule ID not Found');
        // }
    }

    public function update(Request $request , $id){
        $key = $id;
        $waktu = $request->tanggal;
        $waktuFormatted = date('j F Y', strtotime($waktu));
        $updateData = [
            'schedule_title' => $request->schedule_title,
            'kelas' => $request->kelas,
            'date' => $waktuFormatted,
            'time' => $request->waktu,
            'StartTime' => $request->waktu1,
            'EndTime' => $request->waktu2,
        ];
       $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_updated){
            return redirect('Schedule')->with('status','Schedule Updated Successfully');
        }
        else {
            return redirect('Schedule')->with('status','Schedule Not Updated Successfully');
        }
    }

    public function delete ($id){
        $key= $id;
        $del_data =  $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data){
            return redirect('Schedule')->with('status','Schedule Deleted Successfully');
        } else {
            return redirect('Schedule')->with('status','Schedule Not Deleted Successfully');
        }
    }

    public function Beranda(){

        $schedule =  $this->database->getReference( $this->tablename )->getValue();
        $user = $this->database->getReference( $this->tablename1 )->getValue();
        return view('Beranda', compact('schedule','user'));

    }

}
