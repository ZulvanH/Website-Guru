<?php
namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;

class AuthController extends Controller
{

    private $database;
    private $tablename;
    public function __construct(Database $database){
        $this->database = $database;
        $this->tablename = 'user';
    }

    public function showLoginForm()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $factory = (new Factory)
            ->withServiceAccount('C:\Websitesguru\layoutregisterlogin-1f4db6e9a935.json')
            ->withDatabaseUri('https://layoutregisterlogin-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withProjectId('layoutregisterlogin');

        $database = $factory->createDatabase();

        // Ambil data pengguna dari real-time database
        $teacherRef = $database->getReference('user/teacher');
        $teacherSnapshot = $teacherRef->orderByChild('username')->equalTo($credentials['username'])->getSnapshot();

        if ($teacherSnapshot->hasChildren()) {
            $teacherData = $teacherSnapshot->getValue();

            // Ambil data teacher pertama (asumsi hanya ada satu data)
            $teacherId = key($teacherData);
            $teacher = $teacherData[$teacherId];

            if ($teacher['password'] === $credentials['password']) {
                // Perform authentication
                // ...

                // Set authentication successful flag

                $authenticationSuccessful = true;

                if ($authenticationSuccessful) {
                    return redirect('Beranda')->with('status', 'Login Successfully')->with('auth', $authenticationSuccessful);
                }
            } else {
                return back()->withInput()->withErrors(['password' => 'Password salah']);
            }
        } else {
            return back()->withInput()->withErrors(['username' => 'Username tidak valid']);
        }
    }


public function updatePassword()
{
    // Dapatkan data pengguna dari Firebase berdasarkan ID atau email pengguna
    $user = $this->database->getReference('user/teacher/SfHnaTFnHDRxJoDXOpUSFq3wMuw2')->getValue();

    // Lakukan tindakan sesuai kebutuhan untuk mengganti password, misalnya menampilkan halaman form untuk mengganti password
    // Anda dapat menggunakan view atau redirect ke halaman form password baru
    // dd($user);

    return view('Updateprofile')->with('user', $user);
}

public function changePassword(Request $request)
{
    // $userId = $request->input('user_id');
    $newPassword = $request->input('password');
    $confirmPassword = $request->input('password_confirmation');

    // Lakukan validasi password baru dan konfirmasi password

    if ($newPassword === $confirmPassword) {
        // Dapatkan referensi ke pengguna yang sesuai di Firebase berdasarkan ID atau email pengguna
        $userRef = $this->database->getReference("user/teacher/SfHnaTFnHDRxJoDXOpUSFq3wMuw2");

        // Update password pengguna di Firebase
        $userRef->update([
            'password' => $newPassword
        ]);

        // Lakukan tindakan sesuai kebutuhan setelah berhasil mengubah password
        // Misalnya, mengirim email konfirmasi ke pengguna atau memberikan respons sukses ke pengguna

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    return redirect()->back()->with('error', 'Password and confirmation password do not match');
}



}
