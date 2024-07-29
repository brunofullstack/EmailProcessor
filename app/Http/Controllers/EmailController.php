<?php

namespace App\Http\Controllers;

use App\Models\SuccessfulEmail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        $email = SuccessfulEmail::create($request->all());
        // Processar o e-mail recém-criado
        (new \App\Console\Commands\ProcessEmails)->handle();
        return response()->json($email, 201);
    }

    public function show($id)
    {
        $email = SuccessfulEmail::findOrFail($id);
        return response()->json($email);
    }

    public function update(Request $request, $id)
    {
        $email = SuccessfulEmail::findOrFail($id);
        $email->update($request->all());
        return response()->json($email);
    }

    public function index()
    {
        $emails = SuccessfulEmail::all();
        return response()->json($emails);
    }

    public function destroy($id)
    {
        SuccessfulEmail::destroy($id);
        return response()->json(['message' => 'Registro deletado com sucesso']);
    }
}
