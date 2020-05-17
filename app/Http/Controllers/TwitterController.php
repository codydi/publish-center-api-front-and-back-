<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Twitter\Twitter;
use Twitter\Exceptions\TwitterResponseException;
use Twitter\Exceptions\TwitterSDKException;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function showFaceBook($accessToken)
    {
        try {
            $fb = self::getTwitterClient();
            $response = $fb->get('/me', $accessToken);
        } catch(TwitterResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(TwitterSDKException $e) {
            // When validation fails or other local issues
            echo 'Twitter SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        return view('facebook')->with('username', $me->getName())
            ->with('data', json_decode(\Storage::disk('local')->get('facebook.json')));
    }

    public function showTwitter($accessToken)
    {
        try {
            $fb = self::getTwitterClient();
            $response = $fb->get('/me', $accessToken);
        } catch(TwitterResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(TwitterSDKException $e) {
            // When validation fails or other local issues
            echo 'Twitter SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        return view('twitter')->with('username', $me->getName())
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

    public function deletePost($id)
    {
        $newPost = [];
        $posts = json_decode(\Storage::disk('local')->get('posts.json'));
        for($i = 0; $i < count($posts); $i++) {
            if($i != $id) {
                array_push($newPost, $posts[$i]);
            }
        }
        \Storage::disk('local')->put("posts.json", json_encode($newPost));
        return redirect('/');
    }

    private function getTwitterClient()
    {
        return new Twitter([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v7.0',
        ]);
    }

    public function showManageDataPage()
    {
        return view('facebook-data')->with('data', json_decode(\Storage::disk('local')->get('facebook.json')));
    }

    public function updateTwitterData(Request $request)
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
