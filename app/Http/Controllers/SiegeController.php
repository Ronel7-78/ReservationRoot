<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiegeController extends Controller
{
    public function getSieges($voyageId): JsonResponse
    {
        // Récupérer le voyage avec ses sièges
        $voyage = Voyage::with('bus.sieges')->findOrFail($voyageId);

        // Vérifier si le bus a des sièges
        if ($voyage->bus && $voyage->bus->sieges) {
            return response()->json([
                'sieges' => $voyage->bus->sieges,
            ]);
        }

        return response()->json(['sieges' => []]);
    }
}
