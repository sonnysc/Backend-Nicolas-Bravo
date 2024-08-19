<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Recupera todos los comunicados de la base de datos
        $announcements = Announcement::all();

        // Devuelve los comunicados en formato JSON
        return response()->json($announcements);
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos del request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'content' => 'required|string',
                'logo' => 'required|string|max:255',
            ]);

            // Crear el nuevo anuncio
            $announcement = new Announcement();
            $announcement->title = $validatedData['title'];
            $announcement->date = $validatedData['date'];
            $announcement->content = $validatedData['content'];
            $announcement->logo = $validatedData['logo'];
            $announcement->save();

            // Obtener el anuncio completo después de guardarlo
            $savedAnnouncement = Announcement::find($announcement->id);

            // Devolver el anuncio completo
            return response()->json($savedAnnouncement, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            $announcement->delete();
            return response()->json(['message' => 'Comunicado eliminado exitosamente']);
        }

        return response()->json(['message' => 'Comunicado no encontrado'], 404);
    }
}
