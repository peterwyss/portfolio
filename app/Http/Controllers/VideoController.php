<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Vimeo;
use App\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($page)
    {
        $lib = new Vimeo\Vimeo("bc74e6cf58d789c06f0eeebdb0181f14dbfb0239","JnQjoleeEePmovkdBE/TsB8BFe6VrjGnXxUACkdb2oK6FzpnzFCq3CpH7klLvOTIFYCTZU2mDQPxKNG9QiYTJHrAF8phX8Uz1pUkEZBeATgVPu/zAkrVw6S3QC42UJmS");
        $lib->setToken("d8d94266be45a2746d5a10791d38d5a4");

        $response = $lib->request('/me/videos',['per_page' => 4,'page' => $page], 'GET');
        $data = $response['body']['data'];
        $video_list = [];
         foreach($data as $i=>$vid){
            $video_id = substr($vid['uri'],strrpos($vid['uri'],"/")+1);

             $item = array(
                 
                 "name" => $vid['name'],
                 "video_id" => $video_id,
                 "description" => $vid['description'],
                 "visible" => false,
                 "position" => 1,
                 "page" => 1,
                 "pictures" => $vid['pictures'],
             );
                
            array_push($video_list,$item);
            
        }

        return view('/admin/video/create', compact('response', 'video_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Request: ' . $request);
        $video = new Video();
        $video->name = request('name');
        $video->video_id = request('video_id');
        $video->description = request('description');
        $video->visible = request('visible');
        $video->position = request('position');
        $video->page = request('page');
        $video->picture = request('picture');
        $video->save();

        /*
        return redirect()->action(
            'VideoController@create', ['page' => 1]
        )->with('status', 'Gespeichert');
        */
        return response()->json([
            'message' => 'Video gespeichert!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
