<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

             $item = array(
                 "uri" => $vid['uri'],
                 "name" => $vid['name'],
                 "description" => $vid['description'],
                 "id" => "",
                 "exist" => false,
                 "pictures" => $vid['pictures'],
                 "link" => $vid['link']
             );


            $id = substr($vid['uri'],strrpos($vid['uri'],"/")+1);
            $video_exist = Video::where('video_id', $id)->get();
            $response['body']['data'][$i]['exist'] =  'false';
            if(count($video_exist) > 0){
                $response['body']['data'][$i]['exist'] =  'true';
                $response['body']['data'][$i]['database_id'] =  $video_exist[0]->id;
                $database_id = $video_exist[0]->id;

                $item['id'] = $video_exist[0]->id;
                $item['exist'] = true;


            }    
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
        $video = new Video();
        $video->name = request('title');
        $video->video_id = request('videoId');
        $video->description = request('description');
        $video->visible = request('visible');
        $video->position = request('position');
        $video->page = request('page');
        $video->picture = request('picture');
        $video->save();

        return redirect()->action(
            'VideoController@create', ['page' => 1]
        )->with('status', 'Gespeichert');

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
