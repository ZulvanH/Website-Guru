<?php


namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Google\Cloud\Core\Exception\ServiceException;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Firestore;
use App\Models\Video;

class CourseController extends Controller
{

    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'courses';
    }

    public function index() {
        $courses = $this->database->getReference($this->tablename)->getValue();
        // $convertedURLs = [];

        // if (!empty($courses)) {
        //     foreach ($courses as $key => $course) {
        //         // Mengambil nilai videoURL dari realtime database
        //         $videoURL = $course['youtube'];

        //         $convertedURL = str_replace("watch?v=", "embed/", $videoURL);

        //         // Menyimpan hasil konversi dalam array
        //         $convertedURLs[$key] = $convertedURL;
        //     }
        // }

        return view('Courses', compact('courses'));
    }

    public function create(){
        return view('createcourses');
    }

    public function store(Request $request){

        $postData = [
            'name_Course' => $request->course_name,
            'kelas' => $request->kelas,
            // 'subject' => $request->subject,
            'Course_description' => $request->description,
            // 'youtube' => $request->youtubeurl,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);
        $postKey = $postRef->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['course_id'] = $postKey; // Menggunakan kunci ID sebagai nilai ID dalam data

        $postRef->set($postData);

        // $childKey = $postRef->getKey(); // Mendapatkan kunci anak yang dihasilkan

        // // Menambahkan atribut baru ke data yang ada
        // $modulesData = [
        //     'modules_id' => $childKey,
        //     'kurikulum' => $request->kurikulum,
        //     'name' => $request->course_name,
        //     'kelas' => $request->kelas,
        //     'subject' => $request->subject,
        //     'description' => $request->description,
        //     'youtube' => $request->youtubeurl,
        // ];

        // $modulesRef = $this->database->getReference($this->tablename.'/'.$childKey.'/modules');
        // $id = $modulesRef->push()->getKey(); // Mendapatkan ID kunci baru
        // $modulesRef->getChild($id)->set($modulesData); // Menambahkan atribut dengan ID kunci

        if($postRef){
            return redirect('Courses')->with('status', 'Course Added Successfully');
        } else {
            return redirect('Courses')->with('status', 'Courses not Added');
        }
    }

    public function edit($id){
        $key =$id;
        $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editdata){
            return view('editcourse', compact('editdata', 'key'));
        }
        // else {
        //     return redirect('Courses')->with('status','Courses ID not Found');
        // }
    }

    public function update(Request $request , $id){
        $key = $id;
        $updateData = [
            'name_Course' => $request->course_name,
            'kelas' => $request->kelas,
            'Course_description' => $request->description,
        ];
       $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_updated){
            return redirect('Courses')->with('status','Courses Updated Successfully');
        }
        else {
            return redirect('Courses')->with('status','Courses Not Updated Successfully');
        }
    }

    public function delete ($id){
        $key= $id;
        $del_data =  $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data){
            return redirect('Courses')->with('status','Courses Deleted Successfully');
        } else {
            return redirect('Courses')->with('status','Courses Not Deleted Successfully');
        }
    }


    public function uploadFile(Request $request)
    {
        // Check if a file was uploaded
        if ($request->hasFile('file')) {
            // Ambil file yang diunggah dari request
            $file = $request->file('file');

            // Simpan file ke Firebase Storage
            $storage = new StorageClient([
                'projectId' => 'layoutregisterlogin',
            ]);
            $bucket = $storage->bucket('layoutregisterlogin.appspot.com/Images');
            $bucket->upload(
                fopen($file->getRealPath(), 'r'),
                [
                    'name' => $file->getClientOriginalName()
                ]
            );

            // Berhasil mengunggah file
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            // Handle the case when no file was uploaded
            return response()->json(['message' => 'No file uploaded'], 400);
        }
    }


    public function upload(Request $request)
    {
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
        // $cleanUrl = str_replace('\\', '', $signedUrl);

        return response()->json(['success' => true, 'message' => 'File uploaded successfully', 'url' =>  $signedUrl]);
    }

    public function testing1()
    {
        // $credentialsFilePath = __DIR__ . '/layoutregisterlogin-1f4db6e9a935.json';
        $credentialsFilePath = env('GOOGLE_APPLICATION_CREDENTIALS');
        if (file_exists($credentialsFilePath)) {
            $serviceAccount = (new Factory)->withServiceAccount($credentialsFilePath);
            dd($serviceAccount);
            // File exists, proceed with using it
            // Your code to use the credentials file
            // ...
        } else {
            // File does not exist
            echo "The credentials file does not exist.";
        }

    }
    public function search(Request $request)
{
    $option1Value = $request->input('subject');
    $option2Value = $request->input('kurikulum');
    $option3Value = $request->input('kelas');
    $query = $request->input('query');

    $results = [];

    $ref = $this->database->getReference('courses');

    // Perform the initial search based on option1, option2, and option3
    if (!empty($option1Value)) {
        $ref = $ref->orderByChild('subject')->equalTo($option1Value);
    }

    $snapshot = $ref->getSnapshot();

    // Iterate over the initial results and add them to the array
    foreach ($snapshot->getValue() as $key => $value) {
        // Perform additional filtering based on option2Value and option3Value
        if (!empty($option2Value) && isset($value['kurikulum']) && $value['kurikulum'] !== $option2Value) {
            continue; // Skip if option2 doesn't match
        }

        if (!empty($option3Value) && isset($value['kelas']) && $value['kelas'] !== $option3Value) {
            continue; // Skip if option3 doesn't match
        }

        $results[] = $value;
    }

    // Perform the query search on the filtered results
    $queryResults = [];
    foreach ($results as $result) {
        // Perform the query matching on the desired field, e.g., 'name'
        if (strpos($result['name_Course'], $query) !== false) {
            $queryResults[] = $result;
        }
    }
    $reference = $this->database->getReference($this->tablename);
    $courseData = $reference->getValue();
    $courseID = null;

    if ($courseData) {
        $courseID = key($courseData);
    }

    return view('CourseSearching', ['results' => $queryResults, 'query' => $query, 'id'=>$courseID]);
}

}




