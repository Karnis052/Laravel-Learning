@extends('layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Posts 
                        <a href="{{ url('posts/create')}}" class="btn btn-primary float-end"> Add post </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container mt-5" >
                        <div  id="allPosts"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        axios.get('api/posts')
            .then(function(response)
            {
                console.log(response.data);
                let posts = response.data;
                let allPostsDiv = document.getElementById('allPosts');
                allPostsDiv.innerHTML = '';
                posts.forEach(function(post)
                {
                    let postDiv = document.createElement('div');
                    postDiv.classList.add('row', 'mb-3');
                    
                    postDiv.innerHTML = `
                    <div class="col-md-4">
                        <h4>${post.title}</h4>
                    </div>
                    <div class="col-md-4">
                        <p><strong>User ID: </strong> ${post.user_id}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Type: </strong> ${post.type}</p>
                    </div>
                    `;
                    allPostsDiv.appendChild(postDiv);
                });
            })
            .catch(function(error){
                console.error(error);
                alert('An error occurred while fetching the posts.');
            });
    });
</script>

@endsection

{{-- axios.get('/api/posts')
    .then(function (response) {
        // handle success
        console.log(response.data);
    })
    .catch(function (error) {
        // handle error
        console.error(error);
    }); --}}
{{-- <div class="container">
    <h1>Post Data</h1>
    <div id="postData"></div>
</div>

<script>
    // Automatically fetch post data when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        axios.get('/api/posts')
            .then(function (response) {
                // handle success
                console.log(response);
                let posts = response.data;
                let postDataDiv = document.getElementById('postData');
                postDataDiv.innerHTML = ''; // Clear previous data

                posts.forEach(function(post) {
                    let postDiv = document.createElement('div');
                    postDiv.innerHTML = `<h4>${post.user_id}</h4><p>${post.title}</p>`;
                    postDataDiv.appendChild(postDiv);
                });
            })
            .catch(function (error) {
                console.error("Error details:", error);
                alert('An error occurred while fetching data.');
            });
    });
</script> --}}

