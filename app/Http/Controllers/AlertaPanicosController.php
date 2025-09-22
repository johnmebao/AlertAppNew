<?php

namespace App\Http\Controllers;

use App\Models\AlertaPanicos;
use App\Http\Requests\StoreAlertaPanicosRequest;
use App\Http\Requests\UpdateAlertaPanicosRequest;
use App\Models\Sede;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;

class AlertaPanicosController extends Controller
{
    public function config()
    {
        $config = [
            'sede_id' => session('sede_id'),
            'consultorio' => session('consultorio'),
            'tipo' => session('tipo'),
        ];
        $sedes = Sede::all();
        return view('alerta.configuracion', compact('sedes', 'config'));
    }

    public function guardarConfiguracion(HttpRequest $request)
    {
        $request->validate([
            'sede_id' => 'required|exists:sedes,id',
            'consultorio' => 'required|string|max:255',
            'tipo' => 'required',
        ]);

        session([
            'sede_id' => $request->input('sede_id'),
            'consultorio' => $request->input('consultorio'),
            'tipo' => $request->input('tipo'),
        ]);

        return redirect()->route('alerta.boton.mostrar');
    }

    public function mostrarBoton()
    {
        if (!session()->has('sede_id') || !session()->has('consultorio') || !session()->has('tipo')) {
            return redirect()->route('alerta.configuracion');
        }

        return view('alerta.boton');
    }

    public function activarPanico()
    {
        $sedeId = session('sede_id');
        $consultorio = session('consultorio');
        $tipo = session('tipo');
        $usuario = Auth::user();
        $telefono = $usuario->telefono;

        $alerta = AlertaPanicos::create([
            'usuario_id' => $usuario->id,
            'sede_id' => $sedeId,
            'consultorio' => $consultorio,
            'tipo' => $tipo,
            'hora_evento' => now(),
        ]);

        $sede = Sede::find($sedeId);
        //dd($sede);
        $sedeNombre = $sede->nombre;
        $telefonoSede = $sede->telefono; // Cambia a telefono si tu campo se llama diferente
        $mensaje = "🚨 *Alerta de Pánico* 🚨\n\n" .
            "📍 Sede: $sedeNombre\n" .
            "🔔 Tipo: $tipo\n" .
            "📌 Ubicación: $tipo - $consultorio\n" .
            "📱 Teléfono Sede: $telefonoSede\n" .
            "👤 Usuario: {$usuario->name}\n" .
            "⏰ Hora: " . now()->format('Y-m-d H:i:s');

        $exito = $this->enviarAlertaTelegram($mensaje);

        //dd($mensaje);

        if (!$exito) {
            return redirect()->back()->with('status', 'Error al enviar la alerta a Telegram.');
        }

        return redirect()->back()->with('status', 'Alerta enviada con éxito, se activará equipo de seguridad de la sede.');
    }

    protected function enviarAlertaTelegram($mensaje)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        try {
            $response = Http::get("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $mensaje
            ]);

            if ($response->successful()) {
                return true;
            } else {
                Log::error('Fallo al enviar mensaje a Telegram', [
                    'response' => $response->body(),
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Excepción al enviar mensaje a Telegram', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
