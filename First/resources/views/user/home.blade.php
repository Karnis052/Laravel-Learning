{{-- @extends('layout')
@section('content')
<div class="container">
    <div class= "row jusitify-content-center">
        <div class="col-md-8">
            @foreach ($users as $user)
                <h4> {{$user->name}} </h4>
                <p> {{$user->email}} </p>
                <p> {{$user->password}} </p>
                @if($user->posts->isNotEmpty())
                    <ul>
                        @foreach ($user->posts as $post)
                            <li> {{$post->title}} </li>
                        @endforeach
                    </ul> 
                @endif     
            @endforeach
        </div>
    </div>
</div>
@endsection
 --}}


@extends('layout')
@section('content')
<div class="container">
    <h1>Fetch Data with Axios</h1>
    <button id="fetchDataBtn">Fetch User Data</button>
    <div id="userData"></div>
</div>

<script>
    
    document.getElementById('fetchDataBtn').addEventListener('click', function() {
        axios.get('/api/users')
            .then(function (response) {
                // handle success
                console.log(response)
                let users = response.data;
                let userDataDiv = document.getElementById('userData');
                userDataDiv.innerHTML = ''; // Clear previous data

                users.forEach(function(user) {
                    let userDiv = document.createElement('div');
                    userDiv.innerHTML = `<h4>${user.name}</h4><p>${user.email}</p>`;
                    userDataDiv.appendChild(userDiv);
                });
            })
            .catch(function (error) {
                // handle error
                console.error(error);
                alert('An error occurred while fetching data.');
            });
    });
</script>
@endsection
