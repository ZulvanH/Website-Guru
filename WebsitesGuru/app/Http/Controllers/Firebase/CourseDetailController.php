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

class CourseDetailController extends Controller
{

    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'courses';
    }

    public function index($id) {
        $key = $id;
        // dd($key);
        $moduleshead = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        $modulesRef = $this->database->getReference($this->tablename)->getChild($key)->getChild('modules');
        $courses = $modulesRef->getValue();
        $convertedURLs = [];

        if (!empty($courses)) {
            foreach ($courses as $key => $course) {
                // Mengambil nilai videoURL dari realtime database
                $videoURL = isset($course['youtube']) ? $course['youtube'] : '';


                $convertedURL = str_replace("watch?v=", "embed/", $videoURL);

                // Menyimpan hasil konversi dalam array
                $convertedURLs[$key] = $convertedURL;
            }
        }
    //    dd( $moduleshead);

        return view('CoursesDetail', compact('courses', 'convertedURLs' ,'moduleshead'));
    }

    public function create($id){
        $key=$id;
        $moduleshead = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        $reference = $this->database->getReference($this->tablename);
        $courseData = $reference->getChild($key)->getChild('modules')->getValue();
        $courseID = null;

        if ($courseData) {
            $courseID = key($courseData);
        }
        return view('Createmodulecourses', compact('courseID' , 'moduleshead'));
    }

    public function store(Request $request , $id)
    {
        $key = $id;
        $file = $request->file('file');
        $keyFilePath = 'C:\Websitesguru\layoutregisterlogin-1f4db6e9a935.json'; // Update this path to the actual path of your credentials file

        $storage = new StorageClient([
            'keyFilePath' => $keyFilePath,
        ]);

        $folderPath = 'images';
        $bucket = $storage->bucket('layoutregisterlogin.appspot.com');
        $fileName = null;
        $soalUrl = null;

        if ($file) {
            $fileName = $folderPath . '/' . $file->getClientOriginalName();
            $fileContents = file_get_contents($file->getRealPath());

            $object = $bucket->upload($fileContents, [
                'name' => $fileName
            ]);

            // Generate a signed URL for the uploaded file
            $expiresAt = strtotime('+1 week'); // Set the expiration time as needed
            $soalUrl = $bucket->object($fileName)->signedUrl($expiresAt);
        }

        $postData = [
            'modules' => [
                'name' => $request->course_name,
                'kelas' => $request->kelas,
                'subject' => $request->subject,
                'description' => $request->description,
                'youtube' => $request->youtubeurl,
                'fileUrl' => $soalUrl,
            ]
        ];

        $reference = $this->database->getReference($this->tablename);

        $res_updated =  $reference->getChild($key)->getChild('modules')->push($postData['modules']);
        $postKey = $res_updated->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['modules']['material_id'] = $postKey; // Menggunakan kunci ID sebagai nilai material_id dalam data

        $res_updated->set($postData['modules']);

        // $reference = $this->database->getReference($this->tablename);
        // $snapshot = $reference->getSnapshot();
        // $children = $snapshot->getValue();

        //     if (!empty($children)) {
        //         foreach ($children as $childKey => $childData) {
        //             $childReference = $reference->getChild($childKey);
        //             $childReference->getChild('modules')->push($postData['modules']);
        //         }

        if($res_updated){
            return redirect('CourseDetail/'.$key)->with('status', 'Material Added Successfully');
        }

             else {
                return redirect('CoursesDetail')->with('status', 'Material not Added');
            }
        }

        public function edit($id)
        {
            $key = $id;
            $reference = $this->database->getReference($this->tablename);

            $courseData = $reference->getValue();
            $courseID = null;

            if ($courseData) {
                foreach ($courseData as $courseKey => $course) {
                    if (isset($course['modules'][$key])) {
                        $courseID = $courseKey;
                        break;
                    }
                }
            }

            $editdata = null;

            if ($courseID) {
                if (isset($courseData[$courseID]['modules'][$key])) {
                    $editdata = $courseData[$courseID]['modules'][$key];
                }
            }

            // dd($editdata);
            if ($editdata) {
                return view('editmodulescourses', compact('editdata', 'key', 'courseID'));
            } else {
                // return redirect('Courses')->with('status', 'Course ID not Found');
            }
        }

        public function update(Request $request, $id)
        {
            $key = $id;
            $reference = $this->database->getReference($this->tablename);
            $file = $request->file('file');
            $keyFilePath = 'C:\Websitesguru\layoutregisterlogin-1f4db6e9a935.json'; // Update this path to the actual path of your credentials file

            $storage = new StorageClient([
                'keyFilePath' => $keyFilePath,
            ]);

            $folderPath = 'images';
            $bucket = $storage->bucket('layoutregisterlogin.appspot.com');
            $fileName = null;
            $soalUrl = null;

            if ($file) {
                $fileName = $folderPath . '/' . $file->getClientOriginalName();
                $fileContents = file_get_contents($file->getRealPath());

                $object = $bucket->upload($fileContents, [
                    'name' => $fileName
                ]);

                // Generate a signed URL for the uploaded file
                $expiresAt = strtotime('+1 week'); // Set the expiration time as needed
                $soalUrl = $bucket->object($fileName)->signedUrl($expiresAt);
            }
            $updateData = [
                'name' => $request->course_name,
                'kelas' => $request->kelas,
                'description' => $request->description,
                'youtube' => $request->youtubeurl,
                'fileUrl' => $soalUrl,
            ];


            $courseData = $reference->getValue();
            $courseID = null;

            if ($courseData) {
                foreach ($courseData as $courseKey => $course) {
                    if (isset($course['modules'][$key])) {
                        $courseID = $courseKey;
                        break;
                    }
                }
            }
            // dd($courseID);

            if ($courseID) {
                $res_updated = $reference->getChild($courseID)->getChild('modules')->getChild($key)->update($updateData);

                if ($res_updated) {
                    return redirect('CourseDetail/'.$courseID)->with('status', 'Material Updated Successfully');
                } else {
                    return redirect('CourseDetail/'.$courseID)->with('status', 'Material Not Updated Successfully');
                }
            }

            return redirect('CourseDetail/'.$courseID)->with('status', 'Course ID not found');
        }

    public function delete ($id){
        $key = $id;
        $reference = $this->database->getReference($this->tablename);

        $courseData = $reference->getValue();
        $courseID = null;

        if ($courseData) {
            foreach ($courseData as $courseKey => $course) {
                if (isset($course['modules'][$key])) {
                    $courseID = $courseKey;
                    break;
                }
            }
        }
        if ($courseID) {
            $del_data =  $reference->getChild($courseID)->getChild('modules')->getChild($key)->remove();
        }
        if($del_data){
            return redirect('CourseDetail/'.$courseID)->with('status','Material Deleted Successfully');
        } else {
            return redirect('CourseDetail/'.$courseID)->with('status','Material Not Deleted Successfully');
        }
    }

    public function search(Request $request, $id)
{
    $key=$id;
    $moduleshead = $this->database->getReference($this->tablename)->getChild($key)->getValue();
    $query = $request->input('query');
    $option2Value = $request->input('kurikulum');
    $option3Value = $request->input('kelas');

    // dd($option2Value);
    // dd($option3Value);
    $reference = $this->database->getReference($this->tablename);

    $courseData = $reference->getValue();

    $results=[];

    foreach ($courseData as $courseKey => $course) {
        if (isset($course['modules']) && is_array($course['modules'])) {
            $modules = $course['modules'];
            $filteredModules = array_filter($modules, function ($module) use ($query, $option2Value, $option3Value) {
                return $module['name'] === $query
                    && (empty($option2Value) || ($option2Value === 'Nasional' && $module['kurikulum'] === $option2Value))
                    && (empty($option3Value) || $module['kelas'] === $option3Value);
            });

            $results = array_merge($results, $filteredModules);
        }
    }
    return view('CourseDetailSearch', compact('results', 'query', 'moduleshead'));

    // return view('CourseDetailSearch', ['results' => $results, 'query' => $query]);
}

    }
