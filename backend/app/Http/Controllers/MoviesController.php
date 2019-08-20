<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
class MoviesController extends Controller
{
    //

    public function favorites(Request $request){
        $user = $request->user();
        $favorite_movies = Movie::where('user_id', $user->id)->get();
       return response()->json($favorite_movies, 201);
    }

   

    public function popular(Request $request){
        $user = $request->user();
        $page = isset($request->page) ? $request->page : 1; 
        $api_key = env('API_KEY_MOVIES');
        $popular = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=".$api_key."&language=en-US&page=".$page));

        //return response()->json($popular->results);
        $favorite_movies = Movie::where("user_id", $user->id)->select('id')->get();
        //print_r($user->id);
        //var_dump($favorite_movies);
        //return response()->json($favorite_movies);
        $fid = array();
        foreach($favorite_movies as $f){
            $fid[] = $f['id'];
        }
        if(!empty($favorite_movies)){
            foreach($popular->results as &$movie){
                if(in_array($movie->id, $fid)){
                    $movie->favorite = true;
                }
            }
        }
        return response()->json($popular, 201);
    }

    public function toggleFavorite(Request $request){
        $movie_id = $request->movie_id;
        $user = $request->user();
        $api_key = env('API_KEY_MOVIES');
        $movie = Movie::where(['id' => $movie_id, 'user_id' => $user->id])->first();
        $message = "";
        if(!isset($movie) || empty($movie) ){
            $movie_info = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."?api_key=".$api_key."&language=en-US"));
            $movieObject = new Movie([
                'id' => $movie_id,
                'user_id' => $user->id,
                'title' => $movie_info->title,
                'overview' => $movie_info->overview,
                'poster_path' => $movie_info->poster_path,
                'backdrop_path' => $movie_info->backdrop_path,
                'release_date' => $movie_info->release_date,
            ]);
            $movieObject->save();
            $message = "Successfully added movie to favorites!";
        } else {
           Movie::where(['id' => $movie_id, 'user_id' => $user->id])->delete();
           $message = "Successfully remove movie from favorites!";
        }
        return response()->json(
            [
                'message' => $message
            ], 
            201
        );
    }

    public function movieInfo(Request $request){
        $movie_id = $request->movie_id;
        $user = $request->user();
        $api_key = env('API_KEY_MOVIES');
        $favorite = Movie::where(["user_id" => $user->id, 'id'=> $movie_id])->count();
        $movie_info = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."?api_key=".$api_key."&language=en-US"));
        if($favorite > 0){
            $movie_info->favorite = true;
        }
        return response()->json(
            $movie_info,
            201
        );
    }
}
