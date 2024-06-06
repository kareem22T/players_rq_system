<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;

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

    public function store(UserCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['id'] = $request->id;
        $validatedData['code'] = $request->code;
        $user = User::find($request->id);

        if ($user)
            $user = $user->update($validatedData);
        else
            $user = User::create($validatedData);

        return redirect()->route('user.show', ["uuid" => $request->id, "code" => $request->code]);
    }
}
