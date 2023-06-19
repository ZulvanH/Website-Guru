<?php


namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Google\Cloud\Storage\StorageClient;


class AssignmentController extends Controller
{
    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'Assignment';
    }

    public function create(){
        return view('createassignment');
    }

    public function index(){
        $Assignment =  $this->database->getReference( $this->tablename )->getValue();
        return view('Assignment', compact('Assignment'));

    }

    public function store(Request $request){
        $file = $request->file('file');
        $keyFilePath = 'C:\Websitesguru\layoutregisterlogin-1f4db6e9a935.json'; // Update this path to the actual path of your credentials file

        $storage = new StorageClient([
            'keyFilePath' => $keyFilePath,
        ]);

        $folderPath = 'images';
        $bucket = $storage->bucket('layoutregisterlogin.appspot.com');
        $fileName = $folderPath . '/' . $file->getClientOriginalName();
        $fileContents = file_get_contents($file->getRealPath());

        $object = $bucket->upload($fileContents, [
            'name' => $fileName
        ]);

        // Generate a signed URL for the uploaded file
        $expiresAt = strtotime('+1 week'); // Set the expiration time as needed
        $signedUrl = $bucket->object($fileName)->signedUrl($expiresAt);

        $postData = [
            'name' => $request->assignment_name,
            'mata_pelajaran' =>$request->subject,
            'kelas' => $request->kelas,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'SoalUrl' => $signedUrl,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        $postKey = $postRef->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['assignment_id'] = $postKey; // Menggunakan kunci ID sebagai nilai ID dalam data

        $postRef->set($postData);
        if($postRef){
            return redirect('Assignment')->with('status','Assignment Added Successfully');
        } else {
            return redirect('Assignment')->with('status','Assignment not Added');
        }
      }
      public function edit($id){
        $key =$id;
        $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata){
            return view('EditAssignment', compact('editdata', 'key'));
        }
        else {
            return redirect('Assignment')->with('status','Assignment ID not Found');
        }
}

public function update(Request $request , $id){
    $key = $id;
    $file = $request->file('file');
    $keyFilePath = 'C:\Websitesguru\layoutregisterlogin-1f4db6e9a935.json'; // Update this path to the actual path of your credentials file

    $storage = new StorageClient([
        'keyFilePath' => $keyFilePath,
    ]);

    $folderPath = 'images';
    $bucket = $storage->bucket('layoutregisterlogin.appspot.com');
    $fileName = $folderPath . '/' . $file->getClientOriginalName();
    $fileContents = file_get_contents($file->getRealPath());

    $object = $bucket->upload($fileContents, [
        'name' => $fileName
    ]);

    // Generate a signed URL for the uploaded file
    $expiresAt = strtotime('+1 week'); // Set the expiration time as needed
    $signedUrl = $bucket->object($fileName)->signedUrl($expiresAt);
    $updateData = [
        'name' => $request->assignment_name,
        'kelas' => $request->kelas,
        'description' => $request->description,
        'deadline' => $request->deadline,
        'SoalUrl' => $signedUrl,
    ];

   $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
    if($res_updated){
        return redirect('Assignment')->with('status','Assignment Updated Successfully');
    }
    else {
        return redirect('Assignment')->with('status','Assignment Not Updated Successfully');
    }
}
public function delete ($id){
    $key= $id;
    $del_data =  $this->database->getReference($this->tablename.'/'.$key)->remove();
    if($del_data){
        return redirect('Assignment')->with('status','Assignment Deleted Successfully');
    } else {
        return redirect('Assignment')->with('status','Assignment Not Deleted Successfully');
    }
}

public function search(Request $request)
{
    $option1Value = $request->input('option1');
    $option2Value = $request->input('option2');
    $option3Value = $request->input('option3');
    $query = $request->input('query');

    $results = [];

    $ref = $this->database->getReference('Assignment');

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

    return view('AssignmentSearching', ['results' => $queryResults, 'query' => $query]);
}


}
