<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'pan_no' => 'required',
            'emailid' => 'required|email',
            'mobileno' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'pan_no' => 'required',
            'emailid' => 'required|email',
            'mobileno' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function showUploadForm()
    {
        return view('upload');
    }

    public function processUpload(Request $request)
    {
    // Validate the uploaded file
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    // Move the uploaded file to a designated directory
    $file = $request->file('csv_file');
    $filePath = $file->store('uploads');

    // Process the CSV file
    $csv = Reader::createFromPath(storage_path('app/' . $filePath), 'r');
    $csv->setHeaderOffset(0);

    $failedRows = [];
    $validRows = [];
    $duplicateRecords = [];

    $existingEmails = DB::table('users')->pluck('emailid')->toArray();

    foreach ($csv as $index => $row) {
        // Extract the data from each row
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $fullName = $row['fullname'];
        $panNo = $row['pan_no'];
        $email = $row['emailid'];
        $mobileNo = $row['mobileno'];

        // Perform validation on the data
        $validator = Validator::make([
            'firstname' => $firstName,
            'lastname' => $lastName,
            'fullname' => $fullName,
            'pan_no' => $panNo,
            'emailid' => $email,
            'mobileno' => $mobileNo,
        ], [
            'firstname' => 'required',
            'lastname' => 'required',
            'fullname' => 'required',
            'pan_no' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'emailid' => 'required|email',
            'mobileno' => 'required|regex:/^\d{10}$/',
        ]);

        if ($validator->fails()) {
            // Store the failed rows with their respective validation errors
            $failedRows[] = [
                'row' => $index + 1,
                'data' => $row,
                'errors' => $validator->errors()->all(),
            ];
        } else {
            // Check for duplicate email records
            if (in_array($email, $existingEmails) || isset($validRows[$email])) {
                $duplicateRecords[] = [
                    'row' => $index + 1,
                    'data' => $row,
                    'errors' => ['Duplicate record'],
                ];
            } else {
                // Save the valid data to the temporary array
                $validRows[$email] = [
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'fullname' => $fullName,
                    'pan_no' => $panNo,
                    'emailid' => $email,
                    'mobileno' => $mobileNo,
                ];
            }
        }
    }

    // Remove duplicates from the temporary array
    $validRows = array_values($validRows);

    // Insert the valid data into the database
    DB::table('users')->insert($validRows);

    // Pass the failed rows, duplicate records, and validation messages to the view
    return view('upload-results')
        ->with('failedRows', $failedRows)
        ->with('duplicateRecords', $duplicateRecords);
    }
}
