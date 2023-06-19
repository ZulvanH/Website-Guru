<?php


namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Carbon\Carbon;

class DiscussionController extends Controller
{
    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'forums';
    }

    public function create(){
        return view('creatediscussion');
    }
    public function index(){
        $forums =  $this->database->getReference( $this->tablename )->getValue();
        return view('Discussion', compact('forums'));

    }

    public function store(Request $request)
    {
        $waktu = $request->tanggal;
        $waktuFormatted = date('j F Y', strtotime($waktu));
        $postData = [
            'Forum_title' => $request->forum_title,
            'author' => $request->author,
            'kelas' => $request->kelas,
            'topic_title' => $request->topic_title,
            'topic_content' => $request->topic_content,
            'date' => $waktuFormatted,
        ];

        $postRef = $this->database->getReference($this->tablename)->push();
        $postKey = $postRef->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

        $postData['forum_id'] = $postKey; // Menggunakan kunci ID sebagai nilai ID dalam data

        $postRef->set($postData);

        if ($postKey) {
            return redirect('Discussion')->with('status', 'Discussion Added Successfully');
        } else {
            return redirect('Discussion')->with('status', 'Discussion not Added');
        }
    }

      public function detail($id)
{
    $key = $id;
    $forum = $this->database->getReference($this->tablename)->getChild($key)->getValue();
    $comments = $this->database->getReference($this->tablename)->getChild($key)->getChild('comments')->getValue();

    if ($forum) {
        return view('discussiondetail', compact('forum', 'comments'));
    } else {
        // Handle the case when $forum or $comments is null
        // For example, you can redirect the user to an error page or display an error message.
        return redirect()->back()->with('error', 'Discussion not found');
    }
}

public function edit($id){
    $key =$id;
    $editdata =$this->database->getReference($this->tablename)->getChild($key)->getValue();
    if($editdata){
        return view('editdiscussion', compact('editdata', 'key'));
    }
    // else {
    //     return redirect('Courses')->with('status','Courses ID not Found');
    // }
}

public function update(Request $request , $id){
    $key = $id;
    $waktu = $request->tanggal;
    $waktuFormatted = date('j F Y', strtotime($waktu));
    $updateData = [
        'Forum_title' => $request->forum_title,
        'author' => $request->author,
        'kelas' => $request->kelas,
        'topic_title' => $request->topic_title,
        'topic_content' => $request->topic_content,
        'date' => $waktuFormatted,
    ];
   $res_updated =  $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

    if($res_updated){
        return redirect('Discussion')->with('status','Discussion Updated Successfully');
    }
    else {
        return redirect('Discussion')->with('status','Discussion Not Updated Successfully');
    }
}

public function delete ($id){
    $key= $id;
    $del_data =  $this->database->getReference($this->tablename.'/'.$key)->remove();
    if($del_data){
        return redirect('Discussion')->with('status','Discussion Deleted Successfully');
    } else {
        return redirect('Discussion')->with('status','Discussion Not Deleted Successfully');
    }
}


public function addcomment(Request $request, $id){
    $key = $id;
    $timestamp = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
    $postData = [
        'comments' => [
            'cooment_content' => $request->message,
            'user_name' => $request->user_name,
            'timestamp' => $timestamp,
        ]
    ];

    $reference = $this->database->getReference($this->tablename);

    $res_updated =  $reference->getChild($key)->getChild('comments')->push($postData['comments']);
    $postKey = $res_updated->getKey(); // Mendapatkan kunci ID baru yang dihasilkan oleh Firebase

    $postData['comments']['id_comment'] = $postKey; // Menggunakan kunci ID sebagai nilai material_id dalam data

    $res_updated->set($postData['comments']);

    if($res_updated){
        return redirect('details/'.$key);
    }

         else {
            return redirect('Discussion');
        }


}



public function search(Request $request)
{
    $option1Value = $request->input('option1');
    $option2Value = $request->input('option2');
    $option3Value = $request->input('option3');
    $query = $request->input('query');

    $results = [];

    $ref = $this->database->getReference('forums');

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
        if (strpos($result['Forum_title'], $query) !== false) {
            $queryResults[] = $result;
        }
    }

    return view('DiscussionSearching', ['results' => $queryResults, 'query' => $query]);
}





}
