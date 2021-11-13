<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use GuzzleHttp\Promise\Create;

class student_Controller extends Controller
{
    public function index()
    {
        $student = Student::all();
        return response()->json($student);
    }
    public function show($id)
    {
        $student = Student::find($id);

        if ($student == null) {
            $error_message = [
                "message" => "data not found"
            ];
            return response()->json($error_message, 404);
        }
        return response()->json($student, 200);

        $nama = $student->nama;
        echo "hallo, $nama";
    }
    public function create(Request $request)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::create(
            [
                "nim" => $nim,
                "nama" => $nama,
                "email" => $email,
                "jurusan" => $jurusan
            ]
        );
        $data = [
            "message" => "data student is created",
            "data" => $student,
        ];
        return response()->json($data, 201);
    }
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::find($id);
        if ($student) {
            $student->update(
                [
                    'nama' => ($nama ? $nama : $student->nama),
                    'nim' => ($nim ? $nim : $student->nim),
                    'email' => ($email ? $email : $student->email),
                    'jurusan' => ($jurusan ? $jurusan : $student->jurusan)
                ]
            );
            $student = Student::where('id', $id)->get();
            $data = [
                "message" => "data student is Updated",
                "data" => $student,
            ];
            return response()->json($data, 200);
        } else
            $data = [
                "message" => "data not found",
            ];
        return response()->json($data, 404);
    }


    public function destroy($id)
    {
        $student =  Student::find($id);
        if ($student) {
            $student->delete();
            $data = [
                "message" => "data Student is delete",
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                "message" => "data not found",
            ];
            return response()->json($data, 404);
        }
    }
}
