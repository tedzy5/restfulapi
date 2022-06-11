<?php

namespace App\Http\Controllers;

use App\Models\Client;
use http\Env\Response;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index() {
        return response()->json(Client::all(), 200);
    }

    public function show($id) {
        $client = Client::find($id);
        if(is_null($client)) {
            return response()->json(['message' => 'Oops! Client not found.'], 404);
        } else {
            return response()->json(Client::find($id), 200);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|min:10',
            'age' => 'required|numeric',
            'address' => 'min:3'
        ]);

        $client = Client::create($request->all());
        return response($client, 201);

    }

    public function update(Request $request, $id) {
        $client = Client::find($id);
        if(is_null($client)) {
            return response()->json(['message' => 'Oops! Client is not found!'], 404);
        } else {
            $client->update($request->all());
            return response($request, 200);
        }
    }

    public function destroy(Request $request, $id) {
        $client = Client::find($id);
        if(is_null($client)) {
            return response()->json(['message' => 'Oops, client is not found!']);
        } else {
            $client->delete();
            return response()->json(['message' => 'Client successfully deleted.'], 204);
        }
    }
}
