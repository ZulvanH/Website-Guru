<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ReportController extends Controller
{
    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'Assignment';
    }

    public function search(){
        $assignments = []; // Array to store assignments with file URL

        $ref = $this->database->getReference('Assignment');
        $ref2 = $this->database->getReference('Exam');

        $snapshot = $ref->getSnapshot();

foreach ($snapshot->getValue() as $key => $value) {
    if (isset($value['fileUrl']) && !empty($value['SoalUrl'])) {
        $assignments[$key] = $value;
        $assignments[$key]['isEditing'] = false;
    }
}


return view('Report', compact('assignments'));
    }

    public function edit($id){
        $key =$id;
        $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata){
            return view('editreport', compact('editdata', 'key'));
        }
        else {
            return redirect('Report');
        }

}
public function update(Request $request , $id){
    $key = $id;
    $updateData = [
        'score' =>$request->score,
        'comment' => $request->comment,
    ];
   $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
    if($res_updated){
        return redirect('Report')->with('status','Report Updated Successfully');
    }
    else {
        return redirect('Report')->with('status','Report Not Updated Successfully');
    }

}



}
