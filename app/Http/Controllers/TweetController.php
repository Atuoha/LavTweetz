<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \Twitter;
use \File;

class TweetController extends Controller
{
    private $count = 20;
    private $format = 'array';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = Twitter.getUserTimeline(['count'=> $this->count, 'format'=> $this->format]);
$data = '';
        return view('index', compact('data'));
        // return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'message'=> 'required',
            'file'=> 'required',
        ]);

        $newTweet = ['status'=> $request->message];

        if(!empty($request->files('file'))){
            foreach($request->file as $key => $value){
                $uploadMedia = Twitter::UploadMedia(['media'=> File::get($value->getRealPath() )]);

                if(!empty($uploadMedia)){
                    $newTweet['media_ids'][$uploadMedia->media_id_string] = $uploadMedia->media_id_string;
                }
            }
            
        }

        
        $twitter = Twitter::postTweet($newTweet);
        Session::flash('tweet', 'Your tweet has been sent successfully :)');
        return redirect()->back();
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
