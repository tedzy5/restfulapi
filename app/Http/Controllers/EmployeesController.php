<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index() {
        return response()->json(Employee::all(), 200);
    }

    public function show($id) {
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Oops! Client not found.'], 404);
        } else {
            return response()->json(Employee::find($id), 200);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|min:10',
            'code' => 'required|numeric'
        ]);

        $employee = Employee::create($request->all());
        return response($employee, 201);

    }

    public function update(Request $request, $id) {
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Oops! Employee is not found!'], 404);
        } else {
            $employee->update($request->all());
            return response($request, 200);
        }
    }

    public function destroy(Request $request, $id) {
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Oops, client is not found!']);
        } else {
            $employee->delete();
            return response()->json(['message' => 'Employee successfully deleted.'], 204);
        }
    }
}
