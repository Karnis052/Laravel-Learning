@extends('layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>
                       Add Posts 
                        
                    </h4>
                </div>
                <div class="card-body">
                    <form id ='createPostWithTags'>
                        @csrf
                        <div class="mb-3">
                            <label>User Id
                                <input type="text" name="user_id" class="form-control" value="{{old('user_id')}}"/>
                            </label>
                            
                        </div>

                        <div class="mb-3">
                            <label>Title
                                <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}"/>
                            </label>
                            
                        </div>

                        <div class="mb-3">
                            <label>Tags
                                <input type="text" name="tags" class="form-control" placeholder="tag1, tag2, tag3" value="{{old('tags')}}"/>
                            </label>
                            
                            
                        </div>
                        <div class="mb-3">
                            <label>Post Type
                                <select name="type" class="form-control">
                                    <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Text</option>
                                    <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Image</option>
                                    <option value="3" {{ old('type') == 3 ? 'selected' : '' }}>Audio</option>
                                    <option value="4" {{ old('type') == 4 ? 'selected' : '' }}>Video</option>
                                </select>
                            </label>
                                
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('createPostWithTags').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);  
        let  data = {}
        for (let [key, value] of formData.entries()) {  
            if (data[key]) {
                if (!Array.isArray(data[key])) {
                    data[key] = [data[key]];
                }
                data[key].push(value);
            } else {
                data[key] = value;
            }
        }
        data['tags'] = data['tags'].split(',').map(tag => tag.trim());
       
        axios.post('{{ url('api/posts/createWithTags')}}', data)
            .then(function(response){
                console.log(response.data);
                alert('Post successfully created!');
            })
            .catch(function(error){
                console.log(error);
                alert('An error occurred while creating the post.');

            }) 
    });
</script>

 

@endsection
