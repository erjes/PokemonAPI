<?php

namespace App\Http\Controllers;

use App\Models\pokemonModel;
use Illuminate\Http\Request;

class pokemonController extends Controller
{
    public function index()
    {
        return response()->json(['results' => pokemonModel::all()]);
    }

    public function catch(Request $request)
    {
        $pokemon = $request->input('name');
        $isCaught = rand(0, 1) ? true : false;

        if ($isCaught) {
            pokemonModel::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Congratulations! ' . $pokemon .' Has been caught ',
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Oh no! The Pokemon escaped.',
            ]);
        }
    }


    public function release($id)
    {
        $randomNumber = rand(1, 21);
        if ($randomNumber <= 1) {
            return response()->json([
                'message' => 'Your number is '.$randomNumber.', Pokemon was not released.',
            ]);
        }

        for ($i = 2; $i <= sqrt($randomNumber); $i++) {
            if ($randomNumber % $i === 0) {
                return response()->json([
                    'message' => 'Your number is '.$randomNumber.', Pokemon was not released.',
                ]);
            }
        }

        pokemonModel::destroy($id);

        return response()->json([
            'message' => $randomNumber.' Pokemon released successfully.',
        ]);
    }



    public function rename($id, Request $request)
    {
        $pokemon = PokemonModel::findOrFail($id);
        $originalName = $pokemon->name;
        $currentNickname = $pokemon->nickname;
        $nickname = $request->input('nickname');

        $lastHyphenPos = strrpos($originalName, '-');
        $baseName = $lastHyphenPos !== false ? substr($originalName, 0, $lastHyphenPos) : $originalName;
        $index = $lastHyphenPos !== false ? intval(substr($originalName, $lastHyphenPos + 1)) : 0;

        if ($nickname !== null || $index <= 1) {
            $index++;
        } else {
            $index = 0;
        }

        $newName = $baseName . '-' . $index;

        if($currentNickname == null){
            $pokemon->update([
                'name' => $baseName . '-0',
                'nickname' => $nickname
            ]);
        }else{
            $pokemon->update([
                'name' => $newName,
                'nickname' => $nickname
            ]);
        }

        return response()->json([
            'message' => 'Pokemon has been renamed to ' . $newName,
        ]);
    }



}
