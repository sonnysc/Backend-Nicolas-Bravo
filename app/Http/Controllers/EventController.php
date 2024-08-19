<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Validación de imágenes
        ]);

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');

        // Guardar imágenes
        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $path = $image->store('images', 'public'); // Guarda en storage/app/public/images
            $imagePaths[] = Storage::url($path); // Obtiene la URL pública
        }
        $event->images = json_encode($imagePaths);
        $event->save();

        return response()->json($event, 201);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $images = json_decode($event->images);
        
        // Verificar y eliminar las imágenes
        foreach ($images as $imagePath) {
            // Construir la ruta del archivo relativo
            $relativePath = str_replace('/storage/', '', $imagePath);
            
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            } else {
                // Puedes registrar esto en el log para depuración
                \Log::warning("File does not exist: $relativePath");
            }
        }
        
        $event->delete();
        
        return response()->json(null, 204);
    }
}
