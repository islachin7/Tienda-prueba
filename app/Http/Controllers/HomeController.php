<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Ciudad;
use App\Models\Distrito;
use App\Models\Departamento;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(Request $request)
    {
        $categorias = Categoria::select('*')->get();
        $subcategorias = SubCategoria::select('*')->get();
        $distritos = Distrito::select('*')->get();
        $departamentos = Departamento::select('*')->get();
        $ciudades = Ciudad::select('*')->get();
        $productos = Producto::select('*')->ByStock();
    
        $productos = $productos->paginate(8);
        $productos->appends($request->all());
        return view('index', compact('productos', 'categorias','subcategorias','distritos','departamentos','ciudades'));
    }

    public function contacto(Request $request)
    {
        $categorias = Categoria::take(5)->get();
        $productos = Producto::select('*')->ByStock();
          
        $productos = $productos->paginate(8);
        $productos->appends($request->all());
        return view('contacto', compact('productos', 'categorias'));
    }

    public function filtroNombre(Request $request)
    {
        
        $productos = Producto::select('*')->ByStock();
        
        if($request->has('nombre') && $request->filled('nombre')){
            $productos->where('producto.nombre', 'like', '%'.$request->nombre.'%');
        }  
        
        $productos = $productos->paginate(8);
        $productos->appends($request->all());
        return view('productos.filtro', compact('productos'));
        
    }


    public function filtroPrecio(Request $request)
    {
        
        $productos = Producto::select('*')->ByStock();
        
        if($request->has('precio') && $request->filled('precio')){
            $productos->orderBy('producto.precio', $request->precio);
        } 
        
        $productos = $productos->paginate(8);
        $productos->appends($request->all());
        return view('productos.filtro', compact('productos'));
        
    }


    public function filtroCategoria(Request $request)
    {
        
        $productos = Producto::select('*')->ByStock();
        
        if($request->has('categoria') && $request->filled('categoria')){
            $productos->BySubCatergoria($request->categoria);
        }
        
        $productos = $productos->paginate(8);
        $productos->appends($request->all());
        return view('productos.filtro', compact('productos'));
        
    }


    public function ciudad(Request $request)
    {
        $ciudades = Ciudad::select('*')
        ->where('idDepa', $request->valor)
        ->get();

        return view('ubigeo.ciudad', compact('ciudades'));
    }

    public function distrito(Request $request)
    {
        $distritos = Distrito::select('*')
        ->where('idCiu', $request->valor)
        ->get();

        return view('ubigeo.distrito', compact('distritos'));
    }

}
