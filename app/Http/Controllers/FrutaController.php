<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fruta;

class FrutaController extends Controller {

    public function listar() {
        $frutas = Fruta::all();
        return view('listar', ['frutas' => $frutas]);
    }

    public function insertar(Request $request) {
        $fruta = new Fruta();
        $fruta->nombre = $request->post('nombre');
        $fruta->precio = $request->post('precio');

        $fruta->save();

        return redirect('/')->with('mensaje', 'Fruta creada correctamente');
    }

    public function eliminar($id) {
        $fruta = Fruta::findOrFail($id);
        $fruta->delete();
        return redirect('/')->with('mensaje', 'Se eliminó correctamente');
    }

    public function mostrarFormularioDeEdicion($id) {
        $fruta = Fruta::findOrFail($id);
        return view('editar', ['fruta' => $fruta]);
    }

    public function modificar(Request $request) {
        $fruta = Fruta::findOrFail($request->post('id'));
        $fruta->nombre = $request->post('nombre');
        $fruta->precio = $request->post('precio');

        $fruta->save();
        return redirect('/')->with('mensaje', 'Fruta editada correctamente');
    }
}
