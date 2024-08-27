<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function getAllNotes()
    {
        $notes = Note::get();
        $res = [
            "status"=>201,
            "notes"=> $notes

        ];
        return response()->json($res);
    }
    public function getOneNote(Request $request)
    {
        $note = Note::find($request->id);
        if ($note == null) 
        {
            return response()->json(["message"=> "Note not found"], 404);
        }
        else
        {
            $res = 
            [
                "status"=> 200,
                "note" => $note,
            ];
            return response()->json($res);
        }
    }

    public function createNote(Request $request)
    {
        
        $validator = Validator::make($request->all(), 
        [
            "serial" => 'required|integer|unique:notes,serial',
            "topic" => "required|string",
            "description" => "required|string" 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $newNote = Note::create($request->all());
            $res = [
                'status'=> 201,
                'note'=> $newNote,
            ];
            return response()->json($res);
        }
      
    }
    public function deleteNote(Request $request)
    {
        $note = Note::find($request->id);
        $note->delete();
        $res = [
            "message" =>"deleted successfully",
            "status"=> 200,
            "data" =>$note,

        ];
        return response()->json($res);
    }

    public function updateNote(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
        [
            "serial" => 'required|integer|unique:notes,serial',
            "topic" => "required|string",
            "description" => "required|string" 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $note = Note::find($id);
            if(!$note)
            {
                return response()->json(["message" => 'Note not found'], 404);
            }
            $note->update($request->all());
            $res = [
                'status'=> 200,
                'message'=>'Updated successfully',
                'note'=> $note,
            ];
            return response()->json($res);
        }
    }

    public function editNote(Request $request, $id)
    {
        $note = Note::find($id);
        if(!$note)
        {
            return response()->json(["message" => 'Note not found'], 404);
        }
        $validator = Validator::make($request->all(), 
        [
            "serial" => 'sometimes|required|integer|unique:notes,serial',
            "topic" => "sometimes|required|string",
            "description" => "sometimes|required|string" 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else
        {
            $note->update($validator->validate());
            $res = [
                'status'=> 200,
                'message'=>'Edited successfully',
                'note'=> $note,
            ];
            return response()->json($res);
        }
    }
}

