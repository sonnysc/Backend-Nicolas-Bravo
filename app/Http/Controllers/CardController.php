<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Muestra una lista de tarjetas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cards = Card::all();

        foreach ($cards as $card) {
            $card->imageSrc = asset('storage/' . $card->imageSrc);
        }

        return response()->json($cards);
    }

    /**
     * Almacena una nueva tarjeta o actualiza una existente.
     *
     * @param Request $request
     * @param int|null $id
     * @return JsonResponse
     */
    public function store(Request $request, $id = null): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string|max:255',
            'pdfLink' => 'nullable|url',
        ]);

        if ($id) {
            // Actualizar tarjeta existente
            $card = Card::findOrFail($id);

            // Manejar la imagen
            if ($request->hasFile('image')) {
                // Eliminar la imagen antigua si existe
                if ($card->imageSrc) {
                    Storage::disk('public')->delete($card->imageSrc);
                }

                // Almacenar la nueva imagen
                $imagePath = $request->file('image')->store('images', 'public');
                $card->imageSrc = $imagePath;
            } else {
                // Si no se proporciona una nueva imagen, conservar la imagen existente
                $card->imageSrc = $card->imageSrc;
            }
        } else {
            // Crear nueva tarjeta
            $card = new Card();

            // Manejar la imagen
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $card->imageSrc = $imagePath;
            }
        }

        $card->title = $request->input('title');
        $card->pdfLink = $request->input('pdfLink');
        $card->save();

        $card->imageSrc = asset('storage/' . $card->imageSrc);

        return response()->json($card, 200);
    }

    // Método para eliminar una tarjeta
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        if ($card->imageSrc) {
            Storage::disk('public')->delete($card->imageSrc);
        }
        $card->delete();

        return response()->json(null, 204);
    }
}
