<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Http\Exports\ApplicantsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index() {
        return view("user.index");
    }
    public function showForm($uuid, $code)
    {
        // Extract the letter and number from the code
        if (preg_match('/^([A-Z])(\d+)$/i', $code, $matches)) {
            $letter = strtoupper($matches[1]);  // Ensure the letter is uppercase
            $number = (int) $matches[2];

            // Calculate the user ID based on the pattern
            $letterValue = ord($letter) - ord('A');
            $id = $letterValue * 500 + $number;

            // Check if the computed ID matches the UUID and is within the valid range
            if ($id == $uuid && $id > 0 && $id <= 5000) {
                $user = User::where('id', $id)->first();

                if ($user) {
                    return redirect()->route('user.show', ["uuid" => $user->id, "code" => $user->code]);
                } else {
                    return view('user.form', compact('uuid', "code"));
                }
            }
        }
        // If the code pattern does not match, ID does not match UUID, or ID is out of range, return a 404 page
        abort(404);
    }

    public function getUser($uuid, $code) {
        // Extract the letter and number from the code
        if (preg_match('/^([A-Z])(\d+)$/i', $code, $matches)) {
            $letter = strtoupper($matches[1]);  // Ensure the letter is uppercase
            $number = (int) $matches[2];

            // Calculate the user ID based on the pattern
            $letterValue = ord($letter) - ord('A');
            $id = $letterValue * 500 + $number;

            // Check if the computed ID matches the UUID and is within the valid range
            if ($id == $uuid && $id > 0 && $id <= 5000) {
                $user = User::where('id', $id)->first();

                if ($user) {
                    return view('user.show', compact(['uuid', "user", "code"]));
                } else {
                    return redirect()->route('user.add', ["uuid" => $id, "code" => $code]);
                }
            }
        }
        // If the code pattern does not match, ID does not match UUID, or ID is out of range, return a 404 page
        abort(404);

    }

    public function editIndex($uuid, $code) {
        // Extract the letter and number from the code
        if (preg_match('/^([A-Z])(\d+)$/i', $code, $matches)) {
            $letter = strtoupper($matches[1]);  // Ensure the letter is uppercase
            $number = (int) $matches[2];

            // Calculate the user ID based on the pattern
            $letterValue = ord($letter) - ord('A');
            $id = $letterValue * 500 + $number;

            // Check if the computed ID matches the UUID and is within the valid range
            if ($id == $uuid && $id > 0 && $id <= 5000) {
                $user = User::where('id', $id)->first();

                if ($user) {
                    return view('user.edit', compact(['uuid', "user", "code"]));
                } else {
                    return redirect()->route('user.add', ["uuid" => $id, "code" => $code]);
                }
            }
        }
        // If the code pattern does not match, ID does not match UUID, or ID is out of range, return a 404 page
        abort(404);

    }

    public function delete(Request $request) {
        $user = User::where('id', $request->id)->first();
        if ($user)
            $user->delete();

        return redirect()->back()
        ->with('success', 'تم الحفظ بنجاح');;

    }

    public function updatePhase(Request $request) {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->phase = $request->phase;
            $user->save();
        }

        return redirect()->back()
        ->with('success', 'تم الحفظ بنجاح');;

    }

    public function getUserId(Request $request)
    {
        $code = $request->input('code');

        // Validate the code pattern
        if (!preg_match('/^[a-jA-J][1-9][0-9]{0,2}$/', $code)) {
            return redirect()->back()->withErrors(["error" => 'هذا الرمز غير متوفر']);
        }

        // Extract letter and number
        $letter = strtolower($code[0]);
        $number = intval(substr($code, 1));

        // Check if number is within the valid range
        if ($number < 1 || $number > 500) {
            return redirect()->back()->withErrors(["error" => 'هذا الرمز غير متوفر']);
        }

        // Assuming you have a method to get the user ID based on the letter position
        // Here, we'll just return the letter position for demonstration
        // Replace this with actual user ID retrieval logic
        $userId = $number + ((ord($letter) - ord('a')) * 500);

        return redirect()->route("user.form", ["uuid" => $userId, "code" => $code]);
    }

    public function store(UserCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['id'] = $request->id;
        $validatedData['code'] = $request->code;
        $validatedData['created_at'] = Carbon::now('GMT+3');
        $user = User::find($request->id);

        if ($user)
            $user = $user->update($validatedData);
        else
            $user = User::create($validatedData);


        return redirect()->to('/')
        ->with('success', 'تم الحفظ بنجاح');;
    }

    public function export(Request $request)
    {
        $users = User::query();
        return Excel::download(new ApplicantsExport($users), 'players.xlsx');
    }

}
