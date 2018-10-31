<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use App\Reserva;
use Auth;
//use App\User;
use Illuminate\Http\Request;

class ReservaController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if (Auth::check()) {
             $reservas = Reserva::where('user_id', Auth::user()->id)->get();
            return view('reserva.index',compact('reservas'));
        }
        else{
             return Redirect('/login'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        if (Auth::check()){            
            $allreservas = $this->AllCheck();
            
            return view('reserva.create')->with('allreservas',$allreservas);
        }else{
            return Redirect('/login'); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if (Auth::check()) {
            //validaciones
            $this->validate($request,[
                'Names'=>'required|string',
                'LastName'=>'required|string',
                'NoPersonas'=>'required|integer',
                'Butacas'=>'required|array'
            ]);
                
            //Almacenamiento
            $reserva = new Reserva;
            $reserva->Names = $request->Names;
            $reserva->LastName = $request->LastName;
            $reserva->NoPersonas = $request->NoPersonas;
            $reserva->Butacas = serialize($request->Butacas);                       
            $reserva->user_id = Auth::user()->id;
            $reserva->save();

            //Redirecionamiento
            return Redirect('/home')->with('success'," Se ha guardado con exito su reserva.");
        }else{
            return Redirect('/login'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    //public function show(Reserva $reserva)
    public function show($id)
    {     
        if (Auth::check()) {   
            $reserva = Reserva::findOrFail($id);
            $butacas = unserialize($reserva->Butacas);
            // return view('reserva.show', ['reserva' => Reserva::findOrFail($id)]);
            return view('reserva.show', ['reserva' => $reserva])->with('butacas',$butacas);
        }else{
            return Redirect('/login'); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    // public function edit(Reserva $reserva)
    public function edit($id)
    {
        if (Auth::check()) {
            $reserva = Reserva::findOrFail($id);
            $butacas = unserialize($reserva->Butacas);
            $allreservas = $this->AllCheck();
            return view('reserva.edit',compact('reserva'))->with('butacas',$butacas)->with('allreservas',$allreservas);
        }else{
            return Redirect('/login'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Reserva $reserva)
    public function update(Request $request, $id)
    {
        //dd($request);
        if (Auth::check()) {
            //validaciones 
            $rules = array(
                'Names'=>'required|string',
                'LastName'=>'required|string',
                'NoPersonas'=>'required|integer',
                'Butacas'=>'required|array'
            );
            $messages = [
                'Names.required' => 'El campo nombres es requerido.',
                'LastName.required'=> 'El campo apellidos es requerido.',
                'NoPersonas.required' => 'el campo numero de personas es requerido.',
                'Butacas.required' => 'Debe de seleccionar las bancas para el numero de personas.'
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            
            if ($validator->fails()) {
                return Redirect('Reservas/' . $id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            }else{                
                //Almacenamiento
                $reserva = new Reserva;
                $reserva = Reserva::find($id);
                $reserva->Names = $request->Names;
                $reserva->LastName = $request->LastName;
                $reserva->NoPersonas = $request->NoPersonas;
                $reserva->Butacas = serialize($request->Butacas);                       
                $reserva->user_id = Auth::user()->id;
                $reserva->save();

                return Redirect('/home')->with('success'," Se ha actualizado con exito su reserva.");;
            }
        }else{
            return Redirect('/login'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        if (Auth::check()) {
            $reserva = Reserva::findOrFail($id);
            $reserva->delete();            
            return Redirect('/home');
        }else{
            return Redirect('/login'); 
        }
    }

    public function AllCheck(){            
        try{
            // $reserva = Reserva::all();
            //$butacas = unserialize($reserva->Butacas);
           
            //return Reserva::all();//unserialize($reserva->Butacas);
            return Reserva::where('user_id', Auth::user()->id)->get();    
        } 
        catch(\Exception $e){
            //return Redirect('/home')->with('success'," Se ha guardado con exito su reserva");
        }
    }
}
