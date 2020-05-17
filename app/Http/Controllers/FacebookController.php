<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function showFaceBook($accessToken)
    {
        try {
            $fb = self::getFacebookClient();
            $response = $fb->get('/me', $accessToken);
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        return view('facebook')->with('username', $me->getName())
            ->with('data', json_decode(\Storage::disk('local')->get('facebook.json')));
    }

    public function makePost(Request $request)
    {
        $input = $request->get('post');

        $posts = json_decode(\Storage::disk('local')->get('posts.json'));
        array_push($posts, [
            'text' => $input,
            'posted_at' =>  date('Y-m-d H:i:s')
        ]);
        \Storage::disk('local')->put("posts.json", json_encode($posts));
        return redirect('/');
    }

    private function getFacebookClient()
    {
        return new Facebook([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v7.0',
        ]);
    }

    public function showManageDataPage()
    {
        return view('facebook-data')->with('data', json_decode(\Storage::disk('local')->get('facebook.json')));
    }

    public function updateFacebookData(Request $request)
    {
        $data = [];
        $input = $request->all();

        $daily = [];
        $dailyKeys = ['read', 'like', 'comment', 'fans', 'share'];
        foreach ($dailyKeys as $dailyKey) {
            $key = 'daily-' . $dailyKey;
            $daily[$key] = $input[$key];
        }
        $data['daily'] = $daily;

        $yesterday = [];
        foreach ($dailyKeys as $dailyKey) {
            $key = 'yesterday-' . $dailyKey;
            $yesterday[$key] = $input[$key];
        }
        $data['yesterday'] = $yesterday;

        \Storage::disk('local')->put("facebook.json", json_encode($data));

        return redirect('data/facebook');
    }
}
