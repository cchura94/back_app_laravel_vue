<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filas = $request->rows?$request->rows:5;
        $productos = Producto::with('categoria')->paginate($filas);

        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required"
        ]);

        // guardar
        $prod = new Producto();
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock;
        $prod->categoria_id = $request->categoria_id;
        $prod->descripcion = $request->descripcion;
        $prod->save();

        //responder
        return response()->json(["mensaje" => "Producto registrado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Producto::findOrFail($id);
        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function actualizarImagen(Request $request)
    {
        if($file = $request->file("imagen")){
            $direccion_archivo = time() . "-" . $file->getClientOriginalName();
            $file->move("imagenes/", $direccion_archivo);

            $prod = Producto::find($request->producto_id);
            $prod->imagen = "imagenes/$direccion_archivo";
            $prod->save();

            return response()->json(["mensaje" => "Imagen Actualizada"]);
        }
    }
}
