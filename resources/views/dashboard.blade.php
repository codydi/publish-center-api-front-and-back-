<html>
<body>

<p><a href="#" onClick="logInWithFacebook()" id="fb-login">Connect facebook</a></p>
<p><button onClick="showFacebookDashboard()" id="fb-dashboard">Facebook</button></p>
<p><button onClick="showTwitterDashboard()" id="fb-dashboard">Twitter</button></p>

<form method="post">
    @csrf
    <div>
        <label for="post">Create Post</label>
    </div>
    <div>
        <textarea id="post" name="post"></textarea>
    </div>
    <div>
        <button>Post</button>
    </div>
    @php
    $id = 0;
    @endphp
    @foreach($posts as $post)
        <p>
            <div>{{$post->text}}</div>
            <div>{{$post->posted_at}} <a href="{{url('delete/') . '/' .$id}}">Delete</a></div>
        </p>
    @endforeach
</form>

<script>
    if (localStorage.fb_expires_at && localStorage.fb_expires_at > new Date().getTime()) {
        document.getElementById('fb-login').style.visibility = "hidden";
    } else {
        document.getElementById('fb-dashboard').style.visibility = "hidden";
        localStorage.clear();
    }

    function showFacebookDashboard() {
        window.location.href = "{{url('/facebook')}}" + "/" + localStorage.fb_access_token;
    }

    function showTwitterDashboard() {
        window.location.href = "{{url('/twitter')}}" + "/" + localStorage.fb_access_token;
    }

    logInWithFacebook = function() {
        FB.login(function(response) {
            if (response.authResponse) {
                alert('You are logged in & cookie set!');

                localStorage.fb_access_token = response.authResponse.accessToken;
                localStorage.fb_expires_at = response.authResponse.expiresIn * 1000 + new Date().getTime();
                document.getElementById('fb-dashboard').style.visibility = "visible";
                document.getElementById('fb-login').style.visibility = "hidden";
                // Now you can redirect the user or do an AJAX request to
                // a PHP script that grabs the signed request from the cookie.
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
        });
        return false;
    };
    window.fbAsyncInit = function() {
        FB.init({
            appId: "{{env('FB_APP_ID')}}",
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.10'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>
</body>
</html>