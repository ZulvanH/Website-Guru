<?php


namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Database\Query\Filter;
use Kreait\Firebase\Database\Query\OrderBy;

class ExamController extends Controller
{
    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'Exam';
    }

    public function create(){
        return view('createexam');
    }

    public function index(){
        $Exam =  $this->database->getReference( $this->tablename )->getValue();
        return view('Exam', compact('Exam'));

    }

    public function store(Request $request){
        $postData = [
            'name' => $request->exam_name,
            'description' => $request->description,
            'kelas' => $request->kelas,
            'deadline' =>$request->tanggal,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);
        $postKey = $postRef->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['exam_id'] = $postKey; // Menggunakan kunci ID sebagai nilai ID dalam data

        $postRef->set($postData);
        if($postRef){
            return redirect('Exam')->with('status','Exam Added Successfully');
        } else {
            return redirect('Exam')->with('status','Exam not Added');
        }
      }

      public function edit($id){
        $key =$id;
        $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata){
            return view('editexam', compact('editdata', 'key'));
        }
        // else {
        //     return redirect('Courses')->with('status','Courses ID not Found');
        // }
    }

    public function update(Request $request , $id){
        $key = $id;
        $updateData = [
            'name' => $request->exam_name,
            'description' => $request->description,
            'kelas' => $request->kelas,
            'deadline' =>$request->tanggal,
        ];
       $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_updated){
            return redirect('Exam')->with('status','Exam Updated Successfully');
        }
        else {
            return redirect('Exam')->with('status','Exam Not Updated Successfully');
        }
    }

    public function delete ($id){
        $key= $id;
        $del_data =  $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data){
            return redirect('Exam')->with('status','Exam Deleted Successfully');
        } else {
            return redirect('Exam')->with('status','Exam Not Deleted Successfully');
        }
    }




      public function search(Request $request)
{
    $option1Value = $request->input('option1');
    $option2Value = $request->input('option2');
    $option3Value = $request->input('option3');
    $query = $request->input('query');

    $results = [];

    // Create a reference to the "Exam" node
    $ref = $this->database->getReference('Exam');

    // Perform the initial search based on option1, option2, and option3
    if (!empty($option1Value)) {
        $ref = $ref->orderByChild('option1')->equalTo($option1Value);
    }

    $snapshot = $ref->getSnapshot();

    // Iterate over the initial results and add them to the array
    foreach ($snapshot->getValue() as $key => $value) {
        // Perform additional filtering based on option2Value and option3Value
        if (!empty($option2Value) && isset($value['option2']) && $value['option2'] !== $option2Value) {
            continue; // Skip if option2 doesn't match
        }

        if (!empty($option3Value) && isset($value['option3']) && $value['option3'] !== $option3Value) {
            continue; // Skip if option3 doesn't match
        }

        $results[] = $value;
    }

    // Perform the query search on the filtered results
    $queryResults = [];
    foreach ($results as $result) {
        // Perform the query matching on the desired field, e.g., 'name'
        if (strpos($result['name'], $query) !== false) {
            $queryResults[] = $result;
        }
    }

    return view('ExamSearching', ['results' => $queryResults, 'query' => $query]);
}




    }
